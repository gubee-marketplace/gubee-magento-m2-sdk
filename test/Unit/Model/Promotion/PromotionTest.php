<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Promotion;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Platform\DomainTypeEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\ValidityPeriod;
use Gubee\SDK\Model\Promotion\Promotion;
use Gubee\SDK\Model\Promotion\PromotionMode;
use Gubee\SDK\Model\Promotion\PromotionStatus;
use PHPUnit\Framework\TestCase;

class PromotionTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildModel(array $overrides = []): Promotion
    {
        return $this->serviceProvider()->create(
            Promotion::class,
            $overrides + [
                'id'              => 'promo-1',
                'name'            => 'Promotion One',
                'sellerId'        => 'seller-1',
                'status'          => ['status' => 'ACTIVE'],
                'description'     => 'desc',
                'period'          => ['beginDt' => '2026-01-01T00:00:00.000', 'endDt' => '2026-02-01T00:00:00.000'],
                'priority'        => 1,
                'modes'           => [['mode' => 'PERCENTUAL', 'value' => 10.0]],
                'deleted'         => false,
                'related'         => true,
                'domainType'      => 'PRODUCT',
                'startOffsetDt'   => '2026-01-01',
                'endOffsetDt'     => '2026-02-01',
                'useVariantRules' => true,
                'platform'        => 'platform-1',
            ]
        );
    }

    public function testConstructorHydratesNestedModelsFromRawArrays(): void
    {
        $model = $this->buildModel();

        $this->assertSame('promo-1', $model->getId());
        $this->assertSame('Promotion One', $model->getName());
        $this->assertSame('seller-1', $model->getSellerId());
        $this->assertInstanceOf(PromotionStatus::class, $model->getStatus());
        $this->assertSame('desc', $model->getDescription());
        $this->assertInstanceOf(ValidityPeriod::class, $model->getPeriod());
        $this->assertSame(1, $model->getPriority());
        $this->assertContainsOnlyInstancesOf(PromotionMode::class, $model->getModes());
        $this->assertFalse($model->getDeleted());
        $this->assertTrue($model->getRelated());
        $this->assertInstanceOf(DomainTypeEnum::class, $model->getDomainType());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getStartOffsetDt());
        $this->assertSame('2026-01-01', $model->getStartOffsetDt()->format('Y-m-d'));
        $this->assertSame('2026-02-01', $model->getEndOffsetDt()->format('Y-m-d'));
        $this->assertTrue($model->getUseVariantRules());
        $this->assertSame('platform-1', $model->getPlatform());
    }

    public function testConstructorWithAllNulls(): void
    {
        $model = $this->serviceProvider()->create(Promotion::class, []);

        $this->assertNull($model->getId());
        $this->assertNull($model->getName());
        $this->assertNull($model->getSellerId());
        $this->assertNull($model->getStatus());
        $this->assertNull($model->getDescription());
        $this->assertNull($model->getPeriod());
        $this->assertNull($model->getPriority());
        $this->assertNull($model->getModes());
        $this->assertNull($model->getDeleted());
        $this->assertNull($model->getRelated());
        $this->assertNull($model->getDomainType());
        $this->assertNull($model->getStartOffsetDt());
        $this->assertNull($model->getEndOffsetDt());
        $this->assertNull($model->getUseVariantRules());
        $this->assertNull($model->getPlatform());
    }

    public function testConstructorAcceptsAlreadyHydratedInstances(): void
    {
        $status = $this->serviceProvider()->create(PromotionStatus::class, ['status' => 'ACTIVE']);
        $period = new ValidityPeriod(new DateTime('2026-01-01'), new DateTime('2026-02-01'));
        $mode   = new PromotionMode('PERCENTUAL', 5.0);

        $model = $this->buildModel([
            'status'     => $status,
            'period'     => $period,
            'modes'      => [$mode],
            'domainType' => DomainTypeEnum::fromValue('AD'),
        ]);

        $this->assertSame($status, $model->getStatus());
        $this->assertSame($period, $model->getPeriod());
        $this->assertSame($mode, $model->getModes()[0]);
        $this->assertSame('AD', (string) $model->getDomainType());
    }

    public function testConstructorAcceptsDateTimeInterfaceOffsets(): void
    {
        $start = new DateTime('2026-03-01');
        $end   = new DateTime('2026-04-01');

        $model = $this->buildModel(['startOffsetDt' => $start, 'endOffsetDt' => $end]);

        $this->assertSame($start, $model->getStartOffsetDt());
        $this->assertSame($end, $model->getEndOffsetDt());
    }

    public function testSetters(): void
    {
        $model  = $this->buildModel();
        $status = new PromotionStatus('CREATED');
        $period = new ValidityPeriod(new DateTime('2026-05-01'), new DateTime('2026-06-01'));
        $mode   = new PromotionMode('PERCENTUAL', 20.0);
        $start  = new DateTime('2026-07-01');
        $end    = new DateTime('2026-08-01');

        $model->setId('promo-2');
        $model->setName('Promotion Two');
        $model->setSellerId('seller-2');
        $model->setStatus($status);
        $model->setDescription('desc2');
        $model->setPeriod($period);
        $model->setPriority(2);
        $model->setModes([$mode]);
        $model->setDeleted(true);
        $model->setRelated(false);
        $model->setDomainType(DomainTypeEnum::fromValue('AD'));
        $model->setStartOffsetDt($start);
        $model->setEndOffsetDt($end);
        $model->setUseVariantRules(false);
        $model->setPlatform('platform-2');

        $this->assertSame('promo-2', $model->getId());
        $this->assertSame('Promotion Two', $model->getName());
        $this->assertSame('seller-2', $model->getSellerId());
        $this->assertSame($status, $model->getStatus());
        $this->assertSame('desc2', $model->getDescription());
        $this->assertSame($period, $model->getPeriod());
        $this->assertSame(2, $model->getPriority());
        $this->assertSame([$mode], $model->getModes());
        $this->assertTrue($model->getDeleted());
        $this->assertFalse($model->getRelated());
        $this->assertSame('AD', (string) $model->getDomainType());
        $this->assertSame($start, $model->getStartOffsetDt());
        $this->assertSame($end, $model->getEndOffsetDt());
        $this->assertFalse($model->getUseVariantRules());
        $this->assertSame('platform-2', $model->getPlatform());
    }
}
