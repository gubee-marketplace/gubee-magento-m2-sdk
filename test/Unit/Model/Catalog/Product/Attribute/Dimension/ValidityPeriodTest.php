<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Attribute\Dimension;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\ValidityPeriod;
use PHPUnit\Framework\TestCase;

class ValidityPeriodTest extends TestCase
{
    public function testConstructorParsesStringDates(): void
    {
        $period = new ValidityPeriod(
            '2026-01-01T00:00:00.000',
            '2026-12-31T23:59:59.000'
        );

        $this->assertInstanceOf(DateTimeInterface::class, $period->getBeginDt());
        $this->assertSame('2026-01-01', $period->getBeginDt()->format('Y-m-d'));
        $this->assertInstanceOf(DateTimeInterface::class, $period->getEndDt());
        $this->assertSame('2026-12-31', $period->getEndDt()->format('Y-m-d'));
    }

    public function testConstructorAcceptsDateTimeInterfaceDirectly(): void
    {
        $begin = new DateTime('2027-01-01');
        $end   = new DateTime('2027-06-01');

        $period = new ValidityPeriod($begin, $end);

        $this->assertSame($begin, $period->getBeginDt());
        $this->assertSame($end, $period->getEndDt());
    }

    public function testSetters(): void
    {
        $period = new ValidityPeriod(new DateTime('2027-01-01'), new DateTime('2027-06-01'));

        $newBegin = new DateTime('2028-01-01');
        $newEnd   = new DateTime('2028-06-01');
        $period->setBeginDt($newBegin);
        $period->setEndDt($newEnd);

        $this->assertSame($newBegin, $period->getBeginDt());
        $this->assertSame($newEnd, $period->getEndDt());
    }
}
