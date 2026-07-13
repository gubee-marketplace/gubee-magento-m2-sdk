<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation\Media;

use Gubee\SDK\Model\Catalog\Product\Variation\Media\PatchVideoMetadata;
use PHPUnit\Framework\TestCase;

class PatchVideoMetadataTest extends TestCase
{
    public function testConstructorSetsFields(): void
    {
        $metadata = new PatchVideoMetadata('seller-1', true, 1);

        $this->assertSame('seller-1', $metadata->getSellerId());
        $this->assertTrue($metadata->getMain());
        $this->assertSame(1, $metadata->getOrder());
    }

    public function testOptionalFieldsDefaultToNull(): void
    {
        $metadata = new PatchVideoMetadata();

        $this->assertNull($metadata->getSellerId());
        $this->assertNull($metadata->getMain());
        $this->assertNull($metadata->getOrder());
    }

    public function testSetters(): void
    {
        $metadata = new PatchVideoMetadata();

        $metadata->setSellerId('seller-2');
        $metadata->setMain(false);
        $metadata->setOrder(2);

        $this->assertSame('seller-2', $metadata->getSellerId());
        $this->assertFalse($metadata->getMain());
        $this->assertSame(2, $metadata->getOrder());
    }
}
