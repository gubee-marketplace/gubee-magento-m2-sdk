<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Common\EmptyResult;
use Gubee\SDK\Model\Common\PagedResult;
use Gubee\SDK\Model\Common\StringList;
use Gubee\SDK\Model\Invoice\SearchParams;
use Gubee\SDK\Model\Promotion\Promotion;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function rawurlencode;

class PromotionResource extends AbstractResource
{
    public function updatePromotion(string $promotionId, Promotion|array $payload): Promotion
    {
        $response = $this->put("/integration/promotions/update/" . rawurlencode($promotionId) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            Promotion::class,
            $response
        );
    }

    public function finishPromotions(array $payload): EmptyResult
    {
        $this->put("/integration/promotions/finish", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function activatePromotions(array $payload): EmptyResult
    {
        $this->put("/integration/promotions/activate", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function createPromotion(Promotion|array $payload): Promotion
    {
        $response = $this->post("/integration/promotions", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            Promotion::class,
            $response
        );
    }

    public function clonePromotion(string $id): Promotion
    {
        $response = $this->post("/integration/promotions/" . rawurlencode($id) . "/clone", []);

        return $this->getClient()->getServiceProvider()->create(
            Promotion::class,
            $response
        );
    }

    public function searchPromotions($pageable, SearchParams|array $payload): PagedResult
    {
        $query = [
            'pageable' => $pageable,
        ];

        $response = $this->post(
            $query === [] ? "/integration/promotions/list/search" : "/integration/promotions/list/search" . self::build($query),
            $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload
        );

        return $this->hydratePagedResult(
            Promotion::class,
            $response,
            [
                'serviceProvider' => $this->getClient()->getServiceProvider(),
            ],
            ['promotions', 'objectList']
        );
    }

    public function searchPromotionIds(SearchParams|array $payload): StringList
    {
        $response = $this->post("/integration/promotions/list/search/ids", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            StringList::class,
            ['values' => $response]
        );
    }

    public function getPromotion(string $promotionId): Promotion
    {
        $response = $this->get(
            "/integration/promotions/" . rawurlencode($promotionId) . ""
        );

        return $this->getClient()->getServiceProvider()->create(
            Promotion::class,
            $response
        );
    }

    public function deletePromotion(string $promotionId): Promotion
    {
        $response = $this->delete(
            "/integration/promotions/" . rawurlencode($promotionId) . ""
        );

        return $this->getClient()->getServiceProvider()->create(
            Promotion::class,
            $response
        );
    }

    public function listPromotions($pageable): PagedResult
    {
        $query = [
            'pageable' => $pageable,
        ];

        $response = $this->get("/integration/promotions/list/all", $query);

        return $this->hydratePagedResult(
            Promotion::class,
            $response,
            [
                'serviceProvider' => $this->getClient()->getServiceProvider(),
            ],
            ['promotions', 'objectList']
        );
    }
}
