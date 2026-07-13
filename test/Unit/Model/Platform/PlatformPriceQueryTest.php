<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Enum\Ad\PriceTypeEnum;
use Gubee\SDK\Enum\Catalog\ProductV2\PriceCalculationTypeEnum;
use Gubee\SDK\Model\Platform\PlatformPriceQuery;
use PHPUnit\Framework\TestCase;

use function array_replace;

class PlatformPriceQueryTest extends TestCase
{
    private function buildModel(array $overrides = []): PlatformPriceQuery
    {
        $defaults = [
            'id'                   => 'id-1',
            'platform'             => 'platform-1',
            'store'                => 'store-1',
            'promotionId'          => 'promo-1',
            'value'                => 10.0,
            'beginDt'              => '2026-01-01',
            'endDt'                => '2026-02-01',
            'priceType'            => 'DEFAULT',
            'priceCalculationType' => 'BY_VALUE',
            'importedByApi'        => true,
        ];
        $args     = array_replace($defaults, $overrides);

        return new PlatformPriceQuery(
            $args['id'],
            $args['platform'],
            $args['store'],
            $args['promotionId'],
            $args['value'],
            $args['beginDt'],
            $args['endDt'],
            $args['priceType'],
            $args['priceCalculationType'],
            $args['importedByApi']
        );
    }

    public function testConstructorParsesStringDatesAndEnums(): void
    {
        $model = $this->buildModel();

        $this->assertSame('id-1', $model->getId());
        $this->assertSame('platform-1', $model->getPlatform());
        $this->assertSame('store-1', $model->getStore());
        $this->assertSame('promo-1', $model->getPromotionId());
        $this->assertSame(10.0, $model->getValue());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getBeginDt());
        $this->assertSame('2026-01-01', $model->getBeginDt()->format('Y-m-d'));
        $this->assertSame('2026-02-01', $model->getEndDt()->format('Y-m-d'));
        $this->assertInstanceOf(PriceTypeEnum::class, $model->getPriceType());
        $this->assertInstanceOf(PriceCalculationTypeEnum::class, $model->getPriceCalculationType());
        $this->assertTrue($model->getImportedByApi());
    }

    public function testConstructorAcceptsNullOptionalFields(): void
    {
        $model = $this->buildModel([
            'id'                   => null,
            'platform'             => null,
            'store'                => null,
            'promotionId'          => null,
            'beginDt'              => null,
            'endDt'                => null,
            'priceCalculationType' => null,
        ]);

        $this->assertNull($model->getId());
        $this->assertNull($model->getPlatform());
        $this->assertNull($model->getStore());
        $this->assertNull($model->getPromotionId());
        $this->assertNull($model->getBeginDt());
        $this->assertNull($model->getEndDt());
        $this->assertNull($model->getPriceCalculationType());
    }

    public function testConstructorAcceptsDateTimeInterfaceAndEnumInstances(): void
    {
        $begin = new DateTime('2026-03-01');
        $end   = new DateTime('2026-04-01');

        $model = $this->buildModel([
            'beginDt'              => $begin,
            'endDt'                => $end,
            'priceType'            => PriceTypeEnum::fromValue('PROMOTION'),
            'priceCalculationType' => PriceCalculationTypeEnum::fromValue('BY_KIT_ITEMS_VALUE'),
        ]);

        $this->assertSame($begin, $model->getBeginDt());
        $this->assertSame($end, $model->getEndDt());
        $this->assertSame('PROMOTION', (string) $model->getPriceType());
        $this->assertSame('BY_KIT_ITEMS_VALUE', (string) $model->getPriceCalculationType());
    }

    public function testSetters(): void
    {
        $model = $this->buildModel();
        $begin = new DateTime('2026-05-01');
        $end   = new DateTime('2026-06-01');

        $model->setId('id-2');
        $model->setPlatform('platform-2');
        $model->setStore('store-2');
        $model->setPromotionId('promo-2');
        $model->setValue(20.0);
        $model->setBeginDt($begin);
        $model->setEndDt($end);
        $model->setPriceType(PriceTypeEnum::fromValue('PROMOTION'));
        $model->setPriceCalculationType(PriceCalculationTypeEnum::fromValue('BY_VALUE'));
        $model->setImportedByApi(false);

        $this->assertSame('id-2', $model->getId());
        $this->assertSame('platform-2', $model->getPlatform());
        $this->assertSame('store-2', $model->getStore());
        $this->assertSame('promo-2', $model->getPromotionId());
        $this->assertSame(20.0, $model->getValue());
        $this->assertSame($begin, $model->getBeginDt());
        $this->assertSame($end, $model->getEndDt());
        $this->assertSame('PROMOTION', (string) $model->getPriceType());
        $this->assertSame('BY_VALUE', (string) $model->getPriceCalculationType());
        $this->assertFalse($model->getImportedByApi());
    }
}
