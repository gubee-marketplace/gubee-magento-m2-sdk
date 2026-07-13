<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product;

use Gubee\SDK\Enum\Catalog\Product\OriginEnum;
use Gubee\SDK\Model\Catalog\Product\TaxInformationProduct;
use PHPUnit\Framework\TestCase;

class TaxInformationProductTest extends TestCase
{
    private function build(): TaxInformationProduct
    {
        return new TaxInformationProduct(
            'name-1',
            'skuId-1',
            'sku-1',
            'ncm-1',
            'NONE',
            10.0,
            'desc-1',
            'unit-1',
            'cest-1',
            1.0,
            2.0,
            3.0,
            4.0,
            'cnpj-1',
            'seal-1'
        );
    }

    public function testConstructorCoercesEnum(): void
    {
        $tax = $this->build();

        $this->assertSame('name-1', $tax->getName());
        $this->assertSame('skuId-1', $tax->getSkuId());
        $this->assertSame('sku-1', $tax->getSku());
        $this->assertSame('ncm-1', $tax->getNcm());
        $this->assertEquals(OriginEnum::fromValue('NONE'), $tax->getOrigin());
        $this->assertSame(10.0, $tax->getValue());
        $this->assertSame('desc-1', $tax->getDescription());
        $this->assertSame('unit-1', $tax->getCommercialUnit());
        $this->assertSame('cest-1', $tax->getCest());
        $this->assertSame(1.0, $tax->getIcmsStRetainedBase());
        $this->assertSame(2.0, $tax->getIcmsStRetainedValue());
        $this->assertSame(3.0, $tax->getIcmsStBaseCalculation());
        $this->assertSame(4.0, $tax->getIcmsStRetainedBaseCalculation());
        $this->assertSame('cnpj-1', $tax->getIpiProducerCnpj());
        $this->assertSame('seal-1', $tax->getIpiControlSealCode());
    }

    public function testConstructorAcceptsEnumInstance(): void
    {
        $tax = new TaxInformationProduct(origin: OriginEnum::fromValue('NONE'));

        $this->assertEquals(OriginEnum::fromValue('NONE'), $tax->getOrigin());
    }

    public function testConstructorDefaults(): void
    {
        $tax = new TaxInformationProduct();

        $this->assertNull($tax->getName());
        $this->assertNull($tax->getOrigin());
    }

    public function testSetters(): void
    {
        $tax = $this->build();

        $tax->setName('name-2');
        $tax->setSkuId('skuId-2');
        $tax->setSku('sku-2');
        $tax->setNcm('ncm-2');
        $tax->setOrigin(OriginEnum::fromValue('NONE'));
        $tax->setValue(20.0);
        $tax->setDescription('desc-2');
        $tax->setCommercialUnit('unit-2');
        $tax->setCest('cest-2');
        $tax->setIcmsStRetainedBase(5.0);
        $tax->setIcmsStRetainedValue(6.0);
        $tax->setIcmsStBaseCalculation(7.0);
        $tax->setIcmsStRetainedBaseCalculation(8.0);
        $tax->setIpiProducerCnpj('cnpj-2');
        $tax->setIpiControlSealCode('seal-2');

        $this->assertSame('name-2', $tax->getName());
        $this->assertSame('skuId-2', $tax->getSkuId());
        $this->assertSame('sku-2', $tax->getSku());
        $this->assertSame('ncm-2', $tax->getNcm());
        $this->assertSame(20.0, $tax->getValue());
        $this->assertSame('desc-2', $tax->getDescription());
        $this->assertSame('unit-2', $tax->getCommercialUnit());
        $this->assertSame('cest-2', $tax->getCest());
        $this->assertSame(5.0, $tax->getIcmsStRetainedBase());
        $this->assertSame(6.0, $tax->getIcmsStRetainedValue());
        $this->assertSame(7.0, $tax->getIcmsStBaseCalculation());
        $this->assertSame(8.0, $tax->getIcmsStRetainedBaseCalculation());
        $this->assertSame('cnpj-2', $tax->getIpiProducerCnpj());
        $this->assertSame('seal-2', $tax->getIpiControlSealCode());
    }
}
