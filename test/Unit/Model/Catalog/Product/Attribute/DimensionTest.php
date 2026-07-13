<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Attribute;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\Measure;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\Weight;
use PHPUnit\Framework\TestCase;

class DimensionTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function rawArgs(): array
    {
        return [
            'depth'  => ['type' => 'CENTIMETER', 'value' => 1.0],
            'height' => ['type' => 'CENTIMETER', 'value' => 2.0],
            'weight' => ['type' => 'KILOGRAM', 'value' => 3.0],
            'width'  => ['type' => 'CENTIMETER', 'value' => 4.0],
        ];
    }

    public function testHydratesFromRawArrays(): void
    {
        $dimension = $this->serviceProvider()->create(Dimension::class, $this->rawArgs());

        $this->assertInstanceOf(Measure::class, $dimension->getDepth());
        $this->assertInstanceOf(Measure::class, $dimension->getHeight());
        $this->assertInstanceOf(Weight::class, $dimension->getWeight());
        $this->assertInstanceOf(Measure::class, $dimension->getWidth());
        $this->assertSame(1.0, $dimension->getDepth()->getValue());
        $this->assertSame(2.0, $dimension->getHeight()->getValue());
        $this->assertSame(3.0, $dimension->getWeight()->getValue());
        $this->assertSame(4.0, $dimension->getWidth()->getValue());
    }

    public function testPassesThroughAlreadyHydratedInstances(): void
    {
        $depth  = $this->serviceProvider()->create(Measure::class, ['type' => 'CENTIMETER', 'value' => 1.0]);
        $height = $this->serviceProvider()->create(Measure::class, ['type' => 'CENTIMETER', 'value' => 2.0]);
        $weight = $this->serviceProvider()->create(Weight::class, ['type' => 'KILOGRAM', 'value' => 3.0]);
        $width  = $this->serviceProvider()->create(Measure::class, ['type' => 'CENTIMETER', 'value' => 4.0]);

        $dimension = $this->serviceProvider()->create(Dimension::class, [
            'depth'  => $depth,
            'height' => $height,
            'weight' => $weight,
            'width'  => $width,
        ]);

        $this->assertSame($depth, $dimension->getDepth());
        $this->assertSame($height, $dimension->getHeight());
        $this->assertSame($weight, $dimension->getWeight());
        $this->assertSame($width, $dimension->getWidth());
    }

    public function testSetters(): void
    {
        $dimension = $this->serviceProvider()->create(Dimension::class, $this->rawArgs());

        $newDepth  = $this->serviceProvider()->create(Measure::class, ['type' => 'CENTIMETER', 'value' => 10.0]);
        $newHeight = $this->serviceProvider()->create(Measure::class, ['type' => 'CENTIMETER', 'value' => 20.0]);
        $newWeight = $this->serviceProvider()->create(Weight::class, ['type' => 'KILOGRAM', 'value' => 30.0]);
        $newWidth  = $this->serviceProvider()->create(Measure::class, ['type' => 'CENTIMETER', 'value' => 40.0]);

        $dimension->setDepth($newDepth);
        $dimension->setHeight($newHeight);
        $dimension->setWeight($newWeight);
        $dimension->setWidth($newWidth);

        $this->assertSame($newDepth, $dimension->getDepth());
        $this->assertSame($newHeight, $dimension->getHeight());
        $this->assertSame($newWeight, $dimension->getWeight());
        $this->assertSame($newWidth, $dimension->getWidth());
    }
}
