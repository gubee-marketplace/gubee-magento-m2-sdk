<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Platform;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Platform\PlatformPriceResult;

use function is_array;

class UpdatePlatformPriceResponse extends AbstractModel
{
    protected ?string $sellerId = null;

    /** @var array<PlatformPriceResult>|null */

    protected ?array $result = null;

    /**
     * @param array<PlatformPriceResult|array<mixed>>|null $result
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $sellerId = null,
        ?array $result = null
    ) {
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($result !== null) {
            foreach ($result as $key => $value) {
                if (is_array($value)) {
                    $result[$key] = $serviceProvider->create(
                        PlatformPriceResult::class,
                        $value
                    );
                }
            }
            $this->setResult($result);
        }
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
     * @return array<PlatformPriceResult>|null
     */
    public function getResult(): ?array
    {
        return $this->result;
    }

    /**
     * @param array<PlatformPriceResult> $result
     */
    public function setResult(?array $result): self
    {
        if ($result !== null) {
            $this->validateArrayElements($result, PlatformPriceResult::class);
        }
        $this->result = $result;
        return $this;
    }
}
