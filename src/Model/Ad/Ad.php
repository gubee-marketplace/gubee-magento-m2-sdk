<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Ad\ConditionEnum;
use Gubee\SDK\Enum\Ad\OriginEnum;
use Gubee\SDK\Enum\Ad\PlatformEnum;
use Gubee\SDK\Enum\Ad\StatusEnum;
use Gubee\SDK\Enum\Ad\TypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Ad\AdPriceApi;
use Gubee\SDK\Model\Ad\AdShippingMode;
use Gubee\SDK\Model\Ad\AdStockApi;
use Gubee\SDK\Model\Ad\AssociateAd;
use Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;
use Gubee\SDK\Model\Catalog\Product\Attribute\OriginCountry;
use Gubee\SDK\Model\Catalog\Product\Variation\Media\Image;
use Gubee\SDK\Model\Common\Specification;
use Gubee\SDK\Model\Video\Video;

use function is_array;
use function is_string;

class Ad extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $sellerId = null;

    protected string $sku;

    protected ?string $marketplaceId = null;

    protected ?string $originSkuId = null;

    protected ?string $originSku = null;

    protected ?string $mainAdId = null;

    protected ?string $externalLink = null;

    protected PlatformEnum $platform;

    protected ?string $accountId = null;

    protected TypeEnum $type;

    protected string $planId;

    protected ?string $categoryId = null;

    /** @var array<AssociateAd>|null */

    protected ?array $associateAds = null;

    protected ?string $name = null;

    protected ?string $description = null;

    protected ?string $brand = null;

    protected ?string $ean = null;

    protected ?string $nbm = null;

    protected ?Dimension $dimension = null;

    protected ?int $warrantyTime = null;

    protected ?int $handlingTime = null;

    protected ?string $warrantyType = null;

    protected ConditionEnum $condition;

    protected OriginEnum $origin;

    protected ?OriginCountry $originCountry = null;

    /** @var array<Image> */

    protected array $images;

    /** @var array<Video> */

    protected array $videos;

    /** @var array<string> */

    protected array $variantSpecification;

    /** @var array<Specification> */

    protected array $specifications;

    protected ?array $defaultAttributes = null;

    protected ?StatusEnum $status = null;

    protected ?AdPriceApi $defaultPrice = null;

    /** @var array<AdPriceApi> */

    protected array $promotionPrices;

    /** @var array<AdStockApi> */

    protected array $stocks;

    /** @var array<AdShippingMode>|null */

    protected ?array $shippingModes = null;

    /** @var array<string> */

    protected array $updateOptions;

    protected ?string $createdBy = null;

    protected ?DateTimeInterface $beginDt = null;

    protected ?DateTimeInterface $endDt = null;

    protected ?DateTimeInterface $createdDt = null;

    protected ?DateTimeInterface $lastModifiedDt = null;

    protected bool $variant;

    protected bool $variation;

    /** @var array<string>|null */

    protected ?array $tags = null;

    protected ?string $parentId = null;

    /** @var array<string>|null */

    protected ?array $warehouseIds = null;

    /** @var array<string>|null */

    protected ?array $channels = null;

    protected ?string $officialStoreId = null;

    protected ?string $warehouseId = null;

    /** @var array<AdPriceApi> */

    protected array $prices;

    protected bool $isFulfillment;

    /**
     * Use shippingModes
     */

    protected ?AdShippingMode $shippingMode = null;

    protected bool $isVariantType;

    /**
     * @param array<AssociateAd|array<mixed>>|null $associateAds
     * @param Dimension|array<mixed>|null $dimension
     * @param OriginCountry|array<mixed>|null $originCountry
     * @param array<Image|array<mixed>> $images
     * @param array<Video|array<mixed>> $videos
     * @param array<string> $variantSpecification
     * @param array<Specification|array<mixed>> $specifications
     * @param AdPriceApi|array<mixed>|null $defaultPrice
     * @param array<AdPriceApi|array<mixed>> $promotionPrices
     * @param array<AdStockApi|array<mixed>> $stocks
     * @param array<AdShippingMode|array<mixed>>|null $shippingModes
     * @param array<string> $updateOptions
     * @param string|DateTimeInterface|null $beginDt
     * @param string|DateTimeInterface|null $endDt
     * @param string|DateTimeInterface|null $createdDt
     * @param string|DateTimeInterface|null $lastModifiedDt
     * @param array<string>|null $tags
     * @param array<string>|null $warehouseIds
     * @param array<string>|null $channels
     * @param array<AdPriceApi|array<mixed>> $prices
     * @param AdShippingMode|array<mixed>|null $shippingMode
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $id = null,
        ?string $sellerId = null,
        string $sku,
        ?string $marketplaceId = null,
        ?string $originSkuId = null,
        ?string $originSku = null,
        ?string $mainAdId = null,
        ?string $externalLink = null,
        PlatformEnum|string $platform,
        ?string $accountId = null,
        TypeEnum|string $type,
        string $planId,
        ?string $categoryId = null,
        ?array $associateAds = null,
        ?string $name = null,
        ?string $description = null,
        ?string $brand = null,
        ?string $ean = null,
        ?string $nbm = null,
        Dimension|array|null $dimension = null,
        ?int $warrantyTime = null,
        ?int $handlingTime = null,
        ?string $warrantyType = null,
        ConditionEnum|string $condition,
        OriginEnum|string $origin,
        OriginCountry|array|null $originCountry = null,
        array $images,
        array $videos,
        array $variantSpecification,
        array $specifications,
        ?array $defaultAttributes = null,
        StatusEnum|string|null $status = null,
        AdPriceApi|array|null $defaultPrice = null,
        array $promotionPrices,
        array $stocks,
        ?array $shippingModes = null,
        array $updateOptions,
        ?string $createdBy = null,
        ?DateTimeInterface $beginDt = null,
        ?DateTimeInterface $endDt = null,
        ?DateTimeInterface $createdDt = null,
        ?DateTimeInterface $lastModifiedDt = null,
        bool $variant,
        bool $variation,
        ?array $tags = null,
        ?string $parentId = null,
        ?array $warehouseIds = null,
        ?array $channels = null,
        ?string $officialStoreId = null,
        ?string $warehouseId = null,
        array $prices,
        bool $isFulfillment,
        AdShippingMode|array|null $shippingMode = null,
        bool $isVariantType
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        $this->setSku($sku);
        if ($marketplaceId !== null) {
            $this->setMarketplaceId($marketplaceId);
        }
        if ($originSkuId !== null) {
            $this->setOriginSkuId($originSkuId);
        }
        if ($originSku !== null) {
            $this->setOriginSku($originSku);
        }
        if ($mainAdId !== null) {
            $this->setMainAdId($mainAdId);
        }
        if ($externalLink !== null) {
            $this->setExternalLink($externalLink);
        }
        if (is_string($platform)) {
            $platform = PlatformEnum::fromValue($platform);
        }
        $this->setPlatform($platform);
        if ($accountId !== null) {
            $this->setAccountId($accountId);
        }
        if (is_string($type)) {
            $type = TypeEnum::fromValue($type);
        }
        $this->setType($type);
        $this->setPlanId($planId);
        if ($categoryId !== null) {
            $this->setCategoryId($categoryId);
        }
        if ($associateAds !== null) {
            foreach ($associateAds as $key => $value) {
                if (is_array($value)) {
                    $associateAds[$key] = $serviceProvider->create(
                        AssociateAd::class,
                        $value
                    );
                }
            }
            $this->setAssociateAds($associateAds);
        }
        if ($name !== null) {
            $this->setName($name);
        }
        if ($description !== null) {
            $this->setDescription($description);
        }
        if ($brand !== null) {
            $this->setBrand($brand);
        }
        if ($ean !== null) {
            $this->setEan($ean);
        }
        if ($nbm !== null) {
            $this->setNbm($nbm);
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
        if ($warrantyTime !== null) {
            $this->setWarrantyTime($warrantyTime);
        }
        if ($handlingTime !== null) {
            $this->setHandlingTime($handlingTime);
        }
        if ($warrantyType !== null) {
            $this->setWarrantyType($warrantyType);
        }
        if (is_string($condition)) {
            $condition = ConditionEnum::fromValue($condition);
        }
        $this->setCondition($condition);
        if (is_string($origin)) {
            $origin = OriginEnum::fromValue($origin);
        }
        $this->setOrigin($origin);
        if ($originCountry !== null) {
            if (is_array($originCountry)) {
                $originCountry = $serviceProvider->create(
                    OriginCountry::class,
                    $originCountry
                );
            }
            $this->setOriginCountry($originCountry);
        }
        foreach ($images as $key => $value) {
            if (is_array($value)) {
                $images[$key] = $serviceProvider->create(
                    Image::class,
                    $value
                );
            }
        }
        $this->setImages($images);
        foreach ($videos as $key => $value) {
            if (is_array($value)) {
                $videos[$key] = $serviceProvider->create(
                    Video::class,
                    $value
                );
            }
        }
        $this->setVideos($videos);
        $this->setVariantSpecification($variantSpecification);
        foreach ($specifications as $key => $value) {
            if (is_array($value)) {
                $specifications[$key] = $serviceProvider->create(
                    Specification::class,
                    $value
                );
            }
        }
        $this->setSpecifications($specifications);
        if ($defaultAttributes !== null) {
            $this->setDefaultAttributes($defaultAttributes);
        }
        if ($status !== null) {
            if (is_string($status)) {
                $status = StatusEnum::fromValue($status);
            }
            $this->setStatus($status);
        }
        if ($defaultPrice !== null) {
            if (is_array($defaultPrice)) {
                $defaultPrice = $serviceProvider->create(
                    AdPriceApi::class,
                    $defaultPrice
                );
            }
            $this->setDefaultPrice($defaultPrice);
        }
        foreach ($promotionPrices as $key => $value) {
            if (is_array($value)) {
                $promotionPrices[$key] = $serviceProvider->create(
                    AdPriceApi::class,
                    $value
                );
            }
        }
        $this->setPromotionPrices($promotionPrices);
        foreach ($stocks as $key => $value) {
            if (is_array($value)) {
                $stocks[$key] = $serviceProvider->create(
                    AdStockApi::class,
                    $value
                );
            }
        }
        $this->setStocks($stocks);
        if ($shippingModes !== null) {
            foreach ($shippingModes as $key => $value) {
                if (is_array($value)) {
                    $shippingModes[$key] = $serviceProvider->create(
                        AdShippingMode::class,
                        $value
                    );
                }
            }
            $this->setShippingModes($shippingModes);
        }
        $this->setUpdateOptions($updateOptions);
        if ($createdBy !== null) {
            $this->setCreatedBy($createdBy);
        }
        if ($beginDt !== null) {
            $this->setBeginDt($beginDt);
        }
        if ($endDt !== null) {
            $this->setEndDt($endDt);
        }
        if ($createdDt !== null) {
            $this->setCreatedDt($createdDt);
        }
        if ($lastModifiedDt !== null) {
            $this->setLastModifiedDt($lastModifiedDt);
        }
        $this->setVariant($variant);
        $this->setVariation($variation);
        if ($tags !== null) {
            $this->setTags($tags);
        }
        if ($parentId !== null) {
            $this->setParentId($parentId);
        }
        if ($warehouseIds !== null) {
            $this->setWarehouseIds($warehouseIds);
        }
        if ($channels !== null) {
            $this->setChannels($channels);
        }
        if ($officialStoreId !== null) {
            $this->setOfficialStoreId($officialStoreId);
        }
        if ($warehouseId !== null) {
            $this->setWarehouseId($warehouseId);
        }
        foreach ($prices as $key => $value) {
            if (is_array($value)) {
                $prices[$key] = $serviceProvider->create(
                    AdPriceApi::class,
                    $value
                );
            }
        }
        $this->setPrices($prices);
        $this->setIsFulfillment($isFulfillment);
        if ($shippingMode !== null) {
            if (is_array($shippingMode)) {
                $shippingMode = $serviceProvider->create(
                    AdShippingMode::class,
                    $shippingMode
                );
            }
            $this->setShippingMode($shippingMode);
        }
        $this->setIsVariantType($isVariantType);
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

    public function getSellerId(): ?string
    {
        return $this->sellerId;
    }

    public function setSellerId(?string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
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

    public function getMarketplaceId(): ?string
    {
        return $this->marketplaceId;
    }

    public function setMarketplaceId(?string $marketplaceId): self
    {
        $this->marketplaceId = $marketplaceId;
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

    public function getOriginSku(): ?string
    {
        return $this->originSku;
    }

    public function setOriginSku(?string $originSku): self
    {
        $this->originSku = $originSku;
        return $this;
    }

    public function getMainAdId(): ?string
    {
        return $this->mainAdId;
    }

    public function setMainAdId(?string $mainAdId): self
    {
        $this->mainAdId = $mainAdId;
        return $this;
    }

    public function getExternalLink(): ?string
    {
        return $this->externalLink;
    }

    public function setExternalLink(?string $externalLink): self
    {
        $this->externalLink = $externalLink;
        return $this;
    }

    public function getPlatform(): PlatformEnum
    {
        return $this->platform;
    }

    public function setPlatform(PlatformEnum $platform): self
    {
        $this->platform = $platform;
        return $this;
    }

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function setAccountId(?string $accountId): self
    {
        $this->accountId = $accountId;
        return $this;
    }

    public function getType(): TypeEnum
    {
        return $this->type;
    }

    public function setType(TypeEnum $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getPlanId(): string
    {
        return $this->planId;
    }

    public function setPlanId(string $planId): self
    {
        $this->planId = $planId;
        return $this;
    }

    public function getCategoryId(): ?string
    {
        return $this->categoryId;
    }

    public function setCategoryId(?string $categoryId): self
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return array<AssociateAd>|null
     */
    public function getAssociateAds(): ?array
    {
        return $this->associateAds;
    }

    /**
     * @param array<AssociateAd> $associateAds
     */
    public function setAssociateAds(?array $associateAds): self
    {
        if ($associateAds !== null) {
            $this->validateArrayElements($associateAds, AssociateAd::class);
        }
        $this->associateAds = $associateAds;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;
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

    public function getNbm(): ?string
    {
        return $this->nbm;
    }

    public function setNbm(?string $nbm): self
    {
        $this->nbm = $nbm;
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

    public function getWarrantyTime(): ?int
    {
        return $this->warrantyTime;
    }

    public function setWarrantyTime(?int $warrantyTime): self
    {
        $this->warrantyTime = $warrantyTime;
        return $this;
    }

    public function getHandlingTime(): ?int
    {
        return $this->handlingTime;
    }

    public function setHandlingTime(?int $handlingTime): self
    {
        $this->handlingTime = $handlingTime;
        return $this;
    }

    public function getWarrantyType(): ?string
    {
        return $this->warrantyType;
    }

    public function setWarrantyType(?string $warrantyType): self
    {
        $this->warrantyType = $warrantyType;
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

    public function getOrigin(): OriginEnum
    {
        return $this->origin;
    }

    public function setOrigin(OriginEnum $origin): self
    {
        $this->origin = $origin;
        return $this;
    }

    public function getOriginCountry(): ?OriginCountry
    {
        return $this->originCountry;
    }

    public function setOriginCountry(?OriginCountry $originCountry): self
    {
        $this->originCountry = $originCountry;
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
     * @return array<Video>
     */
    public function getVideos(): array
    {
        return $this->videos;
    }

    /**
     * @param array<Video> $videos
     */
    public function setVideos(array $videos): self
    {
        $this->validateArrayElements($videos, Video::class);
        $this->videos = $videos;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getVariantSpecification(): array
    {
        return $this->variantSpecification;
    }

    /**
     * @param array<string> $variantSpecification
     */
    public function setVariantSpecification(array $variantSpecification): self
    {
        $this->validateArrayElements($variantSpecification, 'string');
        $this->variantSpecification = $variantSpecification;
        return $this;
    }

    /**
     * @return array<Specification>
     */
    public function getSpecifications(): array
    {
        return $this->specifications;
    }

    /**
     * @param array<Specification> $specifications
     */
    public function setSpecifications(array $specifications): self
    {
        $this->validateArrayElements($specifications, Specification::class);
        $this->specifications = $specifications;
        return $this;
    }

    public function getDefaultAttributes(): ?array
    {
        return $this->defaultAttributes;
    }

    public function setDefaultAttributes(?array $defaultAttributes): self
    {
        $this->defaultAttributes = $defaultAttributes;
        return $this;
    }

    public function getStatus(): ?StatusEnum
    {
        return $this->status;
    }

    public function setStatus(?StatusEnum $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getDefaultPrice(): ?AdPriceApi
    {
        return $this->defaultPrice;
    }

    public function setDefaultPrice(?AdPriceApi $defaultPrice): self
    {
        $this->defaultPrice = $defaultPrice;
        return $this;
    }

    /**
     * @return array<AdPriceApi>
     */
    public function getPromotionPrices(): array
    {
        return $this->promotionPrices;
    }

    /**
     * @param array<AdPriceApi> $promotionPrices
     */
    public function setPromotionPrices(array $promotionPrices): self
    {
        $this->validateArrayElements($promotionPrices, AdPriceApi::class);
        $this->promotionPrices = $promotionPrices;
        return $this;
    }

    /**
     * @return array<AdStockApi>
     */
    public function getStocks(): array
    {
        return $this->stocks;
    }

    /**
     * @param array<AdStockApi> $stocks
     */
    public function setStocks(array $stocks): self
    {
        $this->validateArrayElements($stocks, AdStockApi::class);
        $this->stocks = $stocks;
        return $this;
    }

    /**
     * @return array<AdShippingMode>|null
     */
    public function getShippingModes(): ?array
    {
        return $this->shippingModes;
    }

    /**
     * @param array<AdShippingMode> $shippingModes
     */
    public function setShippingModes(?array $shippingModes): self
    {
        if ($shippingModes !== null) {
            $this->validateArrayElements($shippingModes, AdShippingMode::class);
        }
        $this->shippingModes = $shippingModes;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getUpdateOptions(): array
    {
        return $this->updateOptions;
    }

    /**
     * @param array<string> $updateOptions
     */
    public function setUpdateOptions(array $updateOptions): self
    {
        $this->validateArrayElements($updateOptions, 'string');
        $this->updateOptions = $updateOptions;
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

    public function getVariant(): bool
    {
        return $this->variant;
    }

    public function setVariant(bool $variant): self
    {
        $this->variant = $variant;
        return $this;
    }

    public function getVariation(): bool
    {
        return $this->variation;
    }

    public function setVariation(bool $variation): self
    {
        $this->variation = $variation;
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

    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    public function setParentId(?string $parentId): self
    {
        $this->parentId = $parentId;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getWarehouseIds(): ?array
    {
        return $this->warehouseIds;
    }

    /**
     * @param array<string> $warehouseIds
     */
    public function setWarehouseIds(?array $warehouseIds): self
    {
        if ($warehouseIds !== null) {
            $this->validateArrayElements($warehouseIds, 'string');
        }
        $this->warehouseIds = $warehouseIds;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getChannels(): ?array
    {
        return $this->channels;
    }

    /**
     * @param array<string> $channels
     */
    public function setChannels(?array $channels): self
    {
        if ($channels !== null) {
            $this->validateArrayElements($channels, 'string');
        }
        $this->channels = $channels;
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

    public function getWarehouseId(): ?string
    {
        return $this->warehouseId;
    }

    public function setWarehouseId(?string $warehouseId): self
    {
        $this->warehouseId = $warehouseId;
        return $this;
    }

    /**
     * @return array<AdPriceApi>
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * @param array<AdPriceApi> $prices
     */
    public function setPrices(array $prices): self
    {
        $this->validateArrayElements($prices, AdPriceApi::class);
        $this->prices = $prices;
        return $this;
    }

    public function getIsFulfillment(): bool
    {
        return $this->isFulfillment;
    }

    public function setIsFulfillment(bool $isFulfillment): self
    {
        $this->isFulfillment = $isFulfillment;
        return $this;
    }

    public function getShippingMode(): ?AdShippingMode
    {
        return $this->shippingMode;
    }

    public function setShippingMode(?AdShippingMode $shippingMode): self
    {
        $this->shippingMode = $shippingMode;
        return $this;
    }

    public function getIsVariantType(): bool
    {
        return $this->isVariantType;
    }

    public function setIsVariantType(bool $isVariantType): self
    {
        $this->isVariantType = $isVariantType;
        return $this;
    }
}
