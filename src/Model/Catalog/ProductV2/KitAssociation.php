<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\ProductV2;

use Gubee\SDK\Model\AbstractModel;

class KitAssociation extends AbstractModel
{
    protected ?string $skuId = null;

    protected int $qty;

    protected ?float $percentageOfTotal = null;

    public function __construct(
        ?string $skuId = null,
        int $qty,
        ?float $percentageOfTotal = null
    ) {
        if ($skuId !== null) {
            $this->setSkuId($skuId);
        }
        $this->setQty($qty);
        if ($percentageOfTotal !== null) {
            $this->setPercentageOfTotal($percentageOfTotal);
        }
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

    public function getPercentageOfTotal(): ?float
    {
        return $this->percentageOfTotal;
    }

    public function setPercentageOfTotal(?float $percentageOfTotal): self
    {
        $this->percentageOfTotal = $percentageOfTotal;
        return $this;
    }
}
