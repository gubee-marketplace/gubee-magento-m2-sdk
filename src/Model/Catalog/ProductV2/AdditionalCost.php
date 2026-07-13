<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\ProductV2;

use Gubee\SDK\Model\AbstractModel;

class AdditionalCost extends AbstractModel
{
    protected ?string $name = null;

    protected float $value;

    protected ?string $type = null;

    protected ?string $kind = null;

    public function __construct(
        ?string $name = null,
        float $value,
        ?string $type = null,
        ?string $kind = null
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        $this->setValue($value);
        if ($type !== null) {
            $this->setType($type);
        }
        if ($kind !== null) {
            $this->setKind($kind);
        }
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getKind(): ?string
    {
        return $this->kind;
    }

    public function setKind(?string $kind): self
    {
        $this->kind = $kind;
        return $this;
    }
}
