<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation\Media;

use Gubee\SDK\Model\Catalog\Product\Variation\Media\PatchImageMetadata;
use PHPUnit\Framework\TestCase;

class PatchImageMetadataTest extends TestCase
{
    public function testConstructorSetsFields(): void
    {
        $metadata = new PatchImageMetadata(
            'seller-1',
            'name-1',
            1,
            'local-url-1',
            'image-file-1'
        );

        $this->assertSame('seller-1', $metadata->getSellerId());
        $this->assertSame('name-1', $metadata->getName());
        $this->assertSame(1, $metadata->getOrder());
        $this->assertSame('local-url-1', $metadata->getLocalUrl());
        $this->assertSame('image-file-1', $metadata->getImageFileName());
    }

    public function testOptionalFieldsDefaultToNull(): void
    {
        $metadata = new PatchImageMetadata();

        $this->assertNull($metadata->getSellerId());
        $this->assertNull($metadata->getName());
        $this->assertNull($metadata->getOrder());
        $this->assertNull($metadata->getLocalUrl());
        $this->assertNull($metadata->getImageFileName());
    }

    public function testSetters(): void
    {
        $metadata = new PatchImageMetadata();

        $metadata->setSellerId('seller-2');
        $metadata->setName('name-2');
        $metadata->setOrder(2);
        $metadata->setLocalUrl('local-url-2');
        $metadata->setImageFileName('image-file-2');

        $this->assertSame('seller-2', $metadata->getSellerId());
        $this->assertSame('name-2', $metadata->getName());
        $this->assertSame(2, $metadata->getOrder());
        $this->assertSame('local-url-2', $metadata->getLocalUrl());
        $this->assertSame('image-file-2', $metadata->getImageFileName());
    }
}
