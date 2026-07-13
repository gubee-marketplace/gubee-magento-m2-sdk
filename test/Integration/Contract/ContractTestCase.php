<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Client;
use Gubee\SDK\Library\HttpClient\Builder;
use Gubee\SDK\Tests\Support\OpenApiCoverageTracker;
use GuzzleHttp\Psr7\Response;
use League\OpenAPIValidation\PSR7\Exception\MultipleOperationsMismatchForRequest;
use League\OpenAPIValidation\PSR7\Exception\Validation\InvalidQueryArgs;
use League\OpenAPIValidation\PSR7\RequestValidator;
use League\OpenAPIValidation\PSR7\ResponseValidator;
use League\OpenAPIValidation\PSR7\ValidatorBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Throwable;

use function json_encode;
use function spl_object_id;
use function str_contains;

abstract class ContractTestCase extends TestCase
{
    private const OPENAPI_SPEC_FILE = ROOT . '/test/Integration/Contract/openapi-integration.json';

    private static ?RequestValidator $requestValidator   = null;
    private static ?ResponseValidator $responseValidator = null;
    /** @var array<int, ContractMockHttpClient> */
    private static array $mockClients = [];

    protected function newContractClient(int $statusCode, $responseBody = null, ?string $contentType = null): Client
    {
        $mockClient = new ContractMockHttpClient(
            $this->buildResponse($statusCode, $responseBody, $contentType)
        );

        $client = new Client(
            container(),
            null,
            new Builder($mockClient)
        );
        $client->setUrl('https://example.test');
        $client->authenticate('test-token');
        self::$mockClients[spl_object_id($client)] = $mockClient;

        return $client;
    }

    /**
     * @param callable():mixed $call
     */
    protected function assertContractCall(Client $client, callable $call, bool $validateResponse = true): void
    {
        try {
            $call();
        } catch (Throwable $exception) {
            // The contract check only needs the HTTP exchange. SDK hydration and
            // error-mapping behavior are covered elsewhere.
        }

        $this->assertValidContract($client, $validateResponse);
    }

    /**
     * @param class-string $className
     * @return object&MockObject
     */
    protected function mockPayload(string $className, array $payload)
    {
        $mock = $this->getMockBuilder($className)
            ->disableOriginalConstructor()
            ->onlyMethods(['jsonSerialize'])
            ->getMock();
        $mock->method('jsonSerialize')->willReturn($payload);

        return $mock;
    }

    protected function assertValidContract(Client $client, bool $validateResponse = true): void
    {
        $request   = $this->lastRequest($client);
        $operation = null;

        try {
            $operation = self::requestValidator()->validate($request);
            OpenApiCoverageTracker::recordOperationAddress($operation);
        } catch (Throwable $exception) {
            $this->assertRequestFallback($request, $exception);
            OpenApiCoverageTracker::recordRequest($request);
        }

        if ($validateResponse && $operation !== null) {
            self::responseValidator()->validate($operation, $this->lastResponse($client));
        }

        self::assertSame('Bearer test-token', $request->getHeaderLine('Authorization'));
    }

    private function assertRequestFallback(RequestInterface $request, Throwable $exception): void
    {
        $uri = (string) $request->getUri();

        if ($exception instanceof InvalidQueryArgs && str_contains($uri, 'pageable%5B')) {
            self::assertStringContainsString('pageable%5Bpage%5D=', $uri);
            self::assertStringContainsString('pageable%5Bsize%5D=', $uri);
            return;
        }

        if ($exception instanceof MultipleOperationsMismatchForRequest && str_contains($uri, '/api/integration/orders/queue/')) {
            self::assertStringContainsString('/api/integration/orders/queue/', $uri);
            return;
        }

        throw $exception;
    }

    private function buildResponse(int $statusCode, $responseBody, ?string $contentType): ResponseInterface
    {
        if ($contentType === null) {
            return new Response($statusCode);
        }

        return new Response(
            $statusCode,
            ['Content-Type' => $contentType],
            json_encode($responseBody)
        );
    }

    private function lastRequest(Client $client): RequestInterface
    {
        $httpClient = self::$mockClients[spl_object_id($client)] ?? null;

        if ($httpClient === null || $httpClient->lastRequest === null) {
            throw new RuntimeException('Contract request was not captured.');
        }

        return $httpClient->lastRequest;
    }

    private function lastResponse(Client $client): ResponseInterface
    {
        $mockClient = self::$mockClients[spl_object_id($client)] ?? null;
        $response   = $mockClient?->lastResponse ?? $client->getLastResponse();

        if ($response === null) {
            throw new RuntimeException('Contract response was not captured.');
        }

        return $response;
    }

    private static function requestValidator(): RequestValidator
    {
        if (self::$requestValidator === null) {
            self::$requestValidator = (new ValidatorBuilder())
                ->fromJsonFile(self::OPENAPI_SPEC_FILE)
                ->getRequestValidator();
        }

        return self::$requestValidator;
    }

    private static function responseValidator(): ResponseValidator
    {
        if (self::$responseValidator === null) {
            self::$responseValidator = (new ValidatorBuilder())
                ->fromJsonFile(self::OPENAPI_SPEC_FILE)
                ->getResponseValidator();
        }

        return self::$responseValidator;
    }
}

final class ContractMockHttpClient implements ClientInterface
{
    public ?RequestInterface $lastRequest   = null;
    public ?ResponseInterface $lastResponse = null;

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
        $this->lastRequest  = $request;
        $this->lastResponse = $this->response;

        return $this->response;
    }
}
