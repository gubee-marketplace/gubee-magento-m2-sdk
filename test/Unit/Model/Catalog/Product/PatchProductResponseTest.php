<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product;

use Gubee\SDK\Model\Catalog\Product\PatchProductResponse;
use PHPUnit\Framework\TestCase;

class PatchProductResponseTest extends TestCase
{
    private function build(): PatchProductResponse
    {
        return new PatchProductResponse(true, ['EVENT_ONE', 'EVENT_TWO']);
    }

    public function testConstructor(): void
    {
        $response = $this->build();

        $this->assertTrue($response->getModified());
        $this->assertSame(['EVENT_ONE', 'EVENT_TWO'], $response->getPublishedEventTypes());
    }

    public function testConstructorDefaults(): void
    {
        $response = new PatchProductResponse();

        $this->assertNull($response->getModified());
        $this->assertNull($response->getPublishedEventTypes());
    }

    public function testSetters(): void
    {
        $response = $this->build();

        $response->setModified(false);
        $response->setPublishedEventTypes(['EVENT_THREE']);

        $this->assertFalse($response->getModified());
        $this->assertSame(['EVENT_THREE'], $response->getPublishedEventTypes());
    }
}
