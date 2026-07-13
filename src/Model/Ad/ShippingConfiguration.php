<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use Gubee\SDK\Model\AbstractModel;

class ShippingConfiguration extends AbstractModel
{
    protected string $key;

    protected string $value;

    public function __construct(
        string $key,
        string $value
    ) {
        $this->setKey($key);
        $this->setValue($value);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
