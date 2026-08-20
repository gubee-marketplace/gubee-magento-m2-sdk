<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product;

use Gubee\SDK\Model\Catalog\Product\VariationSkuApiMap;
use PHPUnit\Framework\TestCase;

class VariationSkuApiMapTest extends TestCase
{
    private function build(): VariationSkuApiMap
    {
        return new VariationSkuApiMap('id-1', 'skuId-1', 'sku-1', 'ean-1');
    }

    public function testConstructor(): void
    {
        $map = $this->build();

        $this->assertSame('id-1', $map->getId());
        $this->assertSame('skuId-1', $map->getSkuId());
        $this->assertSame('sku-1', $map->getSku());
        $this->assertSame('ean-1', $map->getEan());
    }

    public function testConstructorDefaults(): void
    {
        $map = new VariationSkuApiMap(skuId: 'skuId-2', sku: 'sku-2');

        $this->assertNull($map->getId());
        $this->assertNull($map->getEan());
    }

    public function testSetters(): void
    {
        $map = $this->build();

        $map->setId('id-2');
        $map->setSkuId('skuId-3');
        $map->setSku('sku-3');
        $map->setEan('ean-2');

        $this->assertSame('id-2', $map->getId());
        $this->assertSame('skuId-3', $map->getSkuId());
        $this->assertSame('sku-3', $map->getSku());
        $this->assertSame('ean-2', $map->getEan());
    }
}
