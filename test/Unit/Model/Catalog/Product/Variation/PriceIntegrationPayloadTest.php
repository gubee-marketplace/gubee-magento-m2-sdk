<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Model\Catalog\Product\Variation\PriceIntegrationPayload;
use PHPUnit\Framework\TestCase;

class PriceIntegrationPayloadTest extends TestCase
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
        $payload = new PriceIntegrationPayload(
            $this->serviceProvider(),
            'product-1',
            'sku-1',
            ['type' => 'DEFAULT', 'value' => 9.9]
        );

        $this->assertSame('product-1', $payload->getProductId());
        $this->assertSame('sku-1', $payload->getSkuId());
        $this->assertInstanceOf(Price::class, $payload->getPrice());
        $this->assertSame(9.9, $payload->getPrice()->getValue());
    }

    public function testConstructWithoutProductId(): void
    {
        $payload = new PriceIntegrationPayload(
            $this->serviceProvider(),
            null,
            'sku-1',
            ['type' => 'DEFAULT', 'value' => 9.9]
        );

        $this->assertNull($payload->getProductId());
    }

    public function testPassesThroughAlreadyHydratedPrice(): void
    {
        $price = $this->serviceProvider()->create(Price::class, ['type' => 'DEFAULT', 'value' => 9.9]);

        $payload = $this->serviceProvider()->create(
            PriceIntegrationPayload::class,
            ['productId' => 'product-1', 'skuId' => 'sku-1', 'price' => $price]
        );

        $this->assertSame($price, $payload->getPrice());
    }

    public function testSetters(): void
    {
        $price = $this->serviceProvider()->create(Price::class, ['type' => 'DEFAULT', 'value' => 9.9]);

        $payload = $this->serviceProvider()->create(
            PriceIntegrationPayload::class,
            ['productId' => 'product-1', 'skuId' => 'sku-1', 'price' => $price]
        );

        $newPrice = $this->serviceProvider()->create(Price::class, ['type' => 'DEFAULT', 'value' => 19.9]);

        $payload->setProductId('product-2');
        $payload->setSkuId('sku-2');
        $payload->setPrice($newPrice);

        $this->assertSame('product-2', $payload->getProductId());
        $this->assertSame('sku-2', $payload->getSkuId());
        $this->assertSame($newPrice, $payload->getPrice());
    }
}
