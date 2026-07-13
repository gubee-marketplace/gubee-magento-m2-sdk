<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Platform\TypeEnum;
use Gubee\SDK\Model\Platform\PlatformPriceApi;
use Gubee\SDK\Model\Platform\PlatformPricePeriod;
use PHPUnit\Framework\TestCase;

class PlatformPriceApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildModel(array $overrides = []): PlatformPriceApi
    {
        return $this->serviceProvider()->create(
            PlatformPriceApi::class,
            $overrides + [
                'value'          => 10.5,
                'type'           => 'DEFAULT',
                'platform'       => 'platform-1',
                'validityPeriod' => ['beginDt' => '2026-01-01', 'endDt' => '2026-02-01'],
            ]
        );
    }

    public function testConstructorAndGetters(): void
    {
        $model = $this->buildModel();

        $this->assertSame(10.5, $model->getValue());
        $this->assertInstanceOf(TypeEnum::class, $model->getType());
        $this->assertSame('DEFAULT', (string) $model->getType());
        $this->assertSame('platform-1', $model->getPlatform());
        $this->assertInstanceOf(PlatformPricePeriod::class, $model->getValidityPeriod());
    }

    public function testConstructorAcceptsEnumType(): void
    {
        $model = $this->buildModel(['type' => TypeEnum::fromValue('PROMOTION')]);

        $this->assertSame('PROMOTION', (string) $model->getType());
    }

    public function testConstructorWithNullValidityPeriod(): void
    {
        $model = $this->buildModel(['validityPeriod' => null]);

        $this->assertNull($model->getValidityPeriod());
    }

    public function testConstructorAcceptsAlreadyHydratedValidityPeriod(): void
    {
        $period = $this->serviceProvider()->create(PlatformPricePeriod::class, []);

        $model = $this->buildModel(['validityPeriod' => $period]);

        $this->assertSame($period, $model->getValidityPeriod());
    }

    public function testSetters(): void
    {
        $model  = $this->buildModel();
        $period = $this->serviceProvider()->create(PlatformPricePeriod::class, []);

        $model->setValue(20.0);
        $model->setType(TypeEnum::fromValue('PROMOTION'));
        $model->setPlatform('platform-2');
        $model->setValidityPeriod($period);

        $this->assertSame(20.0, $model->getValue());
        $this->assertSame('PROMOTION', (string) $model->getType());
        $this->assertSame('platform-2', $model->getPlatform());
        $this->assertSame($period, $model->getValidityPeriod());
    }
}
