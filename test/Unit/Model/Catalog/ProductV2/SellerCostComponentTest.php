<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\ProductV2;

use Gubee\SDK\Model\Catalog\ProductV2\SellerCostComponent;
use PHPUnit\Framework\TestCase;

class SellerCostComponentTest extends TestCase
{
    public function testConstructWithAllFields(): void
    {
        $component = new SellerCostComponent('Freight', 9.9, 'FIXED', 'FREIGHT');

        $this->assertSame('Freight', $component->getName());
        $this->assertSame(9.9, $component->getValue());
        $this->assertSame('FIXED', $component->getType());
        $this->assertSame('FREIGHT', $component->getKind());
    }

    public function testConstructWithNoFields(): void
    {
        $component = new SellerCostComponent();

        $this->assertNull($component->getName());
        $this->assertNull($component->getValue());
        $this->assertNull($component->getType());
        $this->assertNull($component->getKind());
    }

    public function testSetters(): void
    {
        $component = new SellerCostComponent();

        $component->setName('Freight');
        $component->setValue(2.5);
        $component->setType('FIXED');
        $component->setKind('FREIGHT');

        $this->assertSame('Freight', $component->getName());
        $this->assertSame(2.5, $component->getValue());
        $this->assertSame('FIXED', $component->getType());
        $this->assertSame('FREIGHT', $component->getKind());
    }
}
