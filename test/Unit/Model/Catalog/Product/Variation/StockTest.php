<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\UnitTime;
use Gubee\SDK\Model\Catalog\Product\Variation\Stock;
use Gubee\SDK\Resource\Catalog\Product\Variation\StockResource;
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function stockResource(): StockResource
    {
        return $this->createMock(StockResource::class);
    }

    public function testHydratesCrossDockingTimeFromRawArray(): void
    {
        $stock = $this->serviceProvider()->create(
            Stock::class,
            ['crossDockingTime' => ['type' => 'DAYS', 'value' => 2], 'qty' => 5]
        );

        $this->assertInstanceOf(UnitTime::class, $stock->getCrossDockingTime());
        $this->assertSame(2, $stock->getCrossDockingTime()->getValue());
    }

    public function testPassesThroughAlreadyHydratedCrossDockingTime(): void
    {
        $unitTime = $this->serviceProvider()->create(UnitTime::class, ['type' => 'DAYS', 'value' => 2]);

        $stock = $this->serviceProvider()->create(
            Stock::class,
            ['crossDockingTime' => $unitTime, 'qty' => 5]
        );

        $this->assertSame($unitTime, $stock->getCrossDockingTime());
    }

    public function testSaveJsonSerializeAndSetters(): void
    {
        $resource = $this->stockResource();
        $unitTime = $this->serviceProvider()->create(UnitTime::class, ['type' => 'DAYS', 'value' => 2]);

        $resource->expects($this->once())
            ->method('updateStock')
            ->with('prod-1', 'sku-1', $this->isInstanceOf(Stock::class));

        $stock = new Stock($this->serviceProvider(), $resource, $unitTime, 1, 5, 'wh-1', 'sku-1');
        $stock
            ->setCrossDockingTime($unitTime)
            ->setPriority(2)
            ->setQty(10)
            ->setWarehouseId('wh-2')
            ->setSku('sku-2');

        $result     = $stock->save('prod-1', 'sku-1');
        $serialized = $stock->jsonSerialize();

        $this->assertSame($stock, $result);
        $this->assertSame($unitTime, $stock->getCrossDockingTime());
        $this->assertSame(2, $stock->getPriority());
        $this->assertSame(10, $stock->getQty());
        $this->assertSame('wh-2', $stock->getWarehouseId());
        $this->assertSame('sku-2', $stock->getSku());
        $this->assertArrayNotHasKey('stockResource', $serialized);
    }
}
