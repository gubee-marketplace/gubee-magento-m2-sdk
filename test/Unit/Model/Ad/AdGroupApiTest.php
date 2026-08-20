<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Ad\Ad;
use Gubee\SDK\Model\Ad\AdGroupApi;
use PHPUnit\Framework\TestCase;

class AdGroupApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function adData(array $overrides = []): array
    {
        return $overrides + [
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
            'associateAds'         => [],
            'name'                 => 'Ad Name',
            'description'          => 'Ad Description',
            'brand'                => 'Brand',
            'ean'                  => 'ean-1',
            'nbm'                  => 'nbm-1',
            'dimension'            => null,
            'warrantyTime'         => null,
            'handlingTime'         => null,
            'warrantyType'         => null,
            'condition'            => 'NEW',
            'origin'               => 'NATIONAL',
            'originCountry'        => null,
            'images'               => [],
            'videos'               => [],
            'variantSpecification' => [],
            'specifications'       => [],
            'defaultAttributes'    => null,
            'status'               => 'ACTIVE',
            'defaultPrice'         => null,
            'promotionPrices'      => [],
            'stocks'               => [],
            'shippingModes'        => null,
            'updateOptions'        => [],
            'createdBy'            => null,
            'beginDt'              => null,
            'endDt'                => null,
            'createdDt'            => null,
            'lastModifiedDt'       => null,
            'variant'              => false,
            'variation'            => false,
            'tags'                 => null,
            'parentId'             => null,
            'warehouseIds'         => null,
            'channels'             => null,
            'officialStoreId'      => null,
            'warehouseId'          => null,
            'prices'               => [],
            'isFulfillment'        => false,
            'shippingMode'         => null,
            'isVariantType'        => false,
        ];
    }

    public function testHydratesArraysAndSetters(): void
    {
        $group = new AdGroupApi(
            $this->serviceProvider(),
            $this->adData(),
            [$this->adData(['id' => 'id-2', 'sku' => 'sku-2'])]
        );

        $this->assertInstanceOf(Ad::class, $group->getAd());
        $this->assertContainsOnlyInstancesOf(Ad::class, $group->getAssociateAds());

        $ad        = $this->serviceProvider()->create(Ad::class, $this->adData(['id' => 'id-3', 'sku' => 'sku-3']));
        $associate = $this->serviceProvider()->create(Ad::class, $this->adData(['id' => 'id-4', 'sku' => 'sku-4']));

        $group->setAd($ad)->setAssociateAds([$associate]);

        $this->assertSame($ad, $group->getAd());
        $this->assertSame([$associate], $group->getAssociateAds());
    }
}
