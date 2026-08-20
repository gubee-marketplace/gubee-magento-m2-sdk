<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Catalog\Product;

use Gubee\SDK\Model\Catalog\Product\AttributeGroup\AttributeGroupApi;
use Gubee\SDK\Resource\Catalog\Product\AttributeGroupResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class AttributeGroupResourceContractTest extends ContractTestCase
{
    public function testGetAttributeGroup(): void
    {
        $name = 'string';

        $client = $this->newContractClient(404);

        $resource = new AttributeGroupResource($client);
        $this->assertContractCall($client, static function () use ($resource, $name): void {
            $resource->getAttributeGroup($name);
        }, false);
    }

    public function testUpdateAttributeGroup(): void
    {
        $name = 'string';

        $payloadData = [
            'attributes'
            => [
                0 => 'string',
            ],
            'name' => 'string',
        ];
        $payload     = $this->mockPayload(AttributeGroupApi::class, $payloadData);

        $client = $this->newContractClient(404);

        $resource = new AttributeGroupResource($client);
        $this->assertContractCall($client, static function () use ($resource, $name, $payload): void {
            $resource->updateAttributeGroup($name, $payload);
        }, false);
    }

    public function testCreateAttributeGroup(): void
    {
        $payloadData = [
            'attributes'
            => [
                0 => 'string',
            ],
            'name' => 'string',
        ];
        $payload     = $this->mockPayload(AttributeGroupApi::class, $payloadData);

        $client = $this->newContractClient(404);

        $resource = new AttributeGroupResource($client);
        $this->assertContractCall($client, static function () use ($resource, $payload): void {
            $resource->createAttributeGroup($payload);
        }, false);
    }

    public function testListAllAttributeGroups(): void
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

        $resource = new AttributeGroupResource($client);
        $this->assertContractCall($client, static function () use ($resource, $pageable): void {
            $resource->listAllAttributeGroups($pageable);
        }, false);
    }
}
