<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Model\Catalog\Product\Variation\SkuQtyApi;
use PHPUnit\Framework\TestCase;

class SkuQtyApiTest extends TestCase
{
    public function testConstructWithAllFields(): void
    {
        $skuQtyApi = new SkuQtyApi('sku-1', 10, 5, 1, 2);

        $this->assertSame('sku-1', $skuQtyApi->getSkuId());
        $this->assertSame(10, $skuQtyApi->getQty());
        $this->assertSame(5, $skuQtyApi->getStockQty());
        $this->assertSame(1, $skuQtyApi->getHandlingTime());
        $this->assertSame(2, $skuQtyApi->getCrossDockingTime());
    }

    public function testConstructWithoutSkuId(): void
    {
        $skuQtyApi = new SkuQtyApi(null, 10, 5, 1, 2);

        $this->assertNull($skuQtyApi->getSkuId());
    }

    public function testSetters(): void
    {
        $skuQtyApi = new SkuQtyApi('sku-1', 10, 5, 1, 2);

        $skuQtyApi->setSkuId('sku-2');
        $skuQtyApi->setQty(20);
        $skuQtyApi->setStockQty(15);
        $skuQtyApi->setHandlingTime(3);
        $skuQtyApi->setCrossDockingTime(4);

        $this->assertSame('sku-2', $skuQtyApi->getSkuId());
        $this->assertSame(20, $skuQtyApi->getQty());
        $this->assertSame(15, $skuQtyApi->getStockQty());
        $this->assertSame(3, $skuQtyApi->getHandlingTime());
        $this->assertSame(4, $skuQtyApi->getCrossDockingTime());
    }
}
