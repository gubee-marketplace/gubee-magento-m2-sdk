<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Catalog\Product\VariationSkuApiMap;
use Gubee\SDK\Resource\AbstractResource;

class SkuResolveResource extends AbstractResource
{
    public function resolveSkuBySkuId(string $skuId): VariationSkuApiMap
    {
        $query = [
            'skuId' => $skuId,
        ];

        $response = $this->get("/integration/skus/by-skuid", $query);

        return $this->getClient()->getServiceProvider()->create(
            VariationSkuApiMap::class,
            $response
        );
    }

    public function resolveSkuIdBySku(string $sku): VariationSkuApiMap
    {
        $query = [
            'sku' => $sku,
        ];

        $response = $this->get("/integration/skus/by-sku", $query);

        return $this->getClient()->getServiceProvider()->create(
            VariationSkuApiMap::class,
            $response
        );
    }
}
