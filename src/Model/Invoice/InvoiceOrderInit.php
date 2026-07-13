<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use Gubee\SDK\Model\AbstractModel;

class InvoiceOrderInit extends AbstractModel
{
    protected ?string $orderId = null;

    protected ?string $storeId = null;

    public function __construct(
        ?string $orderId = null,
        ?string $storeId = null
    ) {
        if ($orderId !== null) {
            $this->setOrderId($orderId);
        }
        if ($storeId !== null) {
            $this->setStoreId($storeId);
        }
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrderId(?string $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getStoreId(): ?string
    {
        return $this->storeId;
    }

    public function setStoreId(?string $storeId): self
    {
        $this->storeId = $storeId;
        return $this;
    }
}
