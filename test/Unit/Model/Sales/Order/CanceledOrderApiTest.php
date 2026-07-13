<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\Sales\Order\CanceledOrderApi;
use PHPUnit\Framework\TestCase;

class CanceledOrderApiTest extends TestCase
{
    public function testConstructorCoercesStringDate(): void
    {
        $api = new CanceledOrderApi('2026-01-01');

        $this->assertInstanceOf(DateTimeInterface::class, $api->getCancelDt());
        $this->assertSame('2026-01-01', $api->getCancelDt()->format('Y-m-d'));
    }

    public function testConstructorAcceptsDateTimeInterface(): void
    {
        $date = new DateTime('2026-02-02');
        $api  = new CanceledOrderApi($date);

        $this->assertSame($date, $api->getCancelDt());
    }

    public function testSetter(): void
    {
        $api     = new CanceledOrderApi('2026-01-01');
        $newDate = new DateTime('2027-01-01');

        $api->setCancelDt($newDate);

        $this->assertSame($newDate, $api->getCancelDt());
    }
}
