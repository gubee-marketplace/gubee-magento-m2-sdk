<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\Invoice\InvoiceStatusApiModel;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class InvoiceStatusApiModelTest extends TestCase
{
    public function testConstructorParsesStringCreatedDate(): void
    {
        $model = new InvoiceStatusApiModel(
            'id-1',
            'invoice-1',
            'ext-1',
            'PROCESSED',
            '2026-07-12T10:00:00.000',
            ['msg-1', 'msg-2']
        );

        $this->assertSame('id-1', $model->getId());
        $this->assertSame('invoice-1', $model->getInvoiceId());
        $this->assertSame('ext-1', $model->getInvoiceExternalId());
        $this->assertSame('PROCESSED', $model->getStatus());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getCreatedDate());
        $this->assertSame('2026-07-12', $model->getCreatedDate()->format('Y-m-d'));
        $this->assertSame(['msg-1', 'msg-2'], $model->getMessages());
    }

    public function testConstructorAcceptsDateTimeInterfaceCreatedDate(): void
    {
        $createdDate = new DateTime('2026-01-01');

        $model = new InvoiceStatusApiModel(null, null, null, null, $createdDate);

        $this->assertSame($createdDate, $model->getCreatedDate());
    }

    public function testConstructorWithNullOptionalValues(): void
    {
        $createdDate = new DateTime('2026-01-01');

        $model = new InvoiceStatusApiModel(null, null, null, null, $createdDate);

        $this->assertNull($model->getId());
        $this->assertNull($model->getInvoiceId());
        $this->assertNull($model->getInvoiceExternalId());
        $this->assertNull($model->getStatus());
        $this->assertNull($model->getMessages());
    }

    public function testSetters(): void
    {
        $model   = new InvoiceStatusApiModel(null, null, null, null, new DateTime('2026-01-01'));
        $newDate = new DateTime('2027-02-02');

        $model->setId('id-2');
        $model->setInvoiceId('invoice-2');
        $model->setInvoiceExternalId('ext-2');
        $model->setStatus('FAILED');
        $model->setCreatedDate($newDate);
        $model->setMessages(['msg-3']);

        $this->assertSame('id-2', $model->getId());
        $this->assertSame('invoice-2', $model->getInvoiceId());
        $this->assertSame('ext-2', $model->getInvoiceExternalId());
        $this->assertSame('FAILED', $model->getStatus());
        $this->assertSame($newDate, $model->getCreatedDate());
        $this->assertSame(['msg-3'], $model->getMessages());

        $model->setMessages(null);
        $this->assertNull($model->getMessages());
    }

    public function testSetMessagesRejectsNonStringElements(): void
    {
        $model = new InvoiceStatusApiModel(null, null, null, null, new DateTime('2026-01-01'));

        $this->expectException(InvalidArgumentException::class);
        $model->setMessages([1, 2]);
    }
}
