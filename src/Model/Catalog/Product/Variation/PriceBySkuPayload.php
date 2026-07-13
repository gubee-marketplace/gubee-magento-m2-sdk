<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;

use function is_array;

class PriceBySkuPayload extends AbstractModel
{
    protected string $sku;

    protected Price $price;

    /**
     * @param Price|array<mixed> $price
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $sku,
        Price|array $price
    ) {
        $this->setSku($sku);
        if (is_array($price)) {
            $price = $serviceProvider->create(
                Price::class,
                $price
            );
        }
        $this->setPrice($price);
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
