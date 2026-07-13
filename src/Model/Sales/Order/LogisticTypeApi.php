<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Model\AbstractModel;

class LogisticTypeApi extends AbstractModel
{
    protected ?string $name = null;

    protected ?string $shippingId = null;

    protected ?string $shippingMode = null;

    public function __construct(
        ?string $name = null,
        ?string $shippingId = null,
        ?string $shippingMode = null
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        if ($shippingId !== null) {
            $this->setShippingId($shippingId);
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

    public function getShippingId(): ?string
    {
        return $this->shippingId;
    }

    public function setShippingId(?string $shippingId): self
    {
        $this->shippingId = $shippingId;
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
