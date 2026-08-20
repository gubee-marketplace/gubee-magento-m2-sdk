<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use Gubee\SDK\Model\AbstractModel;

class ISSQNCalculation extends AbstractModel
{
    protected ?string $municipalRegistration = null;

    protected ?float $totalServiceValue = null;

    protected ?float $issqnCalculationBase = null;

    protected ?float $issqnValue = null;

    public function __construct(
        ?string $municipalRegistration = null,
        ?float $totalServiceValue = null,
        ?float $issqnCalculationBase = null,
        ?float $issqnValue = null
    ) {
        if ($municipalRegistration !== null) {
            $this->setMunicipalRegistration($municipalRegistration);
        }
        if ($totalServiceValue !== null) {
            $this->setTotalServiceValue($totalServiceValue);
        }
        if ($issqnCalculationBase !== null) {
            $this->setIssqnCalculationBase($issqnCalculationBase);
        }
        if ($issqnValue !== null) {
            $this->setIssqnValue($issqnValue);
        }
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

    public function getTotalServiceValue(): ?float
    {
        return $this->totalServiceValue;
    }

    public function setTotalServiceValue(?float $totalServiceValue): self
    {
        $this->totalServiceValue = $totalServiceValue;
        return $this;
    }

    public function getIssqnCalculationBase(): ?float
    {
        return $this->issqnCalculationBase;
    }

    public function setIssqnCalculationBase(?float $issqnCalculationBase): self
    {
        $this->issqnCalculationBase = $issqnCalculationBase;
        return $this;
    }

    public function getIssqnValue(): ?float
    {
        return $this->issqnValue;
    }

    public function setIssqnValue(?float $issqnValue): self
    {
        $this->issqnValue = $issqnValue;
        return $this;
    }
}
