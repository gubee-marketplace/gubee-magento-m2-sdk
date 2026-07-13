<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Platform\DomainTypeEnum;
use Gubee\SDK\Model\Platform\PlatformPriceApi;
use Gubee\SDK\Model\Platform\PlatformPricesIntegrationPayload;
use PHPUnit\Framework\TestCase;

class PlatformPricesIntegrationPayloadTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildModel(array $overrides = []): PlatformPricesIntegrationPayload
    {
        $args = $overrides + [
            'itemId'     => 'item-1',
            'domainType' => 'PRODUCT',
            'prices'     => [
                ['value' => 10.0, 'type' => 'DEFAULT', 'platform' => 'p1'],
            ],
        ];

        return new PlatformPricesIntegrationPayload(
            $this->serviceProvider(),
            $args['itemId'],
            $args['domainType'],
            $args['prices']
        );
    }

    public function testConstructorHydratesPricesFromRawArrays(): void
    {
        $model = $this->buildModel();

        $this->assertSame('item-1', $model->getItemId());
        $this->assertInstanceOf(DomainTypeEnum::class, $model->getDomainType());
        $this->assertContainsOnlyInstancesOf(PlatformPriceApi::class, $model->getPrices());
    }

    public function testConstructorWithNullDomainType(): void
    {
        $model = $this->buildModel(['domainType' => null]);

        $this->assertNull($model->getDomainType());
    }

    public function testConstructorAcceptsEnumDomainType(): void
    {
        $model = $this->buildModel(['domainType' => DomainTypeEnum::fromValue('AD')]);

        $this->assertSame('AD', (string) $model->getDomainType());
    }

    public function testConstructorPassesThroughAlreadyHydratedPrices(): void
    {
        $price = $this->serviceProvider()->create(
            PlatformPriceApi::class,
            ['value' => 5.0, 'type' => 'DEFAULT', 'platform' => 'p2']
        );

        $model = $this->buildModel(['prices' => [$price]]);

        $this->assertSame($price, $model->getPrices()[0]);
    }

    public function testSetters(): void
    {
        $model = $this->buildModel();
        $price = $this->serviceProvider()->create(
            PlatformPriceApi::class,
            ['value' => 1.0, 'type' => 'DEFAULT', 'platform' => 'p3']
        );

        $model->setItemId('item-2');
        $model->setDomainType(DomainTypeEnum::fromValue('AD'));
        $model->setPrices([$price]);

        $this->assertSame('item-2', $model->getItemId());
        $this->assertSame('AD', (string) $model->getDomainType());
        $this->assertSame([$price], $model->getPrices());
    }
}
