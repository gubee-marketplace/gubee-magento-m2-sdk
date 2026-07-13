<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order\Queue;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Sales\Order\Queue\RejectedOrder;
use Gubee\SDK\Model\Sales\Order\Queue\RejectedOrderStatus;
use PHPUnit\Framework\TestCase;

class RejectedOrderTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesRejectedOrderStatusFromRawArrays(): void
    {
        // Constructed via plain `new` (not the DI container's create()/make())
        // because RejectedOrderStatus itself requires ServiceProviderInterface,
        // and PHP-DI's make() cannot be safely re-entered recursively for a
        // second class that also needs ServiceProviderInterface.
        $rejectedOrder = new RejectedOrder(
            $this->serviceProvider(),
            'order-1',
            'ext-1',
            'gubee',
            [
                ['status' => 'CREATED', 'errors' => []],
            ]
        );

        $this->assertSame('order-1', $rejectedOrder->getOrderId());
        $this->assertSame('ext-1', $rejectedOrder->getExternalId());
        $this->assertSame('gubee', $rejectedOrder->getMarketplace());
        $this->assertContainsOnlyInstancesOf(RejectedOrderStatus::class, $rejectedOrder->getRejectedOrderStatus());
    }

    public function testPassesThroughAlreadyHydratedRejectedOrderStatus(): void
    {
        $status = $this->serviceProvider()->create(
            RejectedOrderStatus::class,
            ['status' => 'CREATED', 'errors' => []]
        );

        $rejectedOrder = $this->serviceProvider()->create(
            RejectedOrder::class,
            [
                'orderId'             => 'order-1',
                'externalId'          => 'ext-1',
                'marketplace'         => 'gubee',
                'rejectedOrderStatus' => [$status],
            ]
        );

        $this->assertSame($status, $rejectedOrder->getRejectedOrderStatus()[0]);
    }

    public function testSetters(): void
    {
        $rejectedOrder = $this->serviceProvider()->create(
            RejectedOrder::class,
            [
                'orderId'             => 'order-1',
                'externalId'          => 'ext-1',
                'marketplace'         => 'gubee',
                'rejectedOrderStatus' => [],
            ]
        );

        $status = $this->serviceProvider()->create(
            RejectedOrderStatus::class,
            ['status' => 'CREATED', 'errors' => []]
        );

        $rejectedOrder->setOrderId('order-2');
        $rejectedOrder->setExternalId('ext-2');
        $rejectedOrder->setMarketplace('other');
        $rejectedOrder->setRejectedOrderStatus([$status]);

        $this->assertSame('order-2', $rejectedOrder->getOrderId());
        $this->assertSame('ext-2', $rejectedOrder->getExternalId());
        $this->assertSame('other', $rejectedOrder->getMarketplace());
        $this->assertSame([$status], $rejectedOrder->getRejectedOrderStatus());
    }
}
