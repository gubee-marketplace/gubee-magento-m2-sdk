<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Model\AbstractModel;

class LogisticTypeMappingEntryApi extends AbstractModel
{
    protected ?string $name = null;

    protected ?string $shippingMode = null;

    public function __construct(
        ?string $name = null,
        ?string $shippingMode = null
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        if ($shippingMode !== null) {
            $this->setShippingMode($shippingMode);
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

    public function getShippingMode(): ?string
    {
        return $this->shippingMode;
    }

    public function setShippingMode(?string $shippingMode): self
    {
        $this->shippingMode = $shippingMode;
        return $this;
    }
}
