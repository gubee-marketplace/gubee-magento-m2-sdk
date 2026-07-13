<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation\Media;

use Gubee\SDK\Model\Catalog\Product\Variation\Media\ImageOperationResponse;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ImageOperationResponseTest extends TestCase
{
    public function testConstructorSetsFields(): void
    {
        $response = new ImageOperationResponse(true, ['event-1', 'event-2']);

        $this->assertTrue($response->getModified());
        $this->assertSame(['event-1', 'event-2'], $response->getPublishedEventTypes());
    }

    public function testOptionalFieldsDefaultToNull(): void
    {
        $response = new ImageOperationResponse();

        $this->assertNull($response->getModified());
        $this->assertNull($response->getPublishedEventTypes());
    }

    public function testSetters(): void
    {
        $response = new ImageOperationResponse();

        $response->setModified(false);
        $response->setPublishedEventTypes(['event-3']);

        $this->assertFalse($response->getModified());
        $this->assertSame(['event-3'], $response->getPublishedEventTypes());
    }

    public function testSetPublishedEventTypesRejectsNonStringElements(): void
    {
        $response = new ImageOperationResponse();

        $this->expectException(InvalidArgumentException::class);
        $response->setPublishedEventTypes([1, 2]);
    }
}
