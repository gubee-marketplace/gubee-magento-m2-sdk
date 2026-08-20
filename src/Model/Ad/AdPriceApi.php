<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use DateTimeInterface;
use Gubee\SDK\Enum\Ad\PriceTypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class AdPriceApi extends AbstractModel
{
    protected string $sellerId;

    protected ?string $originSkuId = null;

    protected ?string $itemId = null;

    protected ?string $platform = null;

    protected PriceTypeEnum $priceType;

    protected float $value;

    protected ?string $createdBy = null;

    protected ?DateTimeInterface $beginDt = null;

    protected ?DateTimeInterface $endDt = null;

    /**
     * @param string|DateTimeInterface|null $beginDt
     * @param string|DateTimeInterface|null $endDt
     */
    public function __construct(
        string $sellerId,
        ?string $originSkuId = null,
        ?string $itemId = null,
        ?string $platform = null,
        PriceTypeEnum|string $priceType,
        float $value,
        ?string $createdBy = null,
        ?DateTimeInterface $beginDt = null,
        ?DateTimeInterface $endDt = null
    ) {
        $this->setSellerId($sellerId);
        if ($originSkuId !== null) {
            $this->setOriginSkuId($originSkuId);
        }
        if ($itemId !== null) {
            $this->setItemId($itemId);
        }
        if ($platform !== null) {
            $this->setPlatform($platform);
        }
        if (is_string($priceType)) {
            $priceType = PriceTypeEnum::fromValue($priceType);
        }
        $this->setPriceType($priceType);
        $this->setValue($value);
        if ($createdBy !== null) {
            $this->setCreatedBy($createdBy);
        }
        if ($beginDt !== null) {
            $this->setBeginDt($beginDt);
        }
        if ($endDt !== null) {
            $this->setEndDt($endDt);
        }
    }

    public function getSellerId(): string
    {
        return $this->sellerId;
    }

    public function setSellerId(string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getOriginSkuId(): ?string
    {
        return $this->originSkuId;
    }

    public function setOriginSkuId(?string $originSkuId): self
    {
        $this->originSkuId = $originSkuId;
        return $this;
    }

    public function getItemId(): ?string
    {
        return $this->itemId;
    }

    public function setItemId(?string $itemId): self
    {
        $this->itemId = $itemId;
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

    public function getPriceType(): PriceTypeEnum
    {
        return $this->priceType;
    }

    public function setPriceType(PriceTypeEnum $priceType): self
    {
        $this->priceType = $priceType;
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

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?string $createdBy): self
    {
        $this->createdBy = $createdBy;
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
}
