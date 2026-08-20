<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Invoice\InvoiceApiModel;
use Gubee\SDK\Model\Invoice\InvoiceStatusApiModel;
use PHPUnit\Framework\TestCase;

class InvoiceApiModelTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testConstructorSetsAllScalarFieldsAndHydratesStatuses(): void
    {
        $createdDate = new DateTime('2026-01-01');

        $model = $this->serviceProvider()->create(
            InvoiceApiModel::class,
            [
                'id'          => 'id-1',
                'sellerId'    => 'seller-1',
                'accountId'   => 'account-1',
                'orderId'     => 'order-1',
                'shipmentId'  => 'shipment-1',
                'type'        => 'NFE',
                'extension'   => 'pdf',
                'platform'    => 'gubee',
                'link'        => 'https://example.com/invoice.pdf',
                'createdDate' => $createdDate,
                'statuses'    => [['id' => 'st-1', 'invoiceId' => 'inv-1', 'invoiceExternalId' => 'ext-1', 'status' => 'ISSUED', 'createdDate' => $createdDate]],
            ]
        );

        $this->assertSame('id-1', $model->getId());
        $this->assertSame('seller-1', $model->getSellerId());
        $this->assertSame('account-1', $model->getAccountId());
        $this->assertSame('order-1', $model->getOrderId());
        $this->assertSame('shipment-1', $model->getShipmentId());
        $this->assertSame('NFE', $model->getType());
        $this->assertSame('pdf', $model->getExtension());
        $this->assertSame('gubee', $model->getPlatform());
        $this->assertSame('https://example.com/invoice.pdf', $model->getLink());
        $this->assertSame($createdDate, $model->getCreatedDate());
        $this->assertContainsOnlyInstancesOf(InvoiceStatusApiModel::class, $model->getStatuses());
    }

    public function testConstructorParsesStringCreatedDate(): void
    {
        $model = $this->serviceProvider()->create(
            InvoiceApiModel::class,
            ['createdDate' => '2026-03-03T00:00:00.000']
        );

        $this->assertInstanceOf(DateTimeInterface::class, $model->getCreatedDate());
        $this->assertSame('2026-03-03', $model->getCreatedDate()->format('Y-m-d'));
    }

    public function testConstructorPassesThroughAlreadyHydratedStatus(): void
    {
        $status = $this->serviceProvider()->create(InvoiceStatusApiModel::class, ['id' => 'st-2', 'invoiceId' => 'inv-2', 'invoiceExternalId' => 'ext-2', 'status' => 'ISSUED', 'createdDate' => new DateTime()]);

        $model = $this->serviceProvider()->create(
            InvoiceApiModel::class,
            ['statuses' => [$status]]
        );

        $this->assertSame($status, $model->getStatuses()[0]);
    }

    public function testConstructorWithNullValues(): void
    {
        $model = $this->serviceProvider()->create(InvoiceApiModel::class, []);

        $this->assertNull($model->getId());
        $this->assertNull($model->getSellerId());
        $this->assertNull($model->getAccountId());
        $this->assertNull($model->getOrderId());
        $this->assertNull($model->getShipmentId());
        $this->assertNull($model->getType());
        $this->assertNull($model->getExtension());
        $this->assertNull($model->getPlatform());
        $this->assertNull($model->getLink());
        $this->assertNull($model->getCreatedDate());
        $this->assertNull($model->getStatuses());
    }

    public function testSettersAndGetters(): void
    {
        $model       = $this->serviceProvider()->create(InvoiceApiModel::class, []);
        $createdDate = new DateTime('2027-02-02');
        $status      = $this->serviceProvider()->create(InvoiceStatusApiModel::class, ['id' => 'st-3', 'invoiceId' => 'inv-3', 'invoiceExternalId' => 'ext-3', 'status' => 'CANCELLED', 'createdDate' => new DateTime()]);

        $model->setId('id-2');
        $model->setSellerId('seller-2');
        $model->setAccountId('account-2');
        $model->setOrderId('order-2');
        $model->setShipmentId('shipment-2');
        $model->setType('NFSE');
        $model->setExtension('xml');
        $model->setPlatform('other');
        $model->setLink('https://example.com/other.pdf');
        $model->setCreatedDate($createdDate);
        $model->setStatuses([$status]);

        $this->assertSame('id-2', $model->getId());
        $this->assertSame('seller-2', $model->getSellerId());
        $this->assertSame('account-2', $model->getAccountId());
        $this->assertSame('order-2', $model->getOrderId());
        $this->assertSame('shipment-2', $model->getShipmentId());
        $this->assertSame('NFSE', $model->getType());
        $this->assertSame('xml', $model->getExtension());
        $this->assertSame('other', $model->getPlatform());
        $this->assertSame('https://example.com/other.pdf', $model->getLink());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getCreatedDate());
        $this->assertSame($createdDate, $model->getCreatedDate());
        $this->assertSame([$status], $model->getStatuses());

        $model->setStatuses(null);
        $this->assertNull($model->getStatuses());
    }
}
