<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Resource\LogisticTypeMappingResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class LogisticTypeMappingResourceContractTest extends ContractTestCase
{
    public function testGetLogisticTypeMapping(): void
    {
        $platform = 'string';

        $client = $this->newContractClient(404);

        $resource = new LogisticTypeMappingResource($client);
        $this->assertContractCall($client, static function () use ($resource, $platform): void {
            $resource->getLogisticTypeMapping($platform);
        }, false);
    }
}
