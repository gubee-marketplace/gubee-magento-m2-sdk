<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource\Invoicer;

use Gubee\SDK\Model\Common\EmptyResult;
use Gubee\SDK\Model\Common\StringValue;
use Gubee\SDK\Model\Invoice\FindInvoice;
use Gubee\SDK\Model\Invoice\FindInvoiceBySellerId;
use Gubee\SDK\Model\Invoice\FindInvoiceFiltered;
use Gubee\SDK\Model\Invoice\InvoiceOrderInit;
use Gubee\SDK\Model\Invoicer\ComplementaryInvoice;
use Gubee\SDK\Model\Invoicer\DevolutionInvoice;
use Gubee\SDK\Model\Invoicer\ReversalInvoice;
use Gubee\SDK\Model\Sales\Order\Invoice;
use Gubee\SDK\Resource\AbstractResource;
use JsonSerializable;

use function rawurlencode;

class InvoiceResource extends AbstractResource
{
    public function saleInvoiceOrder(InvoiceOrderInit|array $payload): StringValue
    {
        $response = $this->post("/integration/invoicer/invoices/sale", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }

    public function reversalInvoiceOrder(ReversalInvoice|array $payload): EmptyResult
    {
        $this->post("/integration/invoicer/invoices/reversal", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function previewDanfe(InvoiceOrderInit|array $payload): StringValue
    {
        $response = $this->post("/integration/invoicer/invoices/preview-danfe", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }

    public function findAllPagedFiltered(FindInvoiceFiltered|array $payload): FindInvoice
    {
        $response = $this->post("/integration/invoicer/invoices/filtered", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            FindInvoice::class,
            $response
        );
    }

    public function devolutionInvoiceOrder(DevolutionInvoice|array $payload): StringValue
    {
        $response = $this->post("/integration/invoicer/invoices/devolution", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }

    public function sendCorrectionLetter(string $id, string $payload): EmptyResult
    {
        $this->post(
            "/integration/invoicer/invoices/correction-letter/" . rawurlencode($id) . "",
            $payload
        );
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function complementaryInvoice(ComplementaryInvoice|array $payload): StringValue
    {
        $response = $this->post("/integration/invoicer/invoices/complementary", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }

    public function findBySellerId(FindInvoiceBySellerId|array $payload): FindInvoice
    {
        $response = $this->post("/integration/invoicer/invoices/by-seller-id", $payload instanceof JsonSerializable ? $payload->jsonSerialize() : $payload);

        return $this->getClient()->getServiceProvider()->create(
            FindInvoice::class,
            $response
        );
    }

    public function findById_1(string $id): Invoice
    {
        $response = $this->get(
            "/integration/invoicer/invoices/" . rawurlencode($id) . ""
        );

        return $this->getClient()->getServiceProvider()->create(
            Invoice::class,
            $response
        );
    }

    public function requestInvoiceOrder(string $id): EmptyResult
    {
        $this->get(
            "/integration/invoicer/invoices/invoice-order/" . rawurlencode($id) . ""
        );
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function downloadDanfe(string $invoiceId): StringValue
    {
        $response = $this->get(
            "/integration/invoicer/invoices/download/danfe/path/" . rawurlencode($invoiceId) . ""
        );

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }

    public function getCorrectionLetterFile(string $id, string $type): StringValue
    {
        $query = [
            'type' => $type,
        ];

        $response = $this->get("/integration/invoicer/invoices/download/correction-letter/" . rawurlencode($id) . "", $query);

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }

    public function requestInvoiceAuthorization(string $id): EmptyResult
    {
        $this->get(
            "/integration/invoicer/invoices/authorize/" . rawurlencode($id) . ""
        );
        return $this->hydrateModel(EmptyResult::class, []);
    }

    public function cancelInvoice(string $id, string $payload): EmptyResult
    {
        $this->delete(
            "/integration/invoicer/invoices/cancel-invoice/" . rawurlencode($id) . "",
            $payload
        );
        return $this->hydrateModel(EmptyResult::class, []);
    }
}
