<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use finfo;
use Gubee\SDK\Client;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use Psr\Http\Message\StreamInterface;
use RuntimeException;

use function array_filter;
use function array_keys;
use function array_map;
use function array_merge;
use function basename;
use function class_exists;
use function count;
use function fopen;
use function func_get_args;
use function implode;
use function is_array;
use function json_decode;
use function json_encode;
use function ltrim;
use function range;
use function rawurlencode;
use function restore_error_handler;
use function rtrim;
use function set_error_handler;
use function sprintf;

use const FILEINFO_MIME_TYPE;

abstract class AbstractResource
{
    public const URI_PREFIX = '/api/';

    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Sends a GET request to the specified URI with optional parameters and
     * headers.
     *
     * @param string $uri The URI to send the GET request to.
     * @param array<mixed, string> $params Optional parameters to include in the request.
     * @param array<mixed, string> $headers Optional headers to include in the request.
     * @return array<mixed, string> The response from the GET request.
     */
    protected function get(
        string $uri,
        array $params = [],
        array $headers = []
    ): array {
        $response = $this->client->getHttpClient()
            ->get(
                self::prepareUri($uri, $params),
                $headers
            );
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Sends a POST request to the specified URI with the given parameters,
     * headers, files, and URI parameters.
     *
     * @param string $uri The URI to send the request to.
     * @param array<mixed, mixed> $params The parameters to include in the request body.
     * @param array<mixed, mixed> $headers The headers to include in the request.
     * @param array<mixed, mixed> $files The files to include in the request body (if any).
     * @param array<mixed, mixed> $uriParams The parameters to include in the URI (if any).
     * @return array<string, mixed> The response from the server, parsed as a JSON array.
     */
    protected function post(
        string $uri,
        array $params = [],
        array $headers = [],
        array $files = [],
        array $uriParams = []
    ) {
        if (0 < count($files)) {
            $builder = $this->createMultipartStreamBuilder($params, $files);
            $body    = self::prepareMultipartBody($builder);
            $headers = self::addMultipartContentType($headers, $builder);
        } else {
            $body = self::prepareJsonBody($params);

            if (null !== $body) {
                $headers = self::addJsonContentType($headers);
            }
        }

        $response = $this->client->getHttpClient()->post(
            self::prepareUri($uri, $uriParams),
            $headers,
            $body
        );

        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Sends a PUT request to the specified URI with the given parameters,
     * headers, and files.
     *
     * If files are provided, a multipart request will be created. Otherwise,
     * a JSON request will be created.
     *
     * @param string $uri The URI to send the request to.
     * @param array<mixed, mixed> $params The parameters to include in the request.
     * @param array<mixed, mixed> $headers The headers to include in the request.
     * @param array<mixed, mixed> $files The files to include in the request (optional).
     * @return array<string, mixed> The response from the server, decoded as an associative array.
     */
    protected function put(
        string $uri,
        array $params = [],
        array $headers = [],
        array $files = []
    ) {
        if (0 < count($files)) {
            $builder = $this->createMultipartStreamBuilder($params, $files);
            $body    = self::prepareMultipartBody($builder);
            $headers = self::addMultipartContentType($headers, $builder);
        } else {
            $body = self::prepareJsonBody($params);

            if (null !== $body) {
                $headers = self::addJsonContentType($headers);
            }
        }

        $response = $this->client->getHttpClient()
            ->put(
                self::prepareUri($uri),
                $headers,
                $body ?: ''
            );

        return json_decode(
            (string) $response->getBody(),
            true
        );
    }

    /**
     * Sends a PATCH request to the specified URI with the given parameters,
     * headers, and files.
     *
     * @param string $uri The URI to send the PATCH request to.
     * @param array<mixed, mixed> $params The parameters to include in the request.
     * @param array<mixed, mixed> $headers The headers to include in the request.
     * @param array<mixed, mixed> $files The files to include in the request.
     * @return array<string, mixed> The response from the PATCH request, decoded as an
     * associative array.
     */
    protected function patch(
        string $uri,
        array $params = [],
        array $headers = [],
        array $files = []
    ) {
        if (0 < count($files)) {
            $builder = $this->createMultipartStreamBuilder(
                $params,
                $files
            );
            $body    = self::prepareMultipartBody(
                $builder
            );
            $headers = self::addMultipartContentType(
                $headers,
                $builder
            );
        } else {
            $body = self::prepareJsonBody(
                $params
            );

            if (
                null !== $body
            ) {
                $headers = self::addJsonContentType($headers);
            }
        }

        $response = $this->client->getHttpClient()
            ->patch(
                self::prepareUri($uri),
                $headers,
                $body ?? ''
            );

        return json_decode(
            (string) $response->getBody(),
            true
        );
    }

    /**
     * Adds the multipart content type to the headers array.
     *
     * @param array<string, string> $headers The original headers array.
     * @param MultipartStreamBuilder $builder The MultipartStreamBuilder
     * instance.
     * @return array<string, string> The updated headers array with the added
     * content type.
     */
    private static function addMultipartContentType(
        array $headers,
        MultipartStreamBuilder $builder
    ): array {
        $contentType = sprintf(
            '%s; boundary=%s',
            'applcation/octet-stream',
            $builder->getBoundary()
        );

        return array_merge(
            [
                'Content-Type' => $contentType,
            ],
            $headers
        );
    }

    /**
     * Prepares the multipart body for the request.
     *
     * @param MultipartStreamBuilder $builder The builder used to construct
     * the multipart body.
     * @return StreamInterface The prepared multipart body as a StreamInterface
     * object.
     */
    private static function prepareMultipartBody(
        MultipartStreamBuilder $builder
    ): StreamInterface {
        return $builder->build();
    }

    /**
     * @param  array<mixed, string> $files
     * @param  array<string, string> $headers
     * @return mixed
     */
    public function postForm(
        string $uri,
        string $params,
        array $files = [],
        array $headers = []
    ) {
        $request = Psr17FactoryDiscovery::findRequestFactory()->createRequest(
            'POST',
            self::prepareUri($uri)
        );

        $request = $request->withBody(
            Psr17FactoryDiscovery::findStreamFactory()
                ->createStream(
                    $params
                )
        );

        foreach ($headers as $key => $header) {
            $request = $request->withHeader($key, $header);
        }

        $response = $this->client->getHttpClient()->sendRequest($request);
        return json_decode((string) $response->getBody(), true);
    }

    /**
     * Sends a DELETE request to the specified URI with optional parameters
     * and headers.
     *
     * @param string $uri The URI to send the DELETE request to.
     * @param array<mixed, string> $params An array of parameters to include in the request.
     * @param array<mixed, string> $headers An array of headers to include in the request.
     * @return array<string, string> The response from the DELETE request, parsed as a JSON
     * array.
     */
    protected function delete(
        string $uri,
        array $params = [],
        array $headers = []
    ) {
        $body = self::prepareJsonBody($params);

        if (null !== $body) {
            $headers = self::addJsonContentType($headers);
        }

        $response = $this->client->getHttpClient()->delete(
            self::prepareUri($uri),
            $headers,
            $body ?? ''
        );

        return json_decode(
            (string) $response->getBody(),
            true
        );
    }

    /**
     * Prepares the URI by appending the URI prefix and query parameters.
     *
     * @param string $uri The URI to be prepared.
     * @param array<mixed, string> $query The query parameters to be appended to the URI.
     * @return string The prepared URI.
     */
    protected static function prepareUri(string $uri, array $query = []): string
    {
        $query = array_filter(
            $query,
            function ($value): bool {
                return null !== $value;
            }
        );

        $result = sprintf(
            '%s%s%s',
            self::URI_PREFIX,
            ltrim($uri, '/'),
            self::build($query)
        );
        return rtrim($result, "?");
    }

    /**
     * Builds a query string from an array of query parameters.
     *
     * @param array<mixed, string> $query The array of query parameters.
     * @return string The generated query string.
     */
    public static function build(array $query): string
    {
        return sprintf(
            '?%s',
            implode(
                '&',
                array_map(function ($value, $key): string {
                    return self::encode($value, $key);
                }, $query, array_keys($query))
            )
        );
    }

    /**
     * Encodes the given query parameters into a URL-encoded string.
     *
     * @param mixed $query The query parameters to encode.
     * @param string $prefix The prefix to use for each parameter.
     * @return string The URL-encoded query string.
     */
    private static function encode($query, $prefix): string
    {
        if (! is_array($query)) {
            return self::rawurlencode(
                $prefix
            ) . '=' . self::rawurlencode($query);
        }

        $isList = self::isList($query);

        return implode(
            '&',
            array_map(
                function ($value, $key) use ($prefix, $isList): string {
                    $prefix = $isList
                        ? $prefix . '[]'
                        : $prefix . '[' . $key . ']';

                    return self::encode($value, $prefix);
                },
                $query,
                array_keys($query)
            )
        );
    }

    /**
     * Encodes a value for use in a URL.
     *
     * @param mixed $value The value to be encoded.
     * @return string The encoded value.
     */
    private static function rawurlencode($value): string
    {
        if (false === $value) {
            return '0';
        }

        return rawurlencode((string) $value);
    }

    /**
     * Checks if an array is a list.
     *
     * @param array<mixed, string> $query The array to check.
     * @return bool Returns true if the array is a list, false otherwise.
     */
    private static function isList(array $query): bool
    {
        if (0 === count($query) || ! isset($query[0])) {
            return false;
        }

        return array_keys($query) === range(
            0,
            count($query) - 1
        );
    }

    /**
     * Prepares the JSON body by filtering out null values from the given
     * parameters array and encoding it as JSON.
     *
     * @param array<mixed, string> $params The parameters array to be filtered and encoded.
     * @return string|null The JSON-encoded string of the filtered parameters
     * array, or null if the array is empty.
     */
    private static function prepareJsonBody(array $params): ?string
    {
        $params = array_filter(
            $params,
            function ($value): bool {
                return null !== $value;
            }
        );

        if (0 === count($params)) {
            return null;
        }

        return json_encode($params);
    }

    /**
     * Adds the 'Content-Type' header with the value 'application/json' to the
     * given array of headers.
     *
     * @param array<string, string> $headers The array of headers to add the
     * 'Content-Type' header to.
     * @return array<string, string> The updated array of headers with the
     * 'Content-Type' header added.
     */
    private static function addJsonContentType(array $headers): array
    {
        return array_merge(
            [
                'Content-Type' => 'application/json',
            ],
            $headers
        );
    }

    /**
     * Creates a MultipartStreamBuilder object with the given parameters and
     * files.
     *
     * @param array<mixed, string> $params An array of parameters to be added to
     * the multipart stream.
     * @param array<mixed, string> $files An array of files to be added to the
     * multipart stream.
     * @return MultipartStreamBuilder The created MultipartStreamBuilder object.
     */
    private function createMultipartStreamBuilder(
        array $params = [],
        array $files = []
    ): MultipartStreamBuilder {
        $builder = new MultipartStreamBuilder(
            $this->client->getStreamFactory()
        );

        foreach ($params as $name => $value) {
            $builder->addResource($name, $value);
        }

        foreach ($files as $name => $file) {
            $builder->addResource($name, self::tryFopen($file, 'r'), [
                'headers'  => [
                    'Content-Type' => self::guessFileContentType($file),
                ],
                'filename' => basename($file),
            ]);
        }

        return $builder;
    }

    /**
     * Guesses the content type of a file based on its extension.
     *
     * @param string $file The path to the file.
     * @return string The guessed content type of the file.
     */
    private static function guessFileContentType(string $file): string
    {
        if (! class_exists(finfo::class, false)) {
            return 'application/octet-stream';
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $type  = $finfo->file($file);

        return false !== $type ? $type : 'application/octet-stream';
    }

    /**
     * Tries to open a file with the specified mode.
     *
     * @param string $filename The name of the file to open.
     * @param string $mode The mode in which to open the file.
     * @return resource|false Returns a file pointer resource on success, or
     * false on failure.
     * @throws RuntimeException If unable to open the file.
     */
    private static function tryFopen(string $filename, string $mode)
    {
        $ex = null;
        set_error_handler(
            function () use ($filename, $mode, &$ex): bool {
                $ex = new RuntimeException(
                    sprintf(
                        'Unable to open %s using mode %s: %s',
                        $filename,
                        $mode,
                        func_get_args()[1]
                    )
                );

                return true;
            }
        );

        $handle = fopen($filename, $mode);
        restore_error_handler();

        if (null !== $ex) {
            throw $ex;
        }

        return $handle;
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
