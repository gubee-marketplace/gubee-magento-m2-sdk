<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Resource\TokenResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class TokenResourceContractTest extends ContractTestCase
{
    public function testRevalidate(): void
    {
        $token = 'string';

        $payloadData = 'string';

        $client = $this->newContractClient(404);

        $resource = new TokenResource($client);
        $this->assertContractCall($client, static function () use ($resource, $token): void {
            $resource->revalidate($token);
        }, false);
    }
}
