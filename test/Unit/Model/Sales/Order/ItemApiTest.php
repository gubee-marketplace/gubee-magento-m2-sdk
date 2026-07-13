<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Sales\Order\DiscountApi;
use Gubee\SDK\Model\Sales\Order\ItemApi;
use Gubee\SDK\Model\Sales\Order\ItemOrder;
use PHPUnit\Framework\TestCase;

class ItemApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function build(array $overrides = []): ItemApi
    {
        return $this->serviceProvider()->create(
            ItemApi::class,
            $overrides + [
                'skuId'         => 'sku-1',
                'externalId'    => 'ext-1',
                'qty'           => 2,
                'subItems'      => [['skuId' => 'sub-1', 'qty' => 1]],
                'originalPrice' => 10.0,
                'salePrice'     => 8.0,
                'discount'      => ['discount' => 2.0, 'percentage' => false],
                'fulfillment'   => true,
                'warehouseId'   => 'wh-1',
                'sku'           => 'sku-code-1',
                'skuName'       => 'Sku Name',
            ]
        );
    }

    public function testHydratesNestedModelsFromRawArrays(): void
    {
        $item = $this->build();

        $this->assertSame('sku-1', $item->getSkuId());
        $this->assertSame('ext-1', $item->getExternalId());
        $this->assertSame(2, $item->getQty());
        $this->assertContainsOnlyInstancesOf(ItemOrder::class, $item->getSubItems());
        $this->assertSame(10.0, $item->getOriginalPrice());
        $this->assertSame(8.0, $item->getSalePrice());
        $this->assertInstanceOf(DiscountApi::class, $item->getDiscount());
        $this->assertTrue($item->getFulfillment());
        $this->assertSame('wh-1', $item->getWarehouseId());
        $this->assertSame('sku-code-1', $item->getSku());
        $this->assertSame('Sku Name', $item->getSkuName());
    }

    public function testPassesThroughAlreadyHydratedInstances(): void
    {
        $subItem  = $this->serviceProvider()->create(ItemOrder::class, ['skuId' => 'sub-2', 'qty' => 3]);
        $discount = $this->serviceProvider()->create(DiscountApi::class, ['discount' => 1.0]);

        $item = $this->build(['subItems' => [$subItem], 'discount' => $discount]);

        $this->assertSame($subItem, $item->getSubItems()[0]);
        $this->assertSame($discount, $item->getDiscount());
    }

    public function testSetters(): void
    {
        $item     = $this->build();
        $discount = $this->serviceProvider()->create(DiscountApi::class, ['discount' => 3.0]);

        $item->setSkuId('sku-2');
        $item->setExternalId('ext-2');
        $item->setQty(5);
        $item->setSubItems([]);
        $item->setOriginalPrice(20.0);
        $item->setSalePrice(15.0);
        $item->setDiscount($discount);
        $item->setFulfillment(false);
        $item->setWarehouseId('wh-2');
        $item->setSku('sku-code-2');
        $item->setSkuName('Sku Name 2');

        $this->assertSame('sku-2', $item->getSkuId());
        $this->assertSame('ext-2', $item->getExternalId());
        $this->assertSame(5, $item->getQty());
        $this->assertSame([], $item->getSubItems());
        $this->assertSame(20.0, $item->getOriginalPrice());
        $this->assertSame(15.0, $item->getSalePrice());
        $this->assertSame($discount, $item->getDiscount());
        $this->assertFalse($item->getFulfillment());
        $this->assertSame('wh-2', $item->getWarehouseId());
        $this->assertSame('sku-code-2', $item->getSku());
        $this->assertSame('Sku Name 2', $item->getSkuName());
    }
}
