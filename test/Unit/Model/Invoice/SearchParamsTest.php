<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Enum\Sales\Order\AmbientEnum;
use Gubee\SDK\Model\Invoice\SearchParams;
use PHPUnit\Framework\TestCase;

class SearchParamsTest extends TestCase
{
    public function testConstructorSetsAllFieldsWithStringDatesAndAmbient(): void
    {
        $model = new SearchParams(
            'NFE',
            'store-1',
            ['ISSUED'],
            ['order-1'],
            new DateTime('2026-01-01'),
            new DateTime('2026-02-01'),
            ['DELIVERED'],
            'PRD',
            'south',
            ['key-1'],
            [1, 2],
            [3, 4]
        );

        $this->assertSame('NFE', $model->getType());
        $this->assertSame('store-1', $model->getStoreId());
        $this->assertSame(['ISSUED'], $model->getStatus());
        $this->assertSame(['order-1'], $model->getOrderIds());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getStartDt());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getEndDt());
        $this->assertSame(['DELIVERED'], $model->getOrderStatus());
        $this->assertInstanceOf(AmbientEnum::class, $model->getAmbient());
        $this->assertSame('PRD', (string) $model->getAmbient());
        $this->assertSame('south', $model->getRegion());
        $this->assertSame(['key-1'], $model->getKeys());
        $this->assertSame([1, 2], $model->getNumbers());
        $this->assertSame([3, 4], $model->getSeries());
    }

    public function testConstructorParsesStringStartAndEndDt(): void
    {
        $model = new SearchParams(startDt: '2026-04-04', endDt: '2026-05-05');

        $this->assertInstanceOf(DateTimeInterface::class, $model->getStartDt());
        $this->assertSame('2026-04-04', $model->getStartDt()->format('Y-m-d'));
        $this->assertInstanceOf(DateTimeInterface::class, $model->getEndDt());
        $this->assertSame('2026-05-05', $model->getEndDt()->format('Y-m-d'));
    }

    public function testConstructorAcceptsAmbientEnumInstance(): void
    {
        $model = new SearchParams(ambient: AmbientEnum::HML());

        $this->assertSame('HML', (string) $model->getAmbient());
    }

    public function testConstructorWithNullValues(): void
    {
        $model = new SearchParams();

        $this->assertNull($model->getType());
        $this->assertNull($model->getStoreId());
        $this->assertNull($model->getStatus());
        $this->assertNull($model->getOrderIds());
        $this->assertNull($model->getStartDt());
        $this->assertNull($model->getEndDt());
        $this->assertNull($model->getOrderStatus());
        $this->assertNull($model->getAmbient());
        $this->assertNull($model->getRegion());
        $this->assertNull($model->getKeys());
        $this->assertNull($model->getNumbers());
        $this->assertNull($model->getSeries());
    }

    public function testSettersAndGetters(): void
    {
        $model   = new SearchParams();
        $startDt = new DateTime('2028-01-01');
        $endDt   = new DateTime('2028-02-01');

        $model->setType('NFSE');
        $model->setStoreId('store-2');
        $model->setStatus(['CANCELLED']);
        $model->setOrderIds(['order-2']);
        $model->setStartDt($startDt);
        $model->setEndDt($endDt);
        $model->setOrderStatus(['SHIPPED']);
        $model->setAmbient(AmbientEnum::PRD());
        $model->setRegion('north');
        $model->setKeys(['key-2']);
        $model->setNumbers([5, 6]);
        $model->setSeries([7, 8]);

        $this->assertSame('NFSE', $model->getType());
        $this->assertSame('store-2', $model->getStoreId());
        $this->assertSame(['CANCELLED'], $model->getStatus());
        $this->assertSame(['order-2'], $model->getOrderIds());
        $this->assertSame($startDt, $model->getStartDt());
        $this->assertSame($endDt, $model->getEndDt());
        $this->assertSame(['SHIPPED'], $model->getOrderStatus());
        $this->assertSame('PRD', (string) $model->getAmbient());
        $this->assertSame('north', $model->getRegion());
        $this->assertSame(['key-2'], $model->getKeys());
        $this->assertSame([5, 6], $model->getNumbers());
        $this->assertSame([7, 8], $model->getSeries());
    }
}
