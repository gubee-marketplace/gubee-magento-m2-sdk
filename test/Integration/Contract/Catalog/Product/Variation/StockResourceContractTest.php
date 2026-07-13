<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Catalog\Product\Variation;

use Gubee\SDK\Model\Catalog\Product\Variation\Stock;
use Gubee\SDK\Model\Catalog\Product\Variation\StockIntegrationPayload;
use Gubee\SDK\Resource\Catalog\Product\Variation\StockResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class StockResourceContractTest extends ContractTestCase
{
    public function testUpdateStock(): void
    {
        $productId = 'string';
        $skuId     = 'string';

        $payloadData = [
            'crossDockingTime'
            => [
                'type'  => 'DAYS',
                'value' => 1,
            ],
            'qty' => 1,
        ];
        $payload     = $this->mockPayload(Stock::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new StockResource($client);
        $this->assertContractCall($client, static function () use ($resource, $productId, $skuId, $payload): void {
            $resource->updateStock($productId, $skuId, $payload);
        }, false);
    }

    public function testUpdateStockV2(): void
    {
        $payloadData = [
            'skuId' => 'string',
            'stock'
            => [
                'crossDockingTime'
            => [],
                'qty' => 1,
            ],
        ];
        $payload     = $this->mockPayload(StockIntegrationPayload::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new StockResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->updateStockV2($payload);
        }, false);
    }

    public function testGetStockBySku(): void
    {
        $sku = 'string';

        $client = $this->newContractClient(200);

        $resource = new StockResource($client);
        $this->assertContractCall($client, static function () use ($resource, $sku): void {
            $resource->getStockBySku($sku);
        }, false);
    }

    public function testUpdateStockBySku(): void
    {
        $payloadData = [
            'crossDockingTime'
            => [
                'type'  => 'DAYS',
                'value' => 1,
            ],
            'qty' => 1,
        ];
        $payload     = $this->mockPayload(Stock::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new StockResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->updateStockBySku($payload);
        }, false);
    }

    public function testGetStockByPlatform(): void
    {
        $platform    = 'string';
        $itemId      = 'string';
        $warehouseId = 'string';

        $client = $this->newContractClient(200);

        $resource = new StockResource($client);
        $this->assertContractCall($client, static function () use ($resource, $platform, $itemId, $warehouseId): void {
            $resource->getStockByPlatform($platform, $itemId, $warehouseId);
        }, false);
    }

    public function testLoad(): void
    {
        $itemId      = 'string';
        $warehouseId = 'string';

        $client = $this->newContractClient(200);

        $resource = new StockResource($client);
        $this->assertContractCall($client, static function () use ($resource, $itemId, $warehouseId): void {
            $resource->load($itemId, $warehouseId);
        }, false);
    }

    public function testGetStockById(): void
    {
        $id = 'string';

        $client = $this->newContractClient(200);

        $resource = new StockResource($client);
        $this->assertContractCall($client, static function () use ($resource, $id): void {
            $resource->getStockById($id);
        }, false);
    }

    public function testGetStockByIdAndPlatform(): void
    {
        $id       = 'string';
        $platform = 'string';

        $client = $this->newContractClient(200);

        $resource = new StockResource($client);
        $this->assertContractCall($client, static function () use ($resource, $id, $platform): void {
            $resource->getStockByIdAndPlatform($id, $platform);
        }, false);
    }

    public function testGetAllStockByPlatform(): void
    {
        $platform = 'string';
        $itemId   = 'string';

        $client = $this->newContractClient(200);

        $resource = new StockResource($client);
        $this->assertContractCall($client, static function () use ($resource, $platform, $itemId): void {
            $resource->getAllStockByPlatform($platform, $itemId);
        }, false);
    }
}
