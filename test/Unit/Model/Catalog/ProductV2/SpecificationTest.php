<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\ProductV2;

use Gubee\SDK\Model\Catalog\ProductV2\Specification;
use PHPUnit\Framework\TestCase;

class SpecificationTest extends TestCase
{
    public function testConstructor(): void
    {
        $spec = new Specification('name-1', ['val-1', 'val-2']);

        $this->assertSame('name-1', $spec->getName());
        $this->assertSame(['val-1', 'val-2'], $spec->getValues());
    }

    public function testConstructorDefaults(): void
    {
        $spec = new Specification('name-2');

        $this->assertSame([], $spec->getValues());
    }

    public function testSetters(): void
    {
        $spec = new Specification('name-3', ['val-3']);

        $spec->setName('name-4');
        $spec->setValues(['val-4', 'val-5']);

        $this->assertSame('name-4', $spec->getName());
        $this->assertSame(['val-4', 'val-5'], $spec->getValues());
    }
}
