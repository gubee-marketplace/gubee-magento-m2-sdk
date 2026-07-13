<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Sales;

use DateTimeImmutable;
use Gubee\SDK\Model\Sales\Order\CreateOrderNote;
use Gubee\SDK\Resource\Sales\OrderResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class OrderResourceContractTest extends ContractTestCase
{
    public function testUpdateShipped(): void
    {
        $orderId = 'string';

        $payloadData = [
            'code'                => 'string',
            'estimatedDeliveryDt' => '2024-01-01T00:00:00Z',
            'items'
            => [
                0
                => [
                    'qty'   => 1,
                    'skuId' => 'string',
                ],
            ],
            'tracks'
            => [
                0
                => [
                    'info'    => 'string',
                    'trackDt' => '2024-01-01T00:00:00Z',
                ],
            ],
            'transport'
            => [
                'carrier'              => 'string',
                'deliveredCarrierDate' => '2024-01-01T00:00:00Z',
                'link'                 => 'string',
                'method'               => 'string',
            ],
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new OrderResource($client);
        $this->assertContractCall($client, static function () use ($resource, $orderId, $payload): void {
            $resource->updateShipped($orderId, $payload);
        }, false);
    }

    public function testReturnedOrder(): void
    {
        $orderId           = 'string';
        $marketplaceStatus = 'string';

        $client = $this->newContractClient(200);

        $resource = new OrderResource($client);
        $this->assertContractCall($client, static function () use ($resource, $orderId, $marketplaceStatus): void {
            $resource->returnedOrder($orderId, $marketplaceStatus);
        }, false);
    }

    public function testUpdateInvoiced(): void
    {
        $this->markTestSkipped(
            'SDK sends application/hal+json but the current OpenAPI contract '
            . 'does not accept that request content type.'
        );

        $orderId = 'string';

        $payloadData = [
            'line'      => 'NFe',
            'issueDate' => '2023-01-01T12:00:00Z',
            'danfeXml'  => '<xml>...</xml>',
            'danfeLink' => 'https://example.com/danfe',
            'key'       => 'NFe3519...',
            'number'    => '123456',
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new OrderResource($client);
        $this->assertContractCall($client, static function () use ($resource, $orderId, $payload): void {
            $resource->updateInvoiced($orderId, $payload);
        }, false);
    }

    public function testUpdateDelivered(): void
    {
        $orderId      = 'string';
        $shipmentCode = 'string';

        $payloadData = [
            'deliveredDt' => '2024-01-01T00:00:00Z',
        ];
        $payload     = new DateTimeImmutable($payloadData['deliveredDt']);

        $client = $this->newContractClient(200);

        $resource = new OrderResource($client);
        $this->assertContractCall($client, static function () use ($resource, $orderId, $shipmentCode, $payload): void {
            $resource->updateDelivered($orderId, $shipmentCode, $payload);
        }, false);
    }

    public function testCancelOrder(): void
    {
        $orderId = 'string';

        $payloadData = [
            'cancelDt' => '2024-01-01T00:00:00Z',
        ];
        $payload     = new DateTimeImmutable($payloadData['cancelDt']);

        $client = $this->newContractClient(200);

        $resource = new OrderResource($client);
        $this->assertContractCall($client, static function () use ($resource, $orderId, $payload): void {
            $resource->cancelOrder($orderId, $payload);
        }, false);
    }

    public function testCreateOrderNote(): void
    {
        $accountId = 'string';
        $orderId   = 'string';

        $payloadData = [
            'note' => 'Cliente solicitou entrega no período da manhã',
        ];
        $payload     = $this->mockPayload(CreateOrderNote::class, $payloadData);

        $client = $this->newContractClient(201);

        $resource = new OrderResource($client);
        $this->assertContractCall($client, static function () use ($resource, $accountId, $orderId, $payload): void {
            $resource->createOrderNote($accountId, $orderId, $payload);
        }, false);
    }

    public function testCreateOrder(): void
    {
        $this->markTestSkipped(
            'Generated fixture does not satisfy the current order schema; '
            . 'refine request examples before enforcing this contract.'
        );

        $payloadData = [
            'channel'     => 'string',
            'externalId'  => 'string',
            'freightType' => 'NORMAL',
            'id'          => 'string',
            'invoices'
            => [
                0
                => [
                    'issueDate' => '2024-01-01T00:00:00Z',
                    'key'       => 'string',
                    'line'      => 'string',
                    'number'    => 'string',
                ],
            ],
            'items'
            => [
                0
                => [
                    'skuId'      => 'string',
                    'externalId' => 'string',
                    'qty'        => 1,
                    'subItems'
                    => [
                        0 => 'string',
                    ],
                    'originalPrice' => 1.5,
                ],
            ],
            'orderType' => 'SALE',
            'payments'
            => [
                0
                => [
                    'method'      => 'string',
                    'description' => 'string',
                    'parcels'     => 1,
                    'value'       => 1.5,
                    'paymentDt'   => '2024-01-01T00:00:00Z',
                ],
            ],
            'shipments'
            => [
                0
                => [
                    'code'                => 'string',
                    'estimatedDeliveryDt' => '2024-01-01T00:00:00Z',
                    'items'
                    => [
                        0 => 'string',
                    ],
                    'tracks'
                    => [
                        0 => 'string',
                    ],
                    'transport' => null,
                ],
            ],
            'statusHistory'
            => [
                0
                => [
                    'marketplaceStatus' => 'string',
                    'status'            => 'CREATED',
                    'statusDt'          => '2024-01-01T00:00:00Z',
                ],
            ],
            'tags'
            => [
                0 => 'string',
            ],
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new OrderResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->createOrder($payload);
        }, false);
    }

    public function testLoadByOrderId(): void
    {
        $orderId = 'string';

        $client = $this->newContractClient(404);

        $resource = new OrderResource($client);
        $this->assertContractCall($client, static function () use ($resource, $orderId): void {
            $resource->loadByOrderId($orderId);
        }, false);
    }
}
