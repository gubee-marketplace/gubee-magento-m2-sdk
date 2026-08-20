<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use Gubee\SDK\Model\Invoice\SortParam;
use PHPUnit\Framework\TestCase;

class SortParamTest extends TestCase
{
    public function testConstructorSetsAllFields(): void
    {
        $model = new SortParam('createdDate', 'ASC');

        $this->assertSame('createdDate', $model->getField());
        $this->assertSame('ASC', $model->getDirection());
    }

    public function testConstructorWithNullValues(): void
    {
        $model = new SortParam();

        $this->assertNull($model->getField());
        $this->assertNull($model->getDirection());
    }

    public function testSettersAndGetters(): void
    {
        $model = new SortParam();

        $model->setField('id');
        $model->setDirection('DESC');

        $this->assertSame('id', $model->getField());
        $this->assertSame('DESC', $model->getDirection());
    }
}
