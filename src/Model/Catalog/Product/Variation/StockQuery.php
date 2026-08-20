<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation;

use Gubee\SDK\Enum\Catalog\Product\Variation\StockTypeEnum;
use Gubee\SDK\Enum\Platform\DomainTypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class StockQuery extends AbstractModel
{
    protected string $id;

    protected string $sellerId;

    protected string $itemId;

    protected string $warehouseId;

    protected int $qty;

    protected int $booking;

    protected int $priority;

    protected ?string $sku = null;

    protected StockTypeEnum $stockType;

    protected DomainTypeEnum $domainType;

    protected string $crossDockingTime;

    protected ?string $location = null;

    public function __construct(
        string $id,
        string $sellerId,
        string $itemId,
        string $warehouseId,
        int $qty,
        int $booking,
        int $priority,
        ?string $sku = null,
        StockTypeEnum|string $stockType,
        DomainTypeEnum|string $domainType,
        string $crossDockingTime,
        ?string $location = null
    ) {
        $this->setId($id);
        $this->setSellerId($sellerId);
        $this->setItemId($itemId);
        $this->setWarehouseId($warehouseId);
        $this->setQty($qty);
        $this->setBooking($booking);
        $this->setPriority($priority);
        if ($sku !== null) {
            $this->setSku($sku);
        }
        if (is_string($stockType)) {
            $stockType = StockTypeEnum::fromValue($stockType);
        }
        $this->setStockType($stockType);
        if (is_string($domainType)) {
            $domainType = DomainTypeEnum::fromValue($domainType);
        }
        $this->setDomainType($domainType);
        $this->setCrossDockingTime($crossDockingTime);
        if ($location !== null) {
            $this->setLocation($location);
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
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

    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function setItemId(string $itemId): self
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

    public function getBooking(): int
    {
        return $this->booking;
    }

    public function setBooking(int $booking): self
    {
        $this->booking = $booking;
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

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;
        return $this;
    }

    public function getStockType(): StockTypeEnum
    {
        return $this->stockType;
    }

    public function setStockType(StockTypeEnum $stockType): self
    {
        $this->stockType = $stockType;
        return $this;
    }

    public function getDomainType(): DomainTypeEnum
    {
        return $this->domainType;
    }

    public function setDomainType(DomainTypeEnum $domainType): self
    {
        $this->domainType = $domainType;
        return $this;
    }

    public function getCrossDockingTime(): string
    {
        return $this->crossDockingTime;
    }

    public function setCrossDockingTime(string $crossDockingTime): self
    {
        $this->crossDockingTime = $crossDockingTime;
        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;
        return $this;
    }
}
