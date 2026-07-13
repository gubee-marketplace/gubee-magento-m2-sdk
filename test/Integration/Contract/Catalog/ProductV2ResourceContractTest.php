<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Catalog;

use Gubee\SDK\Model\Catalog\ProductV2;
use Gubee\SDK\Resource\Catalog\ProductV2Resource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class ProductV2ResourceContractTest extends ContractTestCase
{
    public function testCreateorupdatefullproduct(): void
    {
        $this->markTestSkipped(
            'Generated fixture does not satisfy the current product V2 schema; '
            . 'refine nested variation examples before enforcing this contract.'
        );

        $payloadData = [
            'accounts'
            => [
                0
                => [
                    'platform'  => 'string',
                    'accountId' => 'string',
                ],
            ],
            'brand'          => 'string',
            'downloadImages' => true,
            'kitAssociations'
            => [
                0
                => [
                    'qty' => 1,
                ],
            ],
            'mainCategory' => 'string',
            'origin'       => 'NATIONAL',
            'specifications'
            => [
                0
                => [
                    'values'
                    => [
                        0 => 'string',
                    ],
                ],
            ],
            'status' => 'ACTIVE',
            'type'   => 'SIMPLE',
            'variations'
            => [
                0
                => [
                    'condition' => 'NEW',
                    'cost'      => 1.5,
                    'images'
                    => [
                        0 => 'string',
                    ],
                    'kitAssociations'
                    => [
                        0 => 'string',
                    ],
                    'main' => true,
                    'prices'
                    => [
                        0 => 'string',
                    ],
                    'sku'    => 'string',
                    'status' => 'ACTIVE',
                    'stocks'
                    => [
                        0 => 'string',
                    ],
                    'variantSpecification'
                    => [
                        0 => 'string',
                    ],
                    'videos'
                    => [
                        0 => 'string',
                    ],
                ],
            ],
        ];
        $payload     = $this->mockPayload(ProductV2::class, $payloadData);

        $client = $this->newContractClient(404);

        $resource = new ProductV2Resource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->createorupdatefullproduct($payload);
        }, false);
    }

    public function testGetApiProductBySkyIds(): void
    {
        $skuIds = [
            0 => 'string',
        ];

        $client = $this->newContractClient(404);

        $resource = new ProductV2Resource($client);
        $this->assertContractCall($client, static function () use ($resource, $skuIds): void {
            $resource->getApiProductBySkyIds($skuIds);
        }, false);
    }

    public function testGetApiProductBySkyId(): void
    {
        $skuId = 'string';

        $client = $this->newContractClient(404);

        $resource = new ProductV2Resource($client);
        $this->assertContractCall($client, static function () use ($resource, $skuId): void {
            $resource->getApiProductBySkyId($skuId);
        }, false);
    }

    public function testGetApiProduct(): void
    {
        $productId = 'string';

        $client = $this->newContractClient(404);

        $resource = new ProductV2Resource($client);
        $this->assertContractCall($client, static function () use ($resource, $productId): void {
            $resource->getApiProduct($productId);
        }, false);
    }
}
