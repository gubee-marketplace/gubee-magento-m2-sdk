<?php

declare(strict_types=1);

namespace Gubee\Integration\Model\Catalog\ProductV2;

use Gubee\SDK\Model\AbstractModel;

class Cost extends AbstractModel
{
    protected string $currency;
    protected float $amount;

    public function __construct(
        string $currency,
        float $amount
    ) {
        $this->currency = $currency;
        $this->amount   = $amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }
}
