<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Enum\Ad\PriceTypeEnum;
use Gubee\SDK\Enum\Catalog\ProductV2\PriceCalculationTypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class PlatformPriceQuery extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $platform = null;

    protected ?string $store = null;

    protected ?string $promotionId = null;

    protected float $value;

    protected ?DateTimeInterface $beginDt = null;

    protected ?DateTimeInterface $endDt = null;

    protected PriceTypeEnum $priceType;

    protected ?PriceCalculationTypeEnum $priceCalculationType = null;

    protected bool $importedByApi;

    public function __construct(
        ?string $id = null,
        ?string $platform = null,
        ?string $store = null,
        ?string $promotionId = null,
        float $value,
        DateTimeInterface|string|null $beginDt = null,
        DateTimeInterface|string|null $endDt = null,
        PriceTypeEnum|string $priceType,
        PriceCalculationTypeEnum|string|null $priceCalculationType = null,
        bool $importedByApi
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        if ($platform !== null) {
            $this->setPlatform($platform);
        }
        if ($store !== null) {
            $this->setStore($store);
        }
        if ($promotionId !== null) {
            $this->setPromotionId($promotionId);
        }
        $this->setValue($value);
        if ($beginDt !== null) {
            if (! $beginDt instanceof DateTimeInterface) {
                $beginDt = new DateTime($beginDt);
            }
            $this->setBeginDt($beginDt);
        }
        if ($endDt !== null) {
            if (! $endDt instanceof DateTimeInterface) {
                $endDt = new DateTime($endDt);
            }
            $this->setEndDt($endDt);
        }
        if (is_string($priceType)) {
            $priceType = PriceTypeEnum::fromValue($priceType);
        }
        $this->setPriceType($priceType);
        if ($priceCalculationType !== null) {
            if (is_string($priceCalculationType)) {
                $priceCalculationType = PriceCalculationTypeEnum::fromValue($priceCalculationType);
            }
            $this->setPriceCalculationType($priceCalculationType);
        }
        $this->setImportedByApi($importedByApi);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(?string $platform): self
    {
        $this->platform = $platform;
        return $this;
    }

    public function getStore(): ?string
    {
        return $this->store;
    }

    public function setStore(?string $store): self
    {
        $this->store = $store;
        return $this;
    }

    public function getPromotionId(): ?string
    {
        return $this->promotionId;
    }

    public function setPromotionId(?string $promotionId): self
    {
        $this->promotionId = $promotionId;
        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getBeginDt(): ?DateTimeInterface
    {
        return $this->beginDt;
    }

    public function setBeginDt(?DateTimeInterface $beginDt): self
    {
        $this->beginDt = $beginDt;
        return $this;
    }

    public function getEndDt(): ?DateTimeInterface
    {
        return $this->endDt;
    }

    public function setEndDt(?DateTimeInterface $endDt): self
    {
        $this->endDt = $endDt;
        return $this;
    }

    public function getPriceType(): PriceTypeEnum
    {
        return $this->priceType;
    }

    public function setPriceType(PriceTypeEnum $priceType): self
    {
        $this->priceType = $priceType;
        return $this;
    }

    public function getPriceCalculationType(): ?PriceCalculationTypeEnum
    {
        return $this->priceCalculationType;
    }

    public function setPriceCalculationType(?PriceCalculationTypeEnum $priceCalculationType): self
    {
        $this->priceCalculationType = $priceCalculationType;
        return $this;
    }

    public function getImportedByApi(): bool
    {
        return $this->importedByApi;
    }

    public function setImportedByApi(bool $importedByApi): self
    {
        $this->importedByApi = $importedByApi;
        return $this;
    }
}
