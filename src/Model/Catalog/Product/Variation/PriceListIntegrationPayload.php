<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;

use function is_array;

class PriceListIntegrationPayload extends AbstractModel
{
    protected ?string $productId = null;

    protected string $skuId;

    /** @var array<Price> */

    protected array $prices;

    /**
     * @param array<Price|array<mixed>> $prices
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $productId,
        string $skuId,
        array $prices
    ) {
        if ($productId !== null) {
            $this->setProductId($productId);
        }
        $this->setSkuId($skuId);
        foreach ($prices as $key => $value) {
            if (is_array($value)) {
                $prices[$key] = $serviceProvider->create(
                    Price::class,
                    $value
                );
            }
        }
        $this->setPrices($prices);
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
}
