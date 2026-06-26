<?php

declare(strict_types=1);

namespace Gubee\Integration\Model\Catalog\ProductV2;

use Gubee\SDK\Model\AbstractModel;

class Stock extends AbstractModel
{
    protected string $warehouseId;
    protected int $qty;
    protected int $priority;

    public function __construct(
        string $warehouseId,
        int $qty,
        int $priority
    ) {
        $this->warehouseId = $warehouseId;
        $this->qty         = $qty;
        $this->priority    = $priority;
    }

    public function getWarehouseId(): string
    {
        return $this->warehouseId;
    }

    public function setWarehouseId(string $warehouseId): self
    {
        $this->warehouseId = $warehouseId;
        return $this;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;
        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }
}
