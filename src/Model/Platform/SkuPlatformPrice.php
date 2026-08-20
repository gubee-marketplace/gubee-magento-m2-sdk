<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Platform\DomainTypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Platform\PlatformPrice;

use function is_array;
use function is_string;

class SkuPlatformPrice extends AbstractModel
{
    protected ?PlatformPrice $defaultPrice = null;

    protected ?PlatformPrice $promotionPrice = null;

    /** @var array<PlatformPrice>|null */

    protected ?array $scheduledPromotionPrices = null;

    protected string $skuPriceId;

    protected string $sellerId;

    protected string $itemId;

    protected ?string $sku = null;

    protected ?string $platform = null;

    protected ?string $store = null;

    protected DomainTypeEnum $domain;

    protected ?string $createdBy = null;

    protected ?DateTimeInterface $createdDt = null;

    protected ?DateTimeInterface $lastModifiedDt = null;

    /**
     * @param PlatformPrice|array<mixed>|null $defaultPrice
     * @param PlatformPrice|array<mixed>|null $promotionPrice
     * @param array<PlatformPrice|array<mixed>>|null $scheduledPromotionPrices
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        PlatformPrice|array|null $defaultPrice = null,
        PlatformPrice|array|null $promotionPrice = null,
        ?array $scheduledPromotionPrices = null,
        string $skuPriceId,
        string $sellerId,
        string $itemId,
        ?string $sku = null,
        ?string $platform = null,
        ?string $store = null,
        DomainTypeEnum|string $domain,
        ?string $createdBy = null,
        DateTimeInterface|string|null $createdDt = null,
        DateTimeInterface|string|null $lastModifiedDt = null
    ) {
        if ($defaultPrice !== null) {
            if (is_array($defaultPrice)) {
                $defaultPrice = $serviceProvider->create(
                    PlatformPrice::class,
                    $defaultPrice
                );
            }
            $this->setDefaultPrice($defaultPrice);
        }
        if ($promotionPrice !== null) {
            if (is_array($promotionPrice)) {
                $promotionPrice = $serviceProvider->create(
                    PlatformPrice::class,
                    $promotionPrice
                );
            }
            $this->setPromotionPrice($promotionPrice);
        }
        if ($scheduledPromotionPrices !== null) {
            foreach ($scheduledPromotionPrices as $key => $value) {
                if (is_array($value)) {
                    $scheduledPromotionPrices[$key] = $serviceProvider->create(
                        PlatformPrice::class,
                        $value
                    );
                }
            }
            $this->setScheduledPromotionPrices($scheduledPromotionPrices);
        }
        $this->setSkuPriceId($skuPriceId);
        $this->setSellerId($sellerId);
        $this->setItemId($itemId);
        if ($sku !== null) {
            $this->setSku($sku);
        }
        if ($platform !== null) {
            $this->setPlatform($platform);
        }
        if ($store !== null) {
            $this->setStore($store);
        }
        if (is_string($domain)) {
            $domain = DomainTypeEnum::fromValue($domain);
        }
        $this->setDomain($domain);
        if ($createdBy !== null) {
            $this->setCreatedBy($createdBy);
        }
        if ($createdDt !== null) {
            if (! $createdDt instanceof DateTimeInterface) {
                $createdDt = new DateTime($createdDt);
            }
            $this->setCreatedDt($createdDt);
        }
        if ($lastModifiedDt !== null) {
            if (! $lastModifiedDt instanceof DateTimeInterface) {
                $lastModifiedDt = new DateTime($lastModifiedDt);
            }
            $this->setLastModifiedDt($lastModifiedDt);
        }
    }

    public function getDefaultPrice(): ?PlatformPrice
    {
        return $this->defaultPrice;
    }

    public function setDefaultPrice(?PlatformPrice $defaultPrice): self
    {
        $this->defaultPrice = $defaultPrice;
        return $this;
    }

    public function getPromotionPrice(): ?PlatformPrice
    {
        return $this->promotionPrice;
    }

    public function setPromotionPrice(?PlatformPrice $promotionPrice): self
    {
        $this->promotionPrice = $promotionPrice;
        return $this;
    }

    /**
     * @return array<PlatformPrice>|null
     */
    public function getScheduledPromotionPrices(): ?array
    {
        return $this->scheduledPromotionPrices;
    }

    /**
     * @param array<PlatformPrice> $scheduledPromotionPrices
     */
    public function setScheduledPromotionPrices(?array $scheduledPromotionPrices): self
    {
        if ($scheduledPromotionPrices !== null) {
            $this->validateArrayElements($scheduledPromotionPrices, PlatformPrice::class);
        }
        $this->scheduledPromotionPrices = $scheduledPromotionPrices;
        return $this;
    }

    public function getSkuPriceId(): string
    {
        return $this->skuPriceId;
    }

    public function setSkuPriceId(string $skuPriceId): self
    {
        $this->skuPriceId = $skuPriceId;
        return $this;
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

    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function setItemId(string $itemId): self
    {
        $this->itemId = $itemId;
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

    public function getDomain(): DomainTypeEnum
    {
        return $this->domain;
    }

    public function setDomain(DomainTypeEnum $domain): self
    {
        $this->domain = $domain;
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

    public function getCreatedDt(): ?DateTimeInterface
    {
        return $this->createdDt;
    }

    public function setCreatedDt(?DateTimeInterface $createdDt): self
    {
        $this->createdDt = $createdDt;
        return $this;
    }

    public function getLastModifiedDt(): ?DateTimeInterface
    {
        return $this->lastModifiedDt;
    }

    public function setLastModifiedDt(?DateTimeInterface $lastModifiedDt): self
    {
        $this->lastModifiedDt = $lastModifiedDt;
        return $this;
    }
}
