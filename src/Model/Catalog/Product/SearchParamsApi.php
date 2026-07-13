<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\AttributeFilterParams;

use function is_array;

class SearchParamsApi extends AbstractModel
{
    protected ?string $text = null;

    /** @var array<string>|null */

    protected ?array $status = null;

    protected bool $noStatus;

    protected bool $lookUpHistory;

    /** @var array<string>|null */

    protected ?array $platforms = null;

    protected ?string $sku = null;

    protected ?string $ean = null;

    protected ?bool $hasEan = null;

    protected bool $hasCategories;

    protected ?string $name = null;

    protected ?float $stockQty = null;

    protected ?string $stockCondition = null;

    /** @var array<string>|null */

    protected ?array $categories = null;

    /** @var array<string>|null */

    protected ?array $errorsType = null;

    /** @var array<string>|null */

    protected ?array $productStatus = null;

    /** @var array<string>|null */

    protected ?array $brandIds = null;

    protected ?float $minPrice = null;

    protected ?float $maxPrice = null;

    protected ?string $mktPrice = null;

    /** @var array<AttributeFilterParams>|null */

    protected ?array $attributes = null;

    /** @var array<string>|null */

    protected ?array $ncms = null;

    protected ?bool $hasNcm = null;

    /** @var array<string>|null */

    protected ?array $types = null;

    /**
     * @param array<string>|null $status
     * @param array<string>|null $platforms
     * @param array<string>|null $categories
     * @param array<string>|null $errorsType
     * @param array<string>|null $productStatus
     * @param array<string>|null $brandIds
     * @param array<AttributeFilterParams|array<mixed>>|null $attributes
     * @param array<string>|null $ncms
     * @param array<string>|null $types
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $text = null,
        ?array $status = null,
        bool $noStatus,
        bool $lookUpHistory,
        ?array $platforms = null,
        ?string $sku = null,
        ?string $ean = null,
        ?bool $hasEan = null,
        bool $hasCategories,
        ?string $name = null,
        ?float $stockQty = null,
        ?string $stockCondition = null,
        ?array $categories = null,
        ?array $errorsType = null,
        ?array $productStatus = null,
        ?array $brandIds = null,
        ?float $minPrice = null,
        ?float $maxPrice = null,
        ?string $mktPrice = null,
        ?array $attributes = null,
        ?array $ncms = null,
        ?bool $hasNcm = null,
        ?array $types = null
    ) {
        if ($text !== null) {
            $this->setText($text);
        }
        if ($status !== null) {
            $this->setStatus($status);
        }
        $this->setNoStatus($noStatus);
        $this->setLookUpHistory($lookUpHistory);
        if ($platforms !== null) {
            $this->setPlatforms($platforms);
        }
        if ($sku !== null) {
            $this->setSku($sku);
        }
        if ($ean !== null) {
            $this->setEan($ean);
        }
        if ($hasEan !== null) {
            $this->setHasEan($hasEan);
        }
        $this->setHasCategories($hasCategories);
        if ($name !== null) {
            $this->setName($name);
        }
        if ($stockQty !== null) {
            $this->setStockQty($stockQty);
        }
        if ($stockCondition !== null) {
            $this->setStockCondition($stockCondition);
        }
        if ($categories !== null) {
            $this->setCategories($categories);
        }
        if ($errorsType !== null) {
            $this->setErrorsType($errorsType);
        }
        if ($productStatus !== null) {
            $this->setProductStatus($productStatus);
        }
        if ($brandIds !== null) {
            $this->setBrandIds($brandIds);
        }
        if ($minPrice !== null) {
            $this->setMinPrice($minPrice);
        }
        if ($maxPrice !== null) {
            $this->setMaxPrice($maxPrice);
        }
        if ($mktPrice !== null) {
            $this->setMktPrice($mktPrice);
        }
        if ($attributes !== null) {
            foreach ($attributes as $key => $value) {
                if (is_array($value)) {
                    $attributes[$key] = $serviceProvider->create(
                        AttributeFilterParams::class,
                        $value
                    );
                }
            }
            $this->setAttributes($attributes);
        }
        if ($ncms !== null) {
            $this->setNcms($ncms);
        }
        if ($hasNcm !== null) {
            $this->setHasNcm($hasNcm);
        }
        if ($types !== null) {
            $this->setTypes($types);
        }
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getStatus(): ?array
    {
        return $this->status;
    }

    /**
     * @param array<string> $status
     */
    public function setStatus(?array $status): self
    {
        if ($status !== null) {
            $this->validateArrayElements($status, 'string');
        }
        $this->status = $status;
        return $this;
    }

    public function getNoStatus(): bool
    {
        return $this->noStatus;
    }

    public function setNoStatus(bool $noStatus): self
    {
        $this->noStatus = $noStatus;
        return $this;
    }

    public function getLookUpHistory(): bool
    {
        return $this->lookUpHistory;
    }

    public function setLookUpHistory(bool $lookUpHistory): self
    {
        $this->lookUpHistory = $lookUpHistory;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getPlatforms(): ?array
    {
        return $this->platforms;
    }

    /**
     * @param array<string> $platforms
     */
    public function setPlatforms(?array $platforms): self
    {
        if ($platforms !== null) {
            $this->validateArrayElements($platforms, 'string');
        }
        $this->platforms = $platforms;
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

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): self
    {
        $this->ean = $ean;
        return $this;
    }

    public function getHasEan(): ?bool
    {
        return $this->hasEan;
    }

    public function setHasEan(?bool $hasEan): self
    {
        $this->hasEan = $hasEan;
        return $this;
    }

    public function getHasCategories(): bool
    {
        return $this->hasCategories;
    }

    public function setHasCategories(bool $hasCategories): self
    {
        $this->hasCategories = $hasCategories;
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

    public function getStockQty(): ?float
    {
        return $this->stockQty;
    }

    public function setStockQty(?float $stockQty): self
    {
        $this->stockQty = $stockQty;
        return $this;
    }

    public function getStockCondition(): ?string
    {
        return $this->stockCondition;
    }

    public function setStockCondition(?string $stockCondition): self
    {
        $this->stockCondition = $stockCondition;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getCategories(): ?array
    {
        return $this->categories;
    }

    /**
     * @param array<string> $categories
     */
    public function setCategories(?array $categories): self
    {
        if ($categories !== null) {
            $this->validateArrayElements($categories, 'string');
        }
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getErrorsType(): ?array
    {
        return $this->errorsType;
    }

    /**
     * @param array<string> $errorsType
     */
    public function setErrorsType(?array $errorsType): self
    {
        if ($errorsType !== null) {
            $this->validateArrayElements($errorsType, 'string');
        }
        $this->errorsType = $errorsType;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getProductStatus(): ?array
    {
        return $this->productStatus;
    }

    /**
     * @param array<string> $productStatus
     */
    public function setProductStatus(?array $productStatus): self
    {
        if ($productStatus !== null) {
            $this->validateArrayElements($productStatus, 'string');
        }
        $this->productStatus = $productStatus;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getBrandIds(): ?array
    {
        return $this->brandIds;
    }

    /**
     * @param array<string> $brandIds
     */
    public function setBrandIds(?array $brandIds): self
    {
        if ($brandIds !== null) {
            $this->validateArrayElements($brandIds, 'string');
        }
        $this->brandIds = $brandIds;
        return $this;
    }

    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    public function setMinPrice(?float $minPrice): self
    {
        $this->minPrice = $minPrice;
        return $this;
    }

    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(?float $maxPrice): self
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    public function getMktPrice(): ?string
    {
        return $this->mktPrice;
    }

    public function setMktPrice(?string $mktPrice): self
    {
        $this->mktPrice = $mktPrice;
        return $this;
    }

    /**
     * @return array<AttributeFilterParams>|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @param array<AttributeFilterParams> $attributes
     */
    public function setAttributes(?array $attributes): self
    {
        if ($attributes !== null) {
            $this->validateArrayElements($attributes, AttributeFilterParams::class);
        }
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getNcms(): ?array
    {
        return $this->ncms;
    }

    /**
     * @param array<string> $ncms
     */
    public function setNcms(?array $ncms): self
    {
        if ($ncms !== null) {
            $this->validateArrayElements($ncms, 'string');
        }
        $this->ncms = $ncms;
        return $this;
    }

    public function getHasNcm(): ?bool
    {
        return $this->hasNcm;
    }

    public function setHasNcm(?bool $hasNcm): self
    {
        $this->hasNcm = $hasNcm;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getTypes(): ?array
    {
        return $this->types;
    }

    /**
     * @param array<string> $types
     */
    public function setTypes(?array $types): self
    {
        if ($types !== null) {
            $this->validateArrayElements($types, 'string');
        }
        $this->types = $types;
        return $this;
    }
}
