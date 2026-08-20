<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Platform;

use Gubee\SDK\Model\Platform\SetUp;
use PHPUnit\Framework\TestCase;

class SetUpTest extends TestCase
{
    public function testConstructorWithNull(): void
    {
        $model = new SetUp();

        $this->assertNull($model->getUp());
    }

    public function testConstructorWithValue(): void
    {
        $model = new SetUp('up-1');

        $this->assertSame('up-1', $model->getUp());
    }

    public function testSetter(): void
    {
        $model = new SetUp();

        $model->setUp('up-2');

        $this->assertSame('up-2', $model->getUp());
    }
}
