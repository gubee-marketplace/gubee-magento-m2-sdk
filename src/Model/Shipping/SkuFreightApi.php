<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Shipping;

use Gubee\SDK\Model\AbstractModel;

class SkuFreightApi extends AbstractModel
{
    protected ?string $skuId = null;

    protected ?int $qty = null;

    public function __construct(
        ?string $skuId = null,
        ?int $qty = null
    ) {
        if ($skuId !== null) {
            $this->setSkuId($skuId);
        }
        if ($qty !== null) {
            $this->setQty($qty);
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

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(?int $qty): self
    {
        $this->qty = $qty;
        return $this;
    }
}
