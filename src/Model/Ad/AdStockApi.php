<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use DateTimeInterface;
use Gubee\SDK\Model\AbstractModel;

class AdStockApi extends AbstractModel
{
    protected ?string $id = null;

    protected string $sellerId;

    protected ?string $itemId = null;

    protected string $warehouseId;

    protected int $qty;

    protected int $stockBooking;

    protected int $priority;

    protected ?string $crossDockingTime = null;

    protected ?string $createdBy = null;

    protected ?DateTimeInterface $createdDt = null;

    protected ?DateTimeInterface $lastModifiedDt = null;

    /**
     * @param string|DateTimeInterface|null $createdDt
     * @param string|DateTimeInterface|null $lastModifiedDt
     */
    public function __construct(
        ?string $id = null,
        string $sellerId,
        ?string $itemId = null,
        string $warehouseId,
        int $qty,
        int $stockBooking,
        int $priority,
        ?string $crossDockingTime = null,
        ?string $createdBy = null,
        ?DateTimeInterface $createdDt = null,
        ?DateTimeInterface $lastModifiedDt = null
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setSellerId($sellerId);
        if ($itemId !== null) {
            $this->setItemId($itemId);
        }
        $this->setWarehouseId($warehouseId);
        $this->setQty($qty);
        $this->setStockBooking($stockBooking);
        $this->setPriority($priority);
        if ($crossDockingTime !== null) {
            $this->setCrossDockingTime($crossDockingTime);
        }
        if ($createdBy !== null) {
            $this->setCreatedBy($createdBy);
        }
        if ($createdDt !== null) {
            $this->setCreatedDt($createdDt);
        }
        if ($lastModifiedDt !== null) {
            $this->setLastModifiedDt($lastModifiedDt);
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

    public function getSellerId(): string
    {
        return $this->sellerId;
    }

    public function setSellerId(string $sellerId): self
    {
        $this->sellerId = $sellerId;
        return $this;
    }

    public function getItemId(): ?string
    {
        return $this->itemId;
    }

    public function setItemId(?string $itemId): self
    {
        $this->itemId = $itemId;
        return $this;
    }

    public function getWarehouseId(): string
    {
        return $this->warehouseId;
    }

    public function setWarehouseId(string $warehouseId): self
    {
        $this->warehouseId = $warehouseId;
        return $this;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): self
    {
        $this->qty = $qty;
        return $this;
    }

    public function getStockBooking(): int
    {
        return $this->stockBooking;
    }

    public function setStockBooking(int $stockBooking): self
    {
        $this->stockBooking = $stockBooking;
        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    public function getCrossDockingTime(): ?string
    {
        return $this->crossDockingTime;
    }

    public function setCrossDockingTime(?string $crossDockingTime): self
    {
        $this->crossDockingTime = $crossDockingTime;
        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?string $createdBy): self
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getCreatedDt(): ?DateTimeInterface
    {
        return $this->createdDt;
    }

    public function setCreatedDt(?DateTimeInterface $createdDt): self
    {
        $this->createdDt = $createdDt;
        return $this;
    }

    public function getLastModifiedDt(): ?DateTimeInterface
    {
        return $this->lastModifiedDt;
    }

    public function setLastModifiedDt(?DateTimeInterface $lastModifiedDt): self
    {
        $this->lastModifiedDt = $lastModifiedDt;
        return $this;
    }
}
