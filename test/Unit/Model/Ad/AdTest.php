<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Ad\ConditionEnum;
use Gubee\SDK\Enum\Ad\OriginEnum;
use Gubee\SDK\Enum\Ad\PlatformEnum;
use Gubee\SDK\Enum\Ad\StatusEnum;
use Gubee\SDK\Enum\Ad\TypeEnum;
use Gubee\SDK\Model\Ad\Ad;
use Gubee\SDK\Model\Ad\AdPriceApi;
use Gubee\SDK\Model\Ad\AdShippingMode;
use Gubee\SDK\Model\Ad\AdStockApi;
use Gubee\SDK\Model\Ad\AssociateAd;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;
use Gubee\SDK\Model\Catalog\Product\Attribute\OriginCountry;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\Image;
use Gubee\SDK\Model\Common\Specification;
use Gubee\SDK\Model\Video\Video;
use PHPUnit\Framework\TestCase;

use function array_map;

class AdTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function dimensionData(): array
    {
        return [
            'depth'  => ['type' => 'CENTIMETER', 'value' => 1.0],
            'height' => ['type' => 'CENTIMETER', 'value' => 1.0],
            'weight' => ['type' => 'KILOGRAM', 'value' => 1.0],
            'width'  => ['type' => 'CENTIMETER', 'value' => 1.0],
        ];
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function build(array $overrides = []): Ad
    {
        $data = $overrides + [
            'id'                   => 'id-1',
            'sellerId'             => 'seller-1',
            'sku'                  => 'sku-1',
            'marketplaceId'        => 'marketplace-1',
            'originSkuId'          => 'origin-sku-1',
            'originSku'            => 'origin-sku-name',
            'mainAdId'             => 'main-ad-1',
            'externalLink'         => 'https://link',
            'platform'             => 'HUBEE',
            'accountId'            => 'account-1',
            'type'                 => 'SIMPLE',
            'planId'               => 'plan-1',
            'categoryId'           => 'category-1',
            'associateAds'         => [['id' => 'assoc-1', 'qty' => null, 'type' => 'VARIANT']],
            'name'                 => 'Ad Name',
            'description'          => 'Ad Description',
            'brand'                => 'Brand',
            'ean'                  => 'ean-1',
            'nbm'                  => 'nbm-1',
            'dimension'            => $this->dimensionData(),
            'warrantyTime'         => 30,
            'handlingTime'         => 1,
            'warrantyType'         => 'manufacturer',
            'condition'            => 'NEW',
            'origin'               => 'NATIONAL',
            'originCountry'        => ['name' => 'Brazil', 'alpha2Code' => 'BR', 'alpha3Code' => 'BRA'],
            'images'               => [['main' => true, 'order' => 0, 'url' => 'https://img']],
            'videos'               => [],
            'variantSpecification' => ['color'],
            'specifications'       => [['id' => 'spec-1', 'name' => 'spec', 'values' => ['a']]],
            'defaultAttributes'    => ['attr' => 'value'],
            'status'               => 'ACTIVE',
            'defaultPrice'         => [
                'sellerId'    => 'seller-1',
                'originSkuId' => 'origin-sku-1',
                'itemId'      => 'item-1',
                'platform'    => 'HUBEE',
                'priceType'   => 'DEFAULT',
                'value'       => 10.0,
            ],
            'promotionPrices'      => [],
            'stocks'               => [
                [
                    'id'           => 'stock-1',
                    'sellerId'     => 'seller-1',
                    'itemId'       => 'item-1',
                    'warehouseId'  => 'wh-1',
                    'qty'          => 1,
                    'stockBooking' => 0,
                    'priority'     => 1,
                ],
            ],
            'shippingModes'        => [['id' => 'mode-1', 'name' => null, 'options' => []]],
            'updateOptions'        => ['name'],
            'createdBy'            => 'creator-1',
            'beginDt'              => new DateTime('2024-01-01'),
            'endDt'                => new DateTime('2024-06-01'),
            'createdDt'            => new DateTime('2024-01-01'),
            'lastModifiedDt'       => new DateTime('2024-01-02'),
            'variant'              => false,
            'variation'            => false,
            'tags'                 => ['tag-1'],
            'parentId'             => 'parent-1',
            'warehouseIds'         => ['wh-1'],
            'channels'             => ['channel-1'],
            'officialStoreId'      => 'store-1',
            'warehouseId'          => 'wh-1',
            'prices'               => [
                [
                    'sellerId'    => 'seller-1',
                    'originSkuId' => 'origin-sku-1',
                    'itemId'      => 'item-1',
                    'platform'    => 'HUBEE',
                    'priceType'   => 'DEFAULT',
                    'value'       => 10.0,
                ],
            ],
            'isFulfillment'        => false,
            'shippingMode'         => ['id' => 'mode-1', 'name' => null, 'options' => []],
            'isVariantType'        => false,
        ];

        return new Ad(
            $this->serviceProvider(),
            $data['id'],
            $data['sellerId'],
            $data['sku'],
            $data['marketplaceId'],
            $data['originSkuId'],
            $data['originSku'],
            $data['mainAdId'],
            $data['externalLink'],
            $data['platform'],
            $data['accountId'],
            $data['type'],
            $data['planId'],
            $data['categoryId'],
            $data['associateAds'],
            $data['name'],
            $data['description'],
            $data['brand'],
            $data['ean'],
            $data['nbm'],
            $data['dimension'],
            $data['warrantyTime'],
            $data['handlingTime'],
            $data['warrantyType'],
            $data['condition'],
            $data['origin'],
            $data['originCountry'],
            $data['images'],
            $data['videos'],
            $data['variantSpecification'],
            $data['specifications'],
            $data['defaultAttributes'],
            $data['status'],
            $data['defaultPrice'],
            $data['promotionPrices'],
            $data['stocks'],
            $data['shippingModes'],
            $data['updateOptions'],
            $data['createdBy'],
            $data['beginDt'],
            $data['endDt'],
            $data['createdDt'],
            $data['lastModifiedDt'],
            $data['variant'],
            $data['variation'],
            $data['tags'],
            $data['parentId'],
            $data['warehouseIds'],
            $data['channels'],
            $data['officialStoreId'],
            $data['warehouseId'],
            $data['prices'],
            $data['isFulfillment'],
            $data['shippingMode'],
            $data['isVariantType']
        );
    }

    public function testHydratesNestedFieldsFromRawArrays(): void
    {
        $ad = $this->build();

        $this->assertSame('id-1', $ad->getId());
        $this->assertSame('seller-1', $ad->getSellerId());
        $this->assertSame('sku-1', $ad->getSku());
        $this->assertSame('marketplace-1', $ad->getMarketplaceId());
        $this->assertSame('origin-sku-1', $ad->getOriginSkuId());
        $this->assertSame('origin-sku-name', $ad->getOriginSku());
        $this->assertSame('main-ad-1', $ad->getMainAdId());
        $this->assertSame('https://link', $ad->getExternalLink());
        $this->assertEquals(PlatformEnum::HUBEE(), $ad->getPlatform());
        $this->assertSame('account-1', $ad->getAccountId());
        $this->assertEquals(TypeEnum::SIMPLE(), $ad->getType());
        $this->assertSame('plan-1', $ad->getPlanId());
        $this->assertSame('category-1', $ad->getCategoryId());
        $this->assertContainsOnlyInstancesOf(AssociateAd::class, $ad->getAssociateAds());
        $this->assertSame('Ad Name', $ad->getName());
        $this->assertSame('Ad Description', $ad->getDescription());
        $this->assertSame('Brand', $ad->getBrand());
        $this->assertSame('ean-1', $ad->getEan());
        $this->assertSame('nbm-1', $ad->getNbm());
        $this->assertInstanceOf(Dimension::class, $ad->getDimension());
        $this->assertSame(30, $ad->getWarrantyTime());
        $this->assertSame(1, $ad->getHandlingTime());
        $this->assertSame('manufacturer', $ad->getWarrantyType());
        $this->assertEquals(ConditionEnum::NEW(), $ad->getCondition());
        $this->assertEquals(OriginEnum::NATIONAL(), $ad->getOrigin());
        $this->assertInstanceOf(OriginCountry::class, $ad->getOriginCountry());
        $this->assertContainsOnlyInstancesOf(Image::class, $ad->getImages());
        $this->assertSame([], $ad->getVideos());
        $this->assertSame(['color'], $ad->getVariantSpecification());
        $this->assertContainsOnlyInstancesOf(Specification::class, $ad->getSpecifications());
        $this->assertSame(['attr' => 'value'], $ad->getDefaultAttributes());
        $this->assertEquals(StatusEnum::ACTIVE(), $ad->getStatus());
        $this->assertInstanceOf(AdPriceApi::class, $ad->getDefaultPrice());
        $this->assertSame([], $ad->getPromotionPrices());
        $this->assertContainsOnlyInstancesOf(AdStockApi::class, $ad->getStocks());
        $this->assertContainsOnlyInstancesOf(AdShippingMode::class, $ad->getShippingModes());
        $this->assertSame(['name'], $ad->getUpdateOptions());
        $this->assertSame('creator-1', $ad->getCreatedBy());
        $this->assertInstanceOf(DateTimeInterface::class, $ad->getBeginDt());
        $this->assertInstanceOf(DateTimeInterface::class, $ad->getEndDt());
        $this->assertInstanceOf(DateTimeInterface::class, $ad->getCreatedDt());
        $this->assertInstanceOf(DateTimeInterface::class, $ad->getLastModifiedDt());
        $this->assertFalse($ad->getVariant());
        $this->assertFalse($ad->getVariation());
        $this->assertSame(['tag-1'], $ad->getTags());
        $this->assertSame('parent-1', $ad->getParentId());
        $this->assertSame(['wh-1'], $ad->getWarehouseIds());
        $this->assertSame(['channel-1'], $ad->getChannels());
        $this->assertSame('store-1', $ad->getOfficialStoreId());
        $this->assertSame('wh-1', $ad->getWarehouseId());
        $this->assertContainsOnlyInstancesOf(AdPriceApi::class, $ad->getPrices());
        $this->assertFalse($ad->getIsFulfillment());
        $this->assertInstanceOf(AdShippingMode::class, $ad->getShippingMode());
        $this->assertFalse($ad->getIsVariantType());
    }

    public function testPassesThroughAlreadyHydratedNestedInstances(): void
    {
        $dimension    = new Dimension(
            $this->serviceProvider(),
            ...array_map(fn ($k) => $this->dimensionData()[$k], ['depth', 'height', 'weight', 'width'])
        );
        $shippingMode = new AdShippingMode($this->serviceProvider(), 'mode-1', null, []);

        $ad = $this->build(['dimension' => $dimension, 'shippingMode' => $shippingMode]);

        $this->assertSame($dimension, $ad->getDimension());
        $this->assertSame($shippingMode, $ad->getShippingMode());
    }

    public function testSetters(): void
    {
        $ad = $this->build();

        $ad->setId('id-2');
        $ad->setSellerId('seller-2');
        $ad->setSku('sku-2');
        $ad->setStatus(StatusEnum::PAUSED());

        $this->assertSame('id-2', $ad->getId());
        $this->assertSame('seller-2', $ad->getSellerId());
        $this->assertSame('sku-2', $ad->getSku());
        $this->assertEquals(StatusEnum::PAUSED(), $ad->getStatus());
    }

    public function testHydratesVideosAndPromotionPricesFromRawArrays(): void
    {
        $ad = $this->build([
            'videos'          => [
                [
                    'id'            => 'video-1',
                    'videoId'       => 'video-1',
                    'sellerId'      => 'seller-1',
                    'status'        => 'READY',
                    'failureReason' => null,
                    'cdnUrl'        => null,
                    'posterUrl'     => null,
                    'durationMs'    => null,
                    'width'         => null,
                    'height'        => null,
                    'sizeBytes'     => null,
                    'main'          => true,
                    'name'          => null,
                    'order'         => 1,
                    'ownerType'     => null,
                    'ownerId'       => null,
                    'processedAt'   => null,
                    'url'           => null,
                ],
            ],
            'promotionPrices' => [
                [
                    'sellerId'    => 'seller-1',
                    'originSkuId' => 'origin-sku-1',
                    'itemId'      => 'item-2',
                    'platform'    => 'HUBEE',
                    'priceType'   => 'PROMOTION',
                    'value'       => 8.5,
                ],
            ],
        ]);

        $this->assertContainsOnlyInstancesOf(Video::class, $ad->getVideos());
        $this->assertContainsOnlyInstancesOf(AdPriceApi::class, $ad->getPromotionPrices());
        $this->assertSame(8.5, $ad->getPromotionPrices()[0]->getValue());
    }
}
