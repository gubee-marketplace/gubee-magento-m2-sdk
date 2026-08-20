<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product;

use Gubee\SDK\Enum\Catalog\Product\Attribute\TypeEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute;
use PHPUnit\Framework\TestCase;

class AttributeTest extends TestCase
{
    private function build(): Attribute
    {
        return new Attribute(
            'name-1',
            'MULTISELECT',
            'hubee-1',
            'id-1',
            'label-1',
            ['opt-1', 'opt-2'],
            true,
            true
        );
    }

    public function testConstructorCoercesEnum(): void
    {
        $attribute = $this->build();

        $this->assertSame('name-1', $attribute->getName());
        $this->assertEquals(TypeEnum::fromValue('MULTISELECT'), $attribute->getAttrType());
        $this->assertSame('hubee-1', $attribute->getHubeeId());
        $this->assertSame('id-1', $attribute->getId());
        $this->assertSame('label-1', $attribute->getLabel());
        $this->assertSame(['opt-1', 'opt-2'], $attribute->getOptions());
        $this->assertTrue($attribute->getRequired());
        $this->assertTrue($attribute->getVariant());
    }

    public function testConstructorAcceptsEnumInstance(): void
    {
        $attribute = new Attribute('name-2', TypeEnum::fromValue('MULTISELECT'));

        $this->assertEquals(TypeEnum::fromValue('MULTISELECT'), $attribute->getAttrType());
    }

    public function testConstructorDefaults(): void
    {
        $attribute = new Attribute('name-3');

        $this->assertNull($attribute->getAttrType());
        $this->assertNull($attribute->getHubeeId());
        $this->assertNull($attribute->getId());
        $this->assertNull($attribute->getLabel());
        $this->assertNull($attribute->getOptions());
        $this->assertFalse($attribute->getRequired());
        $this->assertNull($attribute->getVariant());
    }

    public function testSetters(): void
    {
        $attribute = $this->build();

        $attribute->setName('name-4');
        $attribute->setAttrType(TypeEnum::fromValue('MULTISELECT'));
        $attribute->setHubeeId('hubee-2');
        $attribute->setId('id-2');
        $attribute->setLabel('label-2');
        $attribute->setOptions(['opt-3']);
        $attribute->setRequired(false);
        $attribute->setVariant(false);

        $this->assertSame('name-4', $attribute->getName());
        $this->assertSame('hubee-2', $attribute->getHubeeId());
        $this->assertSame('id-2', $attribute->getId());
        $this->assertSame('label-2', $attribute->getLabel());
        $this->assertSame(['opt-3'], $attribute->getOptions());
        $this->assertFalse($attribute->getRequired());
        $this->assertFalse($attribute->getVariant());
    }
}
