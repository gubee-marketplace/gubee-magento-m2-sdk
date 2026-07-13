<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\UnitTime;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\Image;
use Gubee\SDK\Model\Catalog\ProductV2\SellerCostComponent;
use Gubee\SDK\Model\Common\Money;

use function is_array;

class PatchVariation extends AbstractModel
{
    protected ?string $sellerId = null;

    protected ?Money $cost = null;

    protected ?string $ean = null;

    protected ?UnitTime $warrantyTime = null;

    protected ?UnitTime $handlingTime = null;

    protected ?Dimension $dimension = null;

    protected ?string $name = null;

    /** @var array<Image>|null */

    protected ?array $images = null;

    /** @var array<SellerCostComponent>|null */

    protected ?array $additionalCosts = null;

    /**
     * @param Money|array<mixed>|null $cost
     * @param UnitTime|array<mixed>|null $warrantyTime
     * @param UnitTime|array<mixed>|null $handlingTime
     * @param Dimension|array<mixed>|null $dimension
     * @param array<Image|array<mixed>>|null $images
     * @param array<SellerCostComponent|array<mixed>>|null $additionalCosts
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $sellerId = null,
        Money|array|null $cost = null,
        ?string $ean = null,
        UnitTime|array|null $warrantyTime = null,
        UnitTime|array|null $handlingTime = null,
        Dimension|array|null $dimension = null,
        ?string $name = null,
        ?array $images = null,
        ?array $additionalCosts = null
    ) {
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($cost !== null) {
            if (is_array($cost)) {
                $cost = $serviceProvider->create(
                    Money::class,
                    $cost
                );
            }
            $this->setCost($cost);
        }
        if ($ean !== null) {
            $this->setEan($ean);
        }
        if ($warrantyTime !== null) {
            if (is_array($warrantyTime)) {
                $warrantyTime = $serviceProvider->create(
                    UnitTime::class,
                    $warrantyTime
                );
            }
            $this->setWarrantyTime($warrantyTime);
        }
        if ($handlingTime !== null) {
            if (is_array($handlingTime)) {
                $handlingTime = $serviceProvider->create(
                    UnitTime::class,
                    $handlingTime
                );
            }
            $this->setHandlingTime($handlingTime);
        }
        if ($dimension !== null) {
            if (is_array($dimension)) {
                $dimension = $serviceProvider->create(
                    Dimension::class,
                    $dimension
                );
            }
            $this->setDimension($dimension);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($images !== null) {
            foreach ($images as $key => $value) {
                if (is_array($value)) {
                    $images[$key] = $serviceProvider->create(
                        Image::class,
                        $value
                    );
                }
            }
            $this->setImages($images);
        }
        if ($additionalCosts !== null) {
            foreach ($additionalCosts as $key => $value) {
                if (is_array($value)) {
                    $additionalCosts[$key] = $serviceProvider->create(
                        SellerCostComponent::class,
                        $value
                    );
                }
            }
            $this->setAdditionalCosts($additionalCosts);
        }
    }

    public function getSellerId(): ?string
    {
        return $this->sellerId;
    }

    public function setSellerId(?string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getCost(): ?Money
    {
        return $this->cost;
    }

    public function setCost(?Money $cost): self
    {
        $this->cost = $cost;
        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): self
    {
        $this->ean = $ean;
        return $this;
    }

    public function getWarrantyTime(): ?UnitTime
    {
        return $this->warrantyTime;
    }

    public function setWarrantyTime(?UnitTime $warrantyTime): self
    {
        $this->warrantyTime = $warrantyTime;
        return $this;
    }

    public function getHandlingTime(): ?UnitTime
    {
        return $this->handlingTime;
    }

    public function setHandlingTime(?UnitTime $handlingTime): self
    {
        $this->handlingTime = $handlingTime;
        return $this;
    }

    public function getDimension(): ?Dimension
    {
        return $this->dimension;
    }

    public function setDimension(?Dimension $dimension): self
    {
        $this->dimension = $dimension;
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

    /**
     * @return array<Image>|null
     */
    public function getImages(): ?array
    {
        return $this->images;
    }

    /**
     * @param array<Image> $images
     */
    public function setImages(?array $images): self
    {
        if ($images !== null) {
            $this->validateArrayElements($images, Image::class);
        }
        $this->images = $images;
        return $this;
    }

    /**
     * @return array<SellerCostComponent>|null
     */
    public function getAdditionalCosts(): ?array
    {
        return $this->additionalCosts;
    }

    /**
     * @param array<SellerCostComponent> $additionalCosts
     */
    public function setAdditionalCosts(?array $additionalCosts): self
    {
        if ($additionalCosts !== null) {
            $this->validateArrayElements($additionalCosts, SellerCostComponent::class);
        }
        $this->additionalCosts = $additionalCosts;
        return $this;
    }
}
