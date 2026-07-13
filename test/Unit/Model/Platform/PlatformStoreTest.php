<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use Gubee\SDK\Model\Platform\PlatformStore;
use PHPUnit\Framework\TestCase;

class PlatformStoreTest extends TestCase
{
    public function testConstructorWithNulls(): void
    {
        $model = new PlatformStore();

        $this->assertNull($model->getPlatform());
        $this->assertNull($model->getStore());
    }

    public function testConstructorWithValues(): void
    {
        $model = new PlatformStore('platform-1', 'store-1');

        $this->assertSame('platform-1', $model->getPlatform());
        $this->assertSame('store-1', $model->getStore());
    }

    public function testSetters(): void
    {
        $model = new PlatformStore();

        $model->setPlatform('p2');
        $model->setStore('s2');

        $this->assertSame('p2', $model->getPlatform());
        $this->assertSame('s2', $model->getStore());
    }
}
