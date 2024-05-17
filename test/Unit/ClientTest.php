<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit;

use Gubee\SDK\Client;
use Gubee\SDK\Library\HttpClient\Builder;
use Gubee\SDK\Library\HttpClient\Plugin\Authenticate;
use Gubee\SDK\Library\ObjectManager\ServiceProvider;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

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
}
