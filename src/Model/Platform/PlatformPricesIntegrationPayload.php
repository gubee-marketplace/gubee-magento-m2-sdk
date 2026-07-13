<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Platform\DomainTypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Platform\PlatformPriceApi;

use function is_array;
use function is_string;

class PlatformPricesIntegrationPayload extends AbstractModel
{
    protected string $itemId;

    protected ?DomainTypeEnum $domainType = null;

    /** @var array<PlatformPriceApi> */

    protected array $prices;

    /**
     * @param array<PlatformPriceApi|array<mixed>> $prices
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $itemId,
        DomainTypeEnum|string|null $domainType,
        array $prices
    ) {
        $this->setItemId($itemId);
        if ($domainType !== null) {
            if (is_string($domainType)) {
                $domainType = DomainTypeEnum::fromValue($domainType);
            }
            $this->setDomainType($domainType);
        }
        foreach ($prices as $key => $value) {
            if (is_array($value)) {
                $prices[$key] = $serviceProvider->create(
                    PlatformPriceApi::class,
                    $value
                );
            }
        }
        $this->setPrices($prices);
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

    public function getDomainType(): ?DomainTypeEnum
    {
        return $this->domainType;
    }

    public function setDomainType(?DomainTypeEnum $domainType): self
    {
        $this->domainType = $domainType;
        return $this;
    }

    /**
     * @return array<PlatformPriceApi>
     */
    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * @param array<PlatformPriceApi> $prices
     */
    public function setPrices(array $prices): self
    {
        $this->validateArrayElements($prices, PlatformPriceApi::class);
        $this->prices = $prices;
        return $this;
    }
}
