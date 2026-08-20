<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Library\HttpClient\Exception\NotFoundException;
use Gubee\SDK\Model\Catalog\Category;
use Gubee\SDK\Resource\Catalog\CategoryResource;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CategoryTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function categoryResource(): CategoryResource
    {
        return $this->createMock(CategoryResource::class);
    }

    public function testConstructorAndGetters(): void
    {
        $category = new Category(
            $this->serviceProvider(),
            $this->categoryResource(),
            'id-1',
            'Category Name',
            true,
            'description',
            false,
            'hubee-1'
        );

        $this->assertSame('id-1', $category->getId());
        $this->assertSame('Category Name', $category->getName());
        $this->assertTrue($category->getActive());
        $this->assertSame('description', $category->getDescription());
        $this->assertFalse($category->getEnabledAutoIntegration());
        $this->assertSame('hubee-1', $category->getHubeeId());
    }

    public function testHydratesIntegerParentIntoCategoryInstance(): void
    {
        $category = new Category(
            $this->serviceProvider(),
            $this->categoryResource(),
            'id-1',
            'Category Name',
            parent: 10
        );

        $this->assertInstanceOf(Category::class, $category->getParent());
        $this->assertSame('10', $category->getParent()->getId());
    }

    public function testPassesThroughAlreadyHydratedParent(): void
    {
        $parent = new Category($this->serviceProvider(), $this->categoryResource(), 'parent-id');

        $category = new Category(
            $this->serviceProvider(),
            $this->categoryResource(),
            'id-1',
            parent: $parent
        );

        $this->assertSame($parent, $category->getParent());
    }

    public function testSetters(): void
    {
        $category = new Category($this->serviceProvider(), $this->categoryResource(), 'id-1');

        $category->setId('id-2');
        $category->setName('New Name');
        $category->setActive(true);
        $category->setDescription('desc');
        $category->setEnabledAutoIntegration(true);
        $category->setHubeeId('hubee-2');
        $parent = new Category($this->serviceProvider(), $this->categoryResource(), 'parent-id');
        $category->setParent($parent);

        $this->assertSame('id-2', $category->getId());
        $this->assertSame('New Name', $category->getName());
        $this->assertTrue($category->getActive());
        $this->assertSame('desc', $category->getDescription());
        $this->assertTrue($category->getEnabledAutoIntegration());
        $this->assertSame('hubee-2', $category->getHubeeId());
        $this->assertSame($parent, $category->getParent());
    }

    public function testJsonSerializeSerializesParentAsIdAndOmitsInternals(): void
    {
        $parent = new Category($this->serviceProvider(), $this->categoryResource(), 'parent-id');

        $category = new Category(
            $this->serviceProvider(),
            $this->categoryResource(),
            'id-1',
            'Name',
            parent: $parent
        );

        $values = $category->jsonSerialize();

        $this->assertSame('parent-id', $values['parent']);
        $this->assertArrayNotHasKey('serviceProvider', $values);
        $this->assertArrayNotHasKey('categoryResource', $values);
    }

    public function testJsonSerializeWithoutParent(): void
    {
        $category = new Category($this->serviceProvider(), $this->categoryResource(), 'id-1', 'Name');

        $values = $category->jsonSerialize();

        $this->assertArrayNotHasKey('parent', $values);
        $this->assertArrayNotHasKey('serviceProvider', $values);
        $this->assertArrayNotHasKey('categoryResource', $values);
    }

    public function testSaveCreatesWhenNotFound(): void
    {
        $resource = $this->createMock(CategoryResource::class);
        $resource->expects($this->once())
            ->method('loadByExternalId')
            ->with('id-1')
            ->willThrowException(
                new NotFoundException(
                    $this->createMock(RequestInterface::class),
                    $this->createMock(ResponseInterface::class),
                    'not found'
                )
            );
        $resource->expects($this->once())
            ->method('create')
            ->willReturnCallback(function (Category $category) {
                return $category;
            });

        $category = new Category($this->serviceProvider(), $resource, 'id-1', 'Name');

        $result = $category->save();

        $this->assertSame($category, $result);
    }

    public function testSaveUpdatesWhenFound(): void
    {
        $resource = $this->createMock(CategoryResource::class);
        $resource->expects($this->once())
            ->method('loadByExternalId')
            ->with('id-1')
            ->willReturn($this->createMock(Category::class));
        $resource->expects($this->once())
            ->method('updateByExternalId')
            ->willReturnCallback(function (string $id, Category $category) {
                return $category;
            });

        $category = new Category($this->serviceProvider(), $resource, 'id-1', 'Name');

        $result = $category->save();

        $this->assertSame($category, $result);
    }

    public function testLoadDelegatesToResource(): void
    {
        $resource = $this->createMock(CategoryResource::class);
        $expected = $this->createMock(Category::class);
        $resource->expects($this->once())
            ->method('loadByExternalId')
            ->with('external-1')
            ->willReturn($expected);

        $category = new Category($this->serviceProvider(), $resource, 'id-1', 'Name');

        $this->assertSame($expected, $category->load('external-1'));
    }
}
