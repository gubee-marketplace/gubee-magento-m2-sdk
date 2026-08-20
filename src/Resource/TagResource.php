<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Common\EmptyResult;
use Gubee\SDK\Model\Common\PagedResult;
use Gubee\SDK\Model\Common\ScrollResult;
use Gubee\SDK\Model\Common\StringList;
use Gubee\SDK\Model\Common\StringValue;
use Gubee\SDK\Model\Sales\Order\OrderTagApi;
use Gubee\SDK\Model\Tag\CreateTagResponseApi;
use Gubee\SDK\Model\Tag\TagGroupApi;
use Gubee\SDK\Model\Tag\TagPackageApi;
use Gubee\SDK\Model\Tag\UngroupTagsResponseApi;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function rawurlencode;

class TagResource extends AbstractResource
{
    public function ungroupTag(string $groupId, array $payload): UngroupTagsResponseApi
    {
        $response = $this->put("/integration/tags/group/ungroup/" . rawurlencode($groupId) . "", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            UngroupTagsResponseApi::class,
            $response
        );
    }

    public function createTag(string $platform, ?string $accountId, array $packageTypes, array $payload): CreateTagResponseApi
    {
        $query = [
            'accountId'    => $accountId,
            'packageTypes' => $packageTypes,
        ];

        $response = $this->post(
            $query === [] ? "/integration/tags/group/" . rawurlencode($platform) . "" : "/integration/tags/group/" . rawurlencode($platform) . "" . self::build($query),
            $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload
        );

        return $this->getClient()->getServiceProvider()->create(
            CreateTagResponseApi::class,
            $response
        );
    }

    public function mergePackages(string $groupId, string $packageType): EmptyResult
    {
        $this->post("/integration/tags/group/merge/" . rawurlencode($groupId) . "/" . rawurlencode($packageType) . "", []);
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function findById(string $groupId): TagGroupApi
    {
        $response = $this->get(
            "/integration/tags/" . rawurlencode($groupId) . ""
        );

        return $this->getClient()->getServiceProvider()->create(
            TagGroupApi::class,
            $response
        );
    }

    public function findAllTagPackages(string $groupId): array
    {
        $response = $this->get(
            "/integration/tags/package/list/all/" . rawurlencode($groupId) . ""
        );

        return $this->hydrateCollection(
            TagPackageApi::class,
            $response
        );
    }

    public function getDownloadUrl(string $packageId, string $packageType): StringValue
    {
        $query = [
            'packageType' => $packageType,
        ];

        $response = $this->get("/integration/tags/package/download/" . rawurlencode($packageId) . "", $query);

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }

    public function downloadMergedPackages(string $groupId, string $packageType): StringValue
    {
        $response = $this->get(
            "/integration/tags/package/download/merged/" . rawurlencode($groupId) . "/" . rawurlencode($packageType) . ""
        );

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }

    public function searchPendingTagsOfOrders(string $platform, ?string $startDt = null, ?string $endDt = null, ?int $limit = null, ?string $scrollId = null, ?string $searchText = null, ?array $accountIds = null, ?string $dateFilterType = null): ScrollResult
    {
        $query = [
            'startDt'        => $startDt,
            'endDt'          => $endDt,
            'limit'          => $limit,
            'scrollId'       => $scrollId,
            'searchText'     => $searchText,
            'accountIds'     => $accountIds,
            'dateFilterType' => $dateFilterType,
        ];

        $response = $this->get("/integration/tags/order/searchByPendingTags/" . rawurlencode($platform) . "", $query);

        return $this->hydrateScrollResult(
            OrderTagApi::class,
            $response
        );
    }

    public function searchPendingTagsOfOrdersPageable(string $platform, ?string $startDt, ?string $endDt, ?string $searchText, ?array $accountIds, ?string $dateFilterType, mixed $pageable): PagedResult
    {
        $query = [
            'startDt'        => $startDt,
            'endDt'          => $endDt,
            'searchText'     => $searchText,
            'accountIds'     => $accountIds,
            'dateFilterType' => $dateFilterType,
            'pageable'       => $pageable,
        ];

        $response = $this->get("/integration/tags/order/searchByPendingTags/page/" . rawurlencode($platform) . "", $query);

        return $this->hydratePagedResult(
            OrderTagApi::class,
            $response,
            [],
            ['orderTagApiDTOList']
        );
    }

    public function searchIdsPendingTagsOfOrders(string $platform, ?string $startDt = null, ?string $endDt = null, ?string $search = null, ?string $accountId = null, ?string $dateFilterType = null): StringList
    {
        $query = [
            'startDt'        => $startDt,
            'endDt'          => $endDt,
            'search'         => $search,
            'accountId'      => $accountId,
            'dateFilterType' => $dateFilterType,
        ];

        $response = $this->get("/integration/tags/order/searchByPendingTags/ids/" . rawurlencode($platform) . "", $query);

        return $this->hydrateModel(
            StringList::class,
            ['values' => $response]
        );
    }

    public function findAllTagGroup(string $platform, ?int $limit = null, ?string $scrollId = null, ?string $search = null): ScrollResult
    {
        $query = [
            'limit'    => $limit,
            'scrollId' => $scrollId,
            'search'   => $search,
        ];

        $response = $this->get("/integration/tags/group/list/all/" . rawurlencode($platform) . "", $query);

        return $this->hydrateScrollResult(
            TagGroupApi::class,
            $response
        );
    }
}
