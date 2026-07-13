<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Shipping;

use Gubee\SDK\Model\Shipping\SkuFreightApi;
use PHPUnit\Framework\TestCase;

class SkuFreightApiTest extends TestCase
{
    public function testConstructorAndGetters(): void
    {
        $model = new SkuFreightApi('sku-1', 3);

        $this->assertSame('sku-1', $model->getSkuId());
        $this->assertSame(3, $model->getQty());
    }

    public function testSetters(): void
    {
        $model = new SkuFreightApi();

        $model->setSkuId('sku-2');
        $model->setQty(5);

        $this->assertSame('sku-2', $model->getSkuId());
        $this->assertSame(5, $model->getQty());
    }

    public function testDefaultsAreNull(): void
    {
        $model = new SkuFreightApi();

        $this->assertNull($model->getSkuId());
        $this->assertNull($model->getQty());
    }
}
