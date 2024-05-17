<?php

declare (strict_types = 1);

namespace Gubee\SDK\Model\Catalog;

use DI\NotFoundException;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Catalog\Product\Attribute\OriginEnum;
use Gubee\SDK\Enum\Catalog\Product\StatusEnum;
use Gubee\SDK\Enum\Catalog\Product\TypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Category;
use Gubee\SDK\Model\Catalog\Product\Attribute\AttributeValue;
use Gubee\SDK\Model\Catalog\Product\Attribute\Brand;
use Gubee\SDK\Model\Catalog\Product\Variation;
use Gubee\SDK\Model\Gubee\Account;
use Gubee\SDK\Resource\Catalog\ProductResource;
use Gubee\SDK\Resource\Catalog\Product\Attribute\BrandResource;
use Throwable;

class Product extends AbstractModel {
    protected Brand $brand;
    protected string $id;
    protected Category $mainCategory;
    protected string $mainSku;
    protected OriginEnum $origin;
    protected StatusEnum $status;
    protected TypeEnum $type;
    protected ?string $hubeeId = null;
    protected ?string $name = null;
    protected ?string $nbm = null;
    /** @var array<Account>|null */
    protected ?array $accounts = null;
    /** @var array<Category>|null */
    protected ?array $categories = null;
    /** @var array<AttributeValue>|null */
    protected ?array $specifications = null;
    /** @var array<AttributeValue>|null */
    protected ?array $variantAttributes = null;
    /** @var array<Variation>|null */
    protected ?array $variations = null;
    protected BrandResource $brandResource;
    protected ProductResource $productResource;

    /**
     * @param Brand|array<int|string, mixed> $brand
     * @param Category|string $mainCategory
     * @param OriginEnum|mixed $origin
     * @param StatusEnum|mixed $status
     * @param TypeEnum|mixed $type
     * @param array<int|string, mixed>|array<Account> $accounts
     * @param array<int|string, mixed>|array<Category> $categories
     * @param array<int|string, mixed>|array<AttributeValue> $specifications
     * @param array<int|string, mixed>|array<AttributeValue> $variantAttributes
     * @param array<int|string, mixed>|array<Variation> $variations
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ProductResource $productResource,
        BrandResource $brandResource,
        string $id,
        $mainCategory,
        string $mainSku,
        $origin,
        $status,
        $type,
        $brand = null,
        ?string $hubeeId = null,
        ?string $name = null,
        ?string $nbm = null,
        ?array $accounts = null,
        ?array $categories = null,
        ?array $specifications = null,
        ?array $variantAttributes = null,
        ?array $variations = null
    ) {
        $this->productResource = $productResource;
        $this->brandResource = $brandResource;
        $this->setId($id)
            ->setMainCategory($mainCategory)
            ->setMainSku($mainSku);
        if (is_string($origin)) {
            $origin = OriginEnum::fromValue($origin);
        }
        $this->setOrigin($origin);
        if ($brand) {
            if (is_array($brand)) {
                $brand = $serviceProvider->create(
                    Brand::class,
                    $brand
                );
            }
            $this->setBrand($brand);
        }
        if (is_string($status)) {
            $status = StatusEnum::fromValue($status);
        }
        $this->setStatus($status);
        if (is_string($type)) {
            $type = TypeEnum::fromValue($type);
        }
        $this->setType($type);
        if ($hubeeId) {
            $this->setHubeeId($hubeeId);
        }
        if ($name) {
            $this->setName($name);
        }
        if ($nbm) {
            $this->setNbm($nbm);
        }
        if ($accounts && is_array($accounts)) {
            foreach ($accounts as $key => $accont) {
                if (is_array($accont)) {
                    $accounts[$key] = $serviceProvider->create(
                        Account::class,
                        $accont
                    );
                }
            }
            $this->setAccounts($accounts);
        }
        if ($categories && is_array($categories)) {
            foreach ($categories as $key => $category) {
                if (is_array($category)) {
                    $categories[$key] = $serviceProvider->create(
                        Category::class,
                        $category
                    );
                }
            }
            $this->setCategories($categories);
        }
        if ($specifications && is_array($specifications)) {
            foreach ($specifications as $key => $specification) {
                if (is_array($specification)) {
                    $specifications[$key] = $serviceProvider->create(
                        AttributeValue::class,
                        $specification
                    );
                }
            }
            $this->setSpecifications($specifications);
        }
        if ($variantAttributes && is_array($variantAttributes)) {
            foreach ($variantAttributes as $key => $variantAttribute) {
                if (is_array($variantAttribute)) {
                    $variantAttributes[$key] = $serviceProvider->create(
                        AttributeValue::class,
                        $variantAttribute
                    );
                }
            }
            $this->setVariantAttributes($variantAttributes);
        }
        if ($variations && is_array($variations)) {
            foreach ($variations as $key => $variation) {
                if (is_array($variation)) {
                    $variations[$key] = $serviceProvider->create(
                        AttributeValue::class,
                        $variation
                    );
                }
            }
            $this->setVariations($variations);
        }
    }

    public function load(string $id, string $field = 'externalId'): self {
        switch ($field) {
        case 'externalId':
            $product = $this->productResource->loadById($id);
            break;
        case 'skuId':
            $product = $this->productResource->getBySku($id);
            break;
        default:
            throw new NotFoundException(
                sprintf(
                    'Field %s not found',
                    $field
                )
            );
        }

        return $product;
    }

    public function save() {
        try {
            $this->productResource->update(
                $this->getId(),
                $this
            );
        } catch (\Gubee\SDK\Library\HttpClient\Exception\NotFoundException $e) {
            return $this->productResource->create($this);
        } catch (\Throwable $e) {
            throw $e;
        }

        return $this;
    }

    public function getBrand(): Brand {
        return $this->brand;
    }

    public function setBrand(Brand $brand): self {
        if (!$brand->getHubeeId()) {
            try {
                $brand = $this->brandResource->loadByName(
                    $brand->getName()
                );
            } catch (Throwable $e) {
                $brand = $brand->save();
            }
        }
        $this->brand = $brand;
        return $this;
    }

    public function getId(): string {
        return $this->id;
    }

    public function setId(string $id): self {
        $this->id = $id;
        return $this;
    }

    public function getMainCategory(): Category {
        return $this->mainCategory;
    }

    public function setMainCategory(Category $mainCategory): self {
        $this->mainCategory = $mainCategory;
        return $this;
    }

    public function getMainSku(): string {
        return $this->mainSku;
    }

    public function setMainSku(string $mainSku): self {
        $this->mainSku = $mainSku;
        return $this;
    }

    public function getOrigin(): OriginEnum {
        return $this->origin;
    }

    public function setOrigin(OriginEnum $origin): self {
        $this->origin = $origin;
        return $this;
    }

    public function getStatus(): StatusEnum {
        return $this->status;
    }

    public function setStatus(StatusEnum $status): self {
        $this->status = $status;
        return $this;
    }

    public function getType(): TypeEnum {
        return $this->type;
    }

    public function setType(TypeEnum $type): self {
        $this->type = $type;
        return $this;
    }

    public function getHubeeId(): ?string {
        return $this->hubeeId;
    }

    public function setHubeeId(?string $hubeeId): self {
        $this->hubeeId = $hubeeId;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getNbm(): ?string {
        return $this->nbm;
    }

    public function setNbm(?string $nbm): self {
        $this->nbm = $nbm;
        return $this;
    }

    /**
     * @return array<Account>
     */
    public function getAccounts(): ?array {
        return $this->accounts;
    }

    /**
     * @param array<Account> $accounts
     */
    public function setAccounts(array $accounts): self {
        $this->validateArrayElements(
            $accounts,
            Account::class
        );
        $this->accounts = $accounts;
        return $this;
    }

    /**
     * @return array<Category>
     */
    public function getCategories(): ?array {
        return $this->categories;
    }

    /**
     * @param array<Category> $categories
     */
    public function setCategories(array $categories): self {
        $this->validateArrayElements($categories, Category::class);
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return array<AttributeValue>
     */
    public function getSpecifications(): ?array {
        return $this->specifications;
    }

    /**
     * @param  array<AttributeValue> $specifications
     */
    public function setSpecifications(array $specifications): self {
        $this->validateArrayElements($specifications, AttributeValue::class);
        $this->specifications = $specifications;
        return $this;
    }

    /**
     * @return  array<AttributeValue>
     */
    public function getVariantAttributes(): ?array {
        return $this->variantAttributes;
    }

    /**
     * @param  array<AttributeValue> $variantAttributes
     */
    public function setVariantAttributes(array $variantAttributes): self {
        $this->validateArrayElements($variantAttributes, AttributeValue::class);
        $this->variantAttributes = $variantAttributes;
        return $this;
    }

    /**
     * @return array<Variation>
     */
    public function getVariations(): ?array {
        return $this->variations;
    }

    /**
     * @param array<Variation> $variations
     */
    public function setVariations(?array $variations): self {
        $this->validateArrayElements($variations, Variation::class);
        $this->variations = $variations;
        return $this;
    }

    public function jsonSerialize(): array {
        $values = parent::jsonSerialize();
        foreach ($values['categories'] as $key => $category) {
            $values['categories'][] = $category->getId();

            unset($values['categories'][$key]);
        }
        $values['categories'] = array_values($values['categories']);
        $values['mainCategory'] = $values['mainCategory']->getId();
        if (isset($values['brand'])) {
            $values['brand'] = $values['brand']->getId();
        }
        // foreach ($values['specifications'] as $key => $specification) {
        //     $values['specifications'][$key] = $specification->getAttribute();
        // }
        if (isset($values['variantAttributes'])) {
            foreach ($values['variantAttributes'] as $key => $variantAttribute) {
                $values['variantAttributes'][$key] = $variantAttribute->getAttribute();
            }

            $values['variantAttributes'] = array_values($values['variantAttributes']);
        }
        if (isset($values['brandResource'])) {
            unset($values['brandResource']);
        }
        $values = array_filter(
            $values,
            function ($value) {
                return $value !== null;
            }
        );
        return $values;
    }
}
