<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Platform\DomainTypeEnum;
use Gubee\SDK\Model\Platform\PlatformPrice;
use Gubee\SDK\Model\Platform\SkuPlatformPrice;
use PHPUnit\Framework\TestCase;

class SkuPlatformPriceTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildModel(array $overrides = []): SkuPlatformPrice
    {
        return $this->serviceProvider()->create(
            SkuPlatformPrice::class,
            $overrides + [
                'defaultPrice'             => ['id' => null, 'platform' => null, 'store' => null, 'promotionId' => null, 'value' => 10.0, 'beginDt' => null, 'endDt' => null, 'priceType' => 'DEFAULT', 'status' => 'ACTIVE'],
                'promotionPrice'           => ['id' => null, 'platform' => null, 'store' => null, 'promotionId' => null, 'value' => 8.0, 'beginDt' => null, 'endDt' => null, 'priceType' => 'PROMOTION', 'status' => 'ACTIVE'],
                'scheduledPromotionPrices' => [['id' => null, 'platform' => null, 'store' => null, 'promotionId' => null, 'value' => 7.0, 'beginDt' => null, 'endDt' => null, 'priceType' => 'PROMOTION', 'status' => 'INACTIVE']],
                'skuPriceId'               => 'skuprice-1',
                'sellerId'                 => 'seller-1',
                'itemId'                   => 'item-1',
                'sku'                      => 'sku-1',
                'platform'                 => 'platform-1',
                'store'                    => 'store-1',
                'domain'                   => 'PRODUCT',
                'createdBy'                => 'user-1',
                'createdDt'                => '2026-01-01',
                'lastModifiedDt'           => '2026-02-01',
            ]
        );
    }

    public function testConstructorHydratesNestedModels(): void
    {
        $model = $this->buildModel();

        $this->assertInstanceOf(PlatformPrice::class, $model->getDefaultPrice());
        $this->assertInstanceOf(PlatformPrice::class, $model->getPromotionPrice());
        $this->assertContainsOnlyInstancesOf(PlatformPrice::class, $model->getScheduledPromotionPrices());
        $this->assertSame('skuprice-1', $model->getSkuPriceId());
        $this->assertSame('seller-1', $model->getSellerId());
        $this->assertSame('item-1', $model->getItemId());
        $this->assertSame('sku-1', $model->getSku());
        $this->assertSame('platform-1', $model->getPlatform());
        $this->assertSame('store-1', $model->getStore());
        $this->assertInstanceOf(DomainTypeEnum::class, $model->getDomain());
        $this->assertSame('user-1', $model->getCreatedBy());
        $this->assertInstanceOf(DateTimeInterface::class, $model->getCreatedDt());
        $this->assertSame('2026-01-01', $model->getCreatedDt()->format('Y-m-d'));
        $this->assertSame('2026-02-01', $model->getLastModifiedDt()->format('Y-m-d'));
    }

    public function testConstructorWithNullOptionalFields(): void
    {
        $model = $this->buildModel([
            'defaultPrice'             => null,
            'promotionPrice'           => null,
            'scheduledPromotionPrices' => null,
            'sku'                      => null,
            'platform'                 => null,
            'store'                    => null,
            'createdBy'                => null,
            'createdDt'                => null,
            'lastModifiedDt'           => null,
        ]);

        $this->assertNull($model->getDefaultPrice());
        $this->assertNull($model->getPromotionPrice());
        $this->assertNull($model->getScheduledPromotionPrices());
        $this->assertNull($model->getSku());
        $this->assertNull($model->getPlatform());
        $this->assertNull($model->getStore());
        $this->assertNull($model->getCreatedBy());
        $this->assertNull($model->getCreatedDt());
        $this->assertNull($model->getLastModifiedDt());
    }

    public function testConstructorPassesThroughAlreadyHydratedInstances(): void
    {
        $default   = $this->serviceProvider()->create(
            PlatformPrice::class,
            ['id' => null, 'platform' => null, 'store' => null, 'promotionId' => null, 'value' => 1.0, 'beginDt' => null, 'endDt' => null, 'priceType' => 'DEFAULT', 'status' => 'ACTIVE']
        );
        $promotion = $this->serviceProvider()->create(
            PlatformPrice::class,
            ['id' => null, 'platform' => null, 'store' => null, 'promotionId' => null, 'value' => 2.0, 'beginDt' => null, 'endDt' => null, 'priceType' => 'PROMOTION', 'status' => 'ACTIVE']
        );

        $model = $this->buildModel([
            'defaultPrice'             => $default,
            'promotionPrice'           => $promotion,
            'scheduledPromotionPrices' => [$default],
            'domain'                   => DomainTypeEnum::fromValue('AD'),
        ]);

        $this->assertSame($default, $model->getDefaultPrice());
        $this->assertSame($promotion, $model->getPromotionPrice());
        $this->assertSame($default, $model->getScheduledPromotionPrices()[0]);
        $this->assertSame('AD', (string) $model->getDomain());
    }

    public function testSetters(): void
    {
        $model = $this->buildModel();
        $price = $this->serviceProvider()->create(
            PlatformPrice::class,
            ['id' => null, 'platform' => null, 'store' => null, 'promotionId' => null, 'value' => 3.0, 'beginDt' => null, 'endDt' => null, 'priceType' => 'DEFAULT', 'status' => 'ACTIVE']
        );
        $date  = new DateTime('2027-01-01');

        $model->setDefaultPrice($price);
        $model->setPromotionPrice($price);
        $model->setScheduledPromotionPrices([$price]);
        $model->setSkuPriceId('skuprice-2');
        $model->setSellerId('seller-2');
        $model->setItemId('item-2');
        $model->setSku('sku-2');
        $model->setPlatform('platform-2');
        $model->setStore('store-2');
        $model->setDomain(DomainTypeEnum::fromValue('AD'));
        $model->setCreatedBy('user-2');
        $model->setCreatedDt($date);
        $model->setLastModifiedDt($date);

        $this->assertSame($price, $model->getDefaultPrice());
        $this->assertSame($price, $model->getPromotionPrice());
        $this->assertSame([$price], $model->getScheduledPromotionPrices());
        $this->assertSame('skuprice-2', $model->getSkuPriceId());
        $this->assertSame('seller-2', $model->getSellerId());
        $this->assertSame('item-2', $model->getItemId());
        $this->assertSame('sku-2', $model->getSku());
        $this->assertSame('platform-2', $model->getPlatform());
        $this->assertSame('store-2', $model->getStore());
        $this->assertSame('AD', (string) $model->getDomain());
        $this->assertSame('user-2', $model->getCreatedBy());
        $this->assertSame($date, $model->getCreatedDt());
        $this->assertSame($date, $model->getLastModifiedDt());
    }
}
