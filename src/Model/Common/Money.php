<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Model\AbstractModel;

class Money extends AbstractModel
{
    protected ?string $currency = null;

    protected ?float $amount = null;

    public function __construct(
        ?string $currency = null,
        ?float $amount = null
    ) {
        if ($currency !== null) {
            $this->setCurrency($currency);
        }
        if ($amount !== null) {
            $this->setAmount($amount);
        }
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }
}
