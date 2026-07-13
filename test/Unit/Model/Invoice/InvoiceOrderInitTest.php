<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use Gubee\SDK\Model\Invoice\InvoiceOrderInit;
use PHPUnit\Framework\TestCase;

class InvoiceOrderInitTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $model = new InvoiceOrderInit('order-1', 'store-1');

        $this->assertSame('order-1', $model->getOrderId());
        $this->assertSame('store-1', $model->getStoreId());
    }

    public function testConstructorWithNullValues(): void
    {
        $model = new InvoiceOrderInit();

        $this->assertNull($model->getOrderId());
        $this->assertNull($model->getStoreId());
    }

    public function testSetters(): void
    {
        $model = new InvoiceOrderInit();

        $model->setOrderId('order-2');
        $model->setStoreId('store-2');

        $this->assertSame('order-2', $model->getOrderId());
        $this->assertSame('store-2', $model->getStoreId());
    }
}
