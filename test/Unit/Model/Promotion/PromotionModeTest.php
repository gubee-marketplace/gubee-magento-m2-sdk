<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Promotion;

use Gubee\SDK\Enum\Promotion\ModeEnum;
use Gubee\SDK\Model\Promotion\PromotionMode;
use PHPUnit\Framework\TestCase;

class PromotionModeTest extends TestCase
{
    public function testConstructorWithNulls(): void
    {
        $model = new PromotionMode();

        $this->assertNull($model->getMode());
        $this->assertNull($model->getValue());
    }

    public function testConstructorAcceptsStringMode(): void
    {
        $model = new PromotionMode('PERCENTUAL', 15.5);

        $this->assertInstanceOf(ModeEnum::class, $model->getMode());
        $this->assertSame('PERCENTUAL', (string) $model->getMode());
        $this->assertSame(15.5, $model->getValue());
    }

    public function testConstructorAcceptsEnumInstance(): void
    {
        $model = new PromotionMode(ModeEnum::fromValue('SUM_FIXED_PRICE'), 1.0);

        $this->assertSame('SUM_FIXED_PRICE', (string) $model->getMode());
    }

    public function testSetters(): void
    {
        $model = new PromotionMode();

        $model->setMode(ModeEnum::fromValue('SUBTRACT_FIXED_PRICE'));
        $model->setValue(9.9);

        $this->assertSame('SUBTRACT_FIXED_PRICE', (string) $model->getMode());
        $this->assertSame(9.9, $model->getValue());
    }
}
