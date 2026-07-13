<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation\Media;

use Gubee\SDK\Model\Catalog\Product\Variation\Media\ReorderImagesRequest;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ReorderImagesRequestTest extends TestCase
{
    public function testConstructorSetsFields(): void
    {
        $request = new ReorderImagesRequest('seller-1', ['uuid-1', 'uuid-2']);

        $this->assertSame('seller-1', $request->getSellerId());
        $this->assertSame(['uuid-1', 'uuid-2'], $request->getOrderedUuids());
    }

    public function testOptionalFieldsDefaultToNull(): void
    {
        $request = new ReorderImagesRequest();

        $this->assertNull($request->getSellerId());
        $this->assertNull($request->getOrderedUuids());
    }

    public function testSetters(): void
    {
        $request = new ReorderImagesRequest();

        $request->setSellerId('seller-2');
        $request->setOrderedUuids(['uuid-3']);

        $this->assertSame('seller-2', $request->getSellerId());
        $this->assertSame(['uuid-3'], $request->getOrderedUuids());
    }

    public function testSetOrderedUuidsRejectsNonStringElements(): void
    {
        $request = new ReorderImagesRequest();

        $this->expectException(InvalidArgumentException::class);
        $request->setOrderedUuids([1, 2]);
    }
}
