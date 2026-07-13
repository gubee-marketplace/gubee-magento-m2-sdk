<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Attribute;

use Gubee\SDK\Model\AbstractModel;

class OriginCountry extends AbstractModel
{
    protected ?string $name = null;

    protected ?string $alpha2Code = null;

    protected ?string $alpha3Code = null;

    public function __construct(
        ?string $name = null,
        ?string $alpha2Code = null,
        ?string $alpha3Code = null
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        if ($alpha2Code !== null) {
            $this->setAlpha2Code($alpha2Code);
        }
        if ($alpha3Code !== null) {
            $this->setAlpha3Code($alpha3Code);
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

    public function getAlpha2Code(): ?string
    {
        return $this->alpha2Code;
    }

    public function setAlpha2Code(?string $alpha2Code): self
    {
        $this->alpha2Code = $alpha2Code;
        return $this;
    }

    public function getAlpha3Code(): ?string
    {
        return $this->alpha3Code;
    }

    public function setAlpha3Code(?string $alpha3Code): self
    {
        $this->alpha3Code = $alpha3Code;
        return $this;
    }
}
