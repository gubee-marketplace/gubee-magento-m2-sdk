<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Model\AbstractModel;

class StringValue extends AbstractModel
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->setValue($value);
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
