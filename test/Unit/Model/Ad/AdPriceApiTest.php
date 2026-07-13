<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Ad;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Enum\Ad\PriceTypeEnum;
use Gubee\SDK\Model\Ad\AdPriceApi;
use PHPUnit\Framework\TestCase;

class AdPriceApiTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $price = new AdPriceApi(
            'seller-1',
            'origin-sku-1',
            'item-1',
            'platform-1',
            'DEFAULT',
            9.9,
            'created-by',
            new DateTime('2024-01-01'),
            new DateTime('2024-02-01')
        );

        $this->assertSame('seller-1', $price->getSellerId());
        $this->assertSame('origin-sku-1', $price->getOriginSkuId());
        $this->assertSame('item-1', $price->getItemId());
        $this->assertSame('platform-1', $price->getPlatform());
        $this->assertEquals(PriceTypeEnum::DEFAULT(), $price->getPriceType());
        $this->assertSame(9.9, $price->getValue());
        $this->assertSame('created-by', $price->getCreatedBy());
        $this->assertInstanceOf(DateTimeInterface::class, $price->getBeginDt());
        $this->assertInstanceOf(DateTimeInterface::class, $price->getEndDt());
    }

    public function testSetters(): void
    {
        $price = new AdPriceApi('seller-1', null, null, null, 'DEFAULT', 1.0);

        $price->setSellerId('seller-2');
        $price->setOriginSkuId('origin-2');
        $price->setItemId('item-2');
        $price->setPlatform('platform-2');
        $price->setPriceType(PriceTypeEnum::PROMOTION());
        $price->setValue(2.0);
        $price->setCreatedBy('created-2');
        $date = new DateTime('2024-03-01');
        $price->setBeginDt($date);
        $price->setEndDt($date);

        $this->assertSame('seller-2', $price->getSellerId());
        $this->assertSame('origin-2', $price->getOriginSkuId());
        $this->assertSame('item-2', $price->getItemId());
        $this->assertSame('platform-2', $price->getPlatform());
        $this->assertEquals(PriceTypeEnum::PROMOTION(), $price->getPriceType());
        $this->assertSame(2.0, $price->getValue());
        $this->assertSame('created-2', $price->getCreatedBy());
        $this->assertSame($date, $price->getBeginDt());
        $this->assertSame($date, $price->getEndDt());
    }

    public function testDefaultsAreNull(): void
    {
        $price = new AdPriceApi('seller-1', null, null, null, 'DEFAULT', 1.0);

        $this->assertNull($price->getOriginSkuId());
        $this->assertNull($price->getItemId());
        $this->assertNull($price->getPlatform());
        $this->assertNull($price->getCreatedBy());
        $this->assertNull($price->getBeginDt());
        $this->assertNull($price->getEndDt());
    }
}
