<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use Gubee\SDK\Model\Platform\PlatformPriceResult;
use PHPUnit\Framework\TestCase;

class PlatformPriceResultTest extends TestCase
{
    public function testConstructorWithNulls(): void
    {
        $model = new PlatformPriceResult();

        $this->assertNull($model->getPlatform());
        $this->assertNull($model->getItemId());
        $this->assertNull($model->getUpdated());
        $this->assertNull($model->getMessage());
    }

    public function testConstructorWithValues(): void
    {
        $model = new PlatformPriceResult('platform-1', 'item-1', true, 'ok');

        $this->assertSame('platform-1', $model->getPlatform());
        $this->assertSame('item-1', $model->getItemId());
        $this->assertTrue($model->getUpdated());
        $this->assertSame('ok', $model->getMessage());
    }

    public function testSetters(): void
    {
        $model = new PlatformPriceResult();

        $model->setPlatform('p2');
        $model->setItemId('i2');
        $model->setUpdated(false);
        $model->setMessage('fail');

        $this->assertSame('p2', $model->getPlatform());
        $this->assertSame('i2', $model->getItemId());
        $this->assertFalse($model->getUpdated());
        $this->assertSame('fail', $model->getMessage());
    }
}
