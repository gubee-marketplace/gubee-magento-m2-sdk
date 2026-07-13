<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;

use function is_array;

class PriceIntegrationPayload extends AbstractModel
{
    protected ?string $productId = null;

    protected string $skuId;

    protected Price $price;

    /**
     * @param Price|array<mixed> $price
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $productId,
        string $skuId,
        Price|array $price
    ) {
        if ($productId !== null) {
            $this->setProductId($productId);
        }
        $this->setSkuId($skuId);
        if (is_array($price)) {
            $price = $serviceProvider->create(
                Price::class,
                $price
            );
        }
        $this->setPrice($price);
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(?string $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function getSkuId(): string
    {
        return $this->skuId;
    }

    public function setSkuId(string $skuId): self
    {
        $this->skuId = $skuId;
        return $this;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function setPrice(Price $price): self
    {
        $this->price = $price;
        return $this;
    }
}
