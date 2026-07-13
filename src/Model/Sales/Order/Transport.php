<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\AbstractModel;

class Transport extends AbstractModel
{
    protected string $carrier;

    protected string $method;

    protected string $link;

    protected ?string $trackingCode = null;

    protected DateTimeInterface $deliveredCarrierDate;

    public function __construct(
        string $carrier,
        string $method,
        string $link,
        ?string $trackingCode = null,
        DateTimeInterface|string $deliveredCarrierDate
    ) {
        $this->setCarrier($carrier);
        $this->setMethod($method);
        $this->setLink($link);
        if ($trackingCode !== null) {
            $this->setTrackingCode($trackingCode);
        }
        if (! $deliveredCarrierDate instanceof DateTimeInterface) {
            $deliveredCarrierDate = new DateTime($deliveredCarrierDate);
        }
        $this->setDeliveredCarrierDate($deliveredCarrierDate);
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function setCarrier(string $carrier): self
    {
        $this->carrier = $carrier;
        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getTrackingCode(): ?string
    {
        return $this->trackingCode;
    }

    public function setTrackingCode(?string $trackingCode): self
    {
        $this->trackingCode = $trackingCode;
        return $this;
    }

    public function getDeliveredCarrierDate(): DateTimeInterface
    {
        return $this->deliveredCarrierDate;
    }

    public function setDeliveredCarrierDate(DateTimeInterface $deliveredCarrierDate): self
    {
        $this->deliveredCarrierDate = $deliveredCarrierDate;
        return $this;
    }
}
