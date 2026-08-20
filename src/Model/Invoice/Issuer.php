<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Common\Address;
use Gubee\SDK\Model\Common\Phone;

use function is_array;

class Issuer extends AbstractModel
{
    protected ?string $name = null;

    protected ?string $fantasyName = null;

    protected ?Address $address = null;

    protected ?string $cnpj = null;

    protected ?Phone $phone = null;

    protected ?string $stateRegistration = null;

    protected ?string $municipalRegistration = null;

    /**
     * @param Address|array<mixed>|null $address
     * @param Phone|array<mixed>|null $phone
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $name = null,
        ?string $fantasyName = null,
        Address|array|null $address = null,
        ?string $cnpj = null,
        Phone|array|null $phone = null,
        ?string $stateRegistration = null,
        ?string $municipalRegistration = null
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        if ($fantasyName !== null) {
            $this->setFantasyName($fantasyName);
        }
        if ($address !== null) {
            if (is_array($address)) {
                $address = $serviceProvider->create(
                    Address::class,
                    $address
                );
            }
            $this->setAddress($address);
        }
        if ($cnpj !== null) {
            $this->setCnpj($cnpj);
        }
        if ($phone !== null) {
            if (is_array($phone)) {
                $phone = $serviceProvider->create(
                    Phone::class,
                    $phone
                );
            }
            $this->setPhone($phone);
        }
        if ($stateRegistration !== null) {
            $this->setStateRegistration($stateRegistration);
        }
        if ($municipalRegistration !== null) {
            $this->setMunicipalRegistration($municipalRegistration);
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

    public function getFantasyName(): ?string
    {
        return $this->fantasyName;
    }

    public function setFantasyName(?string $fantasyName): self
    {
        $this->fantasyName = $fantasyName;
        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(?string $cnpj): self
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getPhone(): ?Phone
    {
        return $this->phone;
    }

    public function setPhone(?Phone $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getStateRegistration(): ?string
    {
        return $this->stateRegistration;
    }

    public function setStateRegistration(?string $stateRegistration): self
    {
        $this->stateRegistration = $stateRegistration;
        return $this;
    }

    public function getMunicipalRegistration(): ?string
    {
        return $this->municipalRegistration;
    }

    public function setMunicipalRegistration(?string $municipalRegistration): self
    {
        $this->municipalRegistration = $municipalRegistration;
        return $this;
    }
}
