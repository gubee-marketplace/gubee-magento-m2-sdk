<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\PreviousStatusEnum;
use Gubee\SDK\Enum\Sales\Order\StatusEnum;
use Gubee\SDK\Model\Sales\Order\OrderStatusApi;
use Gubee\SDK\Model\Sales\Order\PlataformIntegrationStatus;
use PHPUnit\Framework\TestCase;

class OrderStatusApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildModel(array $overrides = []): OrderStatusApi
    {
        $defaults = [
            'status'                     => 'CREATED',
            'marketplaceStatus'          => 'created',
            'statusDt'                   => '2026-01-01',
            'deliveredDt'                => '2026-01-02',
            'estimatedDeliveryDt'        => '2026-01-03',
            'shipmentExceptionDt'        => '2026-01-04',
            'cancelDt'                   => '2026-01-05',
            'reason'                     => ['reason-1'],
            'plataformIntegrationStatus' => ['plataform' => 'plat-1'],
            'previousStatus'             => 'PAYED',
        ];
        $args     = $overrides + $defaults;

        return new OrderStatusApi(
            $this->serviceProvider(),
            $args['status'],
            $args['marketplaceStatus'],
            $args['statusDt'],
            $args['deliveredDt'],
            $args['estimatedDeliveryDt'],
            $args['shipmentExceptionDt'],
            $args['cancelDt'],
            $args['reason'],
            $args['plataformIntegrationStatus'],
            $args['previousStatus']
        );
    }

    public function testConstructorHydratesNestedModelsFromRawArrays(): void
    {
        $model = $this->buildModel();

        $this->assertInstanceOf(StatusEnum::class, $model->getStatus());
        $this->assertSame('created', $model->getMarketplaceStatus());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getStatusDt());
        $this->assertSame('2026-01-01', $model->getStatusDt()->format('Y-m-d'));
        $this->assertSame('2026-01-02', $model->getDeliveredDt()->format('Y-m-d'));
        $this->assertSame('2026-01-03', $model->getEstimatedDeliveryDt()->format('Y-m-d'));
        $this->assertSame('2026-01-04', $model->getShipmentExceptionDt()->format('Y-m-d'));
        $this->assertSame('2026-01-05', $model->getCancelDt()->format('Y-m-d'));
        $this->assertSame(['reason-1'], $model->getReason());
        $this->assertInstanceOf(PlataformIntegrationStatus::class, $model->getPlataformIntegrationStatus());
        $this->assertInstanceOf(PreviousStatusEnum::class, $model->getPreviousStatus());
    }

    public function testConstructorWithNullOptionalFields(): void
    {
        $model = $this->buildModel([
            'deliveredDt'                => null,
            'estimatedDeliveryDt'        => null,
            'shipmentExceptionDt'        => null,
            'cancelDt'                   => null,
            'reason'                     => null,
            'plataformIntegrationStatus' => null,
            'previousStatus'             => null,
        ]);

        $this->assertNull($model->getDeliveredDt());
        $this->assertNull($model->getEstimatedDeliveryDt());
        $this->assertNull($model->getShipmentExceptionDt());
        $this->assertNull($model->getCancelDt());
        $this->assertNull($model->getReason());
        $this->assertNull($model->getPlataformIntegrationStatus());
        $this->assertNull($model->getPreviousStatus());
    }

    public function testConstructorAcceptsDateTimeAndEnumInstances(): void
    {
        $statusDt = new DateTime('2026-02-01');

        $model = $this->buildModel([
            'status'         => StatusEnum::fromValue('SHIPPED'),
            'statusDt'       => $statusDt,
            'previousStatus' => PreviousStatusEnum::fromValue('CANCELED'),
        ]);

        $this->assertSame('SHIPPED', (string) $model->getStatus());
        $this->assertSame($statusDt, $model->getStatusDt());
        $this->assertSame('CANCELED', (string) $model->getPreviousStatus());
    }

    public function testConstructorPassesThroughAlreadyHydratedPlataformIntegrationStatus(): void
    {
        $status = new PlataformIntegrationStatus($this->serviceProvider(), 'plat-2');

        $model = $this->buildModel(['plataformIntegrationStatus' => $status]);

        $this->assertSame($status, $model->getPlataformIntegrationStatus());
    }

    public function testSetters(): void
    {
        $model  = $this->buildModel();
        $date   = new DateTime('2026-03-01');
        $status = new PlataformIntegrationStatus($this->serviceProvider(), 'plat-3');

        $model->setStatus(StatusEnum::fromValue('DELIVERED'));
        $model->setMarketplaceStatus('delivered');
        $model->setStatusDt($date);
        $model->setDeliveredDt($date);
        $model->setEstimatedDeliveryDt($date);
        $model->setShipmentExceptionDt($date);
        $model->setCancelDt($date);
        $model->setReason(['reason-2']);
        $model->setPlataformIntegrationStatus($status);
        $model->setPreviousStatus(PreviousStatusEnum::fromValue('DELIVERED'));

        $this->assertSame('DELIVERED', (string) $model->getStatus());
        $this->assertSame('delivered', $model->getMarketplaceStatus());
        $this->assertSame($date, $model->getStatusDt());
        $this->assertSame($date, $model->getDeliveredDt());
        $this->assertSame($date, $model->getEstimatedDeliveryDt());
        $this->assertSame($date, $model->getShipmentExceptionDt());
        $this->assertSame($date, $model->getCancelDt());
        $this->assertSame(['reason-2'], $model->getReason());
        $this->assertSame($status, $model->getPlataformIntegrationStatus());
        $this->assertSame('DELIVERED', (string) $model->getPreviousStatus());
    }
}
