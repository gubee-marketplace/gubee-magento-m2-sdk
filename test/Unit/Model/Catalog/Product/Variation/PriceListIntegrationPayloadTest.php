<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceListIntegrationPayload;
use PHPUnit\Framework\TestCase;

class PriceListIntegrationPayloadTest extends TestCase
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

    public function testHydratesPricesFromRawArraysWithProductId(): void
    {
        $payload = new PriceListIntegrationPayload(
            $this->serviceProvider(),
            'PROD-1',
            'SKU-1',
            [['type' => 'DEFAULT', 'value' => 1.5]]
        );

        $this->assertSame('PROD-1', $payload->getProductId());
        $this->assertSame('SKU-1', $payload->getSkuId());
        $this->assertContainsOnlyInstancesOf(Price::class, $payload->getPrices());
    }

    public function testProductIdDefaultsToNull(): void
    {
        $payload = new PriceListIntegrationPayload(
            $this->serviceProvider(),
            null,
            'SKU-2',
            []
        );

        $this->assertNull($payload->getProductId());
    }

    public function testPassesThroughAlreadyHydratedPrices(): void
    {
        $price = $this->buildPrice();

        $payload = new PriceListIntegrationPayload(
            $this->serviceProvider(),
            null,
            'SKU-3',
            [$price]
        );

        $this->assertSame($price, $payload->getPrices()[0]);
    }

    public function testSetters(): void
    {
        $payload = new PriceListIntegrationPayload(
            $this->serviceProvider(),
            null,
            'SKU-4',
            []
        );

        $payload->setProductId('PROD-2');
        $payload->setSkuId('SKU-5');
        $price = $this->buildPrice();
        $payload->setPrices([$price]);

        $this->assertSame('PROD-2', $payload->getProductId());
        $this->assertSame('SKU-5', $payload->getSkuId());
        $this->assertSame([$price], $payload->getPrices());
    }
}
