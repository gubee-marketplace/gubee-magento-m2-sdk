<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\Attribute\OriginEnum;
use Gubee\SDK\Enum\Catalog\Product\StatusEnum;
use Gubee\SDK\Enum\Catalog\Product\TypeEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;
use Gubee\SDK\Model\Catalog\ProductV2;
use Gubee\SDK\Model\Catalog\ProductV2\Specification;
use Gubee\SDK\Model\Catalog\ProductV2\Variation;
use PHPUnit\Framework\TestCase;

class ProductV2Test extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function variationData(): array
    {
        return [
            'sku'                  => 'sku-1',
            'main'                 => true,
            'name'                 => 'Variation',
            'condition'            => 'NEW',
            'status'               => 'ACTIVE',
            'warrantyTime'         => '30',
            'cost'                 => ['currency' => 'BRL', 'amount' => 10.0],
            'dimension'            => $this->serviceProvider()->create(
                Dimension::class,
                [
                    'depth'  => ['type' => 'CENTIMETER', 'value' => 1.0],
                    'height' => ['type' => 'CENTIMETER', 'value' => 1.0],
                    'weight' => ['type' => 'KILOGRAM', 'value' => 1.0],
                    'width'  => ['type' => 'CENTIMETER', 'value' => 1.0],
                ]
            ),
            'prices'               => [],
            'stocks'               => [],
            'images'               => [],
            'variantSpecification' => [],
        ];
    }

    private function build(): ProductV2
    {
        return new ProductV2(
            $this->serviceProvider(),
            'seller-1',
            'main-sku',
            'Product Name',
            'category-1',
            'brand-1',
            'SIMPLE',
            'NATIONAL',
            'ACTIVE',
            ['acc-1'],
            [['name' => 'spec', 'values' => ['a']]],
            [$this->variationData()],
            true,
            false
        );
    }

    public function testHydratesSpecificationsAndVariationsFromRawArrays(): void
    {
        $product = $this->build();

        $this->assertSame('seller-1', $product->getSellerId());
        $this->assertSame('main-sku', $product->getMainSku());
        $this->assertSame('Product Name', $product->getName());
        $this->assertSame('category-1', $product->getMainCategory());
        $this->assertSame('brand-1', $product->getBrand());
        $this->assertEquals(TypeEnum::SIMPLE(), $product->getType());
        $this->assertEquals(OriginEnum::NATIONAL(), $product->getOrigin());
        $this->assertEquals(StatusEnum::ACTIVE(), $product->getStatus());
        $this->assertSame(['acc-1'], $product->getAccounts());
        $this->assertContainsOnlyInstancesOf(Specification::class, $product->getSpecifications());
        $this->assertContainsOnlyInstancesOf(Variation::class, $product->getVariations());
        $this->assertTrue($product->getAddNewVariations());
        $this->assertFalse($product->getDownloadImages());
    }

    public function testPassesThroughAlreadyHydratedInstances(): void
    {
        $spec      = new Specification('spec', ['a']);
        $variation = $this->serviceProvider()->create(Variation::class, $this->variationData());

        $product = new ProductV2(
            $this->serviceProvider(),
            'seller-1',
            'main-sku',
            'Product Name',
            'category-1',
            'brand-1',
            TypeEnum::SIMPLE(),
            OriginEnum::NATIONAL(),
            StatusEnum::ACTIVE(),
            [],
            [$spec],
            [$variation],
            true,
            false
        );

        $this->assertSame($spec, $product->getSpecifications()[0]);
        $this->assertSame($variation, $product->getVariations()[0]);
    }

    public function testSetters(): void
    {
        $product = $this->build();

        $product->setSellerId('seller-2');
        $product->setMainSku('main-sku-2');
        $product->setName('Name 2');
        $product->setMainCategory('cat-2');
        $product->setBrand('brand-2');
        $product->setType(TypeEnum::KIT());
        $product->setOrigin(OriginEnum::NATIONAL());
        $product->setStatus(StatusEnum::INACTIVE());
        $product->setAccounts(['acc-2']);
        $spec = new Specification('spec-2', ['b']);
        $product->setSpecifications([$spec]);
        $variation = $this->serviceProvider()->create(Variation::class, $this->variationData());
        $product->setVariations([$variation]);
        $product->setAddNewVariations(false);
        $product->setDownloadImages(true);

        $this->assertSame('seller-2', $product->getSellerId());
        $this->assertSame('main-sku-2', $product->getMainSku());
        $this->assertSame('Name 2', $product->getName());
        $this->assertSame('cat-2', $product->getMainCategory());
        $this->assertSame('brand-2', $product->getBrand());
        $this->assertEquals(TypeEnum::KIT(), $product->getType());
        $this->assertEquals(OriginEnum::NATIONAL(), $product->getOrigin());
        $this->assertEquals(StatusEnum::INACTIVE(), $product->getStatus());
        $this->assertSame(['acc-2'], $product->getAccounts());
        $this->assertSame([$spec], $product->getSpecifications());
        $this->assertSame([$variation], $product->getVariations());
        $this->assertFalse($product->getAddNewVariations());
        $this->assertTrue($product->getDownloadImages());
    }
}
