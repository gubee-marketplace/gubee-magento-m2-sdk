<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order\Queue;

use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Sales\Order\Queue\RejectedOrderStatus;

use function is_array;

class RejectedOrder extends AbstractModel
{
    protected string $orderId;

    protected string $externalId;

    protected string $marketplace;

    /** @var array<RejectedOrderStatus> */

    protected array $rejectedOrderStatus;

    /**
     * @param array<RejectedOrderStatus|array<mixed>> $rejectedOrderStatus
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $orderId,
        string $externalId,
        string $marketplace,
        array $rejectedOrderStatus
    ) {
        $this->setOrderId($orderId);
        $this->setExternalId($externalId);
        $this->setMarketplace($marketplace);
        foreach ($rejectedOrderStatus as $key => $value) {
            if (is_array($value)) {
                $rejectedOrderStatus[$key] = $serviceProvider->create(
                    RejectedOrderStatus::class,
                    $value
                );
            }
        }
        $this->setRejectedOrderStatus($rejectedOrderStatus);
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function setOrderId(string $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): self
    {
        $this->externalId = $externalId;
        return $this;
    }

    public function getMarketplace(): string
    {
        return $this->marketplace;
    }

    public function setMarketplace(string $marketplace): self
    {
        $this->marketplace = $marketplace;
        return $this;
    }

    /**
     * @return array<RejectedOrderStatus>
     */
    public function getRejectedOrderStatus(): array
    {
        return $this->rejectedOrderStatus;
    }

    /**
     * @param array<RejectedOrderStatus> $rejectedOrderStatus
     */
    public function setRejectedOrderStatus(array $rejectedOrderStatus): self
    {
        $this->validateArrayElements($rejectedOrderStatus, RejectedOrderStatus::class);
        $this->rejectedOrderStatus = $rejectedOrderStatus;
        return $this;
    }
}
