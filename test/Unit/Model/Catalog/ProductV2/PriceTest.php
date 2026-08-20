<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\ProductV2;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\Variation\Price\TypeEnum;
use Gubee\SDK\Model\Catalog\ProductV2\Cost;
use Gubee\SDK\Model\Catalog\ProductV2\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesCostFromRawArrayAndCoercesType(): void
    {
        $price = $this->serviceProvider()->create(Price::class, [
            'value' => ['currency' => 'BRL', 'amount' => 10.0],
            'type'  => 'DEFAULT',
        ]);

        $this->assertInstanceOf(Cost::class, $price->getValue());
        $this->assertSame('BRL', $price->getValue()->getCurrency());
        $this->assertEquals(TypeEnum::fromValue('DEFAULT'), $price->getType());
    }

    public function testPassesThroughAlreadyHydratedCostAndTypeEnum(): void
    {
        $cost = $this->serviceProvider()->create(Cost::class, ['currency' => 'USD', 'amount' => 5.0]);
        $type = TypeEnum::fromValue('DEFAULT');

        $price = $this->serviceProvider()->create(Price::class, [
            'value' => $cost,
            'type'  => $type,
        ]);

        $this->assertSame($cost, $price->getValue());
        $this->assertSame($type, $price->getType());
    }

    public function testSetters(): void
    {
        $price   = $this->serviceProvider()->create(Price::class, [
            'value' => ['currency' => 'BRL', 'amount' => 10.0],
            'type'  => 'DEFAULT',
        ]);
        $newCost = $this->serviceProvider()->create(Cost::class, ['currency' => 'EUR', 'amount' => 15.0]);
        $newType = TypeEnum::fromValue('DEFAULT');

        $price->setValue($newCost);
        $price->setType($newType);

        $this->assertSame($newCost, $price->getValue());
        $this->assertSame($newType, $price->getType());
    }
}
