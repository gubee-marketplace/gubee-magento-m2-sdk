<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Sales\Order\LogisticTypeMappingEntryApi;

use function is_array;

class LogisticTypeMappingApi extends AbstractModel
{
    protected ?string $platform = null;

    protected ?string $sellerId = null;

    /** @var array<LogisticTypeMappingEntryApi> */

    protected array $logisticTypes;

    /**
     * @param array<LogisticTypeMappingEntryApi|array<mixed>> $logisticTypes
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $platform = null,
        ?string $sellerId = null,
        array $logisticTypes
    ) {
        if ($platform !== null) {
            $this->setPlatform($platform);
        }
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        foreach ($logisticTypes as $key => $value) {
            if (is_array($value)) {
                $logisticTypes[$key] = $serviceProvider->create(
                    LogisticTypeMappingEntryApi::class,
                    $value
                );
            }
        }
        $this->setLogisticTypes($logisticTypes);
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(?string $platform): self
    {
        $this->platform = $platform;
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

    /**
     * @return array<LogisticTypeMappingEntryApi>
     */
    public function getLogisticTypes(): array
    {
        return $this->logisticTypes;
    }

    /**
     * @param array<LogisticTypeMappingEntryApi> $logisticTypes
     */
    public function setLogisticTypes(array $logisticTypes): self
    {
        $this->validateArrayElements($logisticTypes, LogisticTypeMappingEntryApi::class);
        $this->logisticTypes = $logisticTypes;
        return $this;
    }
}
