<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Ad\Ad;
use Gubee\SDK\Model\Ad\AdGroupApi;
use Gubee\SDK\Model\Ad\AdSearchParams;
use Gubee\SDK\Model\Ad\AdTitleDescription;
use Gubee\SDK\Model\Common\StringList;
use Gubee\SDK\Model\Common\StringMap;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function rawurlencode;

class AdResource extends AbstractResource
{
    public function updateDescriptionByOriginSkuId(string $skuId, AdTitleDescription|array $payload): StringList
    {
        $response = $this->put("/integration/ads/titledescription/byOriginSkuId/" . rawurlencode($skuId) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            StringList::class,
            ['values' => $response]
        );
    }

    public function searchOriginSkuIds(string $platform, ?bool $onlySimple, AdSearchParams|array $payload): StringList
    {
        $query = [
            'onlySimple' => $onlySimple,
        ];

        $response = $this->post(
            $query === [] ? "/integration/ads/search/originSkuIds/" . rawurlencode($platform) . "" : "/integration/ads/search/originSkuIds/" . rawurlencode($platform) . "" . self::build($query),
            $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload
        );

        return $this->hydrateModel(
            StringList::class,
            ['values' => $response]
        );
    }

    public function findAllOriginSkuIdByAdIds(array $payload): StringList
    {
        $response = $this->post("/integration/ads/obtain/originSkuIds", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            StringList::class,
            ['values' => $response]
        );
    }

    public function mapOriginSkuIds(array $payload): StringMap
    {
        $response = $this->post("/integration/ads/map/originSkuIds", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            StringMap::class,
            ['values' => $response]
        );
    }

    public function listAdsByOriginSkuIds(array $originSkuIds): array
    {
        $query = [
            'originSkuIds' => $originSkuIds,
        ];

        $response = $this->get("/integration/ads/list/byOriginSkuId", $query);

        return $this->hydrateCollection(
            Ad::class,
            $response
        );
    }

    public function findFullAdById(string $id): AdGroupApi
    {
        $response = $this->get(
            "/integration/ads/full/" . rawurlencode($id) . ""
        );

        return $this->getClient()->getServiceProvider()->create(
            AdGroupApi::class,
            $response
        );
    }
}
