<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Ad\SearchTypeEnum;
use Gubee\SDK\Enum\Ad\TagsFilterModeEnum;
use Gubee\SDK\Model\Ad\AdAttributeFilterParams;
use Gubee\SDK\Model\Ad\AdSearchParams;
use PHPUnit\Framework\TestCase;

class AdSearchParamsTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesAttributesFromRawArrays(): void
    {
        $params = new AdSearchParams(
            $this->serviceProvider(),
            'sku-1',
            'name-1',
            ['plan-1'],
            ['ACTIVE'],
            'ean-1',
            true,
            ['brand-1'],
            [['attributeName' => 'color', 'attributeValue' => 'red']],
            ['account-1'],
            ['id-1'],
            ['status-1'],
            ['tag-1'],
            'ANY',
            ['cat-1'],
            ['type-1'],
            true,
            ['origin-1'],
            'SKU',
            'store-1',
            '2024-01-01'
        );

        $this->assertSame('sku-1', $params->getSku());
        $this->assertSame('name-1', $params->getName());
        $this->assertSame(['plan-1'], $params->getPlansIds());
        $this->assertSame(['ACTIVE'], $params->getStatus());
        $this->assertSame('ean-1', $params->getEan());
        $this->assertTrue($params->getHasEan());
        $this->assertSame(['brand-1'], $params->getBrands());
        $this->assertContainsOnlyInstancesOf(AdAttributeFilterParams::class, $params->getAttributes());
        $this->assertSame(['account-1'], $params->getAccountIds());
        $this->assertSame(['id-1'], $params->getIds());
        $this->assertSame(['status-1'], $params->getIntegrationStatus());
        $this->assertSame(['tag-1'], $params->getTags());
        $this->assertEquals(TagsFilterModeEnum::ANY(), $params->getTagsFilterMode());
        $this->assertSame(['cat-1'], $params->getCategoryIds());
        $this->assertSame(['type-1'], $params->getTypes());
        $this->assertTrue($params->getHasProduct());
        $this->assertSame(['origin-1'], $params->getOriginSkuIds());
        $this->assertEquals(SearchTypeEnum::SKU(), $params->getSearchType());
        $this->assertSame('store-1', $params->getOfficialStoreId());
        $this->assertSame('2024-01-01', $params->getPausedSince());
    }

    public function testPassesThroughAlreadyHydratedAttribute(): void
    {
        $attribute = new AdAttributeFilterParams('color', 'red');

        $params = new AdSearchParams($this->serviceProvider(), attributes: [$attribute]);

        $this->assertSame($attribute, $params->getAttributes()[0]);
    }

    public function testSetters(): void
    {
        $params = new AdSearchParams($this->serviceProvider());

        $params->setSku('sku-2');
        $params->setName('name-2');
        $params->setPlansIds(['plan-2']);
        $params->setStatus(['INACTIVE']);
        $params->setEan('ean-2');
        $params->setHasEan(false);
        $params->setBrands(['brand-2']);
        $attribute = new AdAttributeFilterParams('size', 'M');
        $params->setAttributes([$attribute]);
        $params->setAccountIds(['account-2']);
        $params->setIds(['id-2']);
        $params->setIntegrationStatus(['status-2']);
        $params->setTags(['tag-2']);
        $params->setTagsFilterMode(TagsFilterModeEnum::ALL());
        $params->setCategoryIds(['cat-2']);
        $params->setTypes(['type-2']);
        $params->setHasProduct(false);
        $params->setOriginSkuIds(['origin-2']);
        $params->setSearchType(SearchTypeEnum::TITLE());
        $params->setOfficialStoreId('store-2');
        $params->setPausedSince('2024-02-01');

        $this->assertSame('sku-2', $params->getSku());
        $this->assertSame('name-2', $params->getName());
        $this->assertSame(['plan-2'], $params->getPlansIds());
        $this->assertSame(['INACTIVE'], $params->getStatus());
        $this->assertSame('ean-2', $params->getEan());
        $this->assertFalse($params->getHasEan());
        $this->assertSame(['brand-2'], $params->getBrands());
        $this->assertSame([$attribute], $params->getAttributes());
        $this->assertSame(['account-2'], $params->getAccountIds());
        $this->assertSame(['id-2'], $params->getIds());
        $this->assertSame(['status-2'], $params->getIntegrationStatus());
        $this->assertSame(['tag-2'], $params->getTags());
        $this->assertEquals(TagsFilterModeEnum::ALL(), $params->getTagsFilterMode());
        $this->assertSame(['cat-2'], $params->getCategoryIds());
        $this->assertSame(['type-2'], $params->getTypes());
        $this->assertFalse($params->getHasProduct());
        $this->assertSame(['origin-2'], $params->getOriginSkuIds());
        $this->assertEquals(SearchTypeEnum::TITLE(), $params->getSearchType());
        $this->assertSame('store-2', $params->getOfficialStoreId());
        $this->assertSame('2024-02-01', $params->getPausedSince());
    }

    public function testDefaultsAreNull(): void
    {
        $params = new AdSearchParams($this->serviceProvider());

        $this->assertNull($params->getSku());
        $this->assertNull($params->getName());
        $this->assertNull($params->getPlansIds());
        $this->assertNull($params->getStatus());
        $this->assertNull($params->getEan());
        $this->assertNull($params->getHasEan());
        $this->assertNull($params->getBrands());
        $this->assertNull($params->getAttributes());
        $this->assertNull($params->getAccountIds());
        $this->assertNull($params->getIds());
        $this->assertNull($params->getIntegrationStatus());
        $this->assertNull($params->getTags());
        $this->assertNull($params->getTagsFilterMode());
        $this->assertNull($params->getCategoryIds());
        $this->assertNull($params->getTypes());
        $this->assertNull($params->getHasProduct());
        $this->assertNull($params->getOriginSkuIds());
        $this->assertNull($params->getSearchType());
        $this->assertNull($params->getOfficialStoreId());
        $this->assertNull($params->getPausedSince());
    }
}
