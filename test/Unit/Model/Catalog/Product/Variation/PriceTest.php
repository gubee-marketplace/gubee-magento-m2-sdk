<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\Variation\Price\TypeEnum;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\ValidityPeriod;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Resource\Catalog\Product\Variation\PriceResource;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function priceResource(): PriceResource
    {
        return $this->createMock(PriceResource::class);
    }

    public function testHydratesValidityPeriodFromRawArray(): void
    {
        $price = $this->serviceProvider()->create(
            Price::class,
            [
                'type'           => 'DEFAULT',
                'value'          => 9.9,
                'validityPeriod' => [
                    'beginDt' => '2026-01-01T00:00:00.000',
                    'endDt'   => '2026-12-31T00:00:00.000',
                ],
            ]
        );

        $this->assertInstanceOf(ValidityPeriod::class, $price->getValidityPeriod());
    }

    public function testPassesThroughAlreadyHydratedValidityPeriod(): void
    {
        $validityPeriod = $this->serviceProvider()->create(
            ValidityPeriod::class,
            ['beginDt' => '2026-01-01T00:00:00.000', 'endDt' => '2026-12-31T00:00:00.000']
        );

        $price = $this->serviceProvider()->create(
            Price::class,
            ['type' => 'DEFAULT', 'value' => 9.9, 'validityPeriod' => $validityPeriod]
        );

        $this->assertSame($validityPeriod, $price->getValidityPeriod());
    }

    public function testSaveAndSetters(): void
    {
        $resource       = $this->priceResource();
        $validityPeriod = $this->serviceProvider()->create(
            ValidityPeriod::class,
            ['beginDt' => '2026-01-01T00:00:00.000', 'endDt' => '2026-12-31T00:00:00.000']
        );

        $resource->expects($this->once())
            ->method('updatePriceBySkuId')
            ->with('prod-1', 'sku-1', $this->isInstanceOf(Price::class));

        $price = new Price($resource, $this->serviceProvider(), TypeEnum::DEFAULT(), 9.9, $validityPeriod);
        $price
            ->setType(TypeEnum::PROMOTION())
            ->setValue(19.9)
            ->setValidityPeriod($validityPeriod);

        $price->save('prod-1', 'sku-1');

        $this->assertEquals(TypeEnum::PROMOTION(), $price->getType());
        $this->assertSame(19.9, $price->getValue());
        $this->assertSame($validityPeriod, $price->getValidityPeriod());
    }
}
