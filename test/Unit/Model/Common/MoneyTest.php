<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Common;

use Gubee\SDK\Model\Common\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testConstructorWithAllFields(): void
    {
        $money = new Money('BRL', 10.5);

        $this->assertSame('BRL', $money->getCurrency());
        $this->assertSame(10.5, $money->getAmount());
    }

    public function testConstructorWithDefaults(): void
    {
        $money = new Money();

        $this->assertNull($money->getCurrency());
        $this->assertNull($money->getAmount());
    }

    public function testSetters(): void
    {
        $money = new Money();

        $money->setCurrency('USD');
        $money->setAmount(20.75);

        $this->assertSame('USD', $money->getCurrency());
        $this->assertSame(20.75, $money->getAmount());
    }
}
