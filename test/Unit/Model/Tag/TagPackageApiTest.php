<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Tag;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Tag\PackageErrorApi;
use Gubee\SDK\Model\Tag\PackApi;
use Gubee\SDK\Model\Tag\TagPackageApi;
use PHPUnit\Framework\TestCase;

class TagPackageApiTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testHydratesErrorsAndPacksFromRawArrays(): void
    {
        $model = new TagPackageApi(
            $this->serviceProvider(),
            'id-1',
            ['order-1'],
            [['orderId' => 'order-1', 'message' => 'err']],
            [['link' => 'link', 'type' => 'PDF']]
        );

        $this->assertSame('id-1', $model->getId());
        $this->assertSame(['order-1'], $model->getPackageOrders());
        $this->assertContainsOnlyInstancesOf(PackageErrorApi::class, $model->getErrors());
        $this->assertContainsOnlyInstancesOf(PackApi::class, $model->getPacks());
    }

    public function testPassesThroughAlreadyHydratedInstances(): void
    {
        $error = new PackageErrorApi('order-1');
        $pack  = new PackApi('link', 'PDF');

        $model = new TagPackageApi(
            $this->serviceProvider(),
            null,
            [],
            [$error],
            [$pack]
        );

        $this->assertSame($error, $model->getErrors()[0]);
        $this->assertSame($pack, $model->getPacks()[0]);
    }

    public function testSetters(): void
    {
        $model = new TagPackageApi($this->serviceProvider(), null, [], [], []);

        $model->setId('id-2');
        $model->setPackageOrders(['order-2']);
        $error = new PackageErrorApi('order-2');
        $model->setErrors([$error]);
        $pack = new PackApi('link', 'ZPL');
        $model->setPacks([$pack]);

        $this->assertSame('id-2', $model->getId());
        $this->assertSame(['order-2'], $model->getPackageOrders());
        $this->assertSame([$error], $model->getErrors());
        $this->assertSame([$pack], $model->getPacks());
    }

    public function testIdDefaultsToNull(): void
    {
        $model = new TagPackageApi($this->serviceProvider(), null, [], [], []);

        $this->assertNull($model->getId());
    }
}
