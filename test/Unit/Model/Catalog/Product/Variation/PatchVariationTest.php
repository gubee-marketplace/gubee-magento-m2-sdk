<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\UnitTime;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\Image;
use Gubee\SDK\Model\Catalog\Product\Variation\PatchVariation;
use Gubee\SDK\Model\Catalog\ProductV2\SellerCostComponent;
use Gubee\SDK\Model\Common\Money;
use PHPUnit\Framework\TestCase;

class PatchVariationTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function dimensionArgs(): array
    {
        return [
            'depth'  => ['type' => 'CENTIMETER', 'value' => 1.0],
            'height' => ['type' => 'CENTIMETER', 'value' => 2.0],
            'weight' => ['type' => 'KILOGRAM', 'value' => 3.0],
            'width'  => ['type' => 'CENTIMETER', 'value' => 4.0],
        ];
    }

    public function testConstructWithNoFields(): void
    {
        $patchVariation = $this->serviceProvider()->create(PatchVariation::class, []);

        $this->assertNull($patchVariation->getSellerId());
        $this->assertNull($patchVariation->getCost());
        $this->assertNull($patchVariation->getEan());
        $this->assertNull($patchVariation->getWarrantyTime());
        $this->assertNull($patchVariation->getHandlingTime());
        $this->assertNull($patchVariation->getDimension());
        $this->assertNull($patchVariation->getName());
        $this->assertNull($patchVariation->getImages());
        $this->assertNull($patchVariation->getAdditionalCosts());
    }

    public function testHydratesAllNestedFieldsFromRawArrays(): void
    {
        // Constructed via plain `new` (not the DI container's create()/make())
        // because Dimension itself requires ServiceProviderInterface, and
        // PHP-DI's make() cannot be safely re-entered recursively for a
        // second class that also needs ServiceProviderInterface.
        $patchVariation = new PatchVariation(
            $this->serviceProvider(),
            'seller-1',
            ['currency' => 'BRL', 'amount' => 10.0],
            '123456',
            ['type' => 'DAYS', 'value' => 30],
            ['type' => 'DAYS', 'value' => 2],
            $this->dimensionArgs(),
            'Variation',
            [['main' => true, 'order' => 0, 'url' => 'https://example.com/a.png']],
            [['name' => 'Freight', 'value' => 9.9, 'type' => 'FIXED', 'kind' => 'FREIGHT']]
        );

        $this->assertSame('seller-1', $patchVariation->getSellerId());
        $this->assertInstanceOf(Money::class, $patchVariation->getCost());
        $this->assertSame('123456', $patchVariation->getEan());
        $this->assertInstanceOf(UnitTime::class, $patchVariation->getWarrantyTime());
        $this->assertInstanceOf(UnitTime::class, $patchVariation->getHandlingTime());
        $this->assertInstanceOf(Dimension::class, $patchVariation->getDimension());
        $this->assertSame('Variation', $patchVariation->getName());
        $this->assertContainsOnlyInstancesOf(Image::class, $patchVariation->getImages());
        $this->assertContainsOnlyInstancesOf(SellerCostComponent::class, $patchVariation->getAdditionalCosts());
    }

    public function testPassesThroughAlreadyHydratedNestedInstances(): void
    {
        $cost           = $this->serviceProvider()->create(Money::class, ['currency' => 'BRL', 'amount' => 10.0]);
        $warrantyTime   = $this->serviceProvider()->create(UnitTime::class, ['type' => 'DAYS', 'value' => 30]);
        $handlingTime   = $this->serviceProvider()->create(UnitTime::class, ['type' => 'DAYS', 'value' => 2]);
        $dimension      = $this->serviceProvider()->create(Dimension::class, $this->dimensionArgs());
        $image          = $this->serviceProvider()->create(Image::class, ['main' => true, 'order' => 0, 'url' => 'https://example.com/a.png']);
        $additionalCost = new SellerCostComponent('Freight', 9.9, 'FIXED', 'FREIGHT');

        $patchVariation = $this->serviceProvider()->create(PatchVariation::class, [
            'cost'            => $cost,
            'warrantyTime'    => $warrantyTime,
            'handlingTime'    => $handlingTime,
            'dimension'       => $dimension,
            'images'          => [$image],
            'additionalCosts' => [$additionalCost],
        ]);

        $this->assertSame($cost, $patchVariation->getCost());
        $this->assertSame($warrantyTime, $patchVariation->getWarrantyTime());
        $this->assertSame($handlingTime, $patchVariation->getHandlingTime());
        $this->assertSame($dimension, $patchVariation->getDimension());
        $this->assertSame($image, $patchVariation->getImages()[0]);
        $this->assertSame($additionalCost, $patchVariation->getAdditionalCosts()[0]);
    }

    public function testSetters(): void
    {
        $patchVariation = $this->serviceProvider()->create(PatchVariation::class, []);

        $cost           = $this->serviceProvider()->create(Money::class, ['currency' => 'BRL', 'amount' => 10.0]);
        $warrantyTime   = $this->serviceProvider()->create(UnitTime::class, ['type' => 'DAYS', 'value' => 30]);
        $handlingTime   = $this->serviceProvider()->create(UnitTime::class, ['type' => 'DAYS', 'value' => 2]);
        $dimension      = $this->serviceProvider()->create(Dimension::class, $this->dimensionArgs());
        $image          = $this->serviceProvider()->create(Image::class, ['main' => true, 'order' => 0, 'url' => 'https://example.com/a.png']);
        $additionalCost = new SellerCostComponent('Freight', 9.9, 'FIXED', 'FREIGHT');

        $patchVariation->setSellerId('seller-2');
        $patchVariation->setCost($cost);
        $patchVariation->setEan('654321');
        $patchVariation->setWarrantyTime($warrantyTime);
        $patchVariation->setHandlingTime($handlingTime);
        $patchVariation->setDimension($dimension);
        $patchVariation->setName('Variation 2');
        $patchVariation->setImages([$image]);
        $patchVariation->setAdditionalCosts([$additionalCost]);

        $this->assertSame('seller-2', $patchVariation->getSellerId());
        $this->assertSame($cost, $patchVariation->getCost());
        $this->assertSame('654321', $patchVariation->getEan());
        $this->assertSame($warrantyTime, $patchVariation->getWarrantyTime());
        $this->assertSame($handlingTime, $patchVariation->getHandlingTime());
        $this->assertSame($dimension, $patchVariation->getDimension());
        $this->assertSame('Variation 2', $patchVariation->getName());
        $this->assertSame([$image], $patchVariation->getImages());
        $this->assertSame([$additionalCost], $patchVariation->getAdditionalCosts());
    }
}
