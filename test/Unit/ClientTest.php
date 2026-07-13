<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit;

use Gubee\SDK\Client;
use Gubee\SDK\Library\HttpClient\Builder;
use Gubee\SDK\Library\HttpClient\Plugin\Authenticate;
use Gubee\SDK\Library\HttpClient\Plugin\Journal\History;
use Gubee\SDK\Library\ObjectManager\ServiceProvider;
use Gubee\SDK\Resource\Catalog\Product\AttributeResource;
use Gubee\SDK\Resource\TokenResource;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Exception\HttpException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use ReflectionMethod;
use RuntimeException;
use Throwable;

use function sprintf;

class ClientTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $serviceProvider = container();

        $this->client = $serviceProvider->get(
            Client::class
        );
    }

    public function testAuthenticate(): void
    {
        $this->client->authenticate("token");
        $headers = null;
        foreach ($this->client->getHttpClientBuilder()->getPlugins() as $plugin) {
            if ($plugin instanceof Authenticate) {
                $headers = $plugin;
            }
        }
        $this->assertNotNull($headers, "HeaderDefaultsPlugin not found");
    }

    public function testGetServiceProvider(): void
    {
        $serviceProvider = $this->client->getServiceProvider();
        $this->assertInstanceOf(
            ServiceProvider::class,
            $serviceProvider,
            sprintf(
                "ServiceProvider is not an instance of '%s'",
                ServiceProvider::class
            )
        );
    }

    public function testGetLogger(): void
    {
        $logger = $this->client->getLogger();

        $this->assertInstanceOf(
            LoggerInterface::class,
            $logger,
            sprintf(
                "Logger is not an instance of '%s'",
                LoggerInterface::class
            )
        );
    }

    public function testGetHttpClientBuilder(): void
    {
        $httpClientBuilder = $this->client->getHttpClientBuilder();

        $this->assertInstanceOf(
            Builder::class,
            $httpClientBuilder,
            sprintf(
                "HttpClientBuilder is not an instance of '%s'",
                Builder::class
            )
        );
    }

    public function testAttributeResourceFactory(): void
    {
        $this->assertInstanceOf(AttributeResource::class, $this->client->attribute());
    }

    public function testTokenResourceFactory(): void
    {
        $this->assertInstanceOf(TokenResource::class, $this->client->token());
    }

    public function testGetHttpClient(): void
    {
        $this->assertInstanceOf(
            HttpMethodsClientInterface::class,
            $this->client->getHttpClient()
        );
    }

    public function testGetStreamFactory(): void
    {
        $this->assertInstanceOf(StreamFactoryInterface::class, $this->client->getStreamFactory());
    }

    public function testGetRequestFactory(): void
    {
        $this->assertInstanceOf(RequestFactoryInterface::class, $this->client->getRequestFactory());
    }

    public function testGetLastResponse(): void
    {
        $response = new Response(200);
        $history  = new History($this->createMock(LoggerInterface::class));
        $history->addSuccess(new Request('GET', 'https://example.com/items'), $response);

        $reflection = new ReflectionClass($this->client);
        $property   = $reflection->getProperty('responseHistory');
        $property->setAccessible(true);
        $property->setValue($this->client, $history);

        $this->assertSame($response, $this->client->getLastResponse());
    }

    public function testShouldRetryReturnsTrueForRetryableStatusCodes(): void
    {
        $request   = new Request('GET', 'https://example.com/items');
        $exception = HttpException::create($request, new Response(429));

        $this->assertTrue($this->invokeShouldRetry($exception));
    }

    public function testShouldRetryReturnsTrueForServerErrors(): void
    {
        $request   = new Request('GET', 'https://example.com/items');
        $exception = HttpException::create($request, new Response(500));

        $this->assertTrue($this->invokeShouldRetry($exception));
    }

    public function testShouldRetryReturnsFalseForNonRetryableHttpError(): void
    {
        $request   = new Request('GET', 'https://example.com/items');
        $exception = HttpException::create($request, new Response(404));

        $this->assertFalse($this->invokeShouldRetry($exception));
    }

    public function testShouldRetryReturnsFalseForNonHttpException(): void
    {
        $this->assertFalse($this->invokeShouldRetry(new RuntimeException('boom')));
    }

    private function invokeShouldRetry(Throwable $exception): bool
    {
        $method = new ReflectionMethod($this->client, 'shouldRetry');
        $method->setAccessible(true);

        /** @var bool $result */
        $result = $method->invoke($this->client, $exception);

        return $result;
    }
}
