<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\ProductV2;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\StatusEnum;
use Gubee\SDK\Enum\Catalog\Product\Variation\ConditionEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute\AttributeValue;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\Image;
use Gubee\SDK\Model\Catalog\ProductV2\Cost;
use Gubee\SDK\Model\Catalog\ProductV2\Price;
use Gubee\SDK\Model\Catalog\ProductV2\Stock;
use Gubee\SDK\Model\Catalog\ProductV2\Variation;
use PHPUnit\Framework\TestCase;

class VariationTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function dimension(): Dimension
    {
        return $this->serviceProvider()->create(Dimension::class, [
            'depth'  => ['type' => 'CENTIMETER', 'value' => 1.0],
            'height' => ['type' => 'CENTIMETER', 'value' => 2.0],
            'weight' => ['type' => 'KILOGRAM', 'value' => 3.0],
            'width'  => ['type' => 'CENTIMETER', 'value' => 4.0],
        ]);
    }

    /**
     * Builds a Variation using plain `new` (rather than the DI container's
     * `create()`/`make()`) because Variation's constructor hydrates nested
     * models (e.g. Price) that themselves require ServiceProviderInterface.
     * PHP-DI's container->make() cannot safely be re-entered recursively for
     * a second class that also needs ServiceProviderInterface, so the outer
     * object must be constructed directly while still being handed the real
     * container as its $serviceProvider argument.
     *
     * @param array<string, mixed> $overrides
     */
    private function buildVariation(array $overrides = []): Variation
    {
        $args = $overrides + [
            'sku'                  => 'VAR-1',
            'main'                 => true,
            'name'                 => 'Variation One',
            'condition'            => 'NEW',
            'status'               => 'ACTIVE',
            'warrantyTime'         => '30',
            'cost'                 => ['currency' => 'BRL', 'amount' => 10.0],
            'dimension'            => $this->dimension(),
            'prices'               => [['type' => 'DEFAULT', 'value' => ['currency' => 'BRL', 'amount' => 9.9]]],
            'stocks'               => [['warehouseId' => 'w1', 'qty' => 5, 'priority' => 1]],
            'images'               => [['main' => true, 'order' => 0, 'url' => 'https://example.com/a.png']],
            'variantSpecification' => [['attribute' => 'color', 'values' => ['red']]],
            'ean'                  => null,
            'description'          => null,
        ];

        return new Variation(
            $this->serviceProvider(),
            $args['sku'],
            $args['main'],
            $args['name'],
            $args['condition'],
            $args['status'],
            $args['warrantyTime'],
            $args['cost'],
            $args['dimension'],
            $args['prices'],
            $args['stocks'],
            $args['images'],
            $args['variantSpecification'],
            $args['ean'],
            $args['description']
        );
    }

    public function testConstructWithAllFields(): void
    {
        $variation = $this->buildVariation(['ean' => '123456', 'description' => 'A description']);

        $this->assertSame('VAR-1', $variation->getSku());
        $this->assertTrue($variation->getMain());
        $this->assertSame('123456', $variation->getEan());
        $this->assertSame('Variation One', $variation->getName());
        $this->assertSame('A description', $variation->getDescription());
        $this->assertInstanceOf(ConditionEnum::class, $variation->getCondition());
        $this->assertInstanceOf(StatusEnum::class, $variation->getStatus());
        $this->assertSame('30', $variation->getWarrantyTime());
        $this->assertInstanceOf(Cost::class, $variation->getCost());
        $this->assertInstanceOf(Dimension::class, $variation->getDimension());
    }

    public function testConstructWithoutOptionalFields(): void
    {
        $variation = $this->buildVariation();

        $this->assertNull($variation->getEan());
        $this->assertNull($variation->getDescription());
    }

    public function testAcceptsEnumInstancesDirectly(): void
    {
        $condition = ConditionEnum::NEW();
        $status    = StatusEnum::ACTIVE();

        $variation = $this->buildVariation([
            'condition' => $condition,
            'status'    => $status,
        ]);

        $this->assertSame($condition, $variation->getCondition());
        $this->assertSame($status, $variation->getStatus());
    }

    public function testHydratesCostFromRawArray(): void
    {
        $variation = $this->buildVariation();

        $this->assertSame('BRL', $variation->getCost()->getCurrency());
        $this->assertSame(10.0, $variation->getCost()->getAmount());
    }

    public function testPassesThroughAlreadyHydratedCost(): void
    {
        $cost      = $this->serviceProvider()->create(Cost::class, ['currency' => 'USD', 'amount' => 20.0]);
        $variation = $this->buildVariation(['cost' => $cost]);

        $this->assertSame($cost, $variation->getCost());
    }

    public function testHydratesPricesFromRawArrays(): void
    {
        $variation = $this->buildVariation();

        $this->assertContainsOnlyInstancesOf(Price::class, $variation->getPrices());
    }

    public function testPassesThroughAlreadyHydratedPrices(): void
    {
        $price     = $this->serviceProvider()->create(Price::class, ['type' => 'DEFAULT', 'value' => ['currency' => 'BRL', 'amount' => 9.9]]);
        $variation = $this->buildVariation(['prices' => [$price]]);

        $this->assertSame($price, $variation->getPrices()[0]);
    }

    public function testHydratesStocksFromRawArrays(): void
    {
        $variation = $this->buildVariation();

        $this->assertContainsOnlyInstancesOf(Stock::class, $variation->getStocks());
    }

    public function testPassesThroughAlreadyHydratedStocks(): void
    {
        $stock     = $this->serviceProvider()->create(Stock::class, ['warehouseId' => 'w1', 'qty' => 5, 'priority' => 1]);
        $variation = $this->buildVariation(['stocks' => [$stock]]);

        $this->assertSame($stock, $variation->getStocks()[0]);
    }

    public function testHydratesImagesFromRawArrays(): void
    {
        $variation = $this->buildVariation();

        $this->assertContainsOnlyInstancesOf(Image::class, $variation->getImages());
    }

    public function testPassesThroughAlreadyHydratedImages(): void
    {
        $image     = $this->serviceProvider()->create(Image::class, ['main' => true, 'order' => 0, 'url' => 'https://example.com/a.png']);
        $variation = $this->buildVariation(['images' => [$image]]);

        $this->assertSame($image, $variation->getImages()[0]);
    }

    public function testHydratesVariantSpecificationFromRawArrays(): void
    {
        $variation = $this->buildVariation();

        $this->assertContainsOnlyInstancesOf(AttributeValue::class, $variation->getVariantSpecification());
        $this->assertSame('color', $variation->getVariantSpecification()[0]->getAttribute());
    }

    public function testPassesThroughAlreadyHydratedVariantSpecification(): void
    {
        $spec      = $this->serviceProvider()->create(AttributeValue::class, ['attribute' => 'color', 'values' => ['red']]);
        $variation = $this->buildVariation(['variantSpecification' => [$spec]]);

        $this->assertSame($spec, $variation->getVariantSpecification()[0]);
    }

    public function testSetters(): void
    {
        $variation = $this->buildVariation();

        $newCost      = $this->serviceProvider()->create(Cost::class, ['currency' => 'USD', 'amount' => 20.0]);
        $newDimension = $this->dimension();
        $newPrice     = $this->serviceProvider()->create(Price::class, ['type' => 'DEFAULT', 'value' => ['currency' => 'BRL', 'amount' => 19.9]]);
        $newStock     = $this->serviceProvider()->create(Stock::class, ['warehouseId' => 'w2', 'qty' => 10, 'priority' => 2]);
        $newImage     = $this->serviceProvider()->create(Image::class, ['main' => false, 'order' => 1, 'url' => 'https://example.com/b.png']);
        $newSpec      = $this->serviceProvider()->create(AttributeValue::class, ['attribute' => 'size', 'values' => ['M']]);

        $variation->setSku('VAR-2');
        $variation->setMain(false);
        $variation->setEan('654321');
        $variation->setName('Variation Two');
        $variation->setDescription('Other description');
        $newCondition = ConditionEnum::USED();
        $newStatus    = StatusEnum::INACTIVE();
        $variation->setCondition($newCondition);
        $variation->setStatus($newStatus);
        $variation->setWarrantyTime('60');
        $variation->setCost($newCost);
        $variation->setDimension($newDimension);
        $variation->setPrices([$newPrice]);
        $variation->setStocks([$newStock]);
        $variation->setImages([$newImage]);
        $variation->setVariantSpecification([$newSpec]);

        $this->assertSame('VAR-2', $variation->getSku());
        $this->assertFalse($variation->getMain());
        $this->assertSame('654321', $variation->getEan());
        $this->assertSame('Variation Two', $variation->getName());
        $this->assertSame('Other description', $variation->getDescription());
        $this->assertSame($newCondition, $variation->getCondition());
        $this->assertSame($newStatus, $variation->getStatus());
        $this->assertSame('60', $variation->getWarrantyTime());
        $this->assertSame($newCost, $variation->getCost());
        $this->assertSame($newDimension, $variation->getDimension());
        $this->assertSame([$newPrice], $variation->getPrices());
        $this->assertSame([$newStock], $variation->getStocks());
        $this->assertSame([$newImage], $variation->getImages());
        $this->assertSame([$newSpec], $variation->getVariantSpecification());
    }
}
