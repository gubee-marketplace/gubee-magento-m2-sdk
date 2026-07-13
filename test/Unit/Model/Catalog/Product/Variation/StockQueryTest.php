<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Enum\Catalog\Product\Variation\StockTypeEnum;
use Gubee\SDK\Enum\Platform\DomainTypeEnum;
use Gubee\SDK\Model\Catalog\Product\Variation\StockQuery;
use PHPUnit\Framework\TestCase;

class StockQueryTest extends TestCase
{
    private function buildStockQuery(): StockQuery
    {
        return new StockQuery(
            'id-1',
            'seller-1',
            'item-1',
            'warehouse-1',
            10,
            1,
            2,
            'sku-1',
            'DEFAULT',
            'PRODUCT',
            '2h',
            'location-1'
        );
    }

    public function testConstructorHydratesFieldsFromStrings(): void
    {
        $stockQuery = $this->buildStockQuery();

        $this->assertSame('id-1', $stockQuery->getId());
        $this->assertSame('seller-1', $stockQuery->getSellerId());
        $this->assertSame('item-1', $stockQuery->getItemId());
        $this->assertSame('warehouse-1', $stockQuery->getWarehouseId());
        $this->assertSame(10, $stockQuery->getQty());
        $this->assertSame(1, $stockQuery->getBooking());
        $this->assertSame(2, $stockQuery->getPriority());
        $this->assertSame('sku-1', $stockQuery->getSku());
        $this->assertInstanceOf(StockTypeEnum::class, $stockQuery->getStockType());
        $this->assertSame('DEFAULT', (string) $stockQuery->getStockType());
        $this->assertInstanceOf(DomainTypeEnum::class, $stockQuery->getDomainType());
        $this->assertSame('PRODUCT', (string) $stockQuery->getDomainType());
        $this->assertSame('2h', $stockQuery->getCrossDockingTime());
        $this->assertSame('location-1', $stockQuery->getLocation());
    }

    public function testConstructorAcceptsEnumsDirectly(): void
    {
        $stockQuery = new StockQuery(
            'id-2',
            'seller-2',
            'item-2',
            'warehouse-2',
            5,
            0,
            0,
            null,
            StockTypeEnum::KIT(),
            DomainTypeEnum::AD(),
            '1h'
        );

        $this->assertSame('KIT', (string) $stockQuery->getStockType());
        $this->assertSame('AD', (string) $stockQuery->getDomainType());
        $this->assertNull($stockQuery->getSku());
        $this->assertNull($stockQuery->getLocation());
    }

    public function testSetters(): void
    {
        $stockQuery = $this->buildStockQuery();

        $stockQuery->setId('id-3');
        $stockQuery->setSellerId('seller-3');
        $stockQuery->setItemId('item-3');
        $stockQuery->setWarehouseId('warehouse-3');
        $stockQuery->setQty(20);
        $stockQuery->setBooking(2);
        $stockQuery->setPriority(3);
        $stockQuery->setSku('sku-2');
        $stockQuery->setStockType(StockTypeEnum::KIT());
        $stockQuery->setDomainType(DomainTypeEnum::AD());
        $stockQuery->setCrossDockingTime('3h');
        $stockQuery->setLocation('location-2');

        $this->assertSame('id-3', $stockQuery->getId());
        $this->assertSame('seller-3', $stockQuery->getSellerId());
        $this->assertSame('item-3', $stockQuery->getItemId());
        $this->assertSame('warehouse-3', $stockQuery->getWarehouseId());
        $this->assertSame(20, $stockQuery->getQty());
        $this->assertSame(2, $stockQuery->getBooking());
        $this->assertSame(3, $stockQuery->getPriority());
        $this->assertSame('sku-2', $stockQuery->getSku());
        $this->assertSame('KIT', (string) $stockQuery->getStockType());
        $this->assertSame('AD', (string) $stockQuery->getDomainType());
        $this->assertSame('3h', $stockQuery->getCrossDockingTime());
        $this->assertSame('location-2', $stockQuery->getLocation());
    }
}
