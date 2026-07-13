<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Model\Invoice\SearchParams;
use Gubee\SDK\Model\Promotion\Promotion;
use Gubee\SDK\Resource\PromotionResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class PromotionResourceContractTest extends ContractTestCase
{
    public function testUpdatePromotion(): void
    {
        $promotionId = 'string';

        $payloadData = [
            'id'       => 'string',
            'name'     => 'string',
            'sellerId' => 'string',
            'status'
            => [
                'status' => 'ACTIVE',
            ],
            'description' => 'string',
        ];
        $payload     = $this->mockPayload(Promotion::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new PromotionResource($client);
        $this->assertContractCall($client, static function () use ($resource, $promotionId, $payload): void {
            $resource->updatePromotion($promotionId, $payload);
        }, false);
    }

    public function testFinishPromotions(): void
    {
        $payloadData = [
            0 => 'string',
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new PromotionResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->finishPromotions($payload);
        }, false);
    }

    public function testActivatePromotions(): void
    {
        $payloadData = [
            0 => 'string',
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new PromotionResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->activatePromotions($payload);
        }, false);
    }

    public function testCreatePromotion(): void
    {
        $payloadData = [
            'id'       => 'string',
            'name'     => 'string',
            'sellerId' => 'string',
            'status'
            => [
                'status' => 'ACTIVE',
            ],
            'description' => 'string',
        ];
        $payload     = $this->mockPayload(Promotion::class, $payloadData);

        $client = $this->newContractClient(201);

        $resource = new PromotionResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->createPromotion($payload);
        }, false);
    }

    public function testClonePromotion(): void
    {
        $id = 'string';

        $client = $this->newContractClient(200);

        $resource = new PromotionResource($client);
        $this->assertContractCall($client, static function () use ($resource, $id): void {
            $resource->clonePromotion($id);
        }, false);
    }

    public function testSearchPromotions(): void
    {
        $pageable = [
            'page' => 1,
            'size' => 1,
            'sort'
            => [
                0 => 'string',
            ],
        ];

        $payloadData = [
            'type'    => 'string',
            'storeId' => 'string',
            'status'
            => [
                0 => 'NONE',
            ],
            'orderIds'
            => [
                0 => 'string',
            ],
            'startDt' => '2024-01-01T00:00:00Z',
        ];
        $payload     = $this->mockPayload(SearchParams::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new PromotionResource($client);
        $this->assertContractCall($client, static function () use ($resource, $pageable, $payload): void {
            $resource->searchPromotions($pageable, $payload);
        }, false);
    }

    public function testSearchPromotionIds(): void
    {
        $payloadData = [
            'type'    => 'string',
            'storeId' => 'string',
            'status'
            => [
                0 => 'NONE',
            ],
            'orderIds'
            => [
                0 => 'string',
            ],
            'startDt' => '2024-01-01T00:00:00Z',
        ];
        $payload     = $this->mockPayload(SearchParams::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new PromotionResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->searchPromotionIds($payload);
        }, false);
    }

    public function testGetPromotion(): void
    {
        $promotionId = 'string';

        $client = $this->newContractClient(200);

        $resource = new PromotionResource($client);
        $this->assertContractCall($client, static function () use ($resource, $promotionId): void {
            $resource->getPromotion($promotionId);
        }, false);
    }

    public function testDeletePromotion(): void
    {
        $promotionId = 'string';

        $client = $this->newContractClient(200);

        $resource = new PromotionResource($client);
        $this->assertContractCall($client, static function () use ($resource, $promotionId): void {
            $resource->deletePromotion($promotionId);
        }, false);
    }

    public function testListPromotions(): void
    {
        $pageable = [
            'page' => 1,
            'size' => 1,
            'sort'
            => [
                0 => 'string',
            ],
        ];

        $client = $this->newContractClient(200);

        $resource = new PromotionResource($client);
        $this->assertContractCall($client, static function () use ($resource, $pageable): void {
            $resource->listPromotions($pageable);
        }, false);
    }
}
