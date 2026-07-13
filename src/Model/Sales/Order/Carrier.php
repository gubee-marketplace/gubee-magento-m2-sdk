<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Common\Address;

use function is_array;

class Carrier extends AbstractModel
{
    protected ?string $cpfCnpj = null;

    protected ?string $name = null;

    protected ?string $stateRegistration = null;

    protected ?Address $address = null;

    /**
     * @param Address|array<mixed>|null $address
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $cpfCnpj = null,
        ?string $name = null,
        ?string $stateRegistration = null,
        Address|array|null $address = null
    ) {
        if ($cpfCnpj !== null) {
            $this->setCpfCnpj($cpfCnpj);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($stateRegistration !== null) {
            $this->setStateRegistration($stateRegistration);
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
    }

    public function getCpfCnpj(): ?string
    {
        return $this->cpfCnpj;
    }

    public function setCpfCnpj(?string $cpfCnpj): self
    {
        $this->cpfCnpj = $cpfCnpj;
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

    public function getStateRegistration(): ?string
    {
        return $this->stateRegistration;
    }

    public function setStateRegistration(?string $stateRegistration): self
    {
        $this->stateRegistration = $stateRegistration;
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
}
