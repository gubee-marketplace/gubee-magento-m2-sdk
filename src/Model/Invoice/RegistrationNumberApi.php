<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use Gubee\SDK\Model\AbstractModel;

class RegistrationNumberApi extends AbstractModel
{
    protected ?string $name = null;

    protected ?string $registrationNumber = null;

    public function __construct(
        ?string $name = null,
        ?string $registrationNumber = null
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        if ($registrationNumber !== null) {
            $this->setRegistrationNumber($registrationNumber);
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

    public function getRegistrationNumber(): ?string
    {
        return $this->registrationNumber;
    }

    public function setRegistrationNumber(?string $registrationNumber): self
    {
        $this->registrationNumber = $registrationNumber;
        return $this;
    }
}
