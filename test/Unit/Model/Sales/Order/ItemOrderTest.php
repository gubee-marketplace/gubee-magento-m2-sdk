<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Model\Sales\Order\ItemOrder;
use PHPUnit\Framework\TestCase;

class ItemOrderTest extends TestCase
{
    private function build(): ItemOrder
    {
        return new ItemOrder('sku-1', 2, 50.0, 'sku-code-1', 'Sku Name');
    }

    public function testConstructor(): void
    {
        $item = $this->build();

        $this->assertSame('sku-1', $item->getSkuId());
        $this->assertSame(2, $item->getQty());
        $this->assertSame(50.0, $item->getPercentageOfTotal());
        $this->assertSame('sku-code-1', $item->getSku());
        $this->assertSame('Sku Name', $item->getSkuName());
    }

    public function testConstructorDefaults(): void
    {
        $item = new ItemOrder('sku-2', 1);

        $this->assertNull($item->getPercentageOfTotal());
        $this->assertNull($item->getSku());
        $this->assertNull($item->getSkuName());
    }

    public function testSetters(): void
    {
        $item = $this->build();

        $item->setSkuId('sku-3');
        $item->setQty(3);
        $item->setPercentageOfTotal(75.0);
        $item->setSku('sku-code-3');
        $item->setSkuName('Sku Name 3');

        $this->assertSame('sku-3', $item->getSkuId());
        $this->assertSame(3, $item->getQty());
        $this->assertSame(75.0, $item->getPercentageOfTotal());
        $this->assertSame('sku-code-3', $item->getSku());
        $this->assertSame('Sku Name 3', $item->getSkuName());
    }
}
