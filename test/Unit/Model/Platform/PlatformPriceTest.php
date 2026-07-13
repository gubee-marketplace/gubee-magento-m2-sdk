<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Enum\Ad\PriceTypeEnum;
use Gubee\SDK\Enum\Platform\StatusEnum;
use Gubee\SDK\Model\Platform\PlatformPrice;
use PHPUnit\Framework\TestCase;

class PlatformPriceTest extends TestCase
{
    private function buildPrice(): PlatformPrice
    {
        return new PlatformPrice(
            'id-1',
            'platform-1',
            'store-1',
            'promotion-1',
            9.99,
            '2026-01-01T00:00:00.000',
            '2026-02-01T00:00:00.000',
            'DEFAULT',
            'ACTIVE'
        );
    }

    public function testConstructorWithAllFieldsPopulated(): void
    {
        $price = $this->buildPrice();

        $this->assertSame('id-1', $price->getId());
        $this->assertSame('platform-1', $price->getPlatform());
        $this->assertSame('store-1', $price->getStore());
        $this->assertSame('promotion-1', $price->getPromotionId());
        $this->assertSame(9.99, $price->getValue());
        $this->assertInstanceOf(DateTimeInterface::class, $price->getBeginDt());
        $this->assertSame('2026-01-01', $price->getBeginDt()->format('Y-m-d'));
        $this->assertInstanceOf(DateTimeInterface::class, $price->getEndDt());
        $this->assertSame('2026-02-01', $price->getEndDt()->format('Y-m-d'));
        $this->assertInstanceOf(PriceTypeEnum::class, $price->getPriceType());
        $this->assertSame('DEFAULT', (string) $price->getPriceType());
        $this->assertInstanceOf(StatusEnum::class, $price->getStatus());
        $this->assertSame('ACTIVE', (string) $price->getStatus());
    }

    public function testConstructorAcceptsEnumInstances(): void
    {
        $begin = new DateTime('2026-03-01');
        $end   = new DateTime('2026-04-01');

        $price = new PlatformPrice(
            null,
            null,
            null,
            null,
            1.5,
            $begin,
            $end,
            PriceTypeEnum::PROMOTION(),
            StatusEnum::INACTIVE()
        );

        $this->assertSame($begin, $price->getBeginDt());
        $this->assertSame($end, $price->getEndDt());
        $this->assertSame('PROMOTION', (string) $price->getPriceType());
        $this->assertSame('INACTIVE', (string) $price->getStatus());
    }

    public function testConstructorDefaultsToNullForOptionalFields(): void
    {
        $price = new PlatformPrice(
            null,
            null,
            null,
            null,
            0.0,
            null,
            null,
            'DEFAULT',
            'ACTIVE'
        );

        $this->assertNull($price->getId());
        $this->assertNull($price->getPlatform());
        $this->assertNull($price->getStore());
        $this->assertNull($price->getPromotionId());
        $this->assertNull($price->getBeginDt());
        $this->assertNull($price->getEndDt());
    }

    public function testSetters(): void
    {
        $price = $this->buildPrice();

        $price->setId('id-2');
        $price->setPlatform('platform-2');
        $price->setStore('store-2');
        $price->setPromotionId('promotion-2');
        $price->setValue(5.5);
        $begin = new DateTime('2027-01-01');
        $end   = new DateTime('2027-02-01');
        $price->setBeginDt($begin);
        $price->setEndDt($end);
        $price->setPriceType(PriceTypeEnum::PROMOTION());
        $price->setStatus(StatusEnum::INACTIVE());

        $this->assertSame('id-2', $price->getId());
        $this->assertSame('platform-2', $price->getPlatform());
        $this->assertSame('store-2', $price->getStore());
        $this->assertSame('promotion-2', $price->getPromotionId());
        $this->assertSame(5.5, $price->getValue());
        $this->assertSame($begin, $price->getBeginDt());
        $this->assertSame($end, $price->getEndDt());
        $this->assertSame('PROMOTION', (string) $price->getPriceType());
        $this->assertSame('INACTIVE', (string) $price->getStatus());
    }
}
