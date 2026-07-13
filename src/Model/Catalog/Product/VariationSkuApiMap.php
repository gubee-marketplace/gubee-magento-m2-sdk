<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product;

use Gubee\SDK\Model\AbstractModel;

class VariationSkuApiMap extends AbstractModel
{
    protected ?string $id = null;

    protected string $skuId;

    protected string $sku;

    protected ?string $ean = null;

    public function __construct(
        ?string $id = null,
        string $skuId = '',
        string $sku = '',
        ?string $ean = null
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setSkuId($skuId);
        $this->setSku($sku);
        if ($ean !== null) {
            $this->setEan($ean);
        }
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

    public function getSkuId(): string
    {
        return $this->skuId;
    }

    public function setSkuId(string $skuId): self
    {
        $this->skuId = $skuId;
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

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): self
    {
        $this->ean = $ean;
        return $this;
    }
}
