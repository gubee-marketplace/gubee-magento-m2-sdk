<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Sales\Order;

use DateTime;
use DateTimeInterface;
use Gubee\SDK\Model\AbstractModel;

class OrderTagApi extends AbstractModel
{
    protected ?string $id = null;

    protected ?string $sellerId = null;

    protected ?string $accountId = null;

    protected ?string $platform = null;

    protected ?string $customerName = null;

    protected ?float $value = null;

    protected ?DateTimeInterface $date = null;

    protected ?string $status = null;

    protected ?string $carrierName = null;

    protected ?string $currentStatus = null;

    protected ?DateTimeInterface $shippingDeadlineDt = null;

    protected ?DateTimeInterface $invoiceIssueDt = null;

    public function __construct(
        ?string $id = null,
        ?string $sellerId = null,
        ?string $accountId = null,
        ?string $platform = null,
        ?string $customerName = null,
        ?float $value = null,
        DateTimeInterface|string|null $date = null,
        ?string $status = null,
        ?string $carrierName = null,
        ?string $currentStatus = null,
        DateTimeInterface|string|null $shippingDeadlineDt = null,
        DateTimeInterface|string|null $invoiceIssueDt = null
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
        if ($platform !== null) {
            $this->setPlatform($platform);
        }
        if ($customerName !== null) {
            $this->setCustomerName($customerName);
        }
        if ($value !== null) {
            $this->setValue($value);
        }
        if ($date !== null) {
            if (! $date instanceof DateTimeInterface) {
                $date = new DateTime($date);
            }
            $this->setDate($date);
        }
        if ($status !== null) {
            $this->setStatus($status);
        }
        if ($carrierName !== null) {
            $this->setCarrierName($carrierName);
        }
        if ($currentStatus !== null) {
            $this->setCurrentStatus($currentStatus);
        }
        if ($shippingDeadlineDt !== null) {
            if (! $shippingDeadlineDt instanceof DateTimeInterface) {
                $shippingDeadlineDt = new DateTime($shippingDeadlineDt);
            }
            $this->setShippingDeadlineDt($shippingDeadlineDt);
        }
        if ($invoiceIssueDt !== null) {
            if (! $invoiceIssueDt instanceof DateTimeInterface) {
                $invoiceIssueDt = new DateTime($invoiceIssueDt);
            }
            $this->setInvoiceIssueDt($invoiceIssueDt);
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

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(?string $platform): self
    {
        $this->platform = $platform;
        return $this;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(?string $customerName): self
    {
        $this->customerName = $customerName;
        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCarrierName(): ?string
    {
        return $this->carrierName;
    }

    public function setCarrierName(?string $carrierName): self
    {
        $this->carrierName = $carrierName;
        return $this;
    }

    public function getCurrentStatus(): ?string
    {
        return $this->currentStatus;
    }

    public function setCurrentStatus(?string $currentStatus): self
    {
        $this->currentStatus = $currentStatus;
        return $this;
    }

    public function getShippingDeadlineDt(): ?DateTimeInterface
    {
        return $this->shippingDeadlineDt;
    }

    public function setShippingDeadlineDt(?DateTimeInterface $shippingDeadlineDt): self
    {
        $this->shippingDeadlineDt = $shippingDeadlineDt;
        return $this;
    }

    public function getInvoiceIssueDt(): ?DateTimeInterface
    {
        return $this->invoiceIssueDt;
    }

    public function setInvoiceIssueDt(?DateTimeInterface $invoiceIssueDt): self
    {
        $this->invoiceIssueDt = $invoiceIssueDt;
        return $this;
    }
}
