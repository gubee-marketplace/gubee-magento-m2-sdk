<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Attribute\Dimension;

use Gubee\SDK\Enum\Catalog\Product\Attribute\Dimension\Weight\TypeEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\Weight;
use PHPUnit\Framework\TestCase;

class WeightTest extends TestCase
{
    public function testConstructorAcceptsStringType(): void
    {
        $weight = new Weight('KILOGRAM', 10.0);

        $this->assertInstanceOf(TypeEnum::class, $weight->getType());
        $this->assertSame('KILOGRAM', (string) $weight->getType());
        $this->assertSame(10.0, $weight->getValue());
    }

    public function testConstructorAcceptsEnumType(): void
    {
        $weight = new Weight(TypeEnum::GRAM(), 500.0);

        $this->assertSame('GRAM', (string) $weight->getType());
        $this->assertSame(500.0, $weight->getValue());
    }

    public function testGetTypeConvertsPoundToKilogram(): void
    {
        $weight = new Weight(TypeEnum::POUND(), 1.0);

        $this->assertSame('KILOGRAM', (string) $weight->getType());
    }

    public function testGetValueReturnsStoredValueForPound(): void
    {
        $weight = new Weight(TypeEnum::POUND(), 2.0);

        $this->assertSame(2.0, $weight->getValue());
    }

    public function testSetters(): void
    {
        $weight = new Weight('KILOGRAM', 10.0);

        $weight->setType(TypeEnum::GRAM());
        $weight->setValue(250.0);

        $this->assertSame('GRAM', (string) $weight->getType());
        $this->assertSame(250.0, $weight->getValue());
    }

    public function testJsonSerialize(): void
    {
        $weight = new Weight('KILOGRAM', 10.0);

        $this->assertSame(
            ['type' => 'KILOGRAM', 'value' => 10.0],
            $weight->jsonSerialize()
        );
    }

    public function testJsonSerializeWithPound(): void
    {
        $weight = new Weight(TypeEnum::POUND(), 2.0);

        $this->assertSame(
            ['type' => 'KILOGRAM', 'value' => 2.0],
            $weight->jsonSerialize()
        );
    }
}
