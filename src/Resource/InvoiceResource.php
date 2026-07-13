<?php

declare(strict_types=1);

namespace Gubee\SDK\Resource;

use Gubee\SDK\Model\Common\StringValue;
use Gubee\SDK\Model\Invoice\InvoiceApiModel;
use Gubee\SDK\Resource\AbstractResource;

use function rawurlencode;

class InvoiceResource extends AbstractResource
{
    public function listInvoiceByOrderId(string $orderId): array
    {
        $response = $this->get(
            "/integration/invoices/list/" . rawurlencode($orderId) . ""
        );

        return $this->hydrateCollection(
            InvoiceApiModel::class,
            $response
        );
    }

    public function getDownloadUrl_1(string $invoiceId): StringValue
    {
        $response = $this->get(
            "/integration/invoices/download/" . rawurlencode($invoiceId) . ""
        );

        return $this->hydrateModel(
            StringValue::class,
            ['value' => (string) $response]
        );
    }
}
