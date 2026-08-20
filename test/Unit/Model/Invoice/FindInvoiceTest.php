<?php

declare(strict_types=1);

namespace Gubee\SDK\Tests\Unit\Model\Invoice;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\Invoice\FindInvoice;
use Gubee\SDK\Model\Sales\Order\Invoice;
use PHPUnit\Framework\TestCase;

class FindInvoiceTest extends TestCase
{
    private function serviceProvider(): ServiceProviderInterface
    {
        return container();
    }

    /**
     * @param array<string, mixed> $overrides
     */
    private function invoiceData(array $overrides = []): array
    {
        return $overrides + [
            'line'      => '1',
            'issueDate' => '2026-01-01T00:00:00.000',
            'danfeXml'  => 'xml',
            'danfeLink' => 'https://example.com/danfe.xml',
            'key'       => 'key-1',
            'number'    => 'number-1',
        ];
    }

    public function testConstructorHydratesRawInvoiceArrays(): void
    {
        $model = new FindInvoice(
            $this->serviceProvider(),
            [$this->invoiceData(['id' => 'inv-1'])],
            1
        );

        $this->assertContainsOnlyInstancesOf(Invoice::class, $model->getInvoices());
        $this->assertSame(1, $model->getTotal());
    }

    public function testConstructorPassesThroughAlreadyHydratedInvoice(): void
    {
        $invoice = $this->serviceProvider()->create(Invoice::class, $this->invoiceData(['id' => 'inv-2']));

        $model = $this->serviceProvider()->create(
            FindInvoice::class,
            ['invoices' => [$invoice]]
        );

        $this->assertSame($invoice, $model->getInvoices()[0]);
    }

    public function testConstructorWithNullValues(): void
    {
        $model = $this->serviceProvider()->create(FindInvoice::class, []);

        $this->assertNull($model->getInvoices());
        $this->assertNull($model->getTotal());
    }

    public function testSettersAndGetters(): void
    {
        $model   = $this->serviceProvider()->create(FindInvoice::class, []);
        $invoice = $this->serviceProvider()->create(Invoice::class, $this->invoiceData(['id' => 'inv-3']));

        $model->setInvoices([$invoice]);
        $model->setTotal(5);

        $this->assertSame([$invoice], $model->getInvoices());
        $this->assertSame(5, $model->getTotal());

        $model->setInvoices(null);
        $this->assertNull($model->getInvoices());
    }
}
