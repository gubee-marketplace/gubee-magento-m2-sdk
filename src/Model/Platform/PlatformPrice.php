<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Enum\Ad\PriceTypeEnum;
use Gubee\SDK\Enum\Platform\StatusEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class PlatformPrice extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $platform = null;

    protected ?string $store = null;

    protected ?string $promotionId = null;

    protected float $value;

    protected ?DateTimeInterface $beginDt = null;

    protected ?DateTimeInterface $endDt = null;

    protected PriceTypeEnum $priceType;

    protected StatusEnum $status;

    public function __construct(
        ?string $id = null,
        ?string $platform = null,
        ?string $store = null,
        ?string $promotionId = null,
        float $value,
        string|DateTimeInterface|null $beginDt = null,
        string|DateTimeInterface|null $endDt = null,
        PriceTypeEnum|string $priceType,
        StatusEnum|string $status
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
        if (is_string($status)) {
            $status = StatusEnum::fromValue($status);
        }
        $this->setStatus($status);
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

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function setStatus(StatusEnum $status): self
    {
        $this->status = $status;
        return $this;
    }
}
