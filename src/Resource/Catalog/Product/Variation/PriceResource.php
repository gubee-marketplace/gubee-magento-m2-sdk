<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Catalog\Product\Variation;

use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceBySkuPayload;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceIntegrationPayload;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceListBySkuPayload;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceListIntegrationPayload;
use Gubee\SDK\Model\Catalog\Product\Variation\SkuPrice;
use Gubee\SDK\Model\Common\EmptyResult;
use Gubee\SDK\Model\Platform\PlatformPricesIntegrationPayload;
use Gubee\SDK\Model\Platform\SkuPlatformPrice;
use Gubee\SDK\Model\Platform\UpdatePlatformPriceResponse;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function array_merge;
use function rawurlencode;

class PriceResource extends AbstractResource
{
    // GET
    // /integration/prices/{platform}/{itemId}
    // Get prices of itemId -> (skuId for product, adId for ad)
    public function getPricesByPlatform(string $platform, string $itemId): SkuPlatformPrice
    {
        $response = $this->get(
            '/integration/prices/' . rawurlencode($platform) . '/' . rawurlencode($itemId)
        );

        return $this->hydrateModel(
            SkuPlatformPrice::class,
            $response
        );
    }

    // PUT
    // /integration/prices/{productId}/{skuId}
    // Update price of skuId product
    public function updatePriceBySkuId(string $productId, string $skuId, Price $price): Price
    {
        return $this->hydrateModel(
            Price::class,
            $this->put(
                '/integration/prices/' . rawurlencode($productId) . '/' . rawurlencode($skuId),
                $price->jsonSerialize()
            )
        );
    }

    // POST
    // /integration/prices/byItemId/{itemId}
    // Get price of itemId -> (skuId for product, adId for ad)
    public function getPriceByItemId(string $itemId): Price
    {
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
    public function getPricesByItemIds(array $itemIds): array
    {
        $response = $this->post(
            '/integration/prices/byItemIds',
            $itemIds
        );

        return $this->hydrateCollection(
            SkuPrice::class,
            $response,
            [
                'serviceProvider' => $this->getClient()->getServiceProvider(),
            ]
        );
    }

    // PUT
    // /integration/prices/list/{productId}/{skuId}
    // Update prices of skuId product
    public function updatePricesBySkuId(string $productId, string $skuId, array $prices): array
    {
        $response = $this->put(
            '/integration/prices/list/' . rawurlencode($productId) . '/' . rawurlencode($skuId),
            $prices
        );

        return $this->hydrateCollection(
            Price::class,
            $response,
            [
                'priceResource'   => $this,
                'serviceProvider' => $this->getClient()->getServiceProvider(),
            ]
        );
    }

    // PUT
    // /integration/prices/platforms/{itemId}
    // Update prices by platform
    public function updatePricesByPlatform(string $itemId, array $prices): UpdatePlatformPriceResponse
    {
        $response = $this->put(
            '/integration/prices/platforms/' . rawurlencode($itemId),
            $prices
        );

        return $this->hydrateModel(
            UpdatePlatformPriceResponse::class,
            $response
        );
    }

    //PUT
    // /integration/prices/bysku
    // Update prices by sku
    public function updatePricesBySku(PriceListBySkuPayload|array $payload): EmptyResult
    {
        $this->put("/integration/prices/list/bysku", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function updatePriceV2(PriceIntegrationPayload|array $payload): EmptyResult
    {
        $this->put("/integration/prices/v2", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function updatePricesByPlatformV2(PlatformPricesIntegrationPayload|array $payload): UpdatePlatformPriceResponse
    {
        $response = $this->put("/integration/prices/platforms/v2", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            UpdatePlatformPriceResponse::class,
            $response
        );
    }

    public function updatePricesV2(PriceListIntegrationPayload|array $payload): EmptyResult
    {
        $this->put("/integration/prices/list/v2", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function getPriceBySku(string $sku): SkuPrice
    {
        $query = [
            'sku' => $sku,
        ];

        $response = $this->get("/integration/prices/bysku", $query);

        return $this->getClient()->getServiceProvider()->create(
            SkuPrice::class,
            $response
        );
    }

    public function updatePriceBySku(PriceBySkuPayload|array $payload): EmptyResult
    {
        $this->put("/integration/prices/bysku", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);
        return $this->hydrateModel(EmptyResult::class, []);
    }
}
