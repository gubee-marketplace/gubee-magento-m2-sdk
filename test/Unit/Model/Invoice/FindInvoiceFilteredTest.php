<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Invoice\FindInvoiceFiltered;
use Gubee\SDK\Model\Invoice\SearchParams;
use Gubee\SDK\Model\Invoice\SortParam;
use PHPUnit\Framework\TestCase;

class FindInvoiceFilteredTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    public function testConstructorHydratesRawSearchParamsAndSortArrays(): void
    {
        $model = $this->serviceProvider()->create(
            FindInvoiceFiltered::class,
            [
                'sellerId'     => 'seller-1',
                'searchParams' => ['type' => 'NFE', 'storeId' => 'store-1'],
                'page'         => 1,
                'size'         => 10,
                'sort'         => [['field' => 'createdDate', 'direction' => 'ASC']],
            ]
        );

        $this->assertSame('seller-1', $model->getSellerId());
        $this->assertInstanceOf(SearchParams::class, $model->getSearchParams());
        $this->assertSame('NFE', $model->getSearchParams()->getType());
        $this->assertSame(1, $model->getPage());
        $this->assertSame(10, $model->getSize());
        $this->assertContainsOnlyInstancesOf(SortParam::class, $model->getSort());
    }

    public function testConstructorPassesThroughAlreadyHydratedSearchParamsAndSort(): void
    {
        $searchParams = $this->serviceProvider()->create(SearchParams::class, ['type' => 'NFSE']);
        $sort         = $this->serviceProvider()->create(SortParam::class, ['field' => 'id']);

        $model = $this->serviceProvider()->create(
            FindInvoiceFiltered::class,
            [
                'searchParams' => $searchParams,
                'sort'         => [$sort],
            ]
        );

        $this->assertSame($searchParams, $model->getSearchParams());
        $this->assertSame($sort, $model->getSort()[0]);
    }

    public function testConstructorWithNullValues(): void
    {
        $model = $this->serviceProvider()->create(FindInvoiceFiltered::class, []);

        $this->assertNull($model->getSellerId());
        $this->assertNull($model->getSearchParams());
        $this->assertNull($model->getPage());
        $this->assertNull($model->getSize());
        $this->assertNull($model->getSort());
    }

    public function testSettersAndGetters(): void
    {
        $model        = $this->serviceProvider()->create(FindInvoiceFiltered::class, []);
        $searchParams = $this->serviceProvider()->create(SearchParams::class, ['type' => 'NFE']);
        $sort         = $this->serviceProvider()->create(SortParam::class, ['field' => 'a']);

        $model->setSellerId('seller-2');
        $model->setSearchParams($searchParams);
        $model->setPage(2);
        $model->setSize(20);
        $model->setSort([$sort]);

        $this->assertSame('seller-2', $model->getSellerId());
        $this->assertSame($searchParams, $model->getSearchParams());
        $this->assertSame(2, $model->getPage());
        $this->assertSame(20, $model->getSize());
        $this->assertSame([$sort], $model->getSort());

        $model->setSearchParams(null);
        $model->setSort(null);
        $this->assertNull($model->getSearchParams());
        $this->assertNull($model->getSort());
    }
}
