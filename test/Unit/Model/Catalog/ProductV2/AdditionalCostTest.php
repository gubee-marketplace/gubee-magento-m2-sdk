<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\ProductV2;

use Gubee\SDK\Model\Catalog\ProductV2\AdditionalCost;
use PHPUnit\Framework\TestCase;

class AdditionalCostTest extends TestCase
{
    public function testConstructWithAllFields(): void
    {
        $additionalCost = new AdditionalCost('Freight', 9.9, 'FIXED', 'FREIGHT');

        $this->assertSame('Freight', $additionalCost->getName());
        $this->assertSame(9.9, $additionalCost->getValue());
        $this->assertSame('FIXED', $additionalCost->getType());
        $this->assertSame('FREIGHT', $additionalCost->getKind());
    }

    public function testConstructWithOnlyRequiredField(): void
    {
        $additionalCost = new AdditionalCost(null, 1.5);

        $this->assertNull($additionalCost->getName());
        $this->assertSame(1.5, $additionalCost->getValue());
        $this->assertNull($additionalCost->getType());
        $this->assertNull($additionalCost->getKind());
    }

    public function testSetters(): void
    {
        $additionalCost = new AdditionalCost(null, 1.5);

        $additionalCost->setName('Freight');
        $additionalCost->setValue(2.5);
        $additionalCost->setType('FIXED');
        $additionalCost->setKind('FREIGHT');

        $this->assertSame('Freight', $additionalCost->getName());
        $this->assertSame(2.5, $additionalCost->getValue());
        $this->assertSame('FIXED', $additionalCost->getType());
        $this->assertSame('FREIGHT', $additionalCost->getKind());
    }
}
