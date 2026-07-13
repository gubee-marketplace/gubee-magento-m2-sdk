<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Attribute\Dimension;

use Gubee\SDK\Enum\Catalog\Product\Attribute\Dimension\Measure\TypeEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\Measure;
use PHPUnit\Framework\TestCase;

class MeasureTest extends TestCase
{
    public function testConstructorAcceptsStringType(): void
    {
        $measure = new Measure('CENTIMETER', 10.5);

        $this->assertInstanceOf(TypeEnum::class, $measure->getType());
        $this->assertSame('CENTIMETER', (string) $measure->getType());
        $this->assertSame(10.5, $measure->getValue());
    }

    public function testConstructorAcceptsEnumType(): void
    {
        $measure = new Measure(TypeEnum::METER(), 2.0);

        $this->assertSame('METER', (string) $measure->getType());
    }

    public function testSetters(): void
    {
        $measure = new Measure('CENTIMETER', 10.5);

        $measure->setType(TypeEnum::MILLIMETER());
        $measure->setValue(20.0);

        $this->assertSame('MILLIMETER', (string) $measure->getType());
        $this->assertSame(20.0, $measure->getValue());
    }
}
