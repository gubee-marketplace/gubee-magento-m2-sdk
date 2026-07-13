<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation\Media;

use Gubee\SDK\Model\Catalog\Product\Variation\Media\Image;
use PHPUnit\Framework\TestCase;

class AbstractMediaTest extends TestCase
{
    public function testConstructorSetsAllFields(): void
    {
        $image = new Image(true, 1, 'id-1', 'name-1', 'https://example.com/a.png');

        $this->assertTrue($image->getMain());
        $this->assertSame(1, $image->getOrder());
        $this->assertSame('id-1', $image->getId());
        $this->assertSame('name-1', $image->getName());
        $this->assertSame('https://example.com/a.png', $image->getUrl());
    }

    public function testOptionalFieldsDefaultToNull(): void
    {
        $image = new Image(false, 0);

        $this->assertFalse($image->getMain());
        $this->assertSame(0, $image->getOrder());
        $this->assertNull($image->getId());
        $this->assertNull($image->getName());
        $this->assertNull($image->getUrl());
    }

    public function testSetters(): void
    {
        $image = new Image(false, 0);

        $image->setMain(true);
        $image->setOrder(5);
        $image->setId('id-2');
        $image->setName('name-2');
        $image->setUrl('https://example.com/b.png');

        $this->assertTrue($image->getMain());
        $this->assertSame(5, $image->getOrder());
        $this->assertSame('id-2', $image->getId());
        $this->assertSame('name-2', $image->getName());
        $this->assertSame('https://example.com/b.png', $image->getUrl());
    }
}
