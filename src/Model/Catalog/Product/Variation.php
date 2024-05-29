<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\StatusEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Attribute\AttributeValue;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension\UnitTime;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\Image;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;
use Gubee\SDK\Model\Catalog\Product\Variation\Stock;

use function is_array;
use function is_string;

class Variation extends AbstractModel
{
    protected string $skuId;
    /** @var array<Image> */
    protected array $images;
    protected Dimension $dimension;
    protected UnitTime $handlingTime;
    protected string $name;
    protected string $sku;
    protected UnitTime $warrantyTime;
    protected ?float $cost         = null;
    protected ?string $description = null;
    protected ?string $ean         = null;
    protected ?bool $main          = null;
    /** @var array<Price> */
    protected ?array $prices      = null;
    protected ?StatusEnum $status = null;
    /** @var array<Stock> */
    protected ?array $stocks = null;
    /** @var array<AttributeValue> */
    protected ?array $variantSpecification = null;

    /**
     * @param array<Image|array<mixed>> $images
     * @param array<Price|array<mixed>>|null $prices
     * @param StatusEnum|string $status
     * @param array<Stock|array<mixed>>|null $stocks
     * @param array<AttributeValue|array<mixed>>|null $variantSpecification
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $skuId,
        array $images,
        Dimension $dimension,
        UnitTime $handlingTime,
        string $name,
        string $sku,
        UnitTime $warrantyTime,
        ?float $cost = null,
        ?string $description = null,
        ?string $ean = null,
        ?bool $main = false,
        ?array $prices = null,
        $status = null,
        ?array $stocks = null,
        ?array $variantSpecification = null
    ) {
        $this->setSkuId($skuId);

        foreach ($images as $key => $image) {
            if (is_array($image)) {
                $images[$key] = $serviceProvider->create(
                    Image::class,
                    $image
                );
            }
        }
        $this->setImages($images);
        $this->setDimension($dimension);
        $this->setHandlingTime($handlingTime);
        $this->setName($name);
        $this->setSku($sku);
        $this->setWarrantyTime($warrantyTime);
        if ($cost !== null) {
            $this->setCost($cost);
        }
        if ($description !== null) {
            $this->setDescription($description);
        }
        if ($ean !== null) {
            $this->setEan($ean);
        }
        $this->setMain($main);
        if ($prices !== null) {
            foreach ($prices as $key => $price) {
                if (is_array($price)) {
                    $prices[$key] = $serviceProvider->create(
                        Price::class,
                        $price
                    );
                }
            }
            $this->setPrices($prices);
        }

        if ($status !== null) {
            if (is_string($status)) {
                $status = StatusEnum::fromValue($status);
            }
            $this->setStatus($status);
        }

        if ($stocks !== null) {
            foreach ($stocks as $key => $stock) {
                if (is_array($stock)) {
                    $stocks[$key] = $serviceProvider->create(
                        Stock::class,
                        $stock
                    );
                }
            }
            $this->setStocks($stocks);
        }

        if ($variantSpecification !== null) {
            foreach ($variantSpecification as $key => $attributeValue) {
                if (is_array($attributeValue)) {
                    $variantSpecification[$key] = $serviceProvider->create(
                        AttributeValue::class,
                        $attributeValue
                    );
                }
            }
            $this->setVariantSpecification($variantSpecification);
        }
    }

    public function getSkuId(): string
    {
        return $this->skuId;
    }

    public function setSkuId(string $skuId)
    {
        $this->skuId = $skuId;
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
    public function setImages(array $images)
    {
        $this->validateArrayElements($images, Image::class);
        $this->images = $images;
        return $this;
    }

    public function getDimension(): Dimension
    {
        return $this->dimension;
    }

    public function setDimension(Dimension $dimension)
    {
        $this->dimension = $dimension;
        return $this;
    }

    public function getHandlingTime(): UnitTime
    {
        return $this->handlingTime;
    }

    public function setHandlingTime(UnitTime $handlingTime)
    {
        $this->handlingTime = $handlingTime;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku)
    {
        $this->sku = $sku;
        return $this;
    }

    public function getWarrantyTime(): UnitTime
    {
        return $this->warrantyTime;
    }

    public function setWarrantyTime(UnitTime $warrantyTime)
    {
        $this->warrantyTime = $warrantyTime;
        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost)
    {
        $this->cost = $cost;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean)
    {
        $this->ean = $ean;
        return $this;
    }

    public function getMain(): ?bool
    {
        return $this->main;
    }

    public function setMain(?bool $main)
    {
        $this->main = $main;
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
    public function setPrices(array $prices)
    {
        $this->validateArrayElements(
            $prices,
            Price::class
        );
        $this->prices = $prices;
        return $this;
    }

    public function getStatus(): ?StatusEnum
    {
        return $this->status;
    }

    public function setStatus(StatusEnum $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return array<Stock>
     */
    public function getStocks(): ?array
    {
        return $this->stocks;
    }

    /**
     * @param array<Stock> $stocks
     */
    public function setStocks(array $stocks)
    {
        $this->validateArrayElements(
            $stocks,
            Stock::class
        );
        $this->stocks = $stocks;
        return $this;
    }

    /**
     * @return array<AttributeValue>
     */
    public function getVariantSpecification(): ?array
    {
        return $this->variantSpecification;
    }

    /**
     * @param array<AttributeValue> $variantSpecification
     */
    public function setVariantSpecification(array $variantSpecification)
    {
        $this->validateArrayElements(
            $variantSpecification,
            AttributeValue::class
        );
        $this->variantSpecification = $variantSpecification;
        return $this;
    }
}
