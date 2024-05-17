<?php

//phpcs:disable
declare(strict_types=1);

use Gubee\SDK\Client;
use Gubee\SDK\Model\Token;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\UidProcessor;
use Psr\Log\LoggerInterface;

use function DI\create;
use function DI\get;

if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__, 2));
}

return [
    LoggerInterface::class => create(Logger::class)
        ->constructor(
            'gubee',
            [
                new StreamHandler(
                    (function () {
                        $logDir = ROOT . '/var/log';
                        if (!is_dir($logDir)) {
                            mkdir($logDir, 0777, true);
                        }
                        return $logDir . '/gubee.log';
                    })()
                ),
            ],
            [
                new UidProcessor(),
                new MemoryUsageProcessor(),
            ]
        ),
    Client::class => create(Client::class)
        ->constructor(
            null,
            get(LoggerInterface::class)
        )
];
//phpcs:enable