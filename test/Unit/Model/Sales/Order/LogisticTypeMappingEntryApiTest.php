<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Model\Sales\Order\LogisticTypeMappingEntryApi;
use PHPUnit\Framework\TestCase;

class LogisticTypeMappingEntryApiTest extends TestCase
{
    public function testConstructorWithNulls(): void
    {
        $model = new LogisticTypeMappingEntryApi();

        $this->assertNull($model->getName());
        $this->assertNull($model->getShippingMode());
    }

    public function testConstructorWithValues(): void
    {
        $model = new LogisticTypeMappingEntryApi('name-1', 'mode-1');

        $this->assertSame('name-1', $model->getName());
        $this->assertSame('mode-1', $model->getShippingMode());
    }

    public function testSetters(): void
    {
        $model = new LogisticTypeMappingEntryApi();

        $model->setName('name-2');
        $model->setShippingMode('mode-2');

        $this->assertSame('name-2', $model->getName());
        $this->assertSame('mode-2', $model->getShippingMode());
    }
}
