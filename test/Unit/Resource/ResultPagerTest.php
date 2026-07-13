<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Resource;

use ErrorException;
use Exception;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Client;
use Gubee\SDK\Library\HttpClient\Builder;
use Gubee\SDK\Resource\AbstractResource;
use Gubee\SDK\Resource\ResultPager;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use SebastianBergmann\ObjectEnumerator\InvalidArgumentException;

use function array_shift;
use function iterator_to_array;
use function json_encode;

final class ResultPagerTest extends TestCase
{
    public function testConstructorRejectsPerPageOutsideAllowedRange(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ResultPager($this->newPagerClient(), 0);
    }

    public function testFetchBindsConfiguredPerPageOnClonedResource(): void
    {
        $pager             = new ResultPager($this->newPagerClient(), 25);
        $resource          = new PagerTestResource($this->newPagerClient());
        $resource->perPage = 0;

        $result = $pager->fetch($resource, 'pageAwareList');

        self::assertSame([25], $result);
        self::assertSame(0, $resource->perPage);
    }

    public function testFetchRejectsNonArrayResults(): void
    {
        $pager    = new ResultPager($this->newPagerClient(), 25);
        $resource = new PagerTestResource($this->newPagerClient());

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Pagination of this endpoint is not supported.');

        $pager->fetch($resource, 'scalarResult');
    }

    public function testFetchPagesMergesPagesUntilNoNextLink(): void
    {
        $client   = $this->newPagerClient();
        $resource = new PagerFlowResource($client);
        $pager    = new ResultPager($client, 10);

        $result = $pager->fetchPages($resource, 'pagedValues', 5, 10);

        self::assertSame([1, 2, 3], $result);
    }

    public function testFetchAllWithCallbackAndFetchAllLazyIterateEveryValue(): void
    {
        $client   = $this->newPagerClient();
        $resource = new PagerFlowResource($client);
        $pager    = new ResultPager($client, 10);
        $chunks   = [];

        $pager->fetchAllWithCallback($resource, 'pagedValues', static function (array $chunk) use (&$chunks): void {
            $chunks[] = $chunk;
        });

        self::assertSame([[1, 2], [3]], $chunks);

        $lazyPagerClient = $this->newPagerClient();
        $lazyPagerClient->httpClient->queueWithSyntheticLastResponse(
            'https://example.test/api/items?page=1&sort=asc',
            [3],
            ['_links' => []]
        );
        $lazyResource = new PagerFlowResource($lazyPagerClient);
        $lazyPager    = new ResultPager($lazyPagerClient, 10);

        self::assertSame([1, 2, 3], iterator_to_array($lazyPager->fetchAllLazy($lazyResource, 'pagedValues'), false));

        $singlePageClient   = $this->newPagerClient();
        $singlePageResource = new PagerFlowResource($singlePageClient, false);
        $singlePagePager    = new ResultPager($singlePageClient, 10);

        self::assertSame([1, 2], $singlePagePager->fetchAll($singlePageResource, 'pagedValues'));
    }

    public function testPaginationNavigationMethodsUseStoredLinks(): void
    {
        $client = $this->newPagerClient();
        $client->httpClient->queue('https://example.test/api/items?page=1&sort=asc', ['items' => [2], '_links' => ['prev' => ['href' => 'https://example.test/api/items?page=0']]]);
        $client->httpClient->queue('https://example.test/api/items?page=0&sort=asc', ['items' => [1], '_links' => ['next' => ['href' => 'https://example.test/api/items?page=1']]]);
        $client->httpClient->queue('https://example.test/api/items?page=0&sort=asc', ['items' => [1], '_links' => ['next' => ['href' => 'https://example.test/api/items?page=1']]]);
        $client->httpClient->queue('https://example.test/api/items?page=2&sort=asc', ['items' => [3], '_links' => []]);

        $pager    = new ResultPager($client, 10);
        $resource = new PagerFlowResource($client);

        $pager->fetch($resource, 'pagedNavigationSeed');

        self::assertTrue($pager->hasNext());
        self::assertTrue($pager->hasPrevious());
        self::assertSame(['items' => [2], '_links' => ['prev' => ['href' => 'https://example.test/api/items?page=0']]], $pager->fetchNext());
        self::assertTrue($pager->hasPrevious());
        self::assertSame(['items' => [1], '_links' => ['next' => ['href' => 'https://example.test/api/items?page=1']]], $pager->fetchPrevious());

        $pager->fetch($resource, 'pagedNavigationSeed');
        self::assertSame(['items' => [1], '_links' => ['next' => ['href' => 'https://example.test/api/items?page=1']]], $pager->fetchFirst());

        $pager->fetch($resource, 'pagedNavigationSeed');
        self::assertSame(['items' => [3], '_links' => []], $pager->fetchLast());
        self::assertSame('https://example.test/api/items?page=2&sort=asc', $client->httpClient->lastUri);
    }

    public function testFetchNextReturnsEmptyArrayWhenLinkIsMissing(): void
    {
        $pager = new ResultPager($this->newPagerClient(), 10);

        self::assertSame([], $pager->fetchNext());
        self::assertFalse($pager->hasNext());
        self::assertFalse($pager->hasPrevious());
    }

    public function testGetPaginationThrowsWhenLinksAreMissing(): void
    {
        $response = new Response(200, ['Content-Type' => 'application/json'], (string) json_encode(['items' => []]));

        $this->expectException(ErrorException::class);
        $this->expectExceptionMessage('The response does not have a "links" key.');

        ResultPager::getPagination($response);
    }

    public function testGetPaginationReturnsLinks(): void
    {
        $response = new Response(200, [], (string) json_encode(['_links' => ['next' => ['href' => 'https://example.test/api/items?page=1']]]));

        self::assertSame(['next' => ['href' => 'https://example.test/api/items?page=1']], ResultPager::getPagination($response));
    }

    public function testFetchNextThrowsWhenLinkedResponseIsNotAnArray(): void
    {
        $client = $this->newPagerClient();
        $client->httpClient->queueRaw('https://example.test/api/items?page=1&sort=asc', '"oops"');

        $pager    = new ResultPager($client, 10);
        $resource = new PagerFlowResource($client);
        $pager->fetch($resource, 'pagedWithNextOnly');

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Pagination of this endpoint is not supported.');

        $pager->fetchNext();
    }

    public function testFetchNextKeepsExistingSortParameter(): void
    {
        $client = $this->newPagerClient();
        $client->httpClient->queue(
            'https://example.test/api/items?page=1&sort=desc',
            ['items' => [2], '_links' => []]
        );

        $pager    = new ResultPager($client, 10);
        $resource = new PagerSortedLinkResource($client);
        $pager->fetch($resource, 'pagedWithSortedNext');

        self::assertSame(['items' => [2], '_links' => []], $pager->fetchNext());
        self::assertSame('https://example.test/api/items?page=1&sort=desc', $client->httpClient->lastUri);
    }

    private function newPagerClient(): PagerClient
    {
        return new PagerClient();
    }
}

final class PagerFlowResource extends AbstractResource
{
    private PagerClient $pagerClient;
    private bool $includeNextLink;

    public function __construct(PagerClient $client, bool $includeNextLink = true)
    {
        parent::__construct($client);
        $this->pagerClient     = $client;
        $this->includeNextLink = $includeNextLink;
    }

    public function pagedValues(int $page = 0, int $size = 50): array
    {
        if ($page === 0 && $this->pagerClient->pageIndex() > 0) {
            $page = $this->pagerClient->pageIndex();
        }

        $pages = [
            [1, 2],
            [3],
        ];

        $links = $page === 0 && $this->includeNextLink
            ? ['next' => ['href' => 'https://example.test/api/items?page=1']]
            : [];

        $this->pagerClient->advancePageIndex();

        $this->pagerClient->setSyntheticLastResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode(['_links' => $links]))
        );

        return $pages[$page] ?? [];
    }

    public function pagedNavigationSeed(): array
    {
        $this->pagerClient->setSyntheticLastResponse(
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                (string) json_encode([
                    '_links' => [
                        'next'  => ['href' => 'https://example.test/api/items?page=1'],
                        'prev'  => ['href' => 'https://example.test/api/items?page=0'],
                        'first' => ['href' => 'https://example.test/api/items?page=0'],
                        'last'  => ['href' => 'https://example.test/api/items?page=2'],
                    ],
                ])
            )
        );

        return ['seed'];
    }

    public function pagedWithNextOnly(): array
    {
        $this->pagerClient->setSyntheticLastResponse(
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                (string) json_encode(['_links' => ['next' => ['href' => 'https://example.test/api/items?page=1']]])
            )
        );

        return ['seed'];
    }
}

final class PagerSortedLinkResource extends AbstractResource
{
    private PagerClient $pagerClient;

    public function __construct(PagerClient $client)
    {
        parent::__construct($client);
        $this->pagerClient = $client;
    }

    public function pagedWithSortedNext(): array
    {
        $this->pagerClient->setSyntheticLastResponse(
            new Response(
                200,
                ['Content-Type' => 'application/json'],
                (string) json_encode(['_links' => ['next' => ['href' => 'https://example.test/api/items?page=1&sort=desc']]])
            )
        );

        return ['seed'];
    }
}

final class PagerTestResource extends AbstractResource
{
    public function pageAwareList(): array
    {
        return [$this->perPage];
    }

    public function scalarResult(): string
    {
        return 'nope';
    }
}

final class PagerNullServiceProvider implements ServiceProviderInterface
{
    public function get($id)
    {
        throw new class ('Not implemented for this test.') extends RuntimeException implements NotFoundExceptionInterface {
        };
    }

    public function has($id): bool
    {
        return false;
    }

    public function create(string $type, array $arguments = [])
    {
        throw new RuntimeException('Not used in this test.');
    }
}

final class PagerClient extends Client
{
    public PagerHttpClient $httpClient;
    private ?ResponseInterface $lastResponse = null;
    private int $pageIndex                   = 0;

    public function __construct()
    {
        $this->httpClient = new PagerHttpClient();
        parent::__construct(new PagerNullServiceProvider(), null, new Builder($this->httpClient), 0);
        $this->setUrl('https://example.test');
        $this->httpClient->bindClient($this);
    }

    public function setSyntheticLastResponse(ResponseInterface $response): void
    {
        $this->lastResponse = $response;
    }

    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    public function pageIndex(): int
    {
        return $this->pageIndex;
    }

    public function advancePageIndex(): void
    {
        $this->pageIndex++;
    }
}

final class PagerHttpClient implements ClientInterface
{
    private ?PagerClient $client = null;
    /** @var array<string, list<array{response:ResponseInterface,last:ResponseInterface}>> */
    private array $responses = [];
    public ?string $lastUri  = null;

    public function bindClient(PagerClient $client): void
    {
        $this->client = $client;
    }

    /**
     * @param array<string, mixed> $payload
     */
    public function queue(string $uri, array $payload): void
    {
        $response                = new Response(200, ['Content-Type' => 'application/json'], (string) json_encode($payload));
        $this->responses[$uri][] = ['response' => $response, 'last' => $response];
    }

    public function queueRaw(string $uri, string $payload): void
    {
        $response                = new Response(200, ['Content-Type' => 'application/json'], $payload);
        $this->responses[$uri][] = ['response' => $response, 'last' => $response];
    }

    /**
     * @param array<mixed, mixed> $payload
     * @param array<mixed, mixed> $lastResponsePayload
     */
    public function queueWithSyntheticLastResponse(string $uri, array $payload, array $lastResponsePayload): void
    {
        $response                = new Response(200, ['Content-Type' => 'application/json'], (string) json_encode($payload));
        $last                    = new Response(200, ['Content-Type' => 'application/json'], (string) json_encode($lastResponsePayload));
        $this->responses[$uri][] = ['response' => $response, 'last' => $last];
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $uri           = (string) $request->getUri();
        $this->lastUri = $uri;

        if (! isset($this->responses[$uri][0])) {
            throw new RuntimeException('No queued response for ' . $uri);
        }

        $entry = array_shift($this->responses[$uri]);
        $this->client?->setSyntheticLastResponse($entry['last']);

        return $entry['response'];
    }
}
