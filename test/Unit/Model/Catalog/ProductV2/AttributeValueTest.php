<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\ProductV2;

use Gubee\SDK\Model\Catalog\ProductV2\AttributeValue;
use PHPUnit\Framework\TestCase;

class AttributeValueTest extends TestCase
{
    public function testConstructWithAllFields(): void
    {
        $attributeValue = new AttributeValue('attribute-1', ['red', 'blue']);

        $this->assertSame('attribute-1', $attributeValue->getAttributeId());
        $this->assertSame(['red', 'blue'], $attributeValue->getValues());
    }

    public function testConstructWithoutAttributeId(): void
    {
        $attributeValue = new AttributeValue(null, ['red']);

        $this->assertNull($attributeValue->getAttributeId());
        $this->assertSame(['red'], $attributeValue->getValues());
    }

    public function testSetters(): void
    {
        $attributeValue = new AttributeValue(null, ['red']);

        $attributeValue->setAttributeId('attribute-2');
        $attributeValue->setValues(['green']);

        $this->assertSame('attribute-2', $attributeValue->getAttributeId());
        $this->assertSame(['green'], $attributeValue->getValues());
    }
}
