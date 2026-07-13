<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Sales\Order;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Sales\Order\LogisticTypeMappingApi;
use Gubee\SDK\Model\Sales\Order\LogisticTypeMappingEntryApi;
use PHPUnit\Framework\TestCase;

class LogisticTypeMappingApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    private function buildModel(array $overrides = []): LogisticTypeMappingApi
    {
        return $this->serviceProvider()->create(
            LogisticTypeMappingApi::class,
            $overrides + [
                'platform'      => 'platform-1',
                'sellerId'      => 'seller-1',
                'logisticTypes' => [['name' => 'name-1', 'shippingMode' => 'mode-1']],
            ]
        );
    }

    public function testConstructorHydratesLogisticTypesFromRawArrays(): void
    {
        $model = $this->buildModel();

        $this->assertSame('platform-1', $model->getPlatform());
        $this->assertSame('seller-1', $model->getSellerId());
        $this->assertContainsOnlyInstancesOf(LogisticTypeMappingEntryApi::class, $model->getLogisticTypes());
    }

    public function testConstructorWithNullOptionalFields(): void
    {
        $model = $this->buildModel(['platform' => null, 'sellerId' => null]);

        $this->assertNull($model->getPlatform());
        $this->assertNull($model->getSellerId());
    }

    public function testConstructorPassesThroughAlreadyHydratedEntries(): void
    {
        $entry = new LogisticTypeMappingEntryApi('name-2', 'mode-2');

        $model = $this->buildModel(['logisticTypes' => [$entry]]);

        $this->assertSame($entry, $model->getLogisticTypes()[0]);
    }

    public function testSetters(): void
    {
        $model = $this->buildModel();
        $entry = new LogisticTypeMappingEntryApi('name-3', 'mode-3');

        $model->setPlatform('platform-2');
        $model->setSellerId('seller-2');
        $model->setLogisticTypes([$entry]);

        $this->assertSame('platform-2', $model->getPlatform());
        $this->assertSame('seller-2', $model->getSellerId());
        $this->assertSame([$entry], $model->getLogisticTypes());
    }
}
