<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Platform\PlatformStore;

use function is_array;

class DescriptionApi extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $productId = null;

    protected ?string $skuId = null;

    protected ?string $sellerId = null;

    protected ?PlatformStore $platformStore = null;

    protected ?string $description = null;

    /**
     * @param PlatformStore|array<mixed>|null $platformStore
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $id = null,
        ?string $productId = null,
        ?string $skuId = null,
        ?string $sellerId = null,
        PlatformStore|array|null $platformStore = null,
        ?string $description = null
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        if ($productId !== null) {
            $this->setProductId($productId);
        }
        if ($skuId !== null) {
            $this->setSkuId($skuId);
        }
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($platformStore !== null) {
            if (is_array($platformStore)) {
                $platformStore = $serviceProvider->create(
                    PlatformStore::class,
                    $platformStore
                );
            }
            $this->setPlatformStore($platformStore);
        }
        if ($description !== null) {
            $this->setDescription($description);
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

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(?string $productId): self
    {
        $this->productId = $productId;
        return $this;
    }

    public function getSkuId(): ?string
    {
        return $this->skuId;
    }

    public function setSkuId(?string $skuId): self
    {
        $this->skuId = $skuId;
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

    public function getPlatformStore(): ?PlatformStore
    {
        return $this->platformStore;
    }

    public function setPlatformStore(?PlatformStore $platformStore): self
    {
        $this->platformStore = $platformStore;
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
}
