<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Model\Sales\Order\LogisticTypeApi;
use PHPUnit\Framework\TestCase;

class LogisticTypeApiTest extends TestCase
{
    public function testConstructorWithNulls(): void
    {
        $model = new LogisticTypeApi();

        $this->assertNull($model->getName());
        $this->assertNull($model->getShippingId());
        $this->assertNull($model->getShippingMode());
    }

    public function testConstructorWithValues(): void
    {
        $model = new LogisticTypeApi('name-1', 'shipping-1', 'mode-1');

        $this->assertSame('name-1', $model->getName());
        $this->assertSame('shipping-1', $model->getShippingId());
        $this->assertSame('mode-1', $model->getShippingMode());
    }

    public function testSetters(): void
    {
        $model = new LogisticTypeApi();

        $model->setName('name-2');
        $model->setShippingId('shipping-2');
        $model->setShippingMode('mode-2');

        $this->assertSame('name-2', $model->getName());
        $this->assertSame('shipping-2', $model->getShippingId());
        $this->assertSame('mode-2', $model->getShippingMode());
    }
}
