<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Platform\DomainTypeEnum;
use Gubee\SDK\Model\Catalog\Product\Variation\SkuPrice;
use Gubee\SDK\Model\Platform\PlatformPriceQuery;
use PHPUnit\Framework\TestCase;

class SkuPriceTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @return array<string, mixed>
     */
    private function rawPrice(): array
    {
        return [
            'id'                   => null,
            'platform'             => null,
            'store'                => null,
            'promotionId'          => null,
            'value'                => 1.5,
            'beginDt'              => null,
            'endDt'                => null,
            'priceType'            => 'DEFAULT',
            'priceCalculationType' => null,
            'importedByApi'        => false,
        ];
    }

    private function buildPlatformPriceQuery(): PlatformPriceQuery
    {
        return $this->serviceProvider()->create(PlatformPriceQuery::class, $this->rawPrice());
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function buildSkuPrice(array $overrides = []): SkuPrice
    {
        $args = $overrides + [
            'serviceProvider' => $this->serviceProvider(),
            'id'              => 'id-1',
            'itemId'          => 'item-1',
            'sellerId'        => 'seller-1',
            'sku'             => 'sku-1',
            'originItemId'    => 'origin-1',
            'domain'          => 'PRODUCT',
            'prices'          => [$this->rawPrice()],
        ];

        return new SkuPrice(...$args);
    }

    public function testConstructorHydratesFields(): void
    {
        $skuPrice = $this->buildSkuPrice();

        $this->assertSame('id-1', $skuPrice->getId());
        $this->assertSame('item-1', $skuPrice->getItemId());
        $this->assertSame('seller-1', $skuPrice->getSellerId());
        $this->assertSame('sku-1', $skuPrice->getSku());
        $this->assertSame('origin-1', $skuPrice->getOriginItemId());
        $this->assertInstanceOf(DomainTypeEnum::class, $skuPrice->getDomain());
        $this->assertSame('PRODUCT', (string) $skuPrice->getDomain());
        $this->assertContainsOnlyInstancesOf(PlatformPriceQuery::class, $skuPrice->getPrices());
    }

    public function testConstructorAcceptsEnumDomainDirectly(): void
    {
        $skuPrice = $this->buildSkuPrice(['domain' => DomainTypeEnum::AD()]);

        $this->assertSame('AD', (string) $skuPrice->getDomain());
    }

    public function testOptionalFieldsDefaultToNull(): void
    {
        $skuPrice = $this->buildSkuPrice([
            'id'           => null,
            'sku'          => null,
            'originItemId' => null,
            'prices'       => [],
        ]);

        $this->assertNull($skuPrice->getId());
        $this->assertNull($skuPrice->getSku());
        $this->assertNull($skuPrice->getOriginItemId());
    }

    public function testPassesThroughAlreadyHydratedPrices(): void
    {
        $price = $this->buildPlatformPriceQuery();

        $skuPrice = $this->buildSkuPrice(['prices' => [$price]]);

        $this->assertSame($price, $skuPrice->getPrices()[0]);
    }

    public function testSetters(): void
    {
        $skuPrice = $this->buildSkuPrice();

        $skuPrice->setId('id-2');
        $skuPrice->setItemId('item-3');
        $skuPrice->setSellerId('seller-3');
        $skuPrice->setSku('sku-2');
        $skuPrice->setOriginItemId('origin-2');
        $skuPrice->setDomain(DomainTypeEnum::AD());
        $price = $this->buildPlatformPriceQuery();
        $skuPrice->setPrices([$price]);

        $this->assertSame('id-2', $skuPrice->getId());
        $this->assertSame('item-3', $skuPrice->getItemId());
        $this->assertSame('seller-3', $skuPrice->getSellerId());
        $this->assertSame('sku-2', $skuPrice->getSku());
        $this->assertSame('origin-2', $skuPrice->getOriginItemId());
        $this->assertSame('AD', (string) $skuPrice->getDomain());
        $this->assertSame([$price], $skuPrice->getPrices());
    }
}
