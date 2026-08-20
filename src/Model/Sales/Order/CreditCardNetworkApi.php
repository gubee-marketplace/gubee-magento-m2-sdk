<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Model\AbstractModel;

class CreditCardNetworkApi extends AbstractModel
{
    protected ?string $code = null;

    protected ?string $name = null;

    public function __construct(
        ?string $code = null,
        ?string $name = null
    ) {
        if ($code !== null) {
            $this->setCode($code);
        }
        if ($name !== null) {
            $this->setName($name);
        }
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;
        return $this;
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
}
