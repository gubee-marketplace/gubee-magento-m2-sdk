<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Common;

use Gubee\SDK\Model\Common\Specification;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class SpecificationTest extends TestCase
{
    public function testConstructorWithAllFields(): void
    {
        $specification = new Specification('id-1', 'name-1', ['value-1', 'value-2']);

        $this->assertSame('id-1', $specification->getId());
        $this->assertSame('name-1', $specification->getName());
        $this->assertSame(['value-1', 'value-2'], $specification->getValues());
    }

    public function testConstructorWithDefaultId(): void
    {
        $specification = new Specification(null, 'name-1', ['value-1']);

        $this->assertNull($specification->getId());
    }

    public function testSetters(): void
    {
        $specification = new Specification('id-1', 'name-1', ['value-1']);

        $specification->setId('id-2');
        $specification->setName('name-2');
        $specification->setValues(['value-2', 'value-3']);

        $this->assertSame('id-2', $specification->getId());
        $this->assertSame('name-2', $specification->getName());
        $this->assertSame(['value-2', 'value-3'], $specification->getValues());
    }

    public function testSetValuesThrowsOnInvalidElementType(): void
    {
        $specification = new Specification('id-1', 'name-1', ['value-1']);

        $this->expectException(InvalidArgumentException::class);

        $specification->setValues([123]);
    }
}
