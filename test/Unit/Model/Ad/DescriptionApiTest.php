<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Ad\DescriptionApi;
use Gubee\SDK\Model\Platform\PlatformStore;
use PHPUnit\Framework\TestCase;

class DescriptionApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testConstructorWithAllFieldsAndArrayPlatformStore(): void
    {
        $descriptionApi = $this->serviceProvider()->create(
            DescriptionApi::class,
            [
                'id'            => 'id-1',
                'productId'     => 'product-1',
                'skuId'         => 'sku-1',
                'sellerId'      => 'seller-1',
                'platformStore' => ['platform' => 'GUBEE', 'store' => 'store-1'],
                'description'   => 'a description',
            ]
        );

        $this->assertSame('id-1', $descriptionApi->getId());
        $this->assertSame('product-1', $descriptionApi->getProductId());
        $this->assertSame('sku-1', $descriptionApi->getSkuId());
        $this->assertSame('seller-1', $descriptionApi->getSellerId());
        $this->assertInstanceOf(PlatformStore::class, $descriptionApi->getPlatformStore());
        $this->assertSame('a description', $descriptionApi->getDescription());
    }

    public function testConstructorWithHydratedPlatformStoreInstance(): void
    {
        $platformStore = $this->serviceProvider()->create(PlatformStore::class, ['platform' => 'GUBEE', 'store' => 'store-2']);

        $descriptionApi = new DescriptionApi($this->serviceProvider(), null, null, null, null, $platformStore);

        $this->assertSame($platformStore, $descriptionApi->getPlatformStore());
    }

    public function testConstructorWithDefaults(): void
    {
        $descriptionApi = new DescriptionApi($this->serviceProvider());

        $this->assertNull($descriptionApi->getId());
        $this->assertNull($descriptionApi->getProductId());
        $this->assertNull($descriptionApi->getSkuId());
        $this->assertNull($descriptionApi->getSellerId());
        $this->assertNull($descriptionApi->getPlatformStore());
        $this->assertNull($descriptionApi->getDescription());
    }

    public function testSetters(): void
    {
        $descriptionApi = new DescriptionApi($this->serviceProvider());
        $platformStore  = $this->serviceProvider()->create(PlatformStore::class, ['platform' => 'GUBEE', 'store' => 'store-3']);

        $descriptionApi->setId('id-2');
        $descriptionApi->setProductId('product-2');
        $descriptionApi->setSkuId('sku-2');
        $descriptionApi->setSellerId('seller-2');
        $descriptionApi->setPlatformStore($platformStore);
        $descriptionApi->setDescription('desc-2');

        $this->assertSame('id-2', $descriptionApi->getId());
        $this->assertSame('product-2', $descriptionApi->getProductId());
        $this->assertSame('sku-2', $descriptionApi->getSkuId());
        $this->assertSame('seller-2', $descriptionApi->getSellerId());
        $this->assertSame($platformStore, $descriptionApi->getPlatformStore());
        $this->assertSame('desc-2', $descriptionApi->getDescription());
    }
}
