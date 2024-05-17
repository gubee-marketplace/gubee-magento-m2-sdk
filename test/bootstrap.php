<?php

/** phpcs:disable */
declare(strict_types=1);

use DI\ContainerBuilder;
use Gubee\SDK\Library\ObjectManager\ServiceProvider;

define('ROOT', dirname(__DIR__));

if ($autoload = file_exists(ROOT . '/vendor/autoload.php')) {
    require_once ROOT . '/vendor/autoload.php';
} else {
    echo 'Please run composer install';
    exit(1);
}

function container(): ServiceProvider
{
    static $container;
    if ($container === null) {
        $containerBuilder = new ContainerBuilder(
            ServiceProvider::class
        );
        $defs             = include ROOT . '/src/config/di.php';
        $containerBuilder->addDefinitions(
            $defs
        );
        $containerBuilder->useAutowiring(true);
        $container = $containerBuilder->build();
    }

    return $container;
}
/** phpcs:enable */
