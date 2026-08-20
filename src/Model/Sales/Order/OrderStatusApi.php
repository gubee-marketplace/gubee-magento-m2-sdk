<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Enum\Sales\Order\PreviousStatusEnum;
use Gubee\SDK\Enum\Sales\Order\StatusEnum;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Sales\Order\PlataformIntegrationStatus;

use function is_array;
use function is_string;

class OrderStatusApi extends AbstractModel
{
    protected StatusEnum $status;

    protected string $marketplaceStatus;

    protected DateTimeInterface $statusDt;

    protected ?DateTimeInterface $deliveredDt = null;

    protected ?DateTimeInterface $estimatedDeliveryDt = null;

    protected ?DateTimeInterface $shipmentExceptionDt = null;

    protected ?DateTimeInterface $cancelDt = null;

    /** @var array<string>|null */

    protected ?array $reason = null;

    protected ?PlataformIntegrationStatus $plataformIntegrationStatus = null;

    protected ?PreviousStatusEnum $previousStatus = null;

    /**
     * @param array<string>|null $reason
     * @param PlataformIntegrationStatus|array<mixed>|null $plataformIntegrationStatus
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        StatusEnum|string $status,
        string $marketplaceStatus,
        DateTimeInterface|string $statusDt,
        DateTimeInterface|string|null $deliveredDt = null,
        DateTimeInterface|string|null $estimatedDeliveryDt = null,
        DateTimeInterface|string|null $shipmentExceptionDt = null,
        DateTimeInterface|string|null $cancelDt = null,
        ?array $reason = null,
        PlataformIntegrationStatus|array|null $plataformIntegrationStatus = null,
        PreviousStatusEnum|string|null $previousStatus = null
    ) {
        if (is_string($status)) {
            $status = StatusEnum::fromValue($status);
        }
        $this->setStatus($status);
        $this->setMarketplaceStatus($marketplaceStatus);
        if (! $statusDt instanceof DateTimeInterface) {
            $statusDt = new DateTime($statusDt);
        }
        $this->setStatusDt($statusDt);
        if ($deliveredDt !== null) {
            if (! $deliveredDt instanceof DateTimeInterface) {
                $deliveredDt = new DateTime($deliveredDt);
            }
            $this->setDeliveredDt($deliveredDt);
        }
        if ($estimatedDeliveryDt !== null) {
            if (! $estimatedDeliveryDt instanceof DateTimeInterface) {
                $estimatedDeliveryDt = new DateTime($estimatedDeliveryDt);
            }
            $this->setEstimatedDeliveryDt($estimatedDeliveryDt);
        }
        if ($shipmentExceptionDt !== null) {
            if (! $shipmentExceptionDt instanceof DateTimeInterface) {
                $shipmentExceptionDt = new DateTime($shipmentExceptionDt);
            }
            $this->setShipmentExceptionDt($shipmentExceptionDt);
        }
        if ($cancelDt !== null) {
            if (! $cancelDt instanceof DateTimeInterface) {
                $cancelDt = new DateTime($cancelDt);
            }
            $this->setCancelDt($cancelDt);
        }
        if ($reason !== null) {
            $this->setReason($reason);
        }
        if ($plataformIntegrationStatus !== null) {
            if (is_array($plataformIntegrationStatus)) {
                $plataformIntegrationStatus = $serviceProvider->create(
                    PlataformIntegrationStatus::class,
                    $plataformIntegrationStatus
                );
            }
            $this->setPlataformIntegrationStatus($plataformIntegrationStatus);
        }
        if ($previousStatus !== null) {
            if (is_string($previousStatus)) {
                $previousStatus = PreviousStatusEnum::fromValue($previousStatus);
            }
            $this->setPreviousStatus($previousStatus);
        }
    }

    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    public function setStatus(StatusEnum $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getMarketplaceStatus(): string
    {
        return $this->marketplaceStatus;
    }

    public function setMarketplaceStatus(string $marketplaceStatus): self
    {
        $this->marketplaceStatus = $marketplaceStatus;
        return $this;
    }

    public function getStatusDt(): DateTimeInterface
    {
        return $this->statusDt;
    }

    public function setStatusDt(DateTimeInterface $statusDt): self
    {
        $this->statusDt = $statusDt;
        return $this;
    }

    public function getDeliveredDt(): ?DateTimeInterface
    {
        return $this->deliveredDt;
    }

    public function setDeliveredDt(?DateTimeInterface $deliveredDt): self
    {
        $this->deliveredDt = $deliveredDt;
        return $this;
    }

    public function getEstimatedDeliveryDt(): ?DateTimeInterface
    {
        return $this->estimatedDeliveryDt;
    }

    public function setEstimatedDeliveryDt(?DateTimeInterface $estimatedDeliveryDt): self
    {
        $this->estimatedDeliveryDt = $estimatedDeliveryDt;
        return $this;
    }

    public function getShipmentExceptionDt(): ?DateTimeInterface
    {
        return $this->shipmentExceptionDt;
    }

    public function setShipmentExceptionDt(?DateTimeInterface $shipmentExceptionDt): self
    {
        $this->shipmentExceptionDt = $shipmentExceptionDt;
        return $this;
    }

    public function getCancelDt(): ?DateTimeInterface
    {
        return $this->cancelDt;
    }

    public function setCancelDt(?DateTimeInterface $cancelDt): self
    {
        $this->cancelDt = $cancelDt;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getReason(): ?array
    {
        return $this->reason;
    }

    /**
     * @param array<string> $reason
     */
    public function setReason(?array $reason): self
    {
        if ($reason !== null) {
            $this->validateArrayElements($reason, 'string');
        }
        $this->reason = $reason;
        return $this;
    }

    public function getPlataformIntegrationStatus(): ?PlataformIntegrationStatus
    {
        return $this->plataformIntegrationStatus;
    }

    public function setPlataformIntegrationStatus(?PlataformIntegrationStatus $plataformIntegrationStatus): self
    {
        $this->plataformIntegrationStatus = $plataformIntegrationStatus;
        return $this;
    }

    public function getPreviousStatus(): ?PreviousStatusEnum
    {
        return $this->previousStatus;
    }

    public function setPreviousStatus(?PreviousStatusEnum $previousStatus): self
    {
        $this->previousStatus = $previousStatus;
        return $this;
    }
}
