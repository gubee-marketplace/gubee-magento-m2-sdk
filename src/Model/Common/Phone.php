<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Enum\Common\PhoneTypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class Phone extends AbstractModel
{
    protected ?int $ddd = null;

    protected ?string $number = null;

    protected ?PhoneTypeEnum $type = null;

    protected ?string $areaCode = null;

    protected ?string $extension = null;

    protected ?bool $verified = null;

    public function __construct(
        ?int $ddd = null,
        ?string $number = null,
        PhoneTypeEnum|string|null $type = null,
        ?string $areaCode = null,
        ?string $extension = null,
        ?bool $verified = null
    ) {
        if ($ddd !== null) {
            $this->setDdd($ddd);
        }
        if ($number !== null) {
            $this->setNumber($number);
        }
        if ($type !== null) {
            if (is_string($type)) {
                $type = PhoneTypeEnum::fromValue($type);
            }
            $this->setType($type);
        }
        if ($areaCode !== null) {
            $this->setAreaCode($areaCode);
        }
        if ($extension !== null) {
            $this->setExtension($extension);
        }
        if ($verified !== null) {
            $this->setVerified($verified);
        }
    }

    public function getDdd(): ?int
    {
        return $this->ddd;
    }

    public function setDdd(?int $ddd): self
    {
        $this->ddd = $ddd;
        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function getType(): ?PhoneTypeEnum
    {
        return $this->type;
    }

    public function setType(?PhoneTypeEnum $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getAreaCode(): ?string
    {
        return $this->areaCode;
    }

    public function setAreaCode(?string $areaCode): self
    {
        $this->areaCode = $areaCode;
        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(?string $extension): self
    {
        $this->extension = $extension;
        return $this;
    }

    public function getVerified(): ?bool
    {
        return $this->verified;
    }

    public function setVerified(?bool $verified): self
    {
        $this->verified = $verified;
        return $this;
    }
}
