<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Model\AbstractModel;

class Address extends AbstractModel
{
    protected ?string $name = null;

    protected ?string $street = null;

    protected ?string $number = null;

    protected ?string $complement = null;

    protected ?string $reference = null;

    protected ?string $neighborhood = null;

    protected ?string $city = null;

    protected ?string $region = null;

    protected ?string $country = null;

    protected ?string $postCode = null;

    protected ?string $state = null;

    public function __construct(
        ?string $name = null,
        ?string $street = null,
        ?string $number = null,
        ?string $complement = null,
        ?string $reference = null,
        ?string $neighborhood = null,
        ?string $city = null,
        ?string $region = null,
        ?string $country = null,
        ?string $postCode = null,
        ?string $state = null
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        if ($street !== null) {
            $this->setStreet($street);
        }
        if ($number !== null) {
            $this->setNumber($number);
        }
        if ($complement !== null) {
            $this->setComplement($complement);
        }
        if ($reference !== null) {
            $this->setReference($reference);
        }
        if ($neighborhood !== null) {
            $this->setNeighborhood($neighborhood);
        }
        if ($city !== null) {
            $this->setCity($city);
        }
        if ($region !== null) {
            $this->setRegion($region);
        }
        if ($country !== null) {
            $this->setCountry($country);
        }
        if ($postCode !== null) {
            $this->setPostCode($postCode);
        }
        if ($state !== null) {
            $this->setState($state);
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

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;
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

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function setComplement(?string $complement): self
    {
        $this->complement = $complement;
        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    public function setNeighborhood(?string $neighborhood): self
    {
        $this->neighborhood = $neighborhood;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(?string $postCode): self
    {
        $this->postCode = $postCode;
        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;
        return $this;
    }
}
