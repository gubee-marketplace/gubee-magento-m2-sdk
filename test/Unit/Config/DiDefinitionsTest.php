<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Config;

use DI\ContainerBuilder;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Library\ObjectManager\ServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class DiDefinitionsTest extends TestCase
{
    private ServiceProvider $container;

    protected function setUp(): void
    {
        $builder = new ContainerBuilder(ServiceProvider::class);
        $builder->addDefinitions(include ROOT . '/src/config/di.php');
        $builder->useAutowiring(true);

        /** @var ServiceProvider $container */
        $container       = $builder->build();
        $this->container = $container;
    }

    public function testServiceProviderInterfaceResolvesToContainer(): void
    {
        $serviceProvider = $this->container->get(ServiceProviderInterface::class);

        $this->assertInstanceOf(ServiceProvider::class, $serviceProvider);
        $this->assertInstanceOf(ServiceProviderInterface::class, $serviceProvider);
    }

    public function testLoggerInterfaceResolvesToConfiguredLogger(): void
    {
        $logger = $this->container->get(LoggerInterface::class);

        $this->assertInstanceOf(Logger::class, $logger);
        $this->assertCount(1, $logger->getHandlers());
        $this->assertInstanceOf(StreamHandler::class, $logger->getHandlers()[0]);
        $this->assertDirectoryExists(ROOT . '/var/log');
    }
}
