<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Api\ServiceProviderInterface;
use Gubee\SDK\Model\AbstractModel;
use Gubee\SDK\Model\Invoice\InvoiceStatusApiModel;

use function is_array;

class InvoiceApiModel extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $sellerId = null;

    protected ?string $accountId = null;

    protected ?string $orderId = null;

    protected ?string $shipmentId = null;

    protected ?string $type = null;

    protected ?string $extension = null;

    protected ?string $platform = null;

    protected ?string $link = null;

    protected ?DateTimeInterface $createdDate = null;

    /** @var array<InvoiceStatusApiModel>|null */

    protected ?array $statuses = null;

    /**
     * @param array<InvoiceStatusApiModel|array<mixed>>|null $statuses
     */
    public function __construct(
        ServiceProviderInterface $serviceProvider,
        ?string $id = null,
        ?string $sellerId = null,
        ?string $accountId = null,
        ?string $orderId = null,
        ?string $shipmentId = null,
        ?string $type = null,
        ?string $extension = null,
        ?string $platform = null,
        ?string $link = null,
        DateTimeInterface|string|null $createdDate = null,
        ?array $statuses = null
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($accountId !== null) {
            $this->setAccountId($accountId);
        }
        if ($orderId !== null) {
            $this->setOrderId($orderId);
        }
        if ($shipmentId !== null) {
            $this->setShipmentId($shipmentId);
        }
        if ($type !== null) {
            $this->setType($type);
        }
        if ($extension !== null) {
            $this->setExtension($extension);
        }
        if ($platform !== null) {
            $this->setPlatform($platform);
        }
        if ($link !== null) {
            $this->setLink($link);
        }
        if ($createdDate !== null) {
            if (! $createdDate instanceof DateTimeInterface) {
                $createdDate = new DateTime($createdDate);
            }
            $this->setCreatedDate($createdDate);
        }
        if ($statuses !== null) {
            foreach ($statuses as $key => $value) {
                if (is_array($value)) {
                    $statuses[$key] = $serviceProvider->create(
                        InvoiceStatusApiModel::class,
                        $value
                    );
                }
            }
            $this->setStatuses($statuses);
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

    public function getSellerId(): ?string
    {
        return $this->sellerId;
    }

    public function setSellerId(?string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    public function setAccountId(?string $accountId): self
    {
        $this->accountId = $accountId;
        return $this;
    }

    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    public function setOrderId(?string $orderId): self
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function getShipmentId(): ?string
    {
        return $this->shipmentId;
    }

    public function setShipmentId(?string $shipmentId): self
    {
        $this->shipmentId = $shipmentId;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(?string $extension): self
    {
        $this->extension = $extension;
        return $this;
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getCreatedDate(): ?DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(?DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return array<InvoiceStatusApiModel>|null
     */
    public function getStatuses(): ?array
    {
        return $this->statuses;
    }

    /**
     * @param array<InvoiceStatusApiModel> $statuses
     */
    public function setStatuses(?array $statuses): self
    {
        if ($statuses !== null) {
            $this->validateArrayElements($statuses, InvoiceStatusApiModel::class);
        }
        $this->statuses = $statuses;
        return $this;
    }
}
