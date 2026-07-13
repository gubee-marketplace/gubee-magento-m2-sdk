<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Sales\Order\ItemOrder;
use Gubee\SDK\Model\Sales\Order\Tracking;
use Gubee\SDK\Model\Sales\Order\Transport;

use function is_array;

class Shipment extends AbstractModel
{
    protected string $code;

    protected ?string $invoiceKey = null;

    protected Transport $transport;

    /** @var array<ItemOrder> */

    protected array $items;

    /** @var array<Tracking> */

    protected array $tracks;

    protected DateTimeInterface $estimatedDeliveryDt;

    protected ?DateTimeInterface $deliveredDt = null;

    protected ?array $additionalInfo = null;

    /**
     * @param Transport|array<mixed> $transport
     * @param array<ItemOrder|array<mixed>> $items
     * @param array<Tracking|array<mixed>> $tracks
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        string $code,
        ?string $invoiceKey = null,
        Transport|array $transport,
        array $items,
        array $tracks,
        DateTimeInterface|string $estimatedDeliveryDt,
        DateTimeInterface|string|null $deliveredDt = null,
        ?array $additionalInfo = null
    ) {
        $this->setCode($code);
        if ($invoiceKey !== null) {
            $this->setInvoiceKey($invoiceKey);
        }
        if (is_array($transport)) {
            $transport = $serviceProvider->create(
                Transport::class,
                $transport
            );
        }
        $this->setTransport($transport);
        foreach ($items as $key => $item) {
            if (is_array($item)) {
                $items[$key] = $serviceProvider->create(
                    ItemOrder::class,
                    $item
                );
            }
        }
        $this->setItems($items);
        foreach ($tracks as $key => $value) {
            if (is_array($value)) {
                $tracks[$key] = $serviceProvider->create(
                    Tracking::class,
                    $value
                );
            }
        }
        $this->setTracks($tracks);
        if (! $estimatedDeliveryDt instanceof DateTimeInterface) {
            $estimatedDeliveryDt = new DateTime($estimatedDeliveryDt);
        }
        $this->setEstimatedDeliveryDt($estimatedDeliveryDt);
        if ($deliveredDt !== null) {
            if (! $deliveredDt instanceof DateTimeInterface) {
                $deliveredDt = new DateTime($deliveredDt);
            }
            $this->setDeliveredDt($deliveredDt);
        }
        if ($additionalInfo !== null) {
            $this->setAdditionalInfo($additionalInfo);
        }
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getInvoiceKey(): ?string
    {
        return $this->invoiceKey;
    }

    public function setInvoiceKey(?string $invoiceKey): self
    {
        $this->invoiceKey = $invoiceKey;
        return $this;
    }

    public function getTransport(): Transport
    {
        return $this->transport;
    }

    public function setTransport(Transport $transport): self
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * @return array<ItemOrder>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array<ItemOrder> $items
     */
    public function setItems(array $items): self
    {
        $this->validateArrayElements($items, ItemOrder::class);
        $this->items = $items;
        return $this;
    }

    /**
     * @return array<Tracking>
     */
    public function getTracks(): array
    {
        return $this->tracks;
    }

    /**
     * @param array<Tracking> $tracks
     */
    public function setTracks(array $tracks): self
    {
        $this->validateArrayElements($tracks, Tracking::class);
        $this->tracks = $tracks;
        return $this;
    }

    public function getEstimatedDeliveryDt(): DateTimeInterface
    {
        return $this->estimatedDeliveryDt;
    }

    public function setEstimatedDeliveryDt(DateTimeInterface $estimatedDeliveryDt): self
    {
        $this->estimatedDeliveryDt = $estimatedDeliveryDt;
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

    public function getAdditionalInfo(): ?array
    {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo(?array $additionalInfo): self
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }
}
