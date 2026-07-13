<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Catalog\Product\Variation;

use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceBySkuPayload;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceIntegrationPayload;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceListBySkuPayload;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceListIntegrationPayload;
use Gubee\SDK\Model\Platform\PlatformPricesIntegrationPayload;
use Gubee\SDK\Resource\Catalog\Product\Variation\PriceResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class PriceResourceContractTest extends ContractTestCase
{
    public function testUpdatePriceBySkuId(): void
    {
        $productId = 'string';
        $skuId     = 'string';

        $payloadData = [
            'type'  => 'DEFAULT',
            'value' => 1.5,
        ];
        $payload     = $this->mockPayload(Price::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $productId, $skuId, $payload): void {
            $resource->updatePriceBySkuId($productId, $skuId, $payload);
        }, false);
    }

    public function testUpdatePriceV2(): void
    {
        $payloadData = [
            'price'
            => [
                'type'  => 'DEFAULT',
                'value' => 1.5,
            ],
            'skuId' => 'string',
        ];
        $payload     = $this->mockPayload(PriceIntegrationPayload::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->updatePriceV2($payload);
        }, false);
    }

    public function testUpdatePricesByPlatformV2(): void
    {
        $payloadData = [
            'itemId' => 'string',
            'prices'
            => [
                0
                => [
                    'platform' => 'string',
                    'type'     => 'DEFAULT',
                    'value'    => 1.5,
                ],
            ],
        ];
        $payload     = $this->mockPayload(PlatformPricesIntegrationPayload::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->updatePricesByPlatformV2($payload);
        }, false);
    }

    public function testUpdatePricesBySkuId(): void
    {
        $productId = 'string';
        $skuId     = 'string';

        $payloadData = [
            0
            => [
                'type'  => 'DEFAULT',
                'value' => 1.5,
            ],
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(202);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $productId, $skuId, $payload): void {
            $resource->updatePricesBySkuId($productId, $skuId, $payload);
        }, false);
    }

    public function testUpdatePricesV2(): void
    {
        $payloadData = [
            'prices'
            => [
                0
                => [
                    'type'  => 'DEFAULT',
                    'value' => 1.5,
                ],
            ],
            'skuId' => 'string',
        ];
        $payload     = $this->mockPayload(PriceListIntegrationPayload::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->updatePricesV2($payload);
        }, false);
    }

    public function testUpdatePricesBySku(): void
    {
        $payloadData = [
            'prices'
            => [
                0
                => [
                    'type'  => 'DEFAULT',
                    'value' => 1.5,
                ],
            ],
            'sku' => 'string',
        ];
        $payload     = $this->mockPayload(PriceListBySkuPayload::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->updatePricesBySku($payload);
        }, false);
    }

    public function testGetPriceBySku(): void
    {
        $sku = 'string';

        $client = $this->newContractClient(200);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $sku): void {
            $resource->getPriceBySku($sku);
        }, false);
    }

    public function testUpdatePriceBySku(): void
    {
        $payloadData = [
            'price'
            => [
                'type'  => 'DEFAULT',
                'value' => 1.5,
            ],
            'sku' => 'string',
        ];
        $payload     = $this->mockPayload(PriceBySkuPayload::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->updatePriceBySku($payload);
        }, false);
    }

    public function testGetPricesByItemIds(): void
    {
        $payloadData = [
            0 => 'string',
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->getPricesByItemIds($payload);
        }, false);
    }

    public function testGetPriceByItemId(): void
    {
        $itemId = 'string';

        $client = $this->newContractClient(200);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $itemId): void {
            $resource->getPriceByItemId($itemId);
        }, false);
    }

    public function testGetPricesByPlatform(): void
    {
        $platform = 'string';
        $itemId   = 'string';

        $client = $this->newContractClient(200);

        $resource = new PriceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $platform, $itemId): void {
            $resource->getPricesByPlatform($platform, $itemId);
        }, false);
    }
}
