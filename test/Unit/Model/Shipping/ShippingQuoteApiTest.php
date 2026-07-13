<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Shipping;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Shipping\FreightTypeEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\Weight;
use Gubee\SDK\Model\Catalog\Product\Variation\SkuQtyApi;
use Gubee\SDK\Model\Shipping\ShippingQuoteApi;
use PHPUnit\Framework\TestCase;

class ShippingQuoteApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function build(): ShippingQuoteApi
    {
        return new ShippingQuoteApi(
            serviceProvider: $this->serviceProvider(),
            valueFreightId: 'vf-1',
            freightServiceId: 'fs-1',
            freightServiceName: 'Normal',
            freightType: 'NORMAL',
            deliveryTime: 5,
            deadlineDays: 7,
            carrierId: 'carrier-1',
            carrierName: 'Carrier',
            weight: ['type' => 'KILOGRAM', 'value' => 1.5],
            shippingCost: 9.9,
            skuQty: ['skuId' => 'sku-1', 'qty' => 1, 'stockQty' => 2, 'handlingTime' => 1, 'crossDockingTime' => 2]
        );
    }

    public function testConstructorAndGetters(): void
    {
        $quote = $this->build();

        $this->assertSame('vf-1', $quote->getValueFreightId());
        $this->assertSame('fs-1', $quote->getFreightServiceId());
        $this->assertSame('Normal', $quote->getFreightServiceName());
        $this->assertEquals(FreightTypeEnum::NORMAL(), $quote->getFreightType());
        $this->assertSame(5, $quote->getDeliveryTime());
        $this->assertSame(7, $quote->getDeadlineDays());
        $this->assertSame('carrier-1', $quote->getCarrierId());
        $this->assertSame('Carrier', $quote->getCarrierName());
        $this->assertInstanceOf(Weight::class, $quote->getWeight());
        $this->assertSame(9.9, $quote->getShippingCost());
        $this->assertInstanceOf(SkuQtyApi::class, $quote->getSkuQty());
    }

    public function testSetters(): void
    {
        $quote = $this->build();

        $quote->setValueFreightId('vf-2');
        $quote->setFreightServiceId('fs-2');
        $quote->setFreightServiceName('Express');
        $quote->setFreightType(FreightTypeEnum::EXPRESS());
        $quote->setDeliveryTime(1);
        $quote->setDeadlineDays(2);
        $quote->setCarrierId('carrier-2');
        $quote->setCarrierName('Carrier2');
        $weight = new Weight('KILOGRAM', 2.0);
        $quote->setWeight($weight);
        $quote->setShippingCost(1.0);
        $skuQty = new SkuQtyApi(null, 1, 1, 1, 1);
        $quote->setSkuQty($skuQty);

        $this->assertSame('vf-2', $quote->getValueFreightId());
        $this->assertSame('fs-2', $quote->getFreightServiceId());
        $this->assertSame('Express', $quote->getFreightServiceName());
        $this->assertEquals(FreightTypeEnum::EXPRESS(), $quote->getFreightType());
        $this->assertSame(1, $quote->getDeliveryTime());
        $this->assertSame(2, $quote->getDeadlineDays());
        $this->assertSame('carrier-2', $quote->getCarrierId());
        $this->assertSame('Carrier2', $quote->getCarrierName());
        $this->assertSame($weight, $quote->getWeight());
        $this->assertSame(1.0, $quote->getShippingCost());
        $this->assertSame($skuQty, $quote->getSkuQty());
    }

    public function testPassesThroughAlreadyHydratedInstances(): void
    {
        $weight = new Weight('KILOGRAM', 3.0);
        $skuQty = new SkuQtyApi(null, 1, 1, 1, 1);

        $quote = new ShippingQuoteApi(
            serviceProvider: $this->serviceProvider(),
            deliveryTime: 1,
            deadlineDays: 2,
            weight: $weight,
            skuQty: $skuQty
        );

        $this->assertSame($weight, $quote->getWeight());
        $this->assertSame($skuQty, $quote->getSkuQty());
    }

    public function testMinimalConstructor(): void
    {
        $quote = new ShippingQuoteApi(
            serviceProvider: $this->serviceProvider(),
            deliveryTime: 1,
            deadlineDays: 2
        );

        $this->assertNull($quote->getValueFreightId());
        $this->assertNull($quote->getFreightServiceId());
        $this->assertNull($quote->getFreightServiceName());
        $this->assertNull($quote->getFreightType());
        $this->assertNull($quote->getCarrierId());
        $this->assertNull($quote->getCarrierName());
        $this->assertNull($quote->getWeight());
        $this->assertNull($quote->getShippingCost());
        $this->assertNull($quote->getSkuQty());
    }
}
