<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\Attribute\OriginEnum;
use Gubee\SDK\Enum\Catalog\Product\StatusEnum;
use Gubee\SDK\Enum\Catalog\Product\TypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\ProductV2\Specification;
use Gubee\SDK\Model\Catalog\ProductV2\Variation;

use function is_array;
use function is_string;

class ProductV2 extends AbstractModel
{
    protected string $sellerId;
    protected string $mainSku;
    protected string $name;
    protected string $mainCategory;
    protected string $brand;
    protected TypeEnum $type;
    protected OriginEnum $origin;
    protected StatusEnum $status;
    /** @var array<mixed> */
    protected array $accounts;
    /** @var array<Specification> */
    protected array $specifications;
    /** @var array<Variation> */
    protected array $variations;
    protected bool $addNewVariations;
    protected bool $downloadImages;

    /**
     * @param array<Specification|array<mixed>> $specifications
     * @param array<Variation|array<mixed>> $variations
     * @param array<mixed> $accounts
     * @param TypeEnum|string $type
     * @param OriginEnum|string $origin
     * @param StatusEnum|string $status
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $sellerId,
        string $mainSku,
        string $name,
        string $mainCategory,
        string $brand,
        $type,
        $origin,
        $status,
        array $accounts,
        array $specifications,
        array $variations,
        bool $addNewVariations,
        bool $downloadImages
    ) {
        $this->sellerId     = $sellerId;
        $this->mainSku      = $mainSku;
        $this->name         = $name;
        $this->mainCategory = $mainCategory;
        $this->brand        = $brand;

        if (is_string($type)) {
            $type = TypeEnum::fromValue($type);
        }
        $this->type = $type;

        if (is_string($origin)) {
            $origin = OriginEnum::fromValue($origin);
        }
        $this->origin = $origin;

        if (is_string($status)) {
            $status = StatusEnum::fromValue($status);
        }
        $this->status = $status;

        $this->accounts = $accounts;

        foreach ($specifications as $key => $spec) {
            if (is_array($spec)) {
                $specifications[$key] = $serviceProvider->create(
                    Specification::class,
                    $spec
                );
            }
        }
        $this->specifications = $specifications;

        foreach ($variations as $key => $variation) {
            if (is_array($variation)) {
                $variations[$key] = $serviceProvider->create(
                    Variation::class,
                    $variation
                );
            }
        }
        $this->variations = $variations;

        $this->addNewVariations = $addNewVariations;
        $this->downloadImages   = $downloadImages;
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

    public function getMainSku(): string
    {
        return $this->mainSku;
    }

    public function setMainSku(string $mainSku): self
    {
        $this->mainSku = $mainSku;
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

    public function getMainCategory(): string
    {
        return $this->mainCategory;
    }

    public function setMainCategory(string $mainCategory): self
    {
        $this->mainCategory = $mainCategory;
        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
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

    public function getOrigin(): OriginEnum
    {
        return $this->origin;
    }

    public function setOrigin(OriginEnum $origin): self
    {
        $this->origin = $origin;
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

    /**
     * @return array<mixed>
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * @param array<mixed> $accounts
     */
    public function setAccounts(array $accounts): self
    {
        $this->accounts = $accounts;
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
        $this->validateArrayElements(
            $specifications,
            Specification::class
        );
        $this->specifications = $specifications;
        return $this;
    }

    /**
     * @return array<Variation>
     */
    public function getVariations(): array
    {
        return $this->variations;
    }

    /**
     * @param array<Variation> $variations
     */
    public function setVariations(array $variations): self
    {
        $this->validateArrayElements($variations, Variation::class);
        $this->variations = $variations;
        return $this;
    }

    public function getAddNewVariations(): bool
    {
        return $this->addNewVariations;
    }

    public function setAddNewVariations(bool $addNewVariations): self
    {
        $this->addNewVariations = $addNewVariations;
        return $this;
    }

    public function getDownloadImages(): bool
    {
        return $this->downloadImages;
    }

    public function setDownloadImages(bool $downloadImages): self
    {
        $this->downloadImages = $downloadImages;
        return $this;
    }
}
