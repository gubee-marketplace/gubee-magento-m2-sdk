<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceListBySkuPayload;
use PHPUnit\Framework\TestCase;

class PriceListBySkuPayloadTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildPrice(): Price
    {
        return $this->serviceProvider()->create(Price::class, [
            'type'  => 'DEFAULT',
            'value' => 9.9,
        ]);
    }

    public function testHydratesPricesFromRawArrays(): void
    {
        $payload = new PriceListBySkuPayload(
            $this->serviceProvider(),
            'SKU-1',
            [['type' => 'DEFAULT', 'value' => 1.5]]
        );

        $this->assertSame('SKU-1', $payload->getSku());
        $this->assertContainsOnlyInstancesOf(Price::class, $payload->getPrices());
    }

    public function testPassesThroughAlreadyHydratedPrices(): void
    {
        $price = $this->buildPrice();

        $payload = new PriceListBySkuPayload(
            $this->serviceProvider(),
            'SKU-2',
            [$price]
        );

        $this->assertSame($price, $payload->getPrices()[0]);
    }

    public function testSetters(): void
    {
        $payload = new PriceListBySkuPayload(
            $this->serviceProvider(),
            'SKU-3',
            []
        );

        $payload->setSku('SKU-4');
        $this->assertSame('SKU-4', $payload->getSku());

        $price = $this->buildPrice();
        $payload->setPrices([$price]);
        $this->assertSame([$price], $payload->getPrices());
    }
}
