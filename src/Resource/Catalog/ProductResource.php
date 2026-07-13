<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Catalog;

use Gubee\SDK\Model\Ad\AddImageRequest;
use Gubee\SDK\Model\Catalog\Product;
use Gubee\SDK\Model\Catalog\Product\PatchProduct;
use Gubee\SDK\Model\Catalog\Product\PatchProductResponse;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\ImageOperationResponse;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\PatchImageMetadata;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\PatchVideoMetadata;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\ReorderImagesRequest;
use Gubee\SDK\Model\Catalog\Product\Variation\PatchVariation;
use Gubee\SDK\Model\Catalog\Product\Variation\PatchVariationResponse;
use Gubee\SDK\Model\Catalog\Product\VariationSkuApiMap;
use Gubee\SDK\Model\Catalog\ProductV2;
use Gubee\SDK\Model\Common\EmptyResult;
use Gubee\SDK\Model\Common\PagedResult;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function array_merge;
use function rawurlencode;

class ProductResource extends AbstractResource
{
    // POST
    // /integration/products
    // Create product
    public function create(Product $product): Product
    {
        $response = $this->post(
            '/integration/products',
            $product->jsonSerialize()
        );

        return $this->hydrateModel(
            Product::class,
            array_merge(
                $response,
                [
                    'serviceProvider' => $this->getClient()->getServiceProvider(),
                    'productResource' => $this,
                ]
            )
        );
    }

    // GET
    // /integration/products/{productId}
    // Get product by productId
    public function loadById(string $id): Product
    {
        $response = $this->get(
            '/integration/products/' . rawurlencode($id)
        );

        return $this->hydrateModel(
            Product::class,
            array_merge(
                $response,
                [
                    'serviceProvider' => $this->getClient()->getServiceProvider(),
                    'productResource' => $this,
                ]
            )
        );
    }

    // PUT
    // /integration/products/{productId}
    // Update product
    public function update(string $id, Product $product): EmptyResult
    {
        $this->put(
            '/integration/products/' . rawurlencode($id),
            $product->jsonSerialize()
        );

        return $this->hydrateModel(EmptyResult::class, []);
    }

    // DELETE
    // /integration/products/{productId}
    // Delete product
    public function deleteById(string $id): EmptyResult
    {
        $this->delete(
            '/integration/products/' . rawurlencode($id)
        );

        return $this->hydrateModel(EmptyResult::class, []);
    }

    // GET
    // /integration/products/bySku/{sku}
    // Get product by variations.sku

    public function getBySku(string $sku): Product
    {
        $response = $this->get(
            '/integration/products/bySku/' . rawurlencode($sku)
        );

        return $this->hydrateModel(
            Product::class,
            array_merge(
                $response,
                [
                    'serviceProvider' => $this->getClient()->getServiceProvider(),
                    'productResource' => $this,
                ]
            )
        );
    }

    // GET
    // /integration/products/bySkuId/{skuId}
    // Get product by variations.skuId
    public function getBySkuId(string $skuId): Product
    {
        $response = $this->get(
            '/integration/products/bySkuId/' . rawurlencode($skuId)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Product::class,
                array_merge(
                    $response,
                    [
                        'serviceProvider' => $this->getClient()->getServiceProvider(),
                        'productResource' => $this,
                    ]
                )
            );
    }

    // PUT
    // /integration/products/image/{productId}/{skuId}
    // Update the list of image of skuId
    public function updateImage(string $productId, string $skuId, array $images): Product
    {
        $response = $this->put(
            '/integration/products/image/' . rawurlencode($productId) . '/' . rawurlencode($skuId),
            $images
        );

        return $this->hydrateModel(
            Product::class,
            array_merge(
                $response,
                [
                    'serviceProvider' => $this->getClient()->getServiceProvider(),
                    'productResource' => $this,
                ]
            )
        );
    }

    // POST
    // /integration/products/list/search
    // search products
    public function search(array $filters): PagedResult
    {
        $response = $this->post(
            '/integration/products/list/search',
            $filters
        );

        return $this->hydratePagedResult(
            Product::class,
            $response,
            [
                'serviceProvider' => $this->getClient()->getServiceProvider(),
                'productResource' => $this,
            ],
            ['products', 'objectList']
        );
    }

    // GET
    // /integration/products/listAll
    // list products
    public function listAll(): PagedResult
    {
        $response = $this->get(
            '/integration/products/listAll'
        );

        return $this->hydratePagedResult(
            Product::class,
            $response,
            [
                'serviceProvider' => $this->getClient()->getServiceProvider(),
                'productResource' => $this,
            ],
            ['products', 'objectList']
        );
    }

    // GET
    // /integration/products/v2/byProductId/{productId}
    // Get api product by productId
    public function getApiProductByProductId(string $productId): Product
    {
        $response = $this->get(
            '/integration/products/v2/byProductId/' . rawurlencode($productId)
        );

        return $this->hydrateModel(
            Product::class,
            array_merge(
                $response,
                [
                    'serviceProvider' => $this->getClient()->getServiceProvider(),
                    'productResource' => $this,
                ]
            )
        );
    }

    // POST
    // /integration/products/v2/createupdate
    // Create or update product
    public function createOrUpdate(ProductV2 $product): ProductV2
    {
        $response = $this->post(
            '/integration/products/v2/createupdate',
            $product->jsonSerialize()
        );

        return $this->hydrateModel(
            ProductV2::class,
            $response
        );
    }

    public function setMainImageByExternalId(string $externalId, string $skuId, string $imageUuid): ImageOperationResponse
    {
        $response = $this->put("/integration/products/" . rawurlencode($externalId) . "/variations/" . rawurlencode($skuId) . "/images/" . rawurlencode($imageUuid) . "/main", []);

        return $this->getClient()->getServiceProvider()->create(
            ImageOperationResponse::class,
            $response
        );
    }

    public function reorderImagesByExternalId(string $externalId, string $skuId, ReorderImagesRequest|array $payload): ImageOperationResponse
    {
        $response = $this->put("/integration/products/" . rawurlencode($externalId) . "/variations/" . rawurlencode($skuId) . "/images/order", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            ImageOperationResponse::class,
            $response
        );
    }

    public function updateProductByMainSkuId(string $mainSkuId, Product|array $payload): EmptyResult
    {
        $this->put("/integration/products/byMainSkuId/" . rawurlencode($mainSkuId) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function addImageByExternalId(string $externalId, string $skuId, AddImageRequest|array $payload): ImageOperationResponse
    {
        $response = $this->post("/integration/products/" . rawurlencode($externalId) . "/variations/" . rawurlencode($skuId) . "/images", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            ImageOperationResponse::class,
            $response
        );
    }

    public function findSkusBySkuIds(array $skuIds): array
    {
        $query = [
            'skuIds' => $skuIds,
        ];

        return $this->hydrateCollection(
            VariationSkuApiMap::class,
            $this->get("/integration/products/skus/bySkuIds", $query)
        );
    }

    public function findSkusBySkuIdsPost(array $payload): array
    {
        $response = $this->post("/integration/products/skus/bySkuIds", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateCollection(
            VariationSkuApiMap::class,
            $response
        );
    }

    public function findSkuIdsBySkus(array $skus): array
    {
        $query = [
            'skus' => $skus,
        ];

        return $this->hydrateCollection(
            VariationSkuApiMap::class,
            $this->get("/integration/products/skuIds/bySkus", $query)
        );
    }

    public function findSkuIdsBySkusPost(array $payload): array
    {
        $response = $this->post("/integration/products/skuIds/bySkus", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateCollection(
            VariationSkuApiMap::class,
            $response
        );
    }

    public function patchProductByExternalId(string $externalId, PatchProduct|array $payload): PatchProductResponse
    {
        $response = $this->patch("/integration/products/" . rawurlencode($externalId) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            PatchProductResponse::class,
            $response
        );
    }

    public function patchVideoMetadataByExternalId(string $externalId, string $skuId, string $identifier, PatchVideoMetadata|array $payload): EmptyResult
    {
        $this->patch("/integration/products/" . rawurlencode($externalId) . "/variations/" . rawurlencode($skuId) . "/videos/" . rawurlencode($identifier) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function deleteImageByExternalId(string $externalId, string $skuId, string $imageUuid): ImageOperationResponse
    {
        $response = $this->delete(
            "/integration/products/" . rawurlencode($externalId) . "/variations/" . rawurlencode($skuId) . "/images/" . rawurlencode($imageUuid) . ""
        );

        return $this->getClient()->getServiceProvider()->create(
            ImageOperationResponse::class,
            $response
        );
    }

    public function patchImageMetadataByExternalId(string $externalId, string $skuId, string $imageUuid, PatchImageMetadata|array $payload): ImageOperationResponse
    {
        $response = $this->patch("/integration/products/" . rawurlencode($externalId) . "/variations/" . rawurlencode($skuId) . "/images/" . rawurlencode($imageUuid) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            ImageOperationResponse::class,
            $response
        );
    }

    public function patchVariationBySkuId(string $skuId, PatchVariation|array $payload): PatchVariationResponse
    {
        $response = $this->patch("/integration/products/variations/skuId/" . rawurlencode($skuId) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            PatchVariationResponse::class,
            $response
        );
    }

    public function patchVariationBySku(string $sku, PatchVariation|array $payload): PatchVariationResponse
    {
        $response = $this->patch("/integration/products/variations/sku/" . rawurlencode($sku) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            PatchVariationResponse::class,
            $response
        );
    }
}
