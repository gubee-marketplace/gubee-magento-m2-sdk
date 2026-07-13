<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoicer;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Invoice\InvoiceItem;
use Gubee\SDK\Model\Invoicer\ComplementaryInvoice;
use PHPUnit\Framework\TestCase;

class ComplementaryInvoiceTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesItemsFromRawArrays(): void
    {
        $invoice = new ComplementaryInvoice(
            $this->serviceProvider(),
            'invoice-1',
            'reason',
            [['skuId' => 'sku-1']]
        );

        $this->assertSame('invoice-1', $invoice->getInvoiceId());
        $this->assertSame('reason', $invoice->getReason());
        $this->assertContainsOnlyInstancesOf(InvoiceItem::class, $invoice->getItems());
    }

    public function testPassesThroughAlreadyHydratedInstance(): void
    {
        $item = new InvoiceItem(skuId: 'sku-1');

        $invoice = new ComplementaryInvoice($this->serviceProvider(), items: [$item]);

        $this->assertSame($item, $invoice->getItems()[0]);
    }

    public function testSetters(): void
    {
        $invoice = new ComplementaryInvoice($this->serviceProvider());

        $invoice->setInvoiceId('invoice-2');
        $invoice->setReason('reason-2');
        $item = new InvoiceItem(skuId: 'sku-2');
        $invoice->setItems([$item]);

        $this->assertSame('invoice-2', $invoice->getInvoiceId());
        $this->assertSame('reason-2', $invoice->getReason());
        $this->assertSame([$item], $invoice->getItems());
    }

    public function testDefaultsAreNull(): void
    {
        $invoice = new ComplementaryInvoice($this->serviceProvider());

        $this->assertNull($invoice->getInvoiceId());
        $this->assertNull($invoice->getReason());
        $this->assertNull($invoice->getItems());
    }
}
