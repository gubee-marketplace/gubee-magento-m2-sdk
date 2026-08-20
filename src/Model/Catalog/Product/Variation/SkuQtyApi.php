<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Model\AbstractModel;

class SkuQtyApi extends AbstractModel
{
    protected ?string $skuId = null;

    protected int $qty;

    protected int $stockQty;

    protected int $handlingTime;

    protected int $crossDockingTime;

    public function __construct(
        ?string $skuId = null,
        int $qty,
        int $stockQty,
        int $handlingTime,
        int $crossDockingTime
    ) {
        if ($skuId !== null) {
            $this->setSkuId($skuId);
        }
        $this->setQty($qty);
        $this->setStockQty($stockQty);
        $this->setHandlingTime($handlingTime);
        $this->setCrossDockingTime($crossDockingTime);
    }

    public function getSkuId(): ?string
    {
        return $this->skuId;
    }

    public function setSkuId(?string $skuId): self
    {
        $this->skuId = $skuId;
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

    public function getStockQty(): int
    {
        return $this->stockQty;
    }

    public function setStockQty(int $stockQty): self
    {
        $this->stockQty = $stockQty;
        return $this;
    }

    public function getHandlingTime(): int
    {
        return $this->handlingTime;
    }

    public function setHandlingTime(int $handlingTime): self
    {
        $this->handlingTime = $handlingTime;
        return $this;
    }

    public function getCrossDockingTime(): int
    {
        return $this->crossDockingTime;
    }

    public function setCrossDockingTime(int $crossDockingTime): self
    {
        $this->crossDockingTime = $crossDockingTime;
        return $this;
    }
}
