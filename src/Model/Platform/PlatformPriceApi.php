<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Platform\TypeEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Platform\PlatformPricePeriod;

use function is_array;
use function is_string;

class PlatformPriceApi extends AbstractModel
{
    protected float $value;

    protected TypeEnum $type;

    protected string $platform;

    protected ?PlatformPricePeriod $validityPeriod = null;

    /**
     * @param PlatformPricePeriod|array<mixed>|null $validityPeriod
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        float $value,
        TypeEnum|string $type,
        string $platform,
        PlatformPricePeriod|array|null $validityPeriod = null
    ) {
        $this->setValue($value);
        if (is_string($type)) {
            $type = TypeEnum::fromValue($type);
        }
        $this->setType($type);
        $this->setPlatform($platform);
        if ($validityPeriod !== null) {
            if (is_array($validityPeriod)) {
                $validityPeriod = $serviceProvider->create(
                    PlatformPricePeriod::class,
                    $validityPeriod
                );
            }
            $this->setValidityPeriod($validityPeriod);
        }
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getType(): TypeEnum
    {
        return $this->type;
    }

    public function setType(TypeEnum $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): self
    {
        $this->platform = $platform;
        return $this;
    }

    public function getValidityPeriod(): ?PlatformPricePeriod
    {
        return $this->validityPeriod;
    }

    public function setValidityPeriod(?PlatformPricePeriod $validityPeriod): self
    {
        $this->validityPeriod = $validityPeriod;
        return $this;
    }
}
