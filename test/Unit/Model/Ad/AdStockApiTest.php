<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\Ad\AdStockApi;
use PHPUnit\Framework\TestCase;

class AdStockApiTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $stock = new AdStockApi(
            'id-1',
            'seller-1',
            'item-1',
            'warehouse-1',
            10,
            2,
            1,
            'PT24H',
            'created-by',
            new DateTime('2024-01-01'),
            new DateTime('2024-02-01')
        );

        $this->assertSame('id-1', $stock->getId());
        $this->assertSame('seller-1', $stock->getSellerId());
        $this->assertSame('item-1', $stock->getItemId());
        $this->assertSame('warehouse-1', $stock->getWarehouseId());
        $this->assertSame(10, $stock->getQty());
        $this->assertSame(2, $stock->getStockBooking());
        $this->assertSame(1, $stock->getPriority());
        $this->assertSame('PT24H', $stock->getCrossDockingTime());
        $this->assertSame('created-by', $stock->getCreatedBy());
        $this->assertInstanceOf(DateTimeInterface::class, $stock->getCreatedDt());
        $this->assertInstanceOf(DateTimeInterface::class, $stock->getLastModifiedDt());
    }

    public function testSetters(): void
    {
        $stock = new AdStockApi(null, 'seller-1', null, 'wh-1', 1, 1, 1);

        $stock->setId('id-2');
        $stock->setSellerId('seller-2');
        $stock->setItemId('item-2');
        $stock->setWarehouseId('wh-2');
        $stock->setQty(5);
        $stock->setStockBooking(2);
        $stock->setPriority(3);
        $stock->setCrossDockingTime('PT48H');
        $stock->setCreatedBy('creator-2');
        $date = new DateTime('2024-03-01');
        $stock->setCreatedDt($date);
        $stock->setLastModifiedDt($date);

        $this->assertSame('id-2', $stock->getId());
        $this->assertSame('seller-2', $stock->getSellerId());
        $this->assertSame('item-2', $stock->getItemId());
        $this->assertSame('wh-2', $stock->getWarehouseId());
        $this->assertSame(5, $stock->getQty());
        $this->assertSame(2, $stock->getStockBooking());
        $this->assertSame(3, $stock->getPriority());
        $this->assertSame('PT48H', $stock->getCrossDockingTime());
        $this->assertSame('creator-2', $stock->getCreatedBy());
        $this->assertSame($date, $stock->getCreatedDt());
        $this->assertSame($date, $stock->getLastModifiedDt());
    }

    public function testDefaultsAreNull(): void
    {
        $stock = new AdStockApi(null, 'seller-1', null, 'wh-1', 1, 1, 1);

        $this->assertNull($stock->getId());
        $this->assertNull($stock->getItemId());
        $this->assertNull($stock->getCrossDockingTime());
        $this->assertNull($stock->getCreatedBy());
        $this->assertNull($stock->getCreatedDt());
        $this->assertNull($stock->getLastModifiedDt());
    }
}
