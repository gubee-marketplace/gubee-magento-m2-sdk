<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Catalog\Product\Variation\Stock;
use Gubee\SDK\Model\Catalog\Product\Variation\StockIntegrationPayload;
use PHPUnit\Framework\TestCase;

class StockIntegrationPayloadTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildStock(): Stock
    {
        return $this->serviceProvider()->create(Stock::class, [
            'crossDockingTime' => ['type' => 'DAYS', 'value' => 1],
            'qty'              => 5,
        ]);
    }

    public function testHydratesStockFromRawArray(): void
    {
        $payload = new StockIntegrationPayload(
            $this->serviceProvider(),
            'PROD-1',
            'SKU-1',
            [
                'crossDockingTime' => ['type' => 'DAYS', 'value' => 2],
                'qty'              => 10,
            ]
        );

        $this->assertSame('PROD-1', $payload->getProductId());
        $this->assertSame('SKU-1', $payload->getSkuId());
        $this->assertInstanceOf(Stock::class, $payload->getStock());
        $this->assertSame(10, $payload->getStock()->getQty());
    }

    public function testProductIdDefaultsToNull(): void
    {
        $payload = new StockIntegrationPayload(
            $this->serviceProvider(),
            null,
            'SKU-2',
            $this->buildStock()
        );

        $this->assertNull($payload->getProductId());
    }

    public function testPassesThroughAlreadyHydratedStock(): void
    {
        $stock = $this->buildStock();

        $payload = new StockIntegrationPayload(
            $this->serviceProvider(),
            null,
            'SKU-3',
            $stock
        );

        $this->assertSame($stock, $payload->getStock());
    }

    public function testSetters(): void
    {
        $payload = new StockIntegrationPayload(
            $this->serviceProvider(),
            null,
            'SKU-4',
            $this->buildStock()
        );

        $payload->setProductId('PROD-2');
        $payload->setSkuId('SKU-5');
        $stock = $this->buildStock();
        $payload->setStock($stock);

        $this->assertSame('PROD-2', $payload->getProductId());
        $this->assertSame('SKU-5', $payload->getSkuId());
        $this->assertSame($stock, $payload->getStock());
    }
}
