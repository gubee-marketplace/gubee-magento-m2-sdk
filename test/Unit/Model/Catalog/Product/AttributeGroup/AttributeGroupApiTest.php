<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\AttributeGroup;

use Gubee\SDK\Model\Catalog\Product\AttributeGroup\AttributeGroupApi;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AttributeGroupApiTest extends TestCase
{
    public function testConstructorSetsFields(): void
    {
        $group = new AttributeGroupApi('Group One', ['attr-1', 'attr-2']);

        $this->assertSame('Group One', $group->getName());
        $this->assertSame(['attr-1', 'attr-2'], $group->getAttributes());
    }

    public function testSetters(): void
    {
        $group = new AttributeGroupApi('Group One', ['attr-1']);

        $group->setName('Group Two');
        $group->setAttributes(['attr-2', 'attr-3']);

        $this->assertSame('Group Two', $group->getName());
        $this->assertSame(['attr-2', 'attr-3'], $group->getAttributes());
    }

    public function testSetAttributesRejectsNonStringElements(): void
    {
        $group = new AttributeGroupApi('Group One', ['attr-1']);

        $this->expectException(InvalidArgumentException::class);
        $group->setAttributes([1, 2]);
    }
}
