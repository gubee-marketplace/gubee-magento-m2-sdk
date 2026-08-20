<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\ProductV2;

use Gubee\SDK\Model\Catalog\ProductV2\Stock;
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{
    public function testConstructAndGetters(): void
    {
        $stock = new Stock('warehouse-1', 10, 1);

        $this->assertSame('warehouse-1', $stock->getWarehouseId());
        $this->assertSame(10, $stock->getQty());
        $this->assertSame(1, $stock->getPriority());
    }

    public function testSetters(): void
    {
        $stock = new Stock('warehouse-1', 10, 1);

        $stock->setWarehouseId('warehouse-2');
        $stock->setQty(20);
        $stock->setPriority(2);

        $this->assertSame('warehouse-2', $stock->getWarehouseId());
        $this->assertSame(20, $stock->getQty());
        $this->assertSame(2, $stock->getPriority());
    }
}
