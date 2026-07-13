<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Resource;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Client;
use Gubee\SDK\Library\HttpClient\Builder;
use Gubee\SDK\Resource\AbstractResource;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ReflectionMethod;
use RuntimeException;
use stdClass;

use function file_put_contents;
use function json_decode;
use function json_encode;
use function restore_error_handler;
use function set_error_handler;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;

final class AbstractResourceTest extends TestCase
{
    public function testGetBuildsPrefixedUriAndNestedQueryString(): void
    {
        $resource = $this->newResource(['ok' => true]);

        $response = $resource->callGet('/items', [
            'sellerId' => 'seller-1',
            'flags'    => ['a', 'b'],
            'pageable' => ['page' => 2, 'size' => 25],
            'skip'     => null,
        ]);

        self::assertSame(['ok' => true], $response);
        self::assertSame('GET', $resource->httpClient->lastRequest?->getMethod());
        self::assertSame(
            '/api/items?sellerId=seller-1&flags%5B%5D=a&flags%5B%5D=b&pageable%5Bpage%5D=2&pageable%5Bsize%5D=25',
            $resource->httpClient->lastRequest?->getUri()->getPath() . '?' . $resource->httpClient->lastRequest?->getUri()->getQuery()
        );
    }

    public function testGetEncodesFalseAsZero(): void
    {
        $resource = $this->newResource(['ok' => true]);

        $resource->callGet('/items', ['active' => false]);

        self::assertSame('/api/items?active=0', $resource->httpClient->lastRequest?->getUri()->getPath() . '?' . $resource->httpClient->lastRequest?->getUri()->getQuery());
    }

    public function testGetReturnsDecodedJsonScalarWhenBodyIsAJsonString(): void
    {
        $resource = $this->newResource('https://cdn.example.test/file.pdf');

        self::assertSame('https://cdn.example.test/file.pdf', $resource->callGet('/items'));
    }

    public function testGetReturnsRawBodyForTextResponses(): void
    {
        $resource = $this->newResource('https://cdn.example.test/file.pdf', 'text/plain');

        self::assertSame('https://cdn.example.test/file.pdf', $resource->callGet('/items'));
    }

    public function testPostSendsJsonBodyAndContentType(): void
    {
        $resource = $this->newResource(['created' => true]);

        $response = $resource->callPost('/items', ['name' => 'Test', 'active' => true, 'skip' => null]);

        self::assertSame(['created' => true], $response);
        self::assertSame('POST', $resource->httpClient->lastRequest?->getMethod());
        self::assertSame('/api/items', $resource->httpClient->lastRequest?->getUri()->getPath());
        self::assertSame('application/json', $resource->httpClient->lastRequest?->getHeaderLine('Content-Type'));
        self::assertSame(
            ['name' => 'Test', 'active' => true],
            json_decode((string) $resource->httpClient->lastRequest?->getBody(), true)
        );
    }

    public function testPutSendsJsonBody(): void
    {
        $resource = $this->newResource(['updated' => true]);

        $response = $resource->callPut('/items/1', ['qty' => 3]);

        self::assertSame(['updated' => true], $response);
        self::assertSame('PUT', $resource->httpClient->lastRequest?->getMethod());
        self::assertSame('/api/items/1', $resource->httpClient->lastRequest?->getUri()->getPath());
        self::assertSame(['qty' => 3], json_decode((string) $resource->httpClient->lastRequest?->getBody(), true));
    }

    public function testPatchSendsJsonBody(): void
    {
        $resource = $this->newResource(['patched' => true]);

        $response = $resource->callPatch('/items/1', ['name' => 'Renamed']);

        self::assertSame(['patched' => true], $response);
        self::assertSame('PATCH', $resource->httpClient->lastRequest?->getMethod());
        self::assertSame('/api/items/1', $resource->httpClient->lastRequest?->getUri()->getPath());
        self::assertSame(['name' => 'Renamed'], json_decode((string) $resource->httpClient->lastRequest?->getBody(), true));
    }

    public function testDeleteSendsJsonBodyWhenPayloadExists(): void
    {
        $resource = $this->newResource(['deleted' => true]);

        $response = $resource->callDelete('/items/1', ['force' => true]);

        self::assertSame(['deleted' => true], $response);
        self::assertSame('DELETE', $resource->httpClient->lastRequest?->getMethod());
        self::assertSame('application/json', $resource->httpClient->lastRequest?->getHeaderLine('Content-Type'));
        self::assertSame(['force' => true], json_decode((string) $resource->httpClient->lastRequest?->getBody(), true));
    }

    public function testPostFormSendsExplicitHeaders(): void
    {
        $resource = $this->newResource(['ok' => true]);

        $response = $resource->callPostForm('/items/form', 'plain-body', ['Accept' => 'application/hal+json']);

        self::assertSame(['ok' => true], $response);
        self::assertSame('POST', $resource->httpClient->lastRequest?->getMethod());
        self::assertSame('application/hal+json', $resource->httpClient->lastRequest?->getHeaderLine('Accept'));
        self::assertSame('plain-body', (string) $resource->httpClient->lastRequest?->getBody());
    }

    public function testPostWithFilesUsesMultipartBody(): void
    {
        $resource = $this->newResource(['uploaded' => true]);
        $file     = tempnam(sys_get_temp_dir(), 'sdk-resource-');
        file_put_contents($file, 'payload');

        try {
            $response = $resource->callPost('/items/upload', ['name' => 'test'], [], ['asset' => $file]);
        } finally {
            unlink($file);
        }

        self::assertSame(['uploaded' => true], $response);
        self::assertStringContainsString('applcation/octet-stream; boundary=', $resource->httpClient->lastRequest?->getHeaderLine('Content-Type'));
        self::assertStringContainsString('payload', (string) $resource->httpClient->lastRequest?->getBody());
    }

    public function testPutAndPatchWithFilesUseMultipartBody(): void
    {
        $resource = $this->newResource(['ok' => true]);
        $file     = tempnam(sys_get_temp_dir(), 'sdk-resource-');
        file_put_contents($file, 'payload');

        try {
            $resource->callPut('/items/upload', ['name' => 'test'], [], ['asset' => $file]);
            self::assertSame('PUT', $resource->httpClient->lastRequest?->getMethod());
            self::assertStringContainsString('applcation/octet-stream; boundary=', $resource->httpClient->lastRequest?->getHeaderLine('Content-Type'));

            $resource->callPatch('/items/upload', ['name' => 'test'], [], ['asset' => $file]);
            self::assertSame('PATCH', $resource->httpClient->lastRequest?->getMethod());
            self::assertStringContainsString('applcation/octet-stream; boundary=', $resource->httpClient->lastRequest?->getHeaderLine('Content-Type'));
        } finally {
            unlink($file);
        }
    }

    public function testHydrateCollectionLeavesScalarsUntouched(): void
    {
        $serviceProvider = new NullServiceProviderWithCreateResult(new stdClass());
        $httpClient      = new RecordingHttpClient(new Response(200, ['Content-Type' => 'application/json'], (string) json_encode(['ok' => true])));
        $client          = new Client($serviceProvider, null, new Builder($httpClient), 0);
        $client->setUrl('https://example.test');
        $resource = new TestAbstractResource($client, $httpClient);

        $result = $resource->callHydrateCollection(stdClass::class, ['a' => ['id' => 1], 'b' => 'skip']);

        self::assertInstanceOf(stdClass::class, $result['a']);
        self::assertSame('skip', $result['b']);
    }

    public function testTryFopenThrowsReadableRuntimeExceptionForMissingFile(): void
    {
        $method = new ReflectionMethod(AbstractResource::class, 'tryFopen');
        $method->setAccessible(true);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to open');

        $method->invoke(null, '/definitely/missing/file.txt', 'r');
    }

    public function testGuessFileContentTypeFallsBackWhenFinfoCannotReadFile(): void
    {
        $method = new ReflectionMethod(AbstractResource::class, 'guessFileContentType');
        $method->setAccessible(true);

        set_error_handler(static fn(): bool => true);

        try {
            self::assertSame('application/octet-stream', $method->invoke(null, '/definitely/missing/file.txt'));
        } finally {
            restore_error_handler();
        }
    }

    private function newResource($responseBody, string $contentType = 'application/json'): TestAbstractResource
    {
        $body = $contentType === 'application/json'
            ? (string) json_encode($responseBody)
            : (string) $responseBody;

        $httpClient = new RecordingHttpClient(
            new Response(
                200,
                ['Content-Type' => $contentType],
                $body
            )
        );

        $client = new Client(new NullServiceProvider(), null, new Builder($httpClient), 0);
        $client->setUrl('https://example.test');

        return new TestAbstractResource($client, $httpClient);
    }
}

final class TestAbstractResource extends AbstractResource
{
    public RecordingHttpClient $httpClient;

    public function __construct(Client $client, RecordingHttpClient $httpClient)
    {
        parent::__construct($client);
        $this->httpClient = $httpClient;
    }

    public function callGet(string $uri, array $params = [], array $headers = [])
    {
        return $this->get($uri, $params, $headers);
    }

    public function callPost(string $uri, array $params = [], array $headers = [], array $files = [])
    {
        return $this->post($uri, $params, $headers, $files);
    }

    public function callPostForm(string $uri, string $params, array $headers = [])
    {
        return $this->postForm($uri, $params, [], $headers);
    }

    public function callPut(string $uri, array $params = [], array $headers = [], array $files = [])
    {
        return $this->put($uri, $params, $headers, $files);
    }

    public function callPatch(string $uri, array $params = [], array $headers = [], array $files = [])
    {
        return $this->patch($uri, $params, $headers, $files);
    }

    public function callDelete(string $uri, array $params = [], array $headers = [])
    {
        return $this->delete($uri, $params, $headers);
    }

    public function callHydrateCollection(string $modelClass, array $response): array
    {
        return $this->hydrateCollection($modelClass, $response);
    }
}

final class RecordingHttpClient implements ClientInterface
{
    public ?RequestInterface $lastRequest = null;
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->lastRequest = $request;

        return $this->response;
    }
}

class NullServiceProvider implements ServiceProviderInterface
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

final class NullServiceProviderWithCreateResult extends NullServiceProvider
{
    private object $result;

    public function __construct(object $result)
    {
        $this->result = $result;
    }

    public function create(string $type, array $arguments = [])
    {
        return $this->result;
    }
}
