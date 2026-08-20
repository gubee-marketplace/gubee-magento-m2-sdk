<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use DateTime;
use Gubee\SDK\Model\Platform\PlatformPricePeriod;
use PHPUnit\Framework\TestCase;

class PlatformPricePeriodTest extends TestCase
{
    public function testConstructorWithNulls(): void
    {
        $model = new PlatformPricePeriod();

        $this->assertNull($model->getBeginDt());
        $this->assertNull($model->getEndDt());
    }

    public function testConstructorAcceptsDateTimeInterface(): void
    {
        $begin = new DateTime('2026-03-01');
        $end   = new DateTime('2026-04-01');

        $model = new PlatformPricePeriod($begin, $end);

        $this->assertSame($begin, $model->getBeginDt());
        $this->assertSame($end, $model->getEndDt());
    }

    public function testSetters(): void
    {
        $model = new PlatformPricePeriod();
        $begin = new DateTime('2026-05-01');
        $end   = new DateTime('2026-06-01');

        $model->setBeginDt($begin);
        $model->setEndDt($end);

        $this->assertSame($begin, $model->getBeginDt());
        $this->assertSame($end, $model->getEndDt());
    }
}
