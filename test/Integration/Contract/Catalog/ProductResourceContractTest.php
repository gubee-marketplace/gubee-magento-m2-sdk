<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Catalog;

use Gubee\SDK\Model\Ad\AddImageRequest;
use Gubee\SDK\Model\Catalog\Product;
use Gubee\SDK\Model\Catalog\Product\PatchProduct;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\PatchImageMetadata;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\PatchVideoMetadata;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\ReorderImagesRequest;
use Gubee\SDK\Model\Catalog\Product\Variation\PatchVariation;
use Gubee\SDK\Resource\Catalog\ProductResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class ProductResourceContractTest extends ContractTestCase
{
    public function testLoadById(): void
    {
        $id = 'string';

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $id): void {
            $resource->loadById($id);
        }, false);
    }

    public function testUpdate(): void
    {
        $this->markTestSkipped('Generated fixture does not satisfy the current product schema; refine request examples before enforcing this contract.');

        $id = 'string';

        $payloadData = [
            'brand' => 'string',
            'id'    => 'string',
            'kitAssociations'
            => [
                0
                => [
                    'qty' => 1,
                ],
            ],
            'mainCategory' => 'string',
            'mainSku'      => 'string',
            'origin'       => 'NATIONAL',
            'specifications'
            => [
                0
                => [
                    'attribute' => 'string',
                    'values'
                    => [
                        0 => 'string',
                    ],
                ],
            ],
            'status' => 'ACTIVE',
            'type'   => 'SIMPLE',
            'variantAttributes'
            => [
                0 => 'string',
            ],
            'variations'
            => [
                0
                => [
                    'cost'         => 1.5,
                    'dimension'    => null,
                    'handlingTime' => null,
                    'images'
                    => [
                        0 => 'string',
                    ],
                    'kitAssociations'
                    => [
                        0 => 'string',
                    ],
                    'main' => true,
                    'name' => 'string',
                    'prices'
                    => [
                        0 => 'string',
                    ],
                    'sku'   => 'string',
                    'skuId' => 'string',
                    'stocks'
                    => [
                        0 => 'string',
                    ],
                    'variantSpecification'
                    => [
                        0 => 'string',
                    ],
                    'warrantyTime' => null,
                ],
            ],
        ];
        $payload     = $this->mockPayload(Product::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $id, $payload): void {
            $resource->update($id, $payload);
        }, false);
    }

    public function testDeleteById(): void
    {
        $id = 'string';

        $client = $this->newContractClient(204);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $id): void {
            $resource->deleteById($id);
        }, false);
    }

    public function testSetMainImageByExternalId(): void
    {
        $externalId = 'string';
        $skuId      = 'string';
        $imageUuid  = 'string';

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId, $skuId, $imageUuid): void {
            $resource->setMainImageByExternalId($externalId, $skuId, $imageUuid);
        }, false);
    }

    public function testReorderImagesByExternalId(): void
    {
        $externalId = 'string';
        $skuId      = 'string';

        $payloadData = [
            'sellerId' => 'string',
            'orderedUuids'
            => [
                0 => 'string',
            ],
        ];
        $payload     = $this->mockPayload(ReorderImagesRequest::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId, $skuId, $payload): void {
            $resource->reorderImagesByExternalId($externalId, $skuId, $payload);
        }, false);
    }

    public function testUpdateImage(): void
    {
        $productId = 'string';
        $skuId     = 'string';

        $payloadData = [
            0
            => [
                'main'  => true,
                'name'  => 'string',
                'order' => 1,
                'url'   => 'string',
            ],
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $productId, $skuId, $payload): void {
            $resource->updateImage($productId, $skuId, $payload);
        }, false);
    }

    public function testUpdateProductByMainSkuId(): void
    {
        $this->markTestSkipped('Generated fixture does not satisfy the current product schema; refine nested variation examples before enforcing this contract.');

        $mainSkuId = 'string';

        $payloadData = [
            'brand' => 'string',
            'id'    => 'string',
            'kitAssociations'
            => [
                0
                => [
                    'qty' => 1,
                ],
            ],
            'mainCategory' => 'string',
            'mainSku'      => 'string',
            'origin'       => 'NATIONAL',
            'specifications'
            => [
                0
                => [
                    'attribute' => 'string',
                    'values'
                    => [
                        0 => 'string',
                    ],
                ],
            ],
            'status' => 'ACTIVE',
            'type'   => 'SIMPLE',
            'variantAttributes'
            => [
                0 => 'string',
            ],
            'variations'
            => [
                0
                => [
                    'cost'         => 1.5,
                    'dimension'    => null,
                    'handlingTime' => null,
                    'images'
                    => [
                        0 => 'string',
                    ],
                    'kitAssociations'
                    => [
                        0 => 'string',
                    ],
                    'main' => true,
                    'name' => 'string',
                    'prices'
                    => [
                        0 => 'string',
                    ],
                    'sku'   => 'string',
                    'skuId' => 'string',
                    'stocks'
                    => [
                        0 => 'string',
                    ],
                    'variantSpecification'
                    => [
                        0 => 'string',
                    ],
                    'warrantyTime' => null,
                ],
            ],
        ];
        $payload     = $this->mockPayload(Product::class, $payloadData);

        $client = $this->newContractClient(202);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $mainSkuId, $payload): void {
            $resource->updateProductByMainSkuId($mainSkuId, $payload);
        }, false);
    }

    public function testCreate(): void
    {
        $this->markTestSkipped('Generated fixture does not satisfy the current product schema; refine request examples before enforcing this contract.');

        $payloadData = [
            'brand' => 'string',
            'id'    => 'string',
            'kitAssociations'
            => [
                0
                => [
                    'qty' => 1,
                ],
            ],
            'mainCategory' => 'string',
            'mainSku'      => 'string',
            'origin'       => 'NATIONAL',
            'specifications'
            => [
                0
                => [
                    'attribute' => 'string',
                    'values'
                    => [
                        0 => 'string',
                    ],
                ],
            ],
            'status' => 'ACTIVE',
            'type'   => 'SIMPLE',
            'variantAttributes'
            => [
                0 => 'string',
            ],
            'variations'
            => [
                0
                => [
                    'cost'         => 1.5,
                    'dimension'    => null,
                    'handlingTime' => null,
                    'images'
                    => [
                        0 => 'string',
                    ],
                    'kitAssociations'
                    => [
                        0 => 'string',
                    ],
                    'main' => true,
                    'name' => 'string',
                    'prices'
                    => [
                        0 => 'string',
                    ],
                    'sku'   => 'string',
                    'skuId' => 'string',
                    'stocks'
                    => [
                        0 => 'string',
                    ],
                    'variantSpecification'
                    => [
                        0 => 'string',
                    ],
                    'warrantyTime' => null,
                ],
            ],
        ];
        $payload     = $this->mockPayload(Product::class, $payloadData);

        $client = $this->newContractClient(201);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->create($payload);
        }, false);
    }

    public function testAddImageByExternalId(): void
    {
        $externalId = 'string';
        $skuId      = 'string';

        $payloadData = [
            'sellerId' => 'string',
            'url'      => 'string',
            'uuid'     => 'string',
            'name'     => 'string',
            'order'    => 1,
        ];
        $payload     = $this->mockPayload(AddImageRequest::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId, $skuId, $payload): void {
            $resource->addImageByExternalId($externalId, $skuId, $payload);
        }, false);
    }

    public function testFindSkusBySkuIds(): void
    {
        $skuIds = [
            0 => 'string',
        ];

        $client = $this->newContractClient(204);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $skuIds): void {
            $resource->findSkusBySkuIds($skuIds);
        }, false);
    }

    public function testFindSkusBySkuIdsPost(): void
    {
        $payloadData = [
            0 => 'string',
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->findSkusBySkuIdsPost($payload);
        }, false);
    }

    public function testFindSkuIdsBySkus(): void
    {
        $skus = [
            0 => 'string',
        ];

        $client = $this->newContractClient(204);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $skus): void {
            $resource->findSkuIdsBySkus($skus);
        }, false);
    }

    public function testFindSkuIdsBySkusPost(): void
    {
        $payloadData = [
            0 => 'string',
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->findSkuIdsBySkusPost($payload);
        }, false);
    }

    public function testPatchProductByExternalId(): void
    {
        $externalId = 'string';

        $payloadData = [
            'sellerId' => 'string',
            'name'     => 'string',
            'nbm'      => 'string',
            'origin'   => 'NATIONAL',
            'originCountry'
            => [
                'name'       => 'string',
                'alpha2Code' => 'string',
                'alpha3Code' => 'string',
            ],
        ];
        $payload     = $this->mockPayload(PatchProduct::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId, $payload): void {
            $resource->patchProductByExternalId($externalId, $payload);
        }, false);
    }

    public function testPatchVideoMetadataByExternalId(): void
    {
        $externalId = 'string';
        $skuId      = 'string';
        $identifier = 'string';

        $payloadData = [
            'sellerId' => 'string',
            'main'     => true,
            'order'    => 1,
        ];
        $payload     = $this->mockPayload(PatchVideoMetadata::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId, $skuId, $identifier, $payload): void {
            $resource->patchVideoMetadataByExternalId($externalId, $skuId, $identifier, $payload);
        }, false);
    }

    public function testDeleteImageByExternalId(): void
    {
        $externalId = 'string';
        $skuId      = 'string';
        $imageUuid  = 'string';

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId, $skuId, $imageUuid): void {
            $resource->deleteImageByExternalId($externalId, $skuId, $imageUuid);
        }, false);
    }

    public function testPatchImageMetadataByExternalId(): void
    {
        $externalId = 'string';
        $skuId      = 'string';
        $imageUuid  = 'string';

        $payloadData = [
            'sellerId'      => 'string',
            'name'          => 'string',
            'order'         => 1,
            'localUrl'      => 'string',
            'imageFileName' => 'string',
        ];
        $payload     = $this->mockPayload(PatchImageMetadata::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId, $skuId, $imageUuid, $payload): void {
            $resource->patchImageMetadataByExternalId($externalId, $skuId, $imageUuid, $payload);
        }, false);
    }

    public function testPatchVariationBySkuId(): void
    {
        $skuId = 'string';

        $payloadData = [
            'sellerId' => 'string',
            'cost'
            => [
                'currency' => 'string',
                'amount'   => 1.5,
            ],
            'ean' => 'string',
            'warrantyTime'
            => [
                'type'  => 'DAYS',
                'value' => 1,
            ],
            'handlingTime'
            => [
                'type'  => 'DAYS',
                'value' => 1,
            ],
        ];
        $payload     = $this->mockPayload(PatchVariation::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $skuId, $payload): void {
            $resource->patchVariationBySkuId($skuId, $payload);
        }, false);
    }

    public function testPatchVariationBySku(): void
    {
        $sku = 'string';

        $payloadData = [
            'sellerId' => 'string',
            'cost'
            => [
                'currency' => 'string',
                'amount'   => 1.5,
            ],
            'ean' => 'string',
            'warrantyTime'
            => [
                'type'  => 'DAYS',
                'value' => 1,
            ],
            'handlingTime'
            => [
                'type'  => 'DAYS',
                'value' => 1,
            ],
        ];
        $payload     = $this->mockPayload(PatchVariation::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $sku, $payload): void {
            $resource->patchVariationBySku($sku, $payload);
        }, false);
    }

    public function testGetBySkuId(): void
    {
        $skuId = 'string';

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $skuId): void {
            $resource->getBySkuId($skuId);
        }, false);
    }

    public function testGetBySku(): void
    {
        $sku = 'string';

        $client = $this->newContractClient(200);

        $resource = new ProductResource($client);
        $this->assertContractCall($client, static function () use ($resource, $sku): void {
            $resource->getBySku($sku);
        }, false);
    }
}
