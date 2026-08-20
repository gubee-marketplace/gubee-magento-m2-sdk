<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Catalog\Product;

use Gubee\SDK\Model\Catalog\Product\Attribute;
use Gubee\SDK\Resource\Catalog\Product\AttributeResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class AttributeResourceContractTest extends ContractTestCase
{
    public function testLoadByExternalId(): void
    {
        $externalId = 'string';

        $client = $this->newContractClient(200);

        $resource = new AttributeResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId): void {
            $resource->loadByExternalId($externalId);
        }, false);
    }

    public function testUpdateByExternalId(): void
    {
        $externalId = 'string';

        $payloadData = [
            'attrType' => 'TEXT',
            'name'     => 'string',
            'options'
            => [
                0 => 'string',
            ],
            'required' => true,
            'variant'  => true,
        ];
        $payload     = $this->mockPayload(Attribute::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new AttributeResource($client);
        $this->assertContractCall($client, static function () use ($resource, $externalId, $payload): void {
            $resource->updateByExternalId($externalId, $payload);
        }, false);
    }

    public function testLoadByName(): void
    {
        $name = 'string';

        $client = $this->newContractClient(200);

        $resource = new AttributeResource($client);
        $this->assertContractCall($client, static function () use ($resource, $name): void {
            $resource->loadByName($name);
        }, false);
    }

    public function testUpdateByName(): void
    {
        $name = 'string';

        $payloadData = [
            'attrType' => 'TEXT',
            'name'     => 'string',
            'options'
            => [
                0 => 'string',
            ],
            'required' => true,
            'variant'  => true,
        ];
        $payload     = $this->mockPayload(Attribute::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new AttributeResource($client);
        $this->assertContractCall($client, static function () use ($resource, $name, $payload): void {
            $resource->updateByName($name, $payload);
        }, false);
    }

    public function testBulkUpdate(): void
    {
        $payloadData = [
            0
            => [
                'attrType' => 'TEXT',
                'name'     => 'string',
                'options'
                => [
                    0 => 'string',
                ],
                'required' => true,
                'variant'  => true,
            ],
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new AttributeResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->bulkUpdate($payload);
        }, false);
    }

    public function testBulkCreate(): void
    {
        $payloadData = [
            0
            => [
                'attrType' => 'TEXT',
                'name'     => 'string',
                'options'
                => [
                    0 => 'string',
                ],
                'required' => true,
                'variant'  => true,
            ],
        ];
        $payload     = $payloadData;

        $client = $this->newContractClient(200);

        $resource = new AttributeResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->bulkCreate($payload);
        }, false);
    }

    public function testCreate(): void
    {
        $payloadData = [
            'attrType' => 'TEXT',
            'name'     => 'string',
            'options'
            => [
                0 => 'string',
            ],
            'required' => true,
            'variant'  => true,
        ];
        $payload     = $this->mockPayload(Attribute::class, $payloadData);

        $client = $this->newContractClient(200);

        $resource = new AttributeResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->create($payload);
        }, false);
    }

    public function testListAll2(): void
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

        $resource = new AttributeResource($client);
        $this->assertContractCall($client, static function () use ($resource, $pageable): void {
            $resource->listAll_2($pageable);
        }, false);
    }

    public function testGetAttributeByQueryName(): void
    {
        $name = 'string';

        $client = $this->newContractClient(200);

        $resource = new AttributeResource($client);
        $this->assertContractCall($client, static function () use ($resource, $name): void {
            $resource->getAttributeByQueryName($name);
        }, false);
    }

    public function testLoadById(): void
    {
        $id = 'string';

        $client = $this->newContractClient(200);

        $resource = new AttributeResource($client);
        $this->assertContractCall($client, static function () use ($resource, $id): void {
            $resource->loadById($id);
        }, false);
    }
}
