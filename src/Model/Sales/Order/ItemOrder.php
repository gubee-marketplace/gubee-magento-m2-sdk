<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Model\AbstractModel;

class ItemOrder extends AbstractModel
{
    protected string $skuId;

    protected int $qty;

    protected ?float $percentageOfTotal = null;

    protected ?string $sku = null;

    protected ?string $skuName = null;

    public function __construct(
        string $skuId,
        int $qty,
        ?float $percentageOfTotal = null,
        ?string $sku = null,
        ?string $skuName = null
    ) {
        $this->setSkuId($skuId);
        $this->setQty($qty);
        if ($percentageOfTotal !== null) {
            $this->setPercentageOfTotal($percentageOfTotal);
        }
        if ($sku !== null) {
            $this->setSku($sku);
        }
        if ($skuName !== null) {
            $this->setSkuName($skuName);
        }
    }

    public function getSkuId(): string
    {
        return $this->skuId;
    }

    public function setSkuId(string $skuId): self
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

    public function getPercentageOfTotal(): ?float
    {
        return $this->percentageOfTotal;
    }

    public function setPercentageOfTotal(?float $percentageOfTotal): self
    {
        $this->percentageOfTotal = $percentageOfTotal;
        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    public function getSkuName(): ?string
    {
        return $this->skuName;
    }

    public function setSkuName(?string $skuName): self
    {
        $this->skuName = $skuName;
        return $this;
    }
}
