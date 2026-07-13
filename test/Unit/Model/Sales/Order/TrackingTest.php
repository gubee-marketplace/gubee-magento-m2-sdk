<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\Sales\Order\Tracking;
use PHPUnit\Framework\TestCase;

class TrackingTest extends TestCase
{
    public function testConstructorCoercesStringDate(): void
    {
        $tracking = new Tracking('info-1', '2026-01-01');

        $this->assertSame('info-1', $tracking->getInfo());
        $this->assertInstanceOf(DateTimeInterface::class, $tracking->getTrackDt());
        $this->assertSame('2026-01-01', $tracking->getTrackDt()->format('Y-m-d'));
    }

    public function testConstructorAcceptsDateTimeInterface(): void
    {
        $date     = new DateTime('2026-02-02');
        $tracking = new Tracking('info-2', $date);

        $this->assertSame($date, $tracking->getTrackDt());
    }

    public function testSetters(): void
    {
        $tracking = new Tracking('info', new DateTime('2026-01-01'));
        $newDate  = new DateTime('2027-01-01');

        $tracking->setInfo('info-3');
        $tracking->setTrackDt($newDate);

        $this->assertSame('info-3', $tracking->getInfo());
        $this->assertSame($newDate, $tracking->getTrackDt());
    }
}
