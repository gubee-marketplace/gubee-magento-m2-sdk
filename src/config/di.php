<?php

//phpcs:disable
declare(strict_types=1);

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Library\ObjectManager\ServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\UidProcessor;
use Psr\Log\LoggerInterface;

if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__, 2));
}

return [
    ServiceProviderInterface::class => static fn(ServiceProvider $serviceProvider): ServiceProviderInterface => $serviceProvider,
    LoggerInterface::class => static function (): LoggerInterface {
        $logDir = ROOT . '/var/log';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        return new Logger(
            'gubee',
            [
                new StreamHandler($logDir . '/gubee.log'),
            ],
            [
                new UidProcessor(),
                new MemoryUsageProcessor(),
            ]
        );
    },
];
//phpcs:enable
