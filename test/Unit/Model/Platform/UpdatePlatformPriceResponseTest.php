<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Platform\PlatformPriceResult;
use Gubee\SDK\Model\Platform\UpdatePlatformPriceResponse;
use PHPUnit\Framework\TestCase;

class UpdatePlatformPriceResponseTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testConstructorWithNulls(): void
    {
        $model = $this->serviceProvider()->create(UpdatePlatformPriceResponse::class, []);

        $this->assertNull($model->getSellerId());
        $this->assertNull($model->getResult());
    }

    public function testConstructorHydratesResultFromRawArrays(): void
    {
        $model = $this->serviceProvider()->create(
            UpdatePlatformPriceResponse::class,
            [
                'sellerId' => 'seller-1',
                'result'   => [
                    ['platform' => 'p1', 'itemId' => 'i1', 'updated' => true, 'message' => 'ok'],
                ],
            ]
        );

        $this->assertSame('seller-1', $model->getSellerId());
        $this->assertContainsOnlyInstancesOf(PlatformPriceResult::class, $model->getResult());
    }

    public function testConstructorPassesThroughAlreadyHydratedResult(): void
    {
        $result = new PlatformPriceResult('p2', 'i2', false, 'fail');

        $model = $this->serviceProvider()->create(
            UpdatePlatformPriceResponse::class,
            ['result' => [$result]]
        );

        $this->assertSame($result, $model->getResult()[0]);
    }

    public function testSetters(): void
    {
        $model  = $this->serviceProvider()->create(UpdatePlatformPriceResponse::class, []);
        $result = new PlatformPriceResult('p3', 'i3', true, 'ok');

        $model->setSellerId('seller-2');
        $model->setResult([$result]);

        $this->assertSame('seller-2', $model->getSellerId());
        $this->assertSame([$result], $model->getResult());
    }
}
