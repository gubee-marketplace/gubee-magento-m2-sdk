<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\ProductV2;

use Gubee\SDK\Model\Catalog\ProductV2\Cost;
use PHPUnit\Framework\TestCase;

class CostTest extends TestCase
{
    public function testConstructor(): void
    {
        $cost = new Cost('BRL', 10.5);

        $this->assertSame('BRL', $cost->getCurrency());
        $this->assertSame(10.5, $cost->getAmount());
    }

    public function testSetters(): void
    {
        $cost = new Cost('BRL', 10.5);

        $cost->setCurrency('USD');
        $cost->setAmount(20.0);

        $this->assertSame('USD', $cost->getCurrency());
        $this->assertSame(20.0, $cost->getAmount());
    }
}
