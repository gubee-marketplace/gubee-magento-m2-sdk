<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoicer;

use Gubee\SDK\Enum\Sales\Order\PurposeEnum;
use Gubee\SDK\Model\Invoicer\ReversalInvoice;
use PHPUnit\Framework\TestCase;

class ReversalInvoiceTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $invoice = new ReversalInvoice('invoice-1', 'reason', 'DEVOLUTION');

        $this->assertSame('invoice-1', $invoice->getInvoiceId());
        $this->assertSame('reason', $invoice->getReason());
        $this->assertEquals(PurposeEnum::DEVOLUTION(), $invoice->getPurpose());
    }

    public function testSetters(): void
    {
        $invoice = new ReversalInvoice();

        $invoice->setInvoiceId('invoice-2');
        $invoice->setReason('reason-2');
        $invoice->setPurpose(PurposeEnum::CREDIT());

        $this->assertSame('invoice-2', $invoice->getInvoiceId());
        $this->assertSame('reason-2', $invoice->getReason());
        $this->assertEquals(PurposeEnum::CREDIT(), $invoice->getPurpose());
    }

    public function testDefaultsAreNull(): void
    {
        $invoice = new ReversalInvoice();

        $this->assertNull($invoice->getInvoiceId());
        $this->assertNull($invoice->getReason());
        $this->assertNull($invoice->getPurpose());
    }
}
