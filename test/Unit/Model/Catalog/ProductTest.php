<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog;

use DI\NotFoundException;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\Attribute\OriginEnum;
use Gubee\SDK\Enum\Catalog\Product\StatusEnum;
use Gubee\SDK\Enum\Catalog\Product\TypeEnum;
use Gubee\SDK\Model\Catalog\Category;
use Gubee\SDK\Model\Catalog\Product;
use Gubee\SDK\Model\Catalog\Product\Attribute\AttributeValue;
use Gubee\SDK\Model\Catalog\Product\Attribute\Brand;
use Gubee\SDK\Model\Catalog\Product\Variation;
use Gubee\SDK\Model\Gubee\Account;
use Gubee\SDK\Resource\Catalog\CategoryResource;
use Gubee\SDK\Resource\Catalog\Product\Attribute\BrandResource;
use Gubee\SDK\Resource\Catalog\ProductResource;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class ProductTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function productResource(): ProductResource
    {
        return $this->createMock(ProductResource::class);
    }

    private function brandResource(): BrandResource
    {
        return $this->createMock(BrandResource::class);
    }

    private function buildProduct(): Product
    {
        return $this->serviceProvider()->create(
            Product::class,
            [
                'id'                => 'prod-1',
                'mainCategory'      => 'cat-main',
                'mainSku'           => 'SKU-1',
                'origin'            => 'NATIONAL',
                'status'            => 'ACTIVE',
                'type'              => 'SIMPLE',
                'accounts'          => [['id' => 'acc-1']],
                'categories'        => [
                    'cat-string-id',
                    ['id' => 'cat-array-id', 'name' => 'From array'],
                ],
                'specifications'    => [
                    ['attribute' => 'color', 'values' => ['red']],
                ],
                'variantAttributes' => [
                    ['attribute' => 'size', 'values' => ['M']],
                ],
                'variations'        => [
                    [
                        'skuId'        => 'variation-1',
                        'images'       => [],
                        'dimension'    => null,
                        'handlingTime' => null,
                        'name'         => 'Variation One',
                        'sku'          => 'VAR-1',
                        'warrantyTime' => null,
                    ],
                ],
            ]
        );
    }

    public function testHydratesMainCategoryFromStringId(): void
    {
        $product = $this->buildProduct();

        $this->assertInstanceOf(Category::class, $product->getMainCategory());
        $this->assertSame('cat-main', $product->getMainCategory()->getId());
    }

    public function testHydratesAccountsFromRawArrays(): void
    {
        $product = $this->buildProduct();

        $this->assertContainsOnlyInstancesOf(Account::class, $product->getAccounts());
    }

    public function testHydratesCategoriesFromMixedStringAndArray(): void
    {
        $product    = $this->buildProduct();
        $categories = $product->getCategories();

        $this->assertInstanceOf(Category::class, $categories[0]);
        $this->assertSame('cat-string-id', $categories[0]->getId());
        $this->assertInstanceOf(Category::class, $categories[1]);
        $this->assertSame('cat-array-id', $categories[1]->getId());
    }

    public function testHydratesSpecificationsFromRawArrays(): void
    {
        $product        = $this->buildProduct();
        $specifications = $product->getSpecifications();

        $this->assertContainsOnlyInstancesOf(AttributeValue::class, $specifications);
        $this->assertSame('color', $specifications[0]->getAttribute());
    }

    public function testHydratesVariantAttributesFromRawArrays(): void
    {
        $product           = $this->buildProduct();
        $variantAttributes = $product->getVariantAttributes();

        $this->assertContainsOnlyInstancesOf(AttributeValue::class, $variantAttributes);
        $this->assertSame('size', $variantAttributes[0]->getAttribute());
    }

    public function testHydratesVariationsFromRawArrays(): void
    {
        $product    = $this->buildProduct();
        $variations = $product->getVariations();

        $this->assertContainsOnlyInstancesOf(Variation::class, $variations);
        $this->assertSame('VAR-1', $variations[0]->getSku());
    }

    public function testJsonSerializeOutputUnchangedForFullyPopulatedProduct(): void
    {
        $product = $this->buildProduct();

        $serialized = $product->jsonSerialize();

        $this->assertSame('prod-1', $serialized['id']);
        $this->assertSame('cat-main', $serialized['mainCategory']);
        $this->assertSame(['cat-string-id', 'cat-array-id'], $serialized['categories']);
        $this->assertCount(1, $serialized['variations']);
        $this->assertArrayNotHasKey('brand', $serialized);
    }

    public function testConstructorAndSettersCoverRemainingAccessors(): void
    {
        $serviceProvider = $this->serviceProvider();
        $productResource = $this->productResource();
        $brandResource   = $this->brandResource();
        $brand           = new Brand($brandResource, 'Brand', hubeeId: 'hubee-brand', id: 'brand-id');
        $mainCategory    = new Category($serviceProvider, $this->createMock(CategoryResource::class), 'cat-main');
        $category        = new Category($serviceProvider, $this->createMock(CategoryResource::class), 'cat-1');
        $specification   = $serviceProvider->create(AttributeValue::class, ['attribute' => 'color', 'values' => ['red']]);
        $variation       = $serviceProvider->create(
            Variation::class,
            [
                'skuId'        => 'variation-1',
                'images'       => [],
                'dimension'    => null,
                'handlingTime' => null,
                'name'         => 'Variation One',
                'sku'          => 'VAR-1',
                'warrantyTime' => null,
            ]
        );
        $accounts        = [new Account()];

        $product = new Product(
            $serviceProvider,
            $productResource,
            $brandResource,
            'prod-1',
            $mainCategory,
            'SKU-1',
            OriginEnum::NATIONAL(),
            StatusEnum::ACTIVE(),
            TypeEnum::SIMPLE(),
            $brand
        );

        $product
            ->setHubeeId('hubee-1')
            ->setName('Product Name')
            ->setNbm('1234')
            ->setAccounts($accounts)
            ->setCategories([$category])
            ->setSpecifications([$specification])
            ->setVariantAttributes([$specification])
            ->setVariations([$variation]);

        $this->assertSame($brand, $product->getBrand());
        $this->assertSame('prod-1', $product->getId());
        $this->assertSame($mainCategory, $product->getMainCategory());
        $this->assertSame('SKU-1', $product->getMainSku());
        $this->assertEquals(OriginEnum::NATIONAL(), $product->getOrigin());
        $this->assertEquals(StatusEnum::ACTIVE(), $product->getStatus());
        $this->assertEquals(TypeEnum::SIMPLE(), $product->getType());
        $this->assertSame('hubee-1', $product->getHubeeId());
        $this->assertSame('Product Name', $product->getName());
        $this->assertSame('1234', $product->getNbm());
        $this->assertSame($accounts, $product->getAccounts());
        $this->assertSame([$category], $product->getCategories());
        $this->assertSame([$specification], $product->getSpecifications());
        $this->assertSame([$specification], $product->getVariantAttributes());
        $this->assertSame([$variation], $product->getVariations());
    }

    public function testSetBrandLoadsExistingBrandWhenHubeeIdIsMissing(): void
    {
        $serviceProvider = $this->serviceProvider();
        $productResource = $this->productResource();
        $brandResource   = $this->brandResource();
        $loadedBrand     = new Brand($brandResource, 'Brand', hubeeId: 'hubee-brand', id: 'brand-id');

        $brandResource->expects($this->once())
            ->method('loadByName')
            ->with('Brand')
            ->willReturn($loadedBrand);

        $product = new Product(
            $serviceProvider,
            $productResource,
            $brandResource,
            'prod-1',
            'cat-main',
            'SKU-1',
            'NATIONAL',
            'ACTIVE',
            'SIMPLE'
        );

        $result = $product->setBrand(new Brand($brandResource, 'Brand'));

        $this->assertSame($product, $result);
        $this->assertSame($loadedBrand, $product->getBrand());
    }

    public function testLoadDelegatesBySupportedField(): void
    {
        $serviceProvider = $this->serviceProvider();
        $productResource = $this->productResource();
        $brandResource   = $this->brandResource();
        $expectedById    = $this->createMock(Product::class);
        $expectedBySku   = $this->createMock(Product::class);

        $productResource->expects($this->once())
            ->method('loadById')
            ->with('prod-1')
            ->willReturn($expectedById);
        $productResource->expects($this->once())
            ->method('getBySku')
            ->with('sku-1')
            ->willReturn($expectedBySku);

        $product = new Product(
            $serviceProvider,
            $productResource,
            $brandResource,
            'prod-0',
            'cat-main',
            'SKU-0',
            'NATIONAL',
            'ACTIVE',
            'SIMPLE'
        );

        $this->assertSame($expectedById, $product->load('prod-1'));
        $this->assertSame($expectedBySku, $product->load('sku-1', 'skuId'));
    }

    public function testSaveUpdatesExistingProduct(): void
    {
        $serviceProvider = $this->serviceProvider();
        $productResource = $this->productResource();
        $brandResource   = $this->brandResource();

        $productResource->expects($this->once())
            ->method('update')
            ->with('prod-1', $this->isInstanceOf(Product::class));

        $product = new Product(
            $serviceProvider,
            $productResource,
            $brandResource,
            'prod-1',
            'cat-main',
            'SKU-1',
            'NATIONAL',
            'ACTIVE',
            'SIMPLE'
        );

        $this->assertSame($product, $product->save());
    }

    public function testSaveCreatesWhenUpdateReturnsNotFound(): void
    {
        $serviceProvider = $this->serviceProvider();
        $productResource = $this->productResource();
        $brandResource   = $this->brandResource();

        $productResource->expects($this->once())
            ->method('update')
            ->willThrowException(
                new \Gubee\SDK\Library\HttpClient\Exception\NotFoundException(
                    $this->createMock(RequestInterface::class),
                    $this->createMock(ResponseInterface::class),
                    'not found'
                )
            );
        $productResource->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Product::class))
            ->willReturnCallback(static function (Product $product): Product {
                return $product;
            });

        $product = new Product(
            $serviceProvider,
            $productResource,
            $brandResource,
            'prod-1',
            'cat-main',
            'SKU-1',
            'NATIONAL',
            'ACTIVE',
            'SIMPLE'
        );

        $this->assertSame($product, $product->save());
    }

    public function testSaveRethrowsUnexpectedExceptions(): void
    {
        $serviceProvider = $this->serviceProvider();
        $productResource = $this->productResource();
        $brandResource   = $this->brandResource();

        $productResource->expects($this->once())
            ->method('update')
            ->willThrowException(new RuntimeException('boom'));

        $product = new Product(
            $serviceProvider,
            $productResource,
            $brandResource,
            'prod-1',
            'cat-main',
            'SKU-1',
            'NATIONAL',
            'ACTIVE',
            'SIMPLE'
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('boom');

        $product->save();
    }

    public function testConstructorCoversBrandStringVariantAttributeStringAndOptionalScalars(): void
    {
        $product = $this->serviceProvider()->create(
            Product::class,
            [
                'id'                => 'prod-1',
                'mainCategory'      => 'cat-main',
                'mainSku'           => 'SKU-1',
                'origin'            => 'NATIONAL',
                'status'            => 'ACTIVE',
                'type'              => 'SIMPLE',
                'brand'             => 'Brand',
                'hubeeId'           => 'hubee-1',
                'name'              => 'Product Name',
                'nbm'               => '1234',
                'variantAttributes' => ['size'],
            ]
        );

        $this->assertSame('Brand', $product->getBrand()->getName());
        $this->assertSame('hubee-1', $product->getHubeeId());
        $this->assertSame('Product Name', $product->getName());
        $this->assertSame('1234', $product->getNbm());
        $this->assertSame('size', $product->getVariantAttributes()[0]->getAttribute());
    }

    public function testConstructorCoversBrandArrayAndSerializesBrandId(): void
    {
        $product = $this->serviceProvider()->create(
            Product::class,
            [
                'id'           => 'prod-1',
                'mainCategory' => 'cat-main',
                'mainSku'      => 'SKU-1',
                'origin'       => 'NATIONAL',
                'status'       => 'ACTIVE',
                'type'         => 'SIMPLE',
                'brand'        => ['name' => 'Brand', 'id' => 'brand-id', 'hubeeId' => 'hubee-brand'],
            ]
        );

        $this->assertSame('brand-id', $product->jsonSerialize()['brand']);
    }

    public function testLoadThrowsForUnsupportedField(): void
    {
        $product = new Product(
            $this->serviceProvider(),
            $this->productResource(),
            $this->brandResource(),
            'prod-1',
            'cat-main',
            'SKU-1',
            'NATIONAL',
            'ACTIVE',
            'SIMPLE'
        );

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Field unknown not found');

        $product->load('prod-1', 'unknown');
    }

    public function testSetBrandSavesWhenBrandLookupFails(): void
    {
        $serviceProvider = $this->serviceProvider();
        $productResource = $this->productResource();
        $brandResource   = $this->brandResource();
        $savedBrand      = new Brand($brandResource, 'Brand', hubeeId: 'hubee-brand');

        $brandResource->expects($this->exactly(2))
            ->method('loadByName')
            ->with('Brand')
            ->willThrowException(new RuntimeException('missing'));
        $brandResource->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Brand::class))
            ->willReturn($savedBrand);

        $product = new Product(
            $serviceProvider,
            $productResource,
            $brandResource,
            'prod-1',
            'cat-main',
            'SKU-1',
            'NATIONAL',
            'ACTIVE',
            'SIMPLE'
        );

        $result = $product->setBrand(new Brand($brandResource, 'Brand'));

        $this->assertSame($product, $result);
        $this->assertSame($savedBrand, $product->getBrand());
    }
}
