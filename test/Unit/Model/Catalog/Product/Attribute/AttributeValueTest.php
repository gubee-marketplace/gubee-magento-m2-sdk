<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Attribute;

use Gubee\SDK\Model\Catalog\Product\Attribute\AttributeValue;
use PHPUnit\Framework\TestCase;

class AttributeValueTest extends TestCase
{
    public function testConstructWithDefaultValues(): void
    {
        $attributeValue = new AttributeValue('color');

        $this->assertSame('color', $attributeValue->getAttribute());
        $this->assertSame([], $attributeValue->getValues());
    }

    public function testConstructWithValues(): void
    {
        $attributeValue = new AttributeValue('color', ['red', 'blue']);

        $this->assertSame('color', $attributeValue->getAttribute());
        $this->assertSame(['red', 'blue'], $attributeValue->getValues());
    }

    public function testSetters(): void
    {
        $attributeValue = new AttributeValue('color', ['red']);

        $attributeValue->setAttribute('size');
        $attributeValue->setValues(['M', 'L']);

        $this->assertSame('size', $attributeValue->getAttribute());
        $this->assertSame(['M', 'L'], $attributeValue->getValues());
    }
}
