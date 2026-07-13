<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Shipping;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Shipping\ShippingQuoteApi;
use Gubee\SDK\Model\Shipping\ShippingQuotesApi;
use PHPUnit\Framework\TestCase;

class ShippingQuotesApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesShippingQuotesFromRawArrays(): void
    {
        $quotes = new ShippingQuotesApi(
            $this->serviceProvider(),
            12345,
            [
                [
                    'valueFreightId'     => null,
                    'freightServiceId'   => null,
                    'freightServiceName' => null,
                    'freightType'        => null,
                    'deliveryTime'       => 1,
                    'deadlineDays'       => 2,
                ],
            ]
        );

        $this->assertSame(12345, $quotes->getPostalCode());
        $this->assertContainsOnlyInstancesOf(ShippingQuoteApi::class, $quotes->getShippingQuotes());
    }

    public function testPassesThroughAlreadyHydratedShippingQuotes(): void
    {
        $quote = new ShippingQuoteApi($this->serviceProvider(), null, null, null, null, 1, 2);

        $quotes = new ShippingQuotesApi($this->serviceProvider(), 1, [$quote]);

        $this->assertSame($quote, $quotes->getShippingQuotes()[0]);
    }

    public function testSetters(): void
    {
        $quotes = new ShippingQuotesApi($this->serviceProvider(), 1);

        $quotes->setPostalCode(999);
        $this->assertSame(999, $quotes->getPostalCode());

        $quote = new ShippingQuoteApi($this->serviceProvider(), null, null, null, null, 1, 2);
        $quotes->setShippingQuotes([$quote]);
        $this->assertSame([$quote], $quotes->getShippingQuotes());
    }

    public function testNullShippingQuotesByDefault(): void
    {
        $quotes = new ShippingQuotesApi($this->serviceProvider(), 1);

        $this->assertNull($quotes->getShippingQuotes());
    }
}
