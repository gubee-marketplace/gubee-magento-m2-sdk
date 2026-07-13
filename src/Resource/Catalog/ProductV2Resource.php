<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Catalog;

use Gubee\SDK\Model\Catalog\ProductV2;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function rawurlencode;

class ProductV2Resource extends AbstractResource
{
    public function createorupdatefullproduct(ProductV2|array $payload): ProductV2
    {
        $response = $this->post("/integration/products/v2/createupdate", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(ProductV2::class, $response);
    }

    public function getApiProductBySkyIds(array $skuIds): array
    {
        $query = [
            'skuIds' => $skuIds,
        ];

        $response = $this->get("/integration/products/v2/bySkuIds", $query);

        return $this->hydrateCollection(
            ProductV2::class,
            $response
        );
    }

    public function getApiProductBySkyId(string $skuId): ProductV2
    {
        $response = $this->get(
            "/integration/products/v2/bySkuId/" . rawurlencode($skuId) . ""
        );

        return $this->hydrateModel(
            ProductV2::class,
            $response
        );
    }

    public function getApiProduct(string $productId): ProductV2
    {
        $response = $this->get(
            "/integration/products/v2/byProductId/" . rawurlencode($productId) . ""
        );

        return $this->hydrateModel(
            ProductV2::class,
            $response
        );
    }
}
