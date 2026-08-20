<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Resource\TagResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class TagResourceContractTest extends ContractTestCase
{
    public function testUngroupTag(): void
    {
        $groupId = 'string';

        $payloadData = [
            0 => 'string',
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $groupId, $payload): void {
            $resource->ungroupTag($groupId, $payload);
        }, false);
    }

    public function testCreateTag(): void
    {
        $platform     = 'HUBEE';
        $accountId    = 'string';
        $packageTypes = [
            0 => 'string',
        ];

        $payloadData = [
            0 => 'string',
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $platform, $accountId, $packageTypes, $payload): void {
            $resource->createTag($platform, $accountId, $packageTypes, $payload);
        }, false);
    }

    public function testMergePackages(): void
    {
        $groupId     = 'string';
        $packageType = 'string';

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $groupId, $packageType): void {
            $resource->mergePackages($groupId, $packageType);
        }, false);
    }

    public function testFindById(): void
    {
        $groupId = 'string';

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $groupId): void {
            $resource->findById($groupId);
        }, false);
    }

    public function testFindAllTagPackages(): void
    {
        $groupId = 'string';

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $groupId): void {
            $resource->findAllTagPackages($groupId);
        }, false);
    }

    public function testGetDownloadUrl(): void
    {
        $packageId   = 'string';
        $packageType = 'string';

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $packageId, $packageType): void {
            $resource->getDownloadUrl($packageId, $packageType);
        }, false);
    }

    public function testDownloadMergedPackages(): void
    {
        $groupId     = 'string';
        $packageType = 'string';

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $groupId, $packageType): void {
            $resource->downloadMergedPackages($groupId, $packageType);
        }, false);
    }

    public function testSearchPendingTagsOfOrders(): void
    {
        $platform       = 'HUBEE';
        $startDt        = 'string';
        $endDt          = 'string';
        $limit          = 1;
        $scrollId       = 'string';
        $searchText     = 'string';
        $accountIds     = [
            0 => 'string',
        ];
        $dateFilterType = 'ORDER_CREATED';

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $platform, $startDt, $endDt, $limit, $scrollId, $searchText, $accountIds, $dateFilterType): void {
            $resource->searchPendingTagsOfOrders($platform, $startDt, $endDt, $limit, $scrollId, $searchText, $accountIds, $dateFilterType);
        }, false);
    }

    public function testSearchPendingTagsOfOrdersPageable(): void
    {
        $platform       = 'HUBEE';
        $startDt        = 'string';
        $endDt          = 'string';
        $searchText     = 'string';
        $accountIds     = [
            0 => 'string',
        ];
        $dateFilterType = 'ORDER_CREATED';
        $pageable       = [
            'page' => 1,
            'size' => 1,
            'sort'
            => [
                0 => 'string',
            ],
        ];

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $platform, $startDt, $endDt, $searchText, $accountIds, $dateFilterType, $pageable): void {
            $resource->searchPendingTagsOfOrdersPageable($platform, $startDt, $endDt, $searchText, $accountIds, $dateFilterType, $pageable);
        }, false);
    }

    public function testSearchIdsPendingTagsOfOrders(): void
    {
        $platform       = 'HUBEE';
        $startDt        = 'string';
        $endDt          = 'string';
        $search         = 'string';
        $accountId      = 'string';
        $dateFilterType = 'ORDER_CREATED';

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $platform, $startDt, $endDt, $search, $accountId, $dateFilterType): void {
            $resource->searchIdsPendingTagsOfOrders($platform, $startDt, $endDt, $search, $accountId, $dateFilterType);
        }, false);
    }

    public function testFindAllTagGroup(): void
    {
        $platform = 'HUBEE';
        $limit    = 1;
        $scrollId = 'string';
        $search   = 'string';

        $client = $this->newContractClient(200);

        $resource = new TagResource($client);
        $this->assertContractCall($client, static function () use ($resource, $platform, $limit, $scrollId, $search): void {
            $resource->findAllTagGroup($platform, $limit, $scrollId, $search);
        }, false);
    }
}
