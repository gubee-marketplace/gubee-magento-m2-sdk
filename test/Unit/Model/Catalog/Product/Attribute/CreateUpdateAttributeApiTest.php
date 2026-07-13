<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Attribute;

use Gubee\SDK\Model\Catalog\Product\Attribute\CreateUpdateAttributeApi;
use PHPUnit\Framework\TestCase;

class CreateUpdateAttributeApiTest extends TestCase
{
    public function testConstructWithAllFields(): void
    {
        $api = new CreateUpdateAttributeApi('color', ['red', 'blue']);

        $this->assertSame('color', $api->getName());
        $this->assertSame(['red', 'blue'], $api->getValues());
    }

    public function testConstructWithoutName(): void
    {
        $api = new CreateUpdateAttributeApi(null, ['red']);

        $this->assertNull($api->getName());
        $this->assertSame(['red'], $api->getValues());
    }

    public function testSetters(): void
    {
        $api = new CreateUpdateAttributeApi(null, ['red']);

        $api->setName('size');
        $api->setValues(['M', 'L']);

        $this->assertSame('size', $api->getName());
        $this->assertSame(['M', 'L'], $api->getValues());
    }
}
