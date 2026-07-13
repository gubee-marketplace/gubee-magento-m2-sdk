<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoicer;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Invoice\InvoiceItem;
use Gubee\SDK\Model\Invoicer\DevolutionInvoice;
use PHPUnit\Framework\TestCase;

class DevolutionInvoiceTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesItemsFromRawArrays(): void
    {
        $invoice = new DevolutionInvoice(
            $this->serviceProvider(),
            'invoice-1',
            [['skuId' => 'sku-1']]
        );

        $this->assertSame('invoice-1', $invoice->getInvoiceId());
        $this->assertContainsOnlyInstancesOf(InvoiceItem::class, $invoice->getItems());
    }

    public function testPassesThroughAlreadyHydratedInstance(): void
    {
        $item = new InvoiceItem(skuId: 'sku-1');

        $invoice = new DevolutionInvoice($this->serviceProvider(), items: [$item]);

        $this->assertSame($item, $invoice->getItems()[0]);
    }

    public function testSetters(): void
    {
        $invoice = new DevolutionInvoice($this->serviceProvider());

        $invoice->setInvoiceId('invoice-2');
        $item = new InvoiceItem(skuId: 'sku-2');
        $invoice->setItems([$item]);

        $this->assertSame('invoice-2', $invoice->getInvoiceId());
        $this->assertSame([$item], $invoice->getItems());
    }

    public function testDefaultsAreNull(): void
    {
        $invoice = new DevolutionInvoice($this->serviceProvider());

        $this->assertNull($invoice->getInvoiceId());
        $this->assertNull($invoice->getItems());
    }
}
