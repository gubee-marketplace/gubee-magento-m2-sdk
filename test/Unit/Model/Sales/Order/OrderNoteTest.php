<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Model\Sales\Order\OrderNote;
use PHPUnit\Framework\TestCase;

class OrderNoteTest extends TestCase
{
    public function testConstructorWithMinimalArgs(): void
    {
        $model = new OrderNote(true, ['order-1', 'order-2']);

        $this->assertTrue($model->getSuccess());
        $this->assertSame(['order-1', 'order-2'], $model->getOrderIds());
        $this->assertNull($model->getErrorMessage());
    }

    public function testConstructorWithErrorMessage(): void
    {
        $model = new OrderNote(false, [], 'boom');

        $this->assertFalse($model->getSuccess());
        $this->assertSame([], $model->getOrderIds());
        $this->assertSame('boom', $model->getErrorMessage());
    }

    public function testSetters(): void
    {
        $model = new OrderNote(true, ['order-1']);

        $model->setSuccess(false);
        $model->setOrderIds(['order-2']);
        $model->setErrorMessage('fail');

        $this->assertFalse($model->getSuccess());
        $this->assertSame(['order-2'], $model->getOrderIds());
        $this->assertSame('fail', $model->getErrorMessage());
    }
}
