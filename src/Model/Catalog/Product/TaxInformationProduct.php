<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product;

use Gubee\SDK\Enum\Catalog\Product\OriginEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class TaxInformationProduct extends AbstractModel
{
    protected ?string $name = null;

    protected ?string $skuId = null;

    protected ?string $sku = null;

    protected ?string $ncm = null;

    protected ?OriginEnum $origin = null;

    protected ?float $value = null;

    protected ?string $description = null;

    protected ?string $commercialUnit = null;

    protected ?string $cest = null;

    protected ?float $icmsStRetainedBase = null;

    protected ?float $icmsStRetainedValue = null;

    protected ?float $icmsStBaseCalculation = null;

    protected ?float $icmsStRetainedBaseCalculation = null;

    protected ?string $ipiProducerCnpj = null;

    protected ?string $ipiControlSealCode = null;

    public function __construct(
        ?string $name = null,
        ?string $skuId = null,
        ?string $sku = null,
        ?string $ncm = null,
        OriginEnum|string|null $origin = null,
        ?float $value = null,
        ?string $description = null,
        ?string $commercialUnit = null,
        ?string $cest = null,
        ?float $icmsStRetainedBase = null,
        ?float $icmsStRetainedValue = null,
        ?float $icmsStBaseCalculation = null,
        ?float $icmsStRetainedBaseCalculation = null,
        ?string $ipiProducerCnpj = null,
        ?string $ipiControlSealCode = null
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        if ($skuId !== null) {
            $this->setSkuId($skuId);
        }
        if ($sku !== null) {
            $this->setSku($sku);
        }
        if ($ncm !== null) {
            $this->setNcm($ncm);
        }
        if ($origin !== null) {
            if (is_string($origin)) {
                $origin = OriginEnum::fromValue($origin);
            }
            $this->setOrigin($origin);
        }
        if ($value !== null) {
            $this->setValue($value);
        }
        if ($description !== null) {
            $this->setDescription($description);
        }
        if ($commercialUnit !== null) {
            $this->setCommercialUnit($commercialUnit);
        }
        if ($cest !== null) {
            $this->setCest($cest);
        }
        if ($icmsStRetainedBase !== null) {
            $this->setIcmsStRetainedBase($icmsStRetainedBase);
        }
        if ($icmsStRetainedValue !== null) {
            $this->setIcmsStRetainedValue($icmsStRetainedValue);
        }
        if ($icmsStBaseCalculation !== null) {
            $this->setIcmsStBaseCalculation($icmsStBaseCalculation);
        }
        if ($icmsStRetainedBaseCalculation !== null) {
            $this->setIcmsStRetainedBaseCalculation($icmsStRetainedBaseCalculation);
        }
        if ($ipiProducerCnpj !== null) {
            $this->setIpiProducerCnpj($ipiProducerCnpj);
        }
        if ($ipiControlSealCode !== null) {
            $this->setIpiControlSealCode($ipiControlSealCode);
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

    public function getSkuId(): ?string
    {
        return $this->skuId;
    }

    public function setSkuId(?string $skuId): self
    {
        $this->skuId = $skuId;
        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    public function getNcm(): ?string
    {
        return $this->ncm;
    }

    public function setNcm(?string $ncm): self
    {
        $this->ncm = $ncm;
        return $this;
    }

    public function getOrigin(): ?OriginEnum
    {
        return $this->origin;
    }

    public function setOrigin(?OriginEnum $origin): self
    {
        $this->origin = $origin;
        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCommercialUnit(): ?string
    {
        return $this->commercialUnit;
    }

    public function setCommercialUnit(?string $commercialUnit): self
    {
        $this->commercialUnit = $commercialUnit;
        return $this;
    }

    public function getCest(): ?string
    {
        return $this->cest;
    }

    public function setCest(?string $cest): self
    {
        $this->cest = $cest;
        return $this;
    }

    public function getIcmsStRetainedBase(): ?float
    {
        return $this->icmsStRetainedBase;
    }

    public function setIcmsStRetainedBase(?float $icmsStRetainedBase): self
    {
        $this->icmsStRetainedBase = $icmsStRetainedBase;
        return $this;
    }

    public function getIcmsStRetainedValue(): ?float
    {
        return $this->icmsStRetainedValue;
    }

    public function setIcmsStRetainedValue(?float $icmsStRetainedValue): self
    {
        $this->icmsStRetainedValue = $icmsStRetainedValue;
        return $this;
    }

    public function getIcmsStBaseCalculation(): ?float
    {
        return $this->icmsStBaseCalculation;
    }

    public function setIcmsStBaseCalculation(?float $icmsStBaseCalculation): self
    {
        $this->icmsStBaseCalculation = $icmsStBaseCalculation;
        return $this;
    }

    public function getIcmsStRetainedBaseCalculation(): ?float
    {
        return $this->icmsStRetainedBaseCalculation;
    }

    public function setIcmsStRetainedBaseCalculation(?float $icmsStRetainedBaseCalculation): self
    {
        $this->icmsStRetainedBaseCalculation = $icmsStRetainedBaseCalculation;
        return $this;
    }

    public function getIpiProducerCnpj(): ?string
    {
        return $this->ipiProducerCnpj;
    }

    public function setIpiProducerCnpj(?string $ipiProducerCnpj): self
    {
        $this->ipiProducerCnpj = $ipiProducerCnpj;
        return $this;
    }

    public function getIpiControlSealCode(): ?string
    {
        return $this->ipiControlSealCode;
    }

    public function setIpiControlSealCode(?string $ipiControlSealCode): self
    {
        $this->ipiControlSealCode = $ipiControlSealCode;
        return $this;
    }
}
