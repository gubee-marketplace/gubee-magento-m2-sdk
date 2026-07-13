<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Sales\Order\ItemOrder;
use Gubee\SDK\Model\Sales\Order\Shipment;
use Gubee\SDK\Model\Sales\Order\Tracking;
use Gubee\SDK\Model\Sales\Order\Transport;
use PHPUnit\Framework\TestCase;

class ShipmentTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function build(array $overrides = []): Shipment
    {
        return $this->serviceProvider()->create(
            Shipment::class,
            $overrides + [
                'code'                => 'ship-1',
                'invoiceKey'          => 'key-1',
                'transport'           => [
                    'carrier'              => 'carrier-1',
                    'method'               => 'method-1',
                    'link'                 => 'https://example.com',
                    'trackingCode'         => 'track-1',
                    'deliveredCarrierDate' => '2026-01-01',
                ],
                'items'               => [
                    ['skuId' => 'sku-1', 'qty' => 1],
                ],
                'tracks'              => [
                    ['info' => 'info-1', 'trackDt' => '2026-01-02'],
                ],
                'estimatedDeliveryDt' => '2026-01-03',
                'deliveredDt'         => '2026-01-04',
                'additionalInfo'      => ['foo' => 'bar'],
            ]
        );
    }

    public function testHydratesNestedModelsFromRawArrays(): void
    {
        $shipment = $this->build();

        $this->assertSame('ship-1', $shipment->getCode());
        $this->assertSame('key-1', $shipment->getInvoiceKey());
        $this->assertInstanceOf(Transport::class, $shipment->getTransport());
        $this->assertContainsOnlyInstancesOf(ItemOrder::class, $shipment->getItems());
        $this->assertContainsOnlyInstancesOf(Tracking::class, $shipment->getTracks());
        $this->assertInstanceOf(DateTimeInterface::class, $shipment->getEstimatedDeliveryDt());
        $this->assertSame('2026-01-03', $shipment->getEstimatedDeliveryDt()->format('Y-m-d'));
        $this->assertInstanceOf(DateTimeInterface::class, $shipment->getDeliveredDt());
        $this->assertSame(['foo' => 'bar'], $shipment->getAdditionalInfo());
    }

    public function testPassesThroughAlreadyHydratedInstances(): void
    {
        $transport = $this->serviceProvider()->create(Transport::class, [
            'carrier'              => 'carrier-2',
            'method'               => 'method-2',
            'link'                 => 'https://example.com',
            'trackingCode'         => null,
            'deliveredCarrierDate' => '2026-01-01',
        ]);
        $item      = $this->serviceProvider()->create(ItemOrder::class, ['skuId' => 'sku-2', 'qty' => 2]);
        $track     = $this->serviceProvider()->create(Tracking::class, ['info' => 'info-2', 'trackDt' => '2026-01-02']);

        $shipment = $this->build([
            'transport' => $transport,
            'items'     => [$item],
            'tracks'    => [$track],
        ]);

        $this->assertSame($transport, $shipment->getTransport());
        $this->assertSame($item, $shipment->getItems()[0]);
        $this->assertSame($track, $shipment->getTracks()[0]);
    }

    public function testSetters(): void
    {
        $shipment  = $this->build();
        $transport = $this->serviceProvider()->create(Transport::class, [
            'carrier'              => 'carrier-3',
            'method'               => 'method-3',
            'link'                 => 'https://example.com',
            'trackingCode'         => null,
            'deliveredCarrierDate' => '2026-01-01',
        ]);

        $shipment->setCode('ship-2');
        $shipment->setInvoiceKey('key-2');
        $shipment->setTransport($transport);
        $shipment->setItems([]);
        $shipment->setTracks([]);
        $newDate = $shipment->getEstimatedDeliveryDt();
        $shipment->setEstimatedDeliveryDt($newDate);
        $shipment->setDeliveredDt(null);
        $shipment->setAdditionalInfo(null);

        $this->assertSame('ship-2', $shipment->getCode());
        $this->assertSame('key-2', $shipment->getInvoiceKey());
        $this->assertSame($transport, $shipment->getTransport());
        $this->assertSame([], $shipment->getItems());
        $this->assertSame([], $shipment->getTracks());
        $this->assertNull($shipment->getDeliveredDt());
        $this->assertNull($shipment->getAdditionalInfo());
    }
}
