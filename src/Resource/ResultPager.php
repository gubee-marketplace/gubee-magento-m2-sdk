<?php

declare (strict_types = 1);

namespace Gubee\SDK\Resource;

use Closure;
use ErrorException;
use Exception;
use Generator;
use Gubee\SDK\Client;
use Psr\Http\Message\ResponseInterface;
use SebastianBergmann\ObjectEnumerator\InvalidArgumentException;

class ResultPager {
    /**
     * The default number of entries to request per page.
     *
     * @var int
     */
    public const PER_PAGE = 50;

    /**
     * The client to use for pagination.
     */
    private Client $client;

    /**
     * The number of entries to request per page.
     */
    public int $perPage;

    /**
     * The pagination result from the API.
     *
     * @var array<string,string>
     */
    private array $pagination;

    /**
     * Create a new result pager instance.
     *
     * @return void
     */
    public function __construct(Client $client, ?int $perPage = null) {
        if (null !== $perPage && ($perPage < 1 || $perPage > 100)) {
            throw new InvalidArgumentException(
                sprintf(
                    '%s::__construct(): Argument #2 ($perPage) must be between 1 and 100, or null',
                    self::class
                )
            );
        }

        $this->client = $client;
        $this->perPage = $perPage ?? self::PER_PAGE;
        $this->pagination = [];
    }

    /**
     * Fetch a single result from an api call.
     *
     * @param array       $parameters
     * @throws \Http\Client\Exception
     * @return array
     */
    public function fetch(AbstractResource $api, string $method, array $parameters = []): array {
        $result = self::bindPerPage($api, $this->perPage)->$method(...$parameters);

        if (!is_array($result)) {
            throw new Exception('Pagination of this endpoint is not supported.');
        }

        $this->postFetch();

        return $result;
    }

    /**
     * Fetch a specific number of pages
     *
     * @param array       $parameters
     */
    public function fetchPages(AbstractResource $api, string $method, int $pages, int $sizes = 50, array $parameters = []): array {
        $results = [];
        for ($i = 0; $i < $pages; $i++) {
            $results = array_merge(
                $results,
                $this->fetch($api, $method, array_merge($parameters, [$i, $sizes]))
            );
            if (!$this->hasNext()) {
                break;
            }
        }
        return $results;
    }

    /**
     * Fetch all results from an api call and execute a callback for each result.
     *
     * @param AbstractResource $api
     * @param string $method
     * @param array $parameters
     * @param callable $callback
     * @return array
     * @throws \Http\Client\Exception
     */
    public function fetchAllWithCallback(AbstractResource $api, string $method, callable $callback, array $parameters = []): void {
        $callback($this->fetch($api, $method, $parameters));
        while ($this->hasNext()) {
            $callback($this->fetch($api, $method, $parameters));
        }
    }

    /**
     * Fetch all results from an api call.
     *
     * @param array       $parameters
     * @throws \Http\Client\Exception
     * @return array
     */
    public function fetchAll(AbstractResource $api, string $method, array $parameters = []): array {
        return iterator_to_array($this->fetchAllLazy($api, $method, $parameters));
    }

    /**
     * Lazily fetch all results from an api call.
     *
     * @param array       $parameters
     * @throws \Http\Client\Exception
     */
    public function fetchAllLazy(AbstractResource $api, string $method, array $parameters = []): Generator {
        /** @var mixed $value */
        foreach ($this->fetch($api, $method, $parameters) as $value) {
            yield $value;
        }

        while ($this->hasNext()) {
            /** @var mixed $value */
            foreach ($this->fetchNext() as $value) {
                yield $value;
            }
        }
    }

    /**
     * Check to determine the availability of a next page.
     */
    public function hasNext(): bool {
        return isset($this->pagination['next']);
    }

    /**
     * Fetch the next page.
     *
     * @throws \Http\Client\Exception
     * @return array
     */
    public function fetchNext(): array {
        return $this->get('next');
    }

    /**
     * Check to determine the availability of a previous page.
     */
    public function hasPrevious(): bool {
        return isset($this->pagination['prev']);
    }

    /**
     * Fetch the previous page.
     *
     * @throws \Http\Client\Exception
     * @return array
     */
    public function fetchPrevious(): array {
        return $this->get('prev');
    }

    /**
     * Fetch the first page.
     *
     * @throws \Http\Client\Exception
     * @return array
     */
    public function fetchFirst(): array {
        return $this->get('first');
    }

    /**
     * Fetch the last page.
     *
     * @throws \Http\Client\Exception
     * @return array
     */
    public function fetchLast(): array {
        return $this->get('last');
    }

    /**
     * Refresh the pagination property.
     */
    private function postFetch(): void {
        $response = $this->client->getLastResponse();

        $this->pagination = null === $response ? [] : self::getPagination($response);
    }

    /**
     * Extract pagination URIs from Link header.
     *
     * @return array<string,string>
     */
    public static function getPagination(ResponseInterface $response): array {
        $links = json_decode(
            (string) $response->getBody(),
            true
        );

        if (!isset($links['_links'])) {
            throw new ErrorException(
                'The response does not have a "links" key.'
            );
        }

        return $links['_links'] ?: [];
    }

    /**
     * Get the value for a single header.
     */
    private static function getHeader(ResponseInterface $response, string $name): ?string {
        $headers = $response->getHeader($name);

        return array_shift($headers);
    }

    /**
     * @throws \Http\Client\Exception
     * @return array
     */
    private function get(string $key): array {
        $pagination = $this->pagination[$key] ?? null;
        if (null === $pagination) {
            return [];
        }

        // url decode $pagination['href']
        $href = parse_url($pagination['href']);
        $query = explode('&', $href['query']);
        $query = array_map(function ($item) {
            return explode('=', $item);
        }, $query);
        // add sort if doesn't exist
        $sort = false;
        foreach ($query as $item) {
            if ($item[0] == 'sort') {
                $sort = true;
            }
        }
        if (!$sort) {
            $query[] = ['sort', 'asc'];
        }
        // convert back to a url
        $query = array_map(function ($item) {
            return implode('=', $item);
        }, $query);
        $query = implode('&', $query);
        $pagination['href'] = $href['scheme'] . '://' . $href['host'] . $href['path'] . '?' . $query;
        $result = $this->client->getHttpClient()->get($pagination['href']);

        $content = json_decode((string) $result->getBody(), true);

        if (!is_array($content)) {
            throw new Exception(
                'Pagination of this endpoint is not supported.'
            );
        }

        $this->postFetch();

        return $content;
    }

    private static function bindPerPage(AbstractResource $api, int $perPage): AbstractResource {
        /** @var Closure(AbstractResource): AbstractResource */
        $closure = Closure::bind(static function (AbstractResource $api) use ($perPage): AbstractResource {
            $clone = clone $api;

            $clone->perPage = $perPage;

            return $clone;
        }, null, AbstractResource::class);

        return $closure($api);
    }
}
