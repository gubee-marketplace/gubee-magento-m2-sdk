<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Sales\Order\DiscountApi;
use Gubee\SDK\Model\Sales\Order\ItemOrder;

use function is_array;

class ItemApi extends AbstractModel
{
    protected ?string $skuId = null;

    protected ?string $externalId = null;

    protected ?int $qty = null;

    /** @var array<ItemOrder>|null */

    protected ?array $subItems = null;

    protected ?float $originalPrice = null;

    protected ?float $salePrice = null;

    protected ?DiscountApi $discount = null;

    protected ?bool $fulfillment = null;

    protected ?string $warehouseId = null;

    protected ?string $sku = null;

    protected ?string $skuName = null;

    /**
     * @param array<ItemOrder|array<mixed>>|null $subItems
     * @param DiscountApi|array<mixed>|null $discount
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $skuId = null,
        ?string $externalId = null,
        ?int $qty = null,
        ?array $subItems = null,
        ?float $originalPrice = null,
        ?float $salePrice = null,
        DiscountApi|array|null $discount = null,
        ?bool $fulfillment = null,
        ?string $warehouseId = null,
        ?string $sku = null,
        ?string $skuName = null
    ) {
        if ($skuId !== null) {
            $this->setSkuId($skuId);
        }
        if ($externalId !== null) {
            $this->setExternalId($externalId);
        }
        if ($qty !== null) {
            $this->setQty($qty);
        }
        if ($subItems !== null) {
            foreach ($subItems as $key => $value) {
                if (is_array($value)) {
                    $subItems[$key] = $serviceProvider->create(
                        ItemOrder::class,
                        $value
                    );
                }
            }
            $this->setSubItems($subItems);
        }
        if ($originalPrice !== null) {
            $this->setOriginalPrice($originalPrice);
        }
        if ($salePrice !== null) {
            $this->setSalePrice($salePrice);
        }
        if ($discount !== null) {
            if (is_array($discount)) {
                $discount = $serviceProvider->create(
                    DiscountApi::class,
                    $discount
                );
            }
            $this->setDiscount($discount);
        }
        if ($fulfillment !== null) {
            $this->setFulfillment($fulfillment);
        }
        if ($warehouseId !== null) {
            $this->setWarehouseId($warehouseId);
        }
        if ($sku !== null) {
            $this->setSku($sku);
        }
        if ($skuName !== null) {
            $this->setSkuName($skuName);
        }
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

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): self
    {
        $this->externalId = $externalId;
        return $this;
    }

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(?int $qty): self
    {
        $this->qty = $qty;
        return $this;
    }

    /**
     * @return array<ItemOrder>|null
     */
    public function getSubItems(): ?array
    {
        return $this->subItems;
    }

    /**
     * @param array<ItemOrder> $subItems
     */
    public function setSubItems(?array $subItems): self
    {
        if ($subItems !== null) {
            $this->validateArrayElements($subItems, ItemOrder::class);
        }
        $this->subItems = $subItems;
        return $this;
    }

    public function getOriginalPrice(): ?float
    {
        return $this->originalPrice;
    }

    public function setOriginalPrice(?float $originalPrice): self
    {
        $this->originalPrice = $originalPrice;
        return $this;
    }

    public function getSalePrice(): ?float
    {
        return $this->salePrice;
    }

    public function setSalePrice(?float $salePrice): self
    {
        $this->salePrice = $salePrice;
        return $this;
    }

    public function getDiscount(): ?DiscountApi
    {
        return $this->discount;
    }

    public function setDiscount(?DiscountApi $discount): self
    {
        $this->discount = $discount;
        return $this;
    }

    public function getFulfillment(): ?bool
    {
        return $this->fulfillment;
    }

    public function setFulfillment(?bool $fulfillment): self
    {
        $this->fulfillment = $fulfillment;
        return $this;
    }

    public function getWarehouseId(): ?string
    {
        return $this->warehouseId;
    }

    public function setWarehouseId(?string $warehouseId): self
    {
        $this->warehouseId = $warehouseId;
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

    public function getSkuName(): ?string
    {
        return $this->skuName;
    }

    public function setSkuName(?string $skuName): self
    {
        $this->skuName = $skuName;
        return $this;
    }
}
