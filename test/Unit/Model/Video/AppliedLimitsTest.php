<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Video;

use Gubee\SDK\Model\Video\AppliedLimits;
use PHPUnit\Framework\TestCase;

class AppliedLimitsTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $limits = new AppliedLimits(1000, 2000, 100, 200);

        $this->assertSame(1000, $limits->getMaxSizeBytes());
        $this->assertSame(2000, $limits->getMaxDurationMs());
        $this->assertSame(100, $limits->getMinWidth());
        $this->assertSame(200, $limits->getMinHeight());
    }

    public function testSetters(): void
    {
        $limits = new AppliedLimits();

        $limits->setMaxSizeBytes(1);
        $limits->setMaxDurationMs(2);
        $limits->setMinWidth(3);
        $limits->setMinHeight(4);

        $this->assertSame(1, $limits->getMaxSizeBytes());
        $this->assertSame(2, $limits->getMaxDurationMs());
        $this->assertSame(3, $limits->getMinWidth());
        $this->assertSame(4, $limits->getMinHeight());
    }

    public function testDefaultsAreNull(): void
    {
        $limits = new AppliedLimits();

        $this->assertNull($limits->getMaxSizeBytes());
        $this->assertNull($limits->getMaxDurationMs());
        $this->assertNull($limits->getMinWidth());
        $this->assertNull($limits->getMinHeight());
    }
}
