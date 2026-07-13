<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\ProductV2;

use Gubee\SDK\Model\Catalog\ProductV2\KitAssociation;
use PHPUnit\Framework\TestCase;

class KitAssociationTest extends TestCase
{
    public function testConstructWithAllFields(): void
    {
        $kitAssociation = new KitAssociation('sku-1', 2, 50.0);

        $this->assertSame('sku-1', $kitAssociation->getSkuId());
        $this->assertSame(2, $kitAssociation->getQty());
        $this->assertSame(50.0, $kitAssociation->getPercentageOfTotal());
    }

    public function testConstructWithOnlyRequiredField(): void
    {
        $kitAssociation = new KitAssociation(null, 1);

        $this->assertNull($kitAssociation->getSkuId());
        $this->assertSame(1, $kitAssociation->getQty());
        $this->assertNull($kitAssociation->getPercentageOfTotal());
    }

    public function testSetters(): void
    {
        $kitAssociation = new KitAssociation(null, 1);

        $kitAssociation->setSkuId('sku-2');
        $kitAssociation->setQty(3);
        $kitAssociation->setPercentageOfTotal(25.0);

        $this->assertSame('sku-2', $kitAssociation->getSkuId());
        $this->assertSame(3, $kitAssociation->getQty());
        $this->assertSame(25.0, $kitAssociation->getPercentageOfTotal());
    }
}
