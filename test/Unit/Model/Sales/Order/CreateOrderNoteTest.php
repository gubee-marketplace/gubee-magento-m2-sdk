<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Model\Sales\Order\CreateOrderNote;
use PHPUnit\Framework\TestCase;

class CreateOrderNoteTest extends TestCase
{
    public function testConstructorAndGetter(): void
    {
        $model = new CreateOrderNote('some note');

        $this->assertSame('some note', $model->getNote());
    }

    public function testSetter(): void
    {
        $model = new CreateOrderNote('some note');

        $model->setNote('another note');

        $this->assertSame('another note', $model->getNote());
    }
}
