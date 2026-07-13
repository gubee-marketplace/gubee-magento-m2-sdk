<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Attribute\Dimension;

use Gubee\SDK\Enum\Catalog\Product\Attribute\Dimension\UnitTime\TypeEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\UnitTime;
use PHPUnit\Framework\TestCase;

class UnitTimeTest extends TestCase
{
    public function testConstructorAcceptsStringType(): void
    {
        $unitTime = new UnitTime('DAYS', 5);

        $this->assertInstanceOf(TypeEnum::class, $unitTime->getType());
        $this->assertSame('DAYS', (string) $unitTime->getType());
        $this->assertSame(5, $unitTime->getValue());
    }

    public function testConstructorAcceptsEnumType(): void
    {
        $unitTime = new UnitTime(TypeEnum::HOURS(), 12);

        $this->assertSame('HOURS', (string) $unitTime->getType());
    }

    public function testSetters(): void
    {
        $unitTime = new UnitTime('DAYS', 5);

        $unitTime->setType(TypeEnum::MONTH());
        $unitTime->setValue(3);

        $this->assertSame('MONTH', (string) $unitTime->getType());
        $this->assertSame(3, $unitTime->getValue());
    }
}
