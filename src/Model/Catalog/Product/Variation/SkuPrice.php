<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Platform\DomainTypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Platform\PlatformPriceQuery;

use function is_array;
use function is_string;

class SkuPrice extends AbstractModel
{
    protected ?string $id = null;

    protected string $itemId;

    protected string $sellerId;

    protected ?string $sku = null;

    protected ?string $originItemId = null;

    protected DomainTypeEnum $domain;

    /** @var array<PlatformPriceQuery> */

    protected array $prices;

    /**
     * @param array<PlatformPriceQuery|array<mixed>> $prices
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $id = null,
        string $itemId,
        string $sellerId,
        ?string $sku = null,
        ?string $originItemId = null,
        DomainTypeEnum|string $domain,
        array $prices
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setItemId($itemId);
        $this->setSellerId($sellerId);
        if ($sku !== null) {
            $this->setSku($sku);
        }
        if ($originItemId !== null) {
            $this->setOriginItemId($originItemId);
        }
        if (is_string($domain)) {
            $domain = DomainTypeEnum::fromValue($domain);
        }
        $this->setDomain($domain);
        foreach ($prices as $key => $value) {
            if (is_array($value)) {
                $prices[$key] = $serviceProvider->create(
                    PlatformPriceQuery::class,
                    $value
                );
            }
        }
        $this->setPrices($prices);
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

    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function setItemId(string $itemId): self
    {
        $this->itemId = $itemId;
        return $this;
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

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    public function getOriginItemId(): ?string
    {
        return $this->originItemId;
    }

    public function setOriginItemId(?string $originItemId): self
    {
        $this->originItemId = $originItemId;
        return $this;
    }

    public function getDomain(): DomainTypeEnum
    {
        return $this->domain;
    }

    public function setDomain(DomainTypeEnum $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return array<PlatformPriceQuery>
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * @param array<PlatformPriceQuery> $prices
     */
    public function setPrices(array $prices): self
    {
        $this->validateArrayElements($prices, PlatformPriceQuery::class);
        $this->prices = $prices;
        return $this;
    }
}
