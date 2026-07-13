<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Shipping;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Shipping\SkuFreightApi;
use Gubee\SDK\Model\Shipping\SkuFreightsApi;
use PHPUnit\Framework\TestCase;

class SkuFreightsApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesQuotationItemsFromRawArrays(): void
    {
        $model = $this->serviceProvider()->create(
            SkuFreightsApi::class,
            ['quotationItems' => [['skuId' => 'sku-1', 'qty' => 1]]]
        );

        $this->assertContainsOnlyInstancesOf(SkuFreightApi::class, $model->getQuotationItems());
    }

    public function testPassesThroughAlreadyHydratedInstance(): void
    {
        $item = new SkuFreightApi('sku-1', 1);

        $model = $this->serviceProvider()->create(
            SkuFreightsApi::class,
            ['quotationItems' => [$item]]
        );

        $this->assertSame($item, $model->getQuotationItems()[0]);
    }

    public function testSetters(): void
    {
        $model = $this->serviceProvider()->create(SkuFreightsApi::class, []);

        $item = new SkuFreightApi('sku-1', 1);
        $model->setQuotationItems([$item]);

        $this->assertSame([$item], $model->getQuotationItems());
    }

    public function testNullByDefault(): void
    {
        $model = $this->serviceProvider()->create(SkuFreightsApi::class, []);

        $this->assertNull($model->getQuotationItems());
    }
}
