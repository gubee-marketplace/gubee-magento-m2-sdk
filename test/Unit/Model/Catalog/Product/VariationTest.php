<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\StatusEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute\AttributeValue;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\UnitTime;
use Gubee\SDK\Model\Catalog\Product\Variation;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\Image;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Model\Catalog\Product\Variation\Stock;
use PHPUnit\Framework\TestCase;

class VariationTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function buildVariation(array $overrides = []): Variation
    {
        return $this->serviceProvider()->create(
            Variation::class,
            $overrides + [
                'skuId'                => 'variation-1',
                'images'               => [['main' => true, 'order' => 0, 'url' => 'https://example.com/a.png']],
                'dimension'            => null,
                'handlingTime'         => null,
                'name'                 => 'Variation One',
                'sku'                  => 'VAR-1',
                'warrantyTime'         => null,
                'variantSpecification' => [['attribute' => 'color', 'values' => ['red']]],
            ]
        );
    }

    public function testHydratesImagesFromRawArrays(): void
    {
        $variation = $this->buildVariation();

        $this->assertContainsOnlyInstancesOf(Image::class, $variation->getImages());
    }

    public function testHydratesVariantSpecificationFromRawArrays(): void
    {
        $variation = $this->buildVariation();

        $this->assertSame('color', $variation->getVariantSpecification()[0]->getAttribute());
    }

    public function testPassesThroughAlreadyHydratedPrices(): void
    {
        $price = $this->serviceProvider()->create(Price::class, ['type' => 'DEFAULT', 'value' => 9.9]);

        $variation = $this->buildVariation(['prices' => [$price]]);

        $this->assertSame($price, $variation->getPrices()[0]);
    }

    public function testPassesThroughAlreadyHydratedStocks(): void
    {
        $stock = $this->serviceProvider()->create(Stock::class, ['crossDockingTime' => ['type' => 'DAYS', 'value' => 1], 'qty' => 5]);

        $variation = $this->buildVariation(['stocks' => [$stock]]);

        $this->assertSame($stock, $variation->getStocks()[0]);
    }

    public function testConstructorAndSettersCoverRemainingAccessors(): void
    {
        $serviceProvider      = $this->serviceProvider();
        $dimension            = $serviceProvider->create(
            Dimension::class,
            [
                'depth'  => ['type' => 'CENTIMETER', 'value' => 1.0],
                'height' => ['type' => 'CENTIMETER', 'value' => 2.0],
                'weight' => ['type' => 'KILOGRAM', 'value' => 3.0],
                'width'  => ['type' => 'CENTIMETER', 'value' => 4.0],
            ]
        );
        $handlingTime         = $serviceProvider->create(UnitTime::class, ['type' => 'DAYS', 'value' => 1]);
        $warrantyTime         = $serviceProvider->create(UnitTime::class, ['type' => 'DAYS', 'value' => 30]);
        $image                = $serviceProvider->create(Image::class, ['main' => true, 'order' => 0, 'url' => 'https://example.com/a.png']);
        $price                = $serviceProvider->create(Price::class, ['type' => 'DEFAULT', 'value' => 9.9]);
        $stock                = $serviceProvider->create(Stock::class, ['crossDockingTime' => ['type' => 'DAYS', 'value' => 1], 'qty' => 5]);
        $variantSpecification = $serviceProvider->create(AttributeValue::class, ['attribute' => 'color', 'values' => ['red']]);

        $variation = new Variation(
            $serviceProvider,
            'variation-1',
            [$image],
            $dimension,
            $handlingTime,
            'Variation One',
            'VAR-1',
            $warrantyTime,
            10.5,
            'Description',
            'EAN-1',
            true,
            [$price],
            StatusEnum::ACTIVE(),
            [$stock],
            [$variantSpecification]
        );

        $this->assertSame('variation-1', $variation->getSkuId());
        $this->assertSame([$image], $variation->getImages());
        $this->assertSame($dimension, $variation->getDimension());
        $this->assertSame($handlingTime, $variation->getHandlingTime());
        $this->assertSame('Variation One', $variation->getName());
        $this->assertSame('VAR-1', $variation->getSku());
        $this->assertSame($warrantyTime, $variation->getWarrantyTime());
        $this->assertSame(10.5, $variation->getCost());
        $this->assertSame('Description', $variation->getDescription());
        $this->assertSame('EAN-1', $variation->getEan());
        $this->assertTrue($variation->getMain());
        $this->assertSame([$price], $variation->getPrices());
        $this->assertEquals(StatusEnum::ACTIVE(), $variation->getStatus());
        $this->assertSame([$stock], $variation->getStocks());
        $this->assertSame([$variantSpecification], $variation->getVariantSpecification());

        $variation
            ->setSkuId('variation-2')
            ->setImages([$image])
            ->setDimension($dimension)
            ->setHandlingTime($handlingTime)
            ->setName('Variation Two')
            ->setSku('VAR-2')
            ->setWarrantyTime($warrantyTime)
            ->setCost(11.5)
            ->setDescription('Description 2')
            ->setEan('EAN-2')
            ->setMain(false)
            ->setPrices([$price])
            ->setStatus(StatusEnum::INACTIVE())
            ->setStocks([$stock])
            ->setVariantSpecification([$variantSpecification]);

        $this->assertSame('variation-2', $variation->getSkuId());
        $this->assertSame('Variation Two', $variation->getName());
        $this->assertSame('VAR-2', $variation->getSku());
        $this->assertSame(11.5, $variation->getCost());
        $this->assertSame('Description 2', $variation->getDescription());
        $this->assertSame('EAN-2', $variation->getEan());
        $this->assertFalse($variation->getMain());
        $this->assertEquals(StatusEnum::INACTIVE(), $variation->getStatus());
    }

    public function testHydratesStringStatusToEnum(): void
    {
        $variation = $this->buildVariation(['status' => 'ACTIVE']);

        $this->assertEquals(StatusEnum::ACTIVE(), $variation->getStatus());
    }
}
