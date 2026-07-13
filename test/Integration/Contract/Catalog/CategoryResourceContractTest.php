<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Catalog;

use Gubee\SDK\Model\Catalog\Category;
use Gubee\SDK\Resource\Catalog\CategoryResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class CategoryResourceContractTest extends ContractTestCase
{
    public function testUpdateByExternalId(): void
    {
        $externalId = 'string';

        $payloadData = [
            'active'                 => true,
            'enabledAutoIntegration' => true,
        ];
        $payload     = $this->mockPayload(Category::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new CategoryResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId, $payload): void {
            $resource->updateByExternalId($externalId, $payload);
        }, false);
    }

    public function testBulkUpdate(): void
    {
        $payloadData = [
            0
            => [
                'active'                 => true,
                'enabledAutoIntegration' => true,
            ],
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(404);

        $resource = new CategoryResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->bulkUpdate($payload);
        }, false);
    }

    public function testBulkCreate(): void
    {
        $payloadData = [
            0
            => [
                'active'                 => true,
                'enabledAutoIntegration' => true,
            ],
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(404);

        $resource = new CategoryResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->bulkCreate($payload);
        }, false);
    }

    public function testCreate(): void
    {
        $payloadData = [
            'active'                 => true,
            'enabledAutoIntegration' => true,
        ];
        $payload     = $this->mockPayload(Category::class, $payloadData);

        $client = $this->newContractClient(201);

        $resource = new CategoryResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->create($payload);
        }, false);
    }

    public function testLoadByExternalId(): void
    {
        $externalId = 'string';

        $client = $this->newContractClient(200);

        $resource = new CategoryResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId): void {
            $resource->loadByExternalId($externalId);
        }, false);
    }

    public function testListAll1(): void
    {
        $pageable = [
            'page' => 1,
            'size' => 1,
            'sort'
            => [
                0 => 'string',
            ],
        ];

        $client = $this->newContractClient(404);

        $resource = new CategoryResource($client);
        $this->assertContractCall($client, static function () use ($resource, $pageable): void {
            $resource->listAll_1($pageable);
        }, false);
    }

    public function testLoadById(): void
    {
        $id = 'string';

        $client = $this->newContractClient(200);

        $resource = new CategoryResource($client);
        $this->assertContractCall($client, static function () use ($resource, $id): void {
            $resource->loadById($id);
        }, false);
    }
}
