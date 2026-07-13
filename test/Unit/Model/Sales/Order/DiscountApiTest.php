<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Model\Sales\Order\DiscountApi;
use PHPUnit\Framework\TestCase;

class DiscountApiTest extends TestCase
{
    public function testConstructor(): void
    {
        $api = new DiscountApi(10.5, true);

        $this->assertSame(10.5, $api->getDiscount());
        $this->assertTrue($api->getPercentage());
    }

    public function testConstructorDefaults(): void
    {
        $api = new DiscountApi();

        $this->assertNull($api->getDiscount());
        $this->assertNull($api->getPercentage());
    }

    public function testSetters(): void
    {
        $api = new DiscountApi();

        $api->setDiscount(5.0);
        $api->setPercentage(false);

        $this->assertSame(5.0, $api->getDiscount());
        $this->assertFalse($api->getPercentage());
    }
}
