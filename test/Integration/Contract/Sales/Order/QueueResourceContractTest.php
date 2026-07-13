<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Sales\Order;

use Gubee\SDK\Resource\Sales\Order\QueueResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class QueueResourceContractTest extends ContractTestCase
{
    public function testListOrdersByStatusQueue(): void
    {
        $status   = 'string';
        $pageable = [
            'page' => 1,
            'size' => 1,
            'sort'
            => [
                0 => 'string',
            ],
        ];

        $client = $this->newContractClient(200);

        $resource = new QueueResource($client);
        $this->assertContractCall($client, static function () use ($resource, $status, $pageable): void {
            $resource->listOrdersByStatusQueue($status, $pageable);
        }, false);
    }

    public function testListOrdersByStatusQueue1(): void
    {
        $status   = 'string';
        $pageable = [
            'page' => 1,
            'size' => 1,
            'sort'
            => [
                0 => 'string',
            ],
        ];

        $client = $this->newContractClient(200);

        $resource = new QueueResource($client);
        $this->assertContractCall($client, static function () use ($resource, $status, $pageable): void {
            $resource->listOrdersByStatusQueue_1($status, $pageable);
        }, false);
    }

    public function testListRejectedQueueOrders(): void
    {
        $pageable = [
            'page' => 1,
            'size' => 1,
            'sort'
            => [
                0 => 'string',
            ],
        ];

        $client = $this->newContractClient(200);

        $resource = new QueueResource($client);
        $this->assertContractCall($client, static function () use ($resource, $pageable): void {
            $resource->listRejectedQueueOrders($pageable);
        }, false);
    }

    public function testDeleteOrderFromQueue(): void
    {
        $status  = 'string';
        $orderId = 'string';

        $client = $this->newContractClient(200);

        $resource = new QueueResource($client);
        $this->assertContractCall($client, static function () use ($resource, $status, $orderId): void {
            $resource->deleteOrderFromQueue($status, $orderId);
        }, false);
    }
}
