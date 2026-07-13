<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Model\Sales\Order\OrderProfitabilityApi;
use PHPUnit\Framework\TestCase;

class OrderProfitabilityApiTest extends TestCase
{
    public function testConstructorWithNulls(): void
    {
        $model = new OrderProfitabilityApi();

        $this->assertNull($model->getTotalCost());
        $this->assertNull($model->getGrossProfit());
        $this->assertNull($model->getGrossMarginPct());
        $this->assertNull($model->getTotalCommission());
        $this->assertNull($model->getServiceFees());
        $this->assertNull($model->getNetShippingCost());
        $this->assertNull($model->getContributionMargin());
        $this->assertNull($model->getContributionMarginPct());
        $this->assertNull($model->getTrend());
        $this->assertNull($model->getTrendPct());
        $this->assertNull($model->getHasCostData());
        $this->assertNull($model->getGrossOperatingRevenue());
        $this->assertNull($model->getEscrowAmount());
        $this->assertNull($model->getTax());
    }

    public function testConstructorWithValues(): void
    {
        $model = new OrderProfitabilityApi(
            1.0,
            2.0,
            3.0,
            4.0,
            5.0,
            6.0,
            7.0,
            8.0,
            'up',
            9.0,
            true,
            10.0,
            11.0,
            12.0
        );

        $this->assertSame(1.0, $model->getTotalCost());
        $this->assertSame(2.0, $model->getGrossProfit());
        $this->assertSame(3.0, $model->getGrossMarginPct());
        $this->assertSame(4.0, $model->getTotalCommission());
        $this->assertSame(5.0, $model->getServiceFees());
        $this->assertSame(6.0, $model->getNetShippingCost());
        $this->assertSame(7.0, $model->getContributionMargin());
        $this->assertSame(8.0, $model->getContributionMarginPct());
        $this->assertSame('up', $model->getTrend());
        $this->assertSame(9.0, $model->getTrendPct());
        $this->assertTrue($model->getHasCostData());
        $this->assertSame(10.0, $model->getGrossOperatingRevenue());
        $this->assertSame(11.0, $model->getEscrowAmount());
        $this->assertSame(12.0, $model->getTax());
    }

    public function testSetters(): void
    {
        $model = new OrderProfitabilityApi();

        $model->setTotalCost(1.1);
        $model->setGrossProfit(2.1);
        $model->setGrossMarginPct(3.1);
        $model->setTotalCommission(4.1);
        $model->setServiceFees(5.1);
        $model->setNetShippingCost(6.1);
        $model->setContributionMargin(7.1);
        $model->setContributionMarginPct(8.1);
        $model->setTrend('down');
        $model->setTrendPct(9.1);
        $model->setHasCostData(false);
        $model->setGrossOperatingRevenue(10.1);
        $model->setEscrowAmount(11.1);
        $model->setTax(12.1);

        $this->assertSame(1.1, $model->getTotalCost());
        $this->assertSame(2.1, $model->getGrossProfit());
        $this->assertSame(3.1, $model->getGrossMarginPct());
        $this->assertSame(4.1, $model->getTotalCommission());
        $this->assertSame(5.1, $model->getServiceFees());
        $this->assertSame(6.1, $model->getNetShippingCost());
        $this->assertSame(7.1, $model->getContributionMargin());
        $this->assertSame(8.1, $model->getContributionMarginPct());
        $this->assertSame('down', $model->getTrend());
        $this->assertSame(9.1, $model->getTrendPct());
        $this->assertFalse($model->getHasCostData());
        $this->assertSame(10.1, $model->getGrossOperatingRevenue());
        $this->assertSame(11.1, $model->getEscrowAmount());
        $this->assertSame(12.1, $model->getTax());
    }
}
