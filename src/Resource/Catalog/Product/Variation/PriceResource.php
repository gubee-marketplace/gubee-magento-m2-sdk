<?php

declare (strict_types = 1);

namespace Gubee\SDK\Resource\Catalog\Product\Variation;

use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Resource\AbstractResource;

class PriceResource extends AbstractResource {
    // GET
    // /integration/prices/{platform}/{itemId}
    // Get prices of itemId -> (skuId for product, adId for ad)
    public function getPricesByPlatform(string $platform, string $itemId): array {
        $response = $this->get(
            '/integration/prices/' . rawurlencode($platform) . '/' . rawurlencode($itemId)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Price::class,
                array_merge(
                    [$this],
                    $response
                )
            );
    }

    // PUT
    // /integration/prices/{productId}/{skuId}
    // Update price of skuId product
    public function updatePriceBySkuId(string $productId, string $skuId, Price $price): void {
        $this->put(
            '/integration/prices/' . rawurlencode($productId) . '/' . rawurlencode($skuId),
            $price->jsonSerialize()
        );
    }

    // POST
    // /integration/prices/byItemId/{itemId}
    // Get price of itemId -> (skuId for product, adId for ad)
    public function getPriceByItemId(string $itemId): Price {
        $response = $this->post(
            '/integration/prices/byItemId/' . rawurlencode($itemId)
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Price::class,
                array_merge(
                    [$this],
                    $response
                )
            );
    }

    // POST
    // /integration/prices/byItemIds
    // List prices of itemIds -> (skuId for product, adId for ad)
    public function getPricesByItemIds(array $itemIds): array {
        $response = $this->post(
            '/integration/prices/byItemIds',
            $itemIds
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Price::class,
                array_merge(
                    [$this],
                    $response
                )
            );
    }

    // PUT
    // /integration/prices/list/{productId}/{skuId}
    // Update prices of skuId product
    public function updatePricesBySkuId(string $productId, string $skuId, array $prices): array {
        $response = $this->put(
            '/integration/prices/list/' . rawurlencode($productId) . '/' . rawurlencode($skuId),
            $prices
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Price::class,
                array_merge(
                    [$this],
                    $response
                )
            );
    }

    // PUT
    // /integration/prices/platforms/{itemId}
    // Update prices by platform
    public function updatePricesByPlatform(string $itemId, array $prices): array {
        $response = $this->put(
            '/integration/prices/platforms/' . rawurlencode($itemId),
            $prices
        );

        return $this->getClient()->getServiceProvider()
            ->create(
                Price::class,
                array_merge(
                    [$this],
                    $response
                )
            );
    }
}
