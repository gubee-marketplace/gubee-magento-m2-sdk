<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Promotion;

use Gubee\SDK\Enum\Promotion\StatusEnum;
use Gubee\SDK\Model\Promotion\PromotionStatus;
use PHPUnit\Framework\TestCase;

class PromotionStatusTest extends TestCase
{
    public function testConstructorWithNull(): void
    {
        $model = new PromotionStatus();

        $this->assertNull($model->getStatus());
    }

    public function testConstructorAcceptsStringValue(): void
    {
        $model = new PromotionStatus('ACTIVE');

        $this->assertInstanceOf(StatusEnum::class, $model->getStatus());
        $this->assertSame('ACTIVE', (string) $model->getStatus());
    }

    public function testConstructorAcceptsEnumInstance(): void
    {
        $model = new PromotionStatus(StatusEnum::fromValue('CREATED'));

        $this->assertSame('CREATED', (string) $model->getStatus());
    }

    public function testSetter(): void
    {
        $model = new PromotionStatus();

        $model->setStatus(StatusEnum::fromValue('FINISHED'));

        $this->assertSame('FINISHED', (string) $model->getStatus());
    }
}
