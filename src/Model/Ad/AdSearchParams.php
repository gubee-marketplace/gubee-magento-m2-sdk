<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Ad\SearchTypeEnum;
use Gubee\SDK\Enum\Ad\TagsFilterModeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Ad\AdAttributeFilterParams;

use function is_array;
use function is_string;

class AdSearchParams extends AbstractModel
{
    protected ?string $sku = null;

    protected ?string $name = null;

    /** @var array<string>|null */

    protected ?array $plansIds = null;

    /** @var array<string>|null */

    protected ?array $status = null;

    protected ?string $ean = null;

    protected ?bool $hasEan = null;

    /** @var array<string>|null */

    protected ?array $brands = null;

    /** @var array<AdAttributeFilterParams>|null */

    protected ?array $attributes = null;

    /** @var array<string>|null */

    protected ?array $accountIds = null;

    /** @var array<string>|null */

    protected ?array $ids = null;

    /** @var array<string>|null */

    protected ?array $integrationStatus = null;

    /** @var array<string>|null */

    protected ?array $tags = null;

    protected ?TagsFilterModeEnum $tagsFilterMode = null;

    /** @var array<string>|null */

    protected ?array $categoryIds = null;

    /** @var array<string>|null */

    protected ?array $types = null;

    protected ?bool $hasProduct = null;

    /** @var array<string>|null */

    protected ?array $originSkuIds = null;

    protected ?SearchTypeEnum $searchType = null;

    protected ?string $officialStoreId = null;

    protected ?string $pausedSince = null;

    /**
     * @param array<string>|null $plansIds
     * @param array<string>|null $status
     * @param array<string>|null $brands
     * @param array<AdAttributeFilterParams|array<mixed>>|null $attributes
     * @param array<string>|null $accountIds
     * @param array<string>|null $ids
     * @param array<string>|null $integrationStatus
     * @param array<string>|null $tags
     * @param array<string>|null $categoryIds
     * @param array<string>|null $types
     * @param array<string>|null $originSkuIds
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $sku = null,
        ?string $name = null,
        ?array $plansIds = null,
        ?array $status = null,
        ?string $ean = null,
        ?bool $hasEan = null,
        ?array $brands = null,
        ?array $attributes = null,
        ?array $accountIds = null,
        ?array $ids = null,
        ?array $integrationStatus = null,
        ?array $tags = null,
        TagsFilterModeEnum|string|null $tagsFilterMode = null,
        ?array $categoryIds = null,
        ?array $types = null,
        ?bool $hasProduct = null,
        ?array $originSkuIds = null,
        SearchTypeEnum|string|null $searchType = null,
        ?string $officialStoreId = null,
        ?string $pausedSince = null
    ) {
        if ($sku !== null) {
            $this->setSku($sku);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($plansIds !== null) {
            $this->setPlansIds($plansIds);
        }
        if ($status !== null) {
            $this->setStatus($status);
        }
        if ($ean !== null) {
            $this->setEan($ean);
        }
        if ($hasEan !== null) {
            $this->setHasEan($hasEan);
        }
        if ($brands !== null) {
            $this->setBrands($brands);
        }
        if ($attributes !== null) {
            foreach ($attributes as $key => $value) {
                if (is_array($value)) {
                    $attributes[$key] = $serviceProvider->create(
                        AdAttributeFilterParams::class,
                        $value
                    );
                }
            }
            $this->setAttributes($attributes);
        }
        if ($accountIds !== null) {
            $this->setAccountIds($accountIds);
        }
        if ($ids !== null) {
            $this->setIds($ids);
        }
        if ($integrationStatus !== null) {
            $this->setIntegrationStatus($integrationStatus);
        }
        if ($tags !== null) {
            $this->setTags($tags);
        }
        if ($tagsFilterMode !== null) {
            if (is_string($tagsFilterMode)) {
                $tagsFilterMode = TagsFilterModeEnum::fromValue($tagsFilterMode);
            }
            $this->setTagsFilterMode($tagsFilterMode);
        }
        if ($categoryIds !== null) {
            $this->setCategoryIds($categoryIds);
        }
        if ($types !== null) {
            $this->setTypes($types);
        }
        if ($hasProduct !== null) {
            $this->setHasProduct($hasProduct);
        }
        if ($originSkuIds !== null) {
            $this->setOriginSkuIds($originSkuIds);
        }
        if ($searchType !== null) {
            if (is_string($searchType)) {
                $searchType = SearchTypeEnum::fromValue($searchType);
            }
            $this->setSearchType($searchType);
        }
        if ($officialStoreId !== null) {
            $this->setOfficialStoreId($officialStoreId);
        }
        if ($pausedSince !== null) {
            $this->setPausedSince($pausedSince);
        }
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
     * @return array<string>|null
     */
    public function getPlansIds(): ?array
    {
        return $this->plansIds;
    }

    /**
     * @param array<string> $plansIds
     */
    public function setPlansIds(?array $plansIds): self
    {
        if ($plansIds !== null) {
            $this->validateArrayElements($plansIds, 'string');
        }
        $this->plansIds = $plansIds;
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

    /**
     * @return array<string>|null
     */
    public function getBrands(): ?array
    {
        return $this->brands;
    }

    /**
     * @param array<string> $brands
     */
    public function setBrands(?array $brands): self
    {
        if ($brands !== null) {
            $this->validateArrayElements($brands, 'string');
        }
        $this->brands = $brands;
        return $this;
    }

    /**
     * @return array<AdAttributeFilterParams>|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @param array<AdAttributeFilterParams> $attributes
     */
    public function setAttributes(?array $attributes): self
    {
        if ($attributes !== null) {
            $this->validateArrayElements($attributes, AdAttributeFilterParams::class);
        }
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getAccountIds(): ?array
    {
        return $this->accountIds;
    }

    /**
     * @param array<string> $accountIds
     */
    public function setAccountIds(?array $accountIds): self
    {
        if ($accountIds !== null) {
            $this->validateArrayElements($accountIds, 'string');
        }
        $this->accountIds = $accountIds;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getIds(): ?array
    {
        return $this->ids;
    }

    /**
     * @param array<string> $ids
     */
    public function setIds(?array $ids): self
    {
        if ($ids !== null) {
            $this->validateArrayElements($ids, 'string');
        }
        $this->ids = $ids;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getIntegrationStatus(): ?array
    {
        return $this->integrationStatus;
    }

    /**
     * @param array<string> $integrationStatus
     */
    public function setIntegrationStatus(?array $integrationStatus): self
    {
        if ($integrationStatus !== null) {
            $this->validateArrayElements($integrationStatus, 'string');
        }
        $this->integrationStatus = $integrationStatus;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param array<string> $tags
     */
    public function setTags(?array $tags): self
    {
        if ($tags !== null) {
            $this->validateArrayElements($tags, 'string');
        }
        $this->tags = $tags;
        return $this;
    }

    public function getTagsFilterMode(): ?TagsFilterModeEnum
    {
        return $this->tagsFilterMode;
    }

    public function setTagsFilterMode(?TagsFilterModeEnum $tagsFilterMode): self
    {
        $this->tagsFilterMode = $tagsFilterMode;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getCategoryIds(): ?array
    {
        return $this->categoryIds;
    }

    /**
     * @param array<string> $categoryIds
     */
    public function setCategoryIds(?array $categoryIds): self
    {
        if ($categoryIds !== null) {
            $this->validateArrayElements($categoryIds, 'string');
        }
        $this->categoryIds = $categoryIds;
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

    public function getHasProduct(): ?bool
    {
        return $this->hasProduct;
    }

    public function setHasProduct(?bool $hasProduct): self
    {
        $this->hasProduct = $hasProduct;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getOriginSkuIds(): ?array
    {
        return $this->originSkuIds;
    }

    /**
     * @param array<string> $originSkuIds
     */
    public function setOriginSkuIds(?array $originSkuIds): self
    {
        if ($originSkuIds !== null) {
            $this->validateArrayElements($originSkuIds, 'string');
        }
        $this->originSkuIds = $originSkuIds;
        return $this;
    }

    public function getSearchType(): ?SearchTypeEnum
    {
        return $this->searchType;
    }

    public function setSearchType(?SearchTypeEnum $searchType): self
    {
        $this->searchType = $searchType;
        return $this;
    }

    public function getOfficialStoreId(): ?string
    {
        return $this->officialStoreId;
    }

    public function setOfficialStoreId(?string $officialStoreId): self
    {
        $this->officialStoreId = $officialStoreId;
        return $this;
    }

    public function getPausedSince(): ?string
    {
        return $this->pausedSince;
    }

    public function setPausedSince(?string $pausedSince): self
    {
        $this->pausedSince = $pausedSince;
        return $this;
    }
}
