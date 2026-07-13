<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Resource\PlatformResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class PlatformResourceContractTest extends ContractTestCase
{
    public function testConfiguration(): void
    {
        $client = $this->newContractClient(200);

        $resource = new PlatformResource($client);
        $this->assertContractCall($client, static function () use ($resource): void {
            $resource->configuration();
        }, false);
    }

    public function testCreatedBlacklist(): void
    {
        $client = $this->newContractClient(200);

        $resource = new PlatformResource($client);
        $this->assertContractCall($client, static function () use ($resource): void {
            $resource->createdBlacklist();
        }, false);
    }
}
