<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Model\Catalog\Product\Variation\PatchVariationResponse;
use PHPUnit\Framework\TestCase;

class PatchVariationResponseTest extends TestCase
{
    public function testConstructWithAllFields(): void
    {
        $response = new PatchVariationResponse(true, ['PRODUCT_UPDATED']);

        $this->assertTrue($response->getModified());
        $this->assertSame(['PRODUCT_UPDATED'], $response->getPublishedEventTypes());
    }

    public function testConstructWithNoFields(): void
    {
        $response = new PatchVariationResponse();

        $this->assertNull($response->getModified());
        $this->assertNull($response->getPublishedEventTypes());
    }

    public function testSetters(): void
    {
        $response = new PatchVariationResponse();

        $response->setModified(false);
        $response->setPublishedEventTypes(['OTHER_EVENT']);

        $this->assertFalse($response->getModified());
        $this->assertSame(['OTHER_EVENT'], $response->getPublishedEventTypes());
    }
}
