<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Catalog\Product\AttributeFilterParams;
use Gubee\SDK\Model\Catalog\Product\SearchParamsApi;
use PHPUnit\Framework\TestCase;

class SearchParamsApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function build(array $overrides = []): SearchParamsApi
    {
        return $this->serviceProvider()->create(
            SearchParamsApi::class,
            $overrides + [
                'text'           => 'text-1',
                'status'         => ['ACTIVE'],
                'noStatus'       => false,
                'lookUpHistory'  => true,
                'platforms'      => ['plat-1'],
                'sku'            => 'sku-1',
                'ean'            => 'ean-1',
                'hasEan'         => true,
                'hasCategories'  => true,
                'name'           => 'name-1',
                'stockQty'       => 5.0,
                'stockCondition' => 'cond-1',
                'categories'     => ['cat-1'],
                'errorsType'     => ['err-1'],
                'productStatus'  => ['pstatus-1'],
                'brandIds'       => ['brand-1'],
                'minPrice'       => 1.0,
                'maxPrice'       => 100.0,
                'mktPrice'       => 'mkt-1',
                'attributes'     => [['attributeId' => 'attr-1', 'attributeValue' => 'val-1']],
                'ncms'           => ['ncm-1'],
                'hasNcm'         => true,
                'types'          => ['type-1'],
            ]
        );
    }

    public function testHydratesAttributesFromRawArrays(): void
    {
        $params = $this->build();

        $this->assertSame('text-1', $params->getText());
        $this->assertSame(['ACTIVE'], $params->getStatus());
        $this->assertFalse($params->getNoStatus());
        $this->assertTrue($params->getLookUpHistory());
        $this->assertSame(['plat-1'], $params->getPlatforms());
        $this->assertSame('sku-1', $params->getSku());
        $this->assertSame('ean-1', $params->getEan());
        $this->assertTrue($params->getHasEan());
        $this->assertTrue($params->getHasCategories());
        $this->assertSame('name-1', $params->getName());
        $this->assertSame(5.0, $params->getStockQty());
        $this->assertSame('cond-1', $params->getStockCondition());
        $this->assertSame(['cat-1'], $params->getCategories());
        $this->assertSame(['err-1'], $params->getErrorsType());
        $this->assertSame(['pstatus-1'], $params->getProductStatus());
        $this->assertSame(['brand-1'], $params->getBrandIds());
        $this->assertSame(1.0, $params->getMinPrice());
        $this->assertSame(100.0, $params->getMaxPrice());
        $this->assertSame('mkt-1', $params->getMktPrice());
        $this->assertContainsOnlyInstancesOf(AttributeFilterParams::class, $params->getAttributes());
        $this->assertSame(['ncm-1'], $params->getNcms());
        $this->assertTrue($params->getHasNcm());
        $this->assertSame(['type-1'], $params->getTypes());
    }

    public function testPassesThroughAlreadyHydratedAttributes(): void
    {
        $attribute = $this->serviceProvider()->create(AttributeFilterParams::class, ['attributeId' => 'attr-2']);

        $params = $this->build(['attributes' => [$attribute]]);

        $this->assertSame($attribute, $params->getAttributes()[0]);
    }

    public function testSetters(): void
    {
        $params = $this->build();

        $params->setText('text-2');
        $params->setStatus(['INACTIVE']);
        $params->setNoStatus(true);
        $params->setLookUpHistory(false);
        $params->setPlatforms(['plat-2']);
        $params->setSku('sku-2');
        $params->setEan('ean-2');
        $params->setHasEan(false);
        $params->setHasCategories(false);
        $params->setName('name-2');
        $params->setStockQty(10.0);
        $params->setStockCondition('cond-2');
        $params->setCategories(['cat-2']);
        $params->setErrorsType(['err-2']);
        $params->setProductStatus(['pstatus-2']);
        $params->setBrandIds(['brand-2']);
        $params->setMinPrice(2.0);
        $params->setMaxPrice(200.0);
        $params->setMktPrice('mkt-2');
        $params->setAttributes([]);
        $params->setNcms(['ncm-2']);
        $params->setHasNcm(false);
        $params->setTypes(['type-2']);

        $this->assertSame('text-2', $params->getText());
        $this->assertSame(['INACTIVE'], $params->getStatus());
        $this->assertTrue($params->getNoStatus());
        $this->assertFalse($params->getLookUpHistory());
        $this->assertSame(['plat-2'], $params->getPlatforms());
        $this->assertSame('sku-2', $params->getSku());
        $this->assertSame('ean-2', $params->getEan());
        $this->assertFalse($params->getHasEan());
        $this->assertFalse($params->getHasCategories());
        $this->assertSame('name-2', $params->getName());
        $this->assertSame(10.0, $params->getStockQty());
        $this->assertSame('cond-2', $params->getStockCondition());
        $this->assertSame(['cat-2'], $params->getCategories());
        $this->assertSame(['err-2'], $params->getErrorsType());
        $this->assertSame(['pstatus-2'], $params->getProductStatus());
        $this->assertSame(['brand-2'], $params->getBrandIds());
        $this->assertSame(2.0, $params->getMinPrice());
        $this->assertSame(200.0, $params->getMaxPrice());
        $this->assertSame('mkt-2', $params->getMktPrice());
        $this->assertSame([], $params->getAttributes());
        $this->assertSame(['ncm-2'], $params->getNcms());
        $this->assertFalse($params->getHasNcm());
        $this->assertSame(['type-2'], $params->getTypes());
    }
}
