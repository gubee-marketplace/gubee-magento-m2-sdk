<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Attribute;

use Error;
use Exception;
use Gubee\SDK\Model\Catalog\Product\Attribute\Brand;
use Gubee\SDK\Resource\Catalog\Product\Attribute\BrandResource;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    private function brandResource(): BrandResource
    {
        return $this->createMock(BrandResource::class);
    }

    public function testConstructWithAllFields(): void
    {
        $brandResource = $this->brandResource();
        $brand         = new Brand($brandResource, 'Nike', 'Sportswear', 'hubee-1', 'id-1');

        $this->assertSame('Nike', $brand->getName());
        $this->assertSame('Sportswear', $brand->getDescription());
        $this->assertSame('hubee-1', $brand->getHubeeId());
        $this->assertSame('id-1', $brand->getId());
    }

    public function testConstructWithOnlyRequiredField(): void
    {
        $brand = new Brand($this->brandResource(), 'Nike');

        $this->assertSame('Nike', $brand->getName());
        $this->assertNull($brand->getDescription());
        $this->assertNull($brand->getHubeeId());
        $this->assertNull($brand->getId());
    }

    public function testSetters(): void
    {
        $brand = new Brand($this->brandResource(), 'Nike');

        $brand->setName('Adidas');
        $brand->setDescription('Sportswear');
        $brand->setHubeeId('hubee-2');
        $brand->setId('id-2');

        $this->assertSame('Adidas', $brand->getName());
        $this->assertSame('Sportswear', $brand->getDescription());
        $this->assertSame('hubee-2', $brand->getHubeeId());
        $this->assertSame('id-2', $brand->getId());
    }

    public function testLoadByName(): void
    {
        $brandResource = $this->brandResource();
        $loaded        = new Brand($brandResource, 'Nike');
        $brandResource->expects($this->once())->method('loadByName')->with('Nike')->willReturn($loaded);

        $brand = new Brand($brandResource, 'Nike');

        $this->assertSame($loaded, $brand->load('Nike', 'name'));
    }

    public function testLoadByExternalId(): void
    {
        $brandResource = $this->brandResource();
        $loaded        = new Brand($brandResource, 'Nike');
        $brandResource->expects($this->once())->method('loadByExternalId')->with('ext-1')->willReturn($loaded);

        $brand = new Brand($brandResource, 'Nike');

        $this->assertSame($loaded, $brand->load('ext-1', 'externalId'));
    }

    public function testLoadById(): void
    {
        $brandResource = $this->brandResource();
        $loaded        = new Brand($brandResource, 'Nike');
        $brandResource->expects($this->once())->method('loadById')->with('id-1')->willReturn($loaded);

        $brand = new Brand($brandResource, 'Nike');

        $this->assertSame($loaded, $brand->load('id-1', 'id'));
    }

    public function testLoadWithInvalidFieldThrows(): void
    {
        $brand = new Brand($this->brandResource(), 'Nike');

        $this->expectException(InvalidArgumentException::class);
        $brand->load('anything', 'invalid');
    }

    public function testSaveWithHubeeIdSetCallsUndefinedMethod(): void
    {
        // NOTE: Brand::save() calls $this->brandResource->updateById(), but
        // BrandResource does not define an updateById() method (only
        // updateByExternalId/updateByName exist). This appears to be a
        // pre-existing bug in Brand::save(), left unmodified per task scope;
        // this test documents the current (broken) behavior instead of
        // asserting a nonexistent method call.
        $brand = new Brand($this->brandResource(), 'Nike', null, 'hubee-1');

        $this->expectException(Error::class);
        $brand->save();
    }

    public function testSaveUpdatesByExternalIdWhenIdIsSet(): void
    {
        $brandResource = $this->brandResource();
        $brand         = new Brand($brandResource, 'Nike', null, null, 'id-1');
        $brandResource->expects($this->once())->method('updateByExternalId')->with($brand)->willReturn($brand);

        $this->assertSame($brand, $brand->save());
    }

    public function testSaveCreatesWhenBrandDoesNotExist(): void
    {
        $brandResource = $this->brandResource();
        $brand         = new Brand($brandResource, 'Nike');
        $brandResource->expects($this->once())->method('loadByName')->with('Nike')
            ->willThrowException(new Exception('not found'));
        $brandResource->expects($this->once())->method('create')->with($brand)->willReturn($brand);

        $this->assertSame($brand, $brand->save());
    }

    public function testSaveUpdatesByNameWhenBrandExists(): void
    {
        $brandResource = $this->brandResource();
        $brand         = new Brand($brandResource, 'Nike');
        $brandResource->expects($this->once())->method('loadByName')->with('Nike')->willReturn($brand);
        $brandResource->expects($this->once())->method('updateByName')->with($brand)->willReturn($brand);

        $this->assertSame($brand, $brand->save());
    }

    public function testJsonSerializeOmitsBrandResource(): void
    {
        $brand = new Brand($this->brandResource(), 'Nike', 'Sportswear');

        $json = $brand->jsonSerialize();

        $this->assertArrayNotHasKey('brandResource', $json);
        $this->assertSame('Nike', $json['name']);
    }
}
