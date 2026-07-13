<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract\Shipping;

use Gubee\SDK\Model\Shipping\SkuFreightsApi;
use Gubee\SDK\Resource\Shipping\FreightQuoteResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class FreightQuoteResourceContractTest extends ContractTestCase
{
    public function testQuote(): void
    {
        $sellerId   = 'string';
        $postalCode = 1;

        $payloadData = [
            'quotationItems'
            => [
                0
                => [
                    'skuId' => 'string',
                    'qty'   => 1,
                ],
            ],
        ];
        $payload     = $this->mockPayload(SkuFreightsApi::class, $payloadData);

        $client = $this->newContractClient(404);

        $resource = new FreightQuoteResource($client);
        $this->assertContractCall($client, static function () use ($resource, $sellerId, $postalCode, $payload): void {
            $resource->quote($sellerId, $postalCode, $payload);
        }, false);
    }
}
