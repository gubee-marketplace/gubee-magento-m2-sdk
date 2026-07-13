<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Model\Ad\AdSearchParams;
use Gubee\SDK\Model\Ad\AdTitleDescription;
use Gubee\SDK\Resource\AdResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class AdResourceContractTest extends ContractTestCase
{
    public function testUpdateDescriptionByOriginSkuId(): void
    {
        $skuId = 'string';

        $payloadData = [
            'title'       => 'string',
            'description' => 'string',
        ];
        $payload     = $this->mockPayload(AdTitleDescription::class, $payloadData);

        $client = $this->newContractClient(404);

        $resource = new AdResource($client);
        $this->assertContractCall($client, static function () use ($resource, $skuId, $payload): void {
            $resource->updateDescriptionByOriginSkuId($skuId, $payload);
        }, false);
    }

    public function testSearchOriginSkuIds(): void
    {
        $platform   = 'string';
        $onlySimple = true;

        $payloadData = [
            'sku'  => 'string',
            'name' => 'string',
            'plansIds'
            => [
                0 => 'string',
            ],
            'status'
            => [
                0 => 'ACTIVE',
            ],
            'ean' => 'string',
        ];
        $payload     = $this->mockPayload(AdSearchParams::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new AdResource($client);
        $this->assertContractCall($client, static function () use ($resource, $platform, $onlySimple, $payload): void {
            $resource->searchOriginSkuIds($platform, $onlySimple, $payload);
        }, false);
    }

    public function testFindAllOriginSkuIdByAdIds(): void
    {
        $payloadData = [
            0 => 'string',
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new AdResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->findAllOriginSkuIdByAdIds($payload);
        }, false);
    }

    public function testMapOriginSkuIds(): void
    {
        $payloadData = [
            0 => 'string',
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new AdResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->mapOriginSkuIds($payload);
        }, false);
    }

    public function testListAdsByOriginSkuIds(): void
    {
        $originSkuIds = [
            0 => 'string',
        ];

        $client = $this->newContractClient(400);

        $resource = new AdResource($client);
        $this->assertContractCall($client, static function () use ($resource, $originSkuIds): void {
            $resource->listAdsByOriginSkuIds($originSkuIds);
        }, false);
    }

    public function testFindFullAdById(): void
    {
        $id = 'string';

        $client = $this->newContractClient(404);

        $resource = new AdResource($client);
        $this->assertContractCall($client, static function () use ($resource, $id): void {
            $resource->findFullAdById($id);
        }, false);
    }
}
