<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Resource\SkuResolveResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class SkuResolveResourceContractTest extends ContractTestCase
{
    public function testResolveSkuBySkuId(): void
    {
        $skuId = 'string';

        $client = $this->newContractClient(200);

        $resource = new SkuResolveResource($client);
        $this->assertContractCall($client, static function () use ($resource, $skuId): void {
            $resource->resolveSkuBySkuId($skuId);
        }, false);
    }

    public function testResolveSkuIdBySku(): void
    {
        $sku = 'string';

        $client = $this->newContractClient(200);

        $resource = new SkuResolveResource($client);
        $this->assertContractCall($client, static function () use ($resource, $sku): void {
            $resource->resolveSkuIdBySku($sku);
        }, false);
    }
}
