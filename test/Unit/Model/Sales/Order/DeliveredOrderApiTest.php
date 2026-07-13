<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\Sales\Order\DeliveredOrderApi;
use PHPUnit\Framework\TestCase;

class DeliveredOrderApiTest extends TestCase
{
    public function testConstructorCoercesStringDate(): void
    {
        $api = new DeliveredOrderApi('2026-01-01');

        $this->assertInstanceOf(DateTimeInterface::class, $api->getDeliveredDt());
        $this->assertSame('2026-01-01', $api->getDeliveredDt()->format('Y-m-d'));
    }

    public function testConstructorAcceptsDateTimeInterface(): void
    {
        $date = new DateTime('2026-02-02');
        $api  = new DeliveredOrderApi($date);

        $this->assertSame($date, $api->getDeliveredDt());
    }

    public function testSetter(): void
    {
        $api     = new DeliveredOrderApi('2026-01-01');
        $newDate = new DateTime('2027-01-01');

        $api->setDeliveredDt($newDate);

        $this->assertSame($newDate, $api->getDeliveredDt());
    }
}
