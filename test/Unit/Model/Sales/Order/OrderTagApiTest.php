<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\Sales\Order\OrderTagApi;
use PHPUnit\Framework\TestCase;

class OrderTagApiTest extends TestCase
{
    public function testConstructorWithNulls(): void
    {
        $model = new OrderTagApi();

        $this->assertNull($model->getId());
        $this->assertNull($model->getSellerId());
        $this->assertNull($model->getAccountId());
        $this->assertNull($model->getPlatform());
        $this->assertNull($model->getCustomerName());
        $this->assertNull($model->getValue());
        $this->assertNull($model->getDate());
        $this->assertNull($model->getStatus());
        $this->assertNull($model->getCarrierName());
        $this->assertNull($model->getCurrentStatus());
        $this->assertNull($model->getShippingDeadlineDt());
        $this->assertNull($model->getInvoiceIssueDt());
    }

    public function testConstructorParsesStringDates(): void
    {
        $model = new OrderTagApi(
            'id-1',
            'seller-1',
            'account-1',
            'platform-1',
            'customer-1',
            10.0,
            '2026-01-01',
            'status-1',
            'carrier-1',
            'current-1',
            '2026-02-01',
            '2026-03-01'
        );

        $this->assertSame('id-1', $model->getId());
        $this->assertSame('seller-1', $model->getSellerId());
        $this->assertSame('account-1', $model->getAccountId());
        $this->assertSame('platform-1', $model->getPlatform());
        $this->assertSame('customer-1', $model->getCustomerName());
        $this->assertSame(10.0, $model->getValue());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getDate());
        $this->assertSame('2026-01-01', $model->getDate()->format('Y-m-d'));
        $this->assertSame('status-1', $model->getStatus());
        $this->assertSame('carrier-1', $model->getCarrierName());
        $this->assertSame('current-1', $model->getCurrentStatus());
        $this->assertSame('2026-02-01', $model->getShippingDeadlineDt()->format('Y-m-d'));
        $this->assertSame('2026-03-01', $model->getInvoiceIssueDt()->format('Y-m-d'));
    }

    public function testConstructorAcceptsDateTimeInterfaceInstances(): void
    {
        $date = new DateTime('2026-04-01');

        $model = new OrderTagApi(date: $date, shippingDeadlineDt: $date, invoiceIssueDt: $date);

        $this->assertSame($date, $model->getDate());
        $this->assertSame($date, $model->getShippingDeadlineDt());
        $this->assertSame($date, $model->getInvoiceIssueDt());
    }

    public function testSetters(): void
    {
        $model = new OrderTagApi();
        $date  = new DateTime('2026-05-01');

        $model->setId('id-2');
        $model->setSellerId('seller-2');
        $model->setAccountId('account-2');
        $model->setPlatform('platform-2');
        $model->setCustomerName('customer-2');
        $model->setValue(20.0);
        $model->setDate($date);
        $model->setStatus('status-2');
        $model->setCarrierName('carrier-2');
        $model->setCurrentStatus('current-2');
        $model->setShippingDeadlineDt($date);
        $model->setInvoiceIssueDt($date);

        $this->assertSame('id-2', $model->getId());
        $this->assertSame('seller-2', $model->getSellerId());
        $this->assertSame('account-2', $model->getAccountId());
        $this->assertSame('platform-2', $model->getPlatform());
        $this->assertSame('customer-2', $model->getCustomerName());
        $this->assertSame(20.0, $model->getValue());
        $this->assertSame($date, $model->getDate());
        $this->assertSame('status-2', $model->getStatus());
        $this->assertSame('carrier-2', $model->getCarrierName());
        $this->assertSame('current-2', $model->getCurrentStatus());
        $this->assertSame($date, $model->getShippingDeadlineDt());
        $this->assertSame($date, $model->getInvoiceIssueDt());
    }
}
