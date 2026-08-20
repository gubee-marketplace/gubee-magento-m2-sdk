<?php

/** phpcs:disable */
declare(strict_types=1);

use DI\ContainerBuilder;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Client;
use Gubee\SDK\Library\ObjectManager\ServiceProvider;
use Gubee\SDK\Tests\Support\OpenApiCoverageTracker;
use Psr\Log\LoggerInterface;

define('ROOT', dirname(__DIR__));

// Vendor libs still emit PHP 8.2 deprecations; keep test output focused on SDK failures.
error_reporting(error_reporting() & ~E_DEPRECATED & ~E_USER_DEPRECATED);

if ($autoload = file_exists(ROOT . '/vendor/autoload.php')) {
    require_once ROOT . '/vendor/autoload.php';
} else {
    echo 'Please run composer install';
    exit(1);
}

OpenApiCoverageTracker::boot();

function container(): ServiceProvider
{
    static $container;
    if ($container === null) {
        $containerBuilder = new ContainerBuilder(
            ServiceProvider::class
        );
        $defs             = include ROOT . '/src/config/di.php';
        $defs[ServiceProviderInterface::class] = static fn(ServiceProvider $serviceProvider): ServiceProviderInterface => $serviceProvider;
        $defs[Client::class] = static fn(ServiceProviderInterface $serviceProvider, LoggerInterface $logger): Client => new Client(
            $serviceProvider,
            $logger
        );
        $containerBuilder->addDefinitions(
            $defs
        );
        $containerBuilder->useAutowiring(true);
        $container = $containerBuilder->build();
    }

    return $container;
}
/** phpcs:enable */
