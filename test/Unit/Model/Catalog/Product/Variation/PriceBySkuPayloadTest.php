<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceBySkuPayload;
use PHPUnit\Framework\TestCase;

class PriceBySkuPayloadTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesPriceFromRawArray(): void
    {
        // Constructed via plain `new` (not the DI container's create()/make())
        // because Price itself requires ServiceProviderInterface, and PHP-DI's
        // make() cannot be safely re-entered recursively for a second class
        // that also needs ServiceProviderInterface.
        $payload = new PriceBySkuPayload(
            $this->serviceProvider(),
            'sku-1',
            ['type' => 'DEFAULT', 'value' => 9.9]
        );

        $this->assertSame('sku-1', $payload->getSku());
        $this->assertInstanceOf(Price::class, $payload->getPrice());
        $this->assertSame(9.9, $payload->getPrice()->getValue());
    }

    public function testPassesThroughAlreadyHydratedPrice(): void
    {
        $price = $this->serviceProvider()->create(Price::class, ['type' => 'DEFAULT', 'value' => 9.9]);

        $payload = $this->serviceProvider()->create(
            PriceBySkuPayload::class,
            ['sku' => 'sku-1', 'price' => $price]
        );

        $this->assertSame($price, $payload->getPrice());
    }

    public function testSetters(): void
    {
        $price = $this->serviceProvider()->create(Price::class, ['type' => 'DEFAULT', 'value' => 9.9]);

        $payload = $this->serviceProvider()->create(
            PriceBySkuPayload::class,
            ['sku' => 'sku-1', 'price' => $price]
        );

        $newPrice = $this->serviceProvider()->create(Price::class, ['type' => 'DEFAULT', 'value' => 19.9]);

        $payload->setSku('sku-2');
        $payload->setPrice($newPrice);

        $this->assertSame('sku-2', $payload->getSku());
        $this->assertSame($newPrice, $payload->getPrice());
    }
}
