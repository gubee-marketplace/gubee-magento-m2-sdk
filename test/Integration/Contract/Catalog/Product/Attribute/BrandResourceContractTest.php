<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Catalog\Product\Attribute;

use Gubee\SDK\Model\Catalog\Product\Attribute\Brand;
use Gubee\SDK\Resource\Catalog\Product\Attribute\BrandResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class BrandResourceContractTest extends ContractTestCase
{
    public function testUpdateBrandByName(): void
    {
        $payloadData = [
            'name' => 'string',
        ];
        $payload     = $this->mockPayload(Brand::class, $payloadData);

        $client = $this->newContractClient(404);

        $resource = new BrandResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->updateBrandByName($payload);
        }, false);
    }

    public function testLoadByName(): void
    {
        $name = 'string';

        $client = $this->newContractClient(404);

        $resource = new BrandResource($client);
        $this->assertContractCall($client, static function () use ($resource, $name): void {
            $resource->loadByName($name);
        }, false);
    }

    public function testUpdateBrandByName1(): void
    {
        $name = 'string';

        $payloadData = [
            'name' => 'string',
        ];
        $payload     = $this->mockPayload(Brand::class, $payloadData);

        $client = $this->newContractClient(404);

        $resource = new BrandResource($client);
        $this->assertContractCall($client, static function () use ($resource, $name, $payload): void {
            $resource->updateBrandByName_1($name, $payload);
        }, false);
    }

    public function testUpdateByExternalId(): void
    {
        $externalId = 'string';

        $payloadData = [
            'name' => 'string',
        ];
        $payload     = $this->mockPayload(Brand::class, $payloadData);

        $client = $this->newContractClient(404);

        $resource = new BrandResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload, $externalId): void {
            $resource->updateByExternalId($payload, $externalId);
        }, false);
    }

    public function testDeleteBrandByExternalId(): void
    {
        $externalId = 'string';

        $client = $this->newContractClient(204);

        $resource = new BrandResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId): void {
            $resource->deleteBrandByExternalId($externalId);
        }, false);
    }

    public function testCreate(): void
    {
        $payloadData = [
            'name' => 'string',
        ];
        $payload     = $this->mockPayload(Brand::class, $payloadData);

        $client = $this->newContractClient(404);

        $resource = new BrandResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->create($payload);
        }, false);
    }

    public function testLoadByExternalId(): void
    {
        $externalId = 'string';

        $client = $this->newContractClient(404);

        $resource = new BrandResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId): void {
            $resource->loadByExternalId($externalId);
        }, false);
    }

    public function testListAllBrands(): void
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

        $resource = new BrandResource($client);
        $this->assertContractCall($client, static function () use ($resource, $pageable): void {
            $resource->listAllBrands($pageable);
        }, false);
    }

    public function testLoadById(): void
    {
        $id = 'string';

        $client = $this->newContractClient(200);

        $resource = new BrandResource($client);
        $this->assertContractCall($client, static function () use ($resource, $id): void {
            $resource->loadById($id);
        }, false);
    }
}
