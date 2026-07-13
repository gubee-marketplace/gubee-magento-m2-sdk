<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\Sales\Order\Transport;
use PHPUnit\Framework\TestCase;

class TransportTest extends TestCase
{
    private function build(): Transport
    {
        return new Transport('carrier-1', 'method-1', 'https://example.com', 'track-1', '2026-01-01');
    }

    public function testConstructorCoercesStringDate(): void
    {
        $transport = $this->build();

        $this->assertSame('carrier-1', $transport->getCarrier());
        $this->assertSame('method-1', $transport->getMethod());
        $this->assertSame('https://example.com', $transport->getLink());
        $this->assertSame('track-1', $transport->getTrackingCode());
        $this->assertInstanceOf(DateTimeInterface::class, $transport->getDeliveredCarrierDate());
        $this->assertSame('2026-01-01', $transport->getDeliveredCarrierDate()->format('Y-m-d'));
    }

    public function testConstructorAcceptsDateTimeInterfaceAndNullTrackingCode(): void
    {
        $date      = new DateTime('2026-02-02');
        $transport = new Transport('carrier-2', 'method-2', 'https://example.com', null, $date);

        $this->assertNull($transport->getTrackingCode());
        $this->assertSame($date, $transport->getDeliveredCarrierDate());
    }

    public function testSetters(): void
    {
        $transport = $this->build();
        $newDate   = new DateTime('2027-01-01');

        $transport->setCarrier('carrier-3');
        $transport->setMethod('method-3');
        $transport->setLink('https://example.org');
        $transport->setTrackingCode('track-3');
        $transport->setDeliveredCarrierDate($newDate);

        $this->assertSame('carrier-3', $transport->getCarrier());
        $this->assertSame('method-3', $transport->getMethod());
        $this->assertSame('https://example.org', $transport->getLink());
        $this->assertSame('track-3', $transport->getTrackingCode());
        $this->assertSame($newDate, $transport->getDeliveredCarrierDate());
    }
}
