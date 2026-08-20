<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Variation\Price;

use function is_array;

class PriceListBySkuPayload extends AbstractModel
{
    protected string $sku;

    /** @var array<Price> */

    protected array $prices;

    /**
     * @param array<Price|array<mixed>> $prices
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $sku,
        array $prices
    ) {
        $this->setSku($sku);
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

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;
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
