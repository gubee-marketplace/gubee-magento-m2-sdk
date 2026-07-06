<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\ProductV2;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\StatusEnum;
use Gubee\SDK\Enum\Catalog\Product\Variation\ConditionEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Attribute\AttributeValue;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\Image;

use function is_array;
use function is_string;

class Variation extends AbstractModel
{
    protected string $sku;
    protected bool $main;
    protected ?string $ean = null;
    protected string $name;
    protected ?string $description = null;
    protected ConditionEnum $condition;
    protected StatusEnum $status;
    protected string $warrantyTime;
    protected float $cost;
    protected Dimension $dimension;
    /** @var array<Price> */
    protected array $prices;
    /** @var array<Stock> */
    protected array $stocks;
    /** @var array<Image> */
    protected array $images;
    /** @var array<AttributeValue> */
    protected array $variantSpecification;

    /**
     * @param array<Price|array<mixed>> $prices
     * @param array<Stock|array<mixed>> $stocks
     * @param array<Image|array<mixed>> $images
     * @param array<AttributeValue|array<mixed>> $variantSpecification
     * @param float $cost
     * @param ConditionEnum|string $condition
     * @param StatusEnum|string $status
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $sku,
        bool $main,
        string $name,
        $condition,
        $status,
        string $warrantyTime,
        float $cost,
        Dimension $dimension,
        array $prices,
        array $stocks,
        array $images,
        array $variantSpecification,
        ?string $ean = null,
        ?string $description = null
    ) {
        $this->sku  = $sku;
        $this->main = $main;
        $this->name = $name;

        if (is_string($condition)) {
            $condition = ConditionEnum::fromValue($condition);
        }
        $this->condition = $condition;

        if (is_string($status)) {
            $status = StatusEnum::fromValue($status);
        }
        $this->status = $status;

        $this->warrantyTime = $warrantyTime;

        $this->cost = $cost;

        $this->dimension = $dimension;

        foreach ($prices as $key => $price) {
            if (is_array($price)) {
                $prices[$key] = $serviceProvider->create(Price::class, $price);
            }
        }
        $this->prices = $prices;

        foreach ($stocks as $key => $stock) {
            if (is_array($stock)) {
                $stocks[$key] = $serviceProvider->create(Stock::class, $stock);
            }
        }
        $this->stocks = $stocks;

        foreach ($images as $key => $image) {
            if (is_array($image)) {
                $images[$key] = $serviceProvider->create(Image::class, $image);
            }
        }
        $this->images = $images;

        foreach ($variantSpecification as $key => $spec) {
            if (is_array($spec)) {
                $variantSpecification[$key] = $serviceProvider->create(
                    AttributeValue::class,
                    $spec
                );
            }
        }
        $this->variantSpecification = $variantSpecification;

        if ($ean !== null) {
            $this->ean = $ean;
        }
        if ($description !== null) {
            $this->description = $description;
        }
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    public function getMain(): bool
    {
        return $this->main;
    }

    public function setMain(bool $main): self
    {
        $this->main = $main;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
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

    public function getCondition(): ConditionEnum
    {
        return $this->condition;
    }

    public function setCondition(ConditionEnum $condition): self
    {
        $this->condition = $condition;
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

    public function getWarrantyTime(): string
    {
        return $this->warrantyTime;
    }

    public function setWarrantyTime(string $warrantyTime): self
    {
        $this->warrantyTime = $warrantyTime;
        return $this;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public function setCost(float $cost): self
    {
        $this->cost = $cost;
        return $this;
    }

    public function getDimension(): Dimension
    {
        return $this->dimension;
    }

    public function setDimension(Dimension $dimension): self
    {
        $this->dimension = $dimension;
        return $this;
    }

    /**
     * @return array<Price>
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * @param array<Price> $prices
     */
    public function setPrices(array $prices): self
    {
        $this->validateArrayElements($prices, Price::class);
        $this->prices = $prices;
        return $this;
    }

    /**
     * @return array<Stock>
     */
    public function getStocks(): array
    {
        return $this->stocks;
    }

    /**
     * @param array<Stock> $stocks
     */
    public function setStocks(array $stocks): self
    {
        $this->validateArrayElements($stocks, Stock::class);
        $this->stocks = $stocks;
        return $this;
    }

    /**
     * @return array<Image>
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array<Image> $images
     */
    public function setImages(array $images): self
    {
        $this->validateArrayElements($images, Image::class);
        $this->images = $images;
        return $this;
    }

    /**
     * @return array<AttributeValue>
     */
    public function getVariantSpecification(): array
    {
        return $this->variantSpecification;
    }

    /**
     * @param array<AttributeValue> $variantSpecification
     */
    public function setVariantSpecification(array $variantSpecification): self
    {
        $this->validateArrayElements(
            $variantSpecification,
            AttributeValue::class
        );
        $this->variantSpecification = $variantSpecification;
        return $this;
    }
}
