<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Model\AbstractModel;

class DiscountApi extends AbstractModel
{
    protected ?float $discount = null;

    protected ?bool $percentage = null;

    public function __construct(
        ?float $discount = null,
        ?bool $percentage = null
    ) {
        if ($discount !== null) {
            $this->setDiscount($discount);
        }
        if ($percentage !== null) {
            $this->setPercentage($percentage);
        }
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;
        return $this;
    }

    public function getPercentage(): ?bool
    {
        return $this->percentage;
    }

    public function setPercentage(?bool $percentage): self
    {
        $this->percentage = $percentage;
        return $this;
    }
}
