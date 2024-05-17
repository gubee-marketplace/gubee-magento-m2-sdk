<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Library\HttpClient;

use Gubee\SDK\Library\HttpClient\Builder;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\RetryPlugin;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

use function sprintf;

class BuilderTest extends TestCase
{
    public function testGetClient(): void
    {
        $builder = new Builder();
        $client  = $builder->getClient();

        $this->assertInstanceOf(
            HttpMethodsClientInterface::class,
            $client,
            sprintf(
                "Failed to assert that the client is an instance of '%s'.",
                HttpMethodsClientInterface::class
            )
        );
    }

    public function testGetUriFactory(): void
    {
        $builder    = new Builder();
        $uriFactory = $builder->getUriFactory();

        $this->assertInstanceOf(
            UriFactoryInterface::class,
            $uriFactory,
            sprintf(
                "Failed to assert that the uriFactory is an instance of '%s'.",
                UriFactoryInterface::class
            )
        );
    }

    public function testGetStreamFactory(): void
    {
        $builder       = new Builder();
        $streamFactory = $builder->getStreamFactory();

        $this->assertInstanceOf(
            StreamFactoryInterface::class,
            $streamFactory,
            sprintf(
                "Failed to assert that streamFactory is an instance of '%s'",
                StreamFactoryInterface::class
            )
        );
    }

    public function testGetRequestFactory(): void
    {
        $builder        = new Builder();
        $requestFactory = $builder->getRequestFactory();

        $this->assertInstanceOf(
            RequestFactoryInterface::class,
            $requestFactory,
            sprintf(
                "Failed to assert that the requestFactory is an instance of '%s'.",
                RequestFactoryInterface::class
            )
        );
    }

    public function testAddPlugin(): void
    {
        $builder = new Builder();
        $plugin  = new HeaderDefaultsPlugin(
            [
                'User-Agent' => 'MyApp/1.0',
            ]
        );

        $builder->addPlugin($plugin);
        $this->assertCount(
            1,
            $builder->getPlugins(),
            'Failed to assert that the plugin was added successfully.'
        );
        $this->assertInstanceOf(
            HeaderDefaultsPlugin::class,
            $builder->getPlugins()[0],
            sprintf(
                "Failed to assert that the plugin is an instance of '%s'.",
                HeaderDefaultsPlugin::class
            )
        );
    }

    public function testRemovePlugin(): void
    {
        $builder = new Builder();
        $plugin1 = new HeaderDefaultsPlugin(
            [
                'User-Agent' => 'MyApp/1.0',
            ]
        );
        $plugin2 = new RetryPlugin(
            [
                'retries' => 3,
            ]
        );

        $builder->addPlugin($plugin1);
        $builder->addPlugin($plugin2);
        $builder->removePlugin(RetryPlugin::class);
        $this->assertCount(
            1,
            $builder->getPlugins(),
            'Failed to assert that the plugin was removed successfully.'
        );
    }
}
