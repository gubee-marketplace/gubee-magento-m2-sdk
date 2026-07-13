<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Integration\Contract;

use Gubee\SDK\Resource\InvoiceResource;
use Gubee\SDK\Tests\Integration\Contract\ContractTestCase;

class InvoiceResourceContractTest extends ContractTestCase
{
    public function testListInvoiceByOrderId(): void
    {
        $orderId = 'string';

        $client = $this->newContractClient(200);

        $resource = new InvoiceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $orderId): void {
            $resource->listInvoiceByOrderId($orderId);
        }, false);
    }

    public function testGetDownloadUrl1(): void
    {
        $invoiceId = 'string';

        $client = $this->newContractClient(200);

        $resource = new InvoiceResource($client);
        $this->assertContractCall($client, static function () use ($resource, $invoiceId): void {
            $resource->getDownloadUrl_1($invoiceId);
        }, false);
    }
}
