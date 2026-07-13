<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Shipping;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Shipping\FreightTypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\Weight;
use Gubee\SDK\Model\Catalog\Product\Variation\SkuQtyApi;

use function is_array;
use function is_string;

class ShippingQuoteApi extends AbstractModel
{
    protected ?string $valueFreightId = null;

    protected ?string $freightServiceId = null;

    protected ?string $freightServiceName = null;

    protected ?FreightTypeEnum $freightType = null;

    protected int $deliveryTime;

    protected int $deadlineDays;

    protected ?string $carrierId = null;

    protected ?string $carrierName = null;

    protected ?Weight $weight = null;

    protected ?float $shippingCost = null;

    protected ?SkuQtyApi $skuQty = null;

    /**
     * @param Weight|array<mixed>|null $weight
     * @param SkuQtyApi|array<mixed>|null $skuQty
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $valueFreightId = null,
        ?string $freightServiceId = null,
        ?string $freightServiceName = null,
        FreightTypeEnum|string|null $freightType = null,
        int $deliveryTime = 0,
        int $deadlineDays = 0,
        ?string $carrierId = null,
        ?string $carrierName = null,
        Weight|array|null $weight = null,
        ?float $shippingCost = null,
        SkuQtyApi|array|null $skuQty = null
    ) {
        if ($valueFreightId !== null) {
            $this->setValueFreightId($valueFreightId);
        }
        if ($freightServiceId !== null) {
            $this->setFreightServiceId($freightServiceId);
        }
        if ($freightServiceName !== null) {
            $this->setFreightServiceName($freightServiceName);
        }
        if ($freightType !== null) {
            if (is_string($freightType)) {
                $freightType = FreightTypeEnum::fromValue($freightType);
            }
            $this->setFreightType($freightType);
        }
        $this->setDeliveryTime($deliveryTime);
        $this->setDeadlineDays($deadlineDays);
        if ($carrierId !== null) {
            $this->setCarrierId($carrierId);
        }
        if ($carrierName !== null) {
            $this->setCarrierName($carrierName);
        }
        if ($weight !== null) {
            if (is_array($weight)) {
                $weight = $serviceProvider->create(
                    Weight::class,
                    $weight
                );
            }
            $this->setWeight($weight);
        }
        if ($shippingCost !== null) {
            $this->setShippingCost($shippingCost);
        }
        if ($skuQty !== null) {
            if (is_array($skuQty)) {
                $skuQty = $serviceProvider->create(
                    SkuQtyApi::class,
                    $skuQty
                );
            }
            $this->setSkuQty($skuQty);
        }
    }

    public function getValueFreightId(): ?string
    {
        return $this->valueFreightId;
    }

    public function setValueFreightId(?string $valueFreightId): self
    {
        $this->valueFreightId = $valueFreightId;
        return $this;
    }

    public function getFreightServiceId(): ?string
    {
        return $this->freightServiceId;
    }

    public function setFreightServiceId(?string $freightServiceId): self
    {
        $this->freightServiceId = $freightServiceId;
        return $this;
    }

    public function getFreightServiceName(): ?string
    {
        return $this->freightServiceName;
    }

    public function setFreightServiceName(?string $freightServiceName): self
    {
        $this->freightServiceName = $freightServiceName;
        return $this;
    }

    public function getFreightType(): ?FreightTypeEnum
    {
        return $this->freightType;
    }

    public function setFreightType(?FreightTypeEnum $freightType): self
    {
        $this->freightType = $freightType;
        return $this;
    }

    public function getDeliveryTime(): int
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(int $deliveryTime): self
    {
        $this->deliveryTime = $deliveryTime;
        return $this;
    }

    public function getDeadlineDays(): int
    {
        return $this->deadlineDays;
    }

    public function setDeadlineDays(int $deadlineDays): self
    {
        $this->deadlineDays = $deadlineDays;
        return $this;
    }

    public function getCarrierId(): ?string
    {
        return $this->carrierId;
    }

    public function setCarrierId(?string $carrierId): self
    {
        $this->carrierId = $carrierId;
        return $this;
    }

    public function getCarrierName(): ?string
    {
        return $this->carrierName;
    }

    public function setCarrierName(?string $carrierName): self
    {
        $this->carrierName = $carrierName;
        return $this;
    }

    public function getWeight(): ?Weight
    {
        return $this->weight;
    }

    public function setWeight(?Weight $weight): self
    {
        $this->weight = $weight;
        return $this;
    }

    public function getShippingCost(): ?float
    {
        return $this->shippingCost;
    }

    public function setShippingCost(?float $shippingCost): self
    {
        $this->shippingCost = $shippingCost;
        return $this;
    }

    public function getSkuQty(): ?SkuQtyApi
    {
        return $this->skuQty;
    }

    public function setSkuQty(?SkuQtyApi $skuQty): self
    {
        $this->skuQty = $skuQty;
        return $this;
    }
}
