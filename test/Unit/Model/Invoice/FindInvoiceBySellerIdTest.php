<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Invoice\FindInvoiceBySellerId;
use Gubee\SDK\Model\Invoice\SortParam;
use PHPUnit\Framework\TestCase;

class FindInvoiceBySellerIdTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testConstructorHydratesRawSortArrays(): void
    {
        $model = $this->serviceProvider()->create(
            FindInvoiceBySellerId::class,
            [
                'sellerId' => 'seller-1',
                'page'     => 1,
                'size'     => 10,
                'sort'     => [['field' => 'createdDate', 'direction' => 'ASC']],
            ]
        );

        $this->assertSame('seller-1', $model->getSellerId());
        $this->assertSame(1, $model->getPage());
        $this->assertSame(10, $model->getSize());
        $this->assertContainsOnlyInstancesOf(SortParam::class, $model->getSort());
        $this->assertSame('createdDate', $model->getSort()[0]->getField());
    }

    public function testConstructorPassesThroughAlreadyHydratedSortParam(): void
    {
        $sort = $this->serviceProvider()->create(SortParam::class, ['field' => 'id', 'direction' => 'DESC']);

        $model = $this->serviceProvider()->create(
            FindInvoiceBySellerId::class,
            ['sort' => [$sort]]
        );

        $this->assertSame($sort, $model->getSort()[0]);
    }

    public function testConstructorWithNullValues(): void
    {
        $model = $this->serviceProvider()->create(FindInvoiceBySellerId::class, []);

        $this->assertNull($model->getSellerId());
        $this->assertNull($model->getPage());
        $this->assertNull($model->getSize());
        $this->assertNull($model->getSort());
    }

    public function testSettersAndGetters(): void
    {
        $model = $this->serviceProvider()->create(FindInvoiceBySellerId::class, []);
        $sort  = $this->serviceProvider()->create(SortParam::class, ['field' => 'a']);

        $model->setSellerId('seller-2');
        $model->setPage(2);
        $model->setSize(20);
        $model->setSort([$sort]);

        $this->assertSame('seller-2', $model->getSellerId());
        $this->assertSame(2, $model->getPage());
        $this->assertSame(20, $model->getSize());
        $this->assertSame([$sort], $model->getSort());

        $model->setSort(null);
        $this->assertNull($model->getSort());
    }
}
