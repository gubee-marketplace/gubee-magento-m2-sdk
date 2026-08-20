<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Catalog\Product\Variation\Stock;

use function is_array;

class StockIntegrationPayload extends AbstractModel
{
    protected ?string $productId = null;

    protected string $skuId;

    protected Stock $stock;

    /**
     * @param Stock|array<mixed> $stock
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $productId,
        string $skuId,
        Stock|array $stock
    ) {
        if ($productId !== null) {
            $this->setProductId($productId);
        }
        $this->setSkuId($skuId);
        if (is_array($stock)) {
            $stock = $serviceProvider->create(
                Stock::class,
                $stock
            );
        }
        $this->setStock($stock);
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

    public function getStock(): Stock
    {
        return $this->stock;
    }

    public function setStock(Stock $stock): self
    {
        $this->stock = $stock;
        return $this;
    }
}
