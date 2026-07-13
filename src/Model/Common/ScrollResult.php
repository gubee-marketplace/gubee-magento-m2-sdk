<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Model\AbstractModel;

class ScrollResult extends AbstractModel
{
    /** @var array<int|string, mixed> */
    protected array $items;

    protected ?string $scrollId = null;

    protected ?int $pageSize = null;

    protected ?int $totalElements = null;

    /**
     * @param array<int|string, mixed> $items
     */
    public function __construct(
        array $items = [],
        ?string $scrollId = null,
        ?int $pageSize = null,
        ?int $totalElements = null
    ) {
        $this->setItems($items);
        if ($scrollId !== null) {
            $this->setScrollId($scrollId);
        }
        if ($pageSize !== null) {
            $this->setPageSize($pageSize);
        }
        if ($totalElements !== null) {
            $this->setTotalElements($totalElements);
        }
    }

    /**
     * @return array<int|string, mixed>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array<int|string, mixed> $items
     */
    public function setItems(array $items): self
    {
        $this->items = $items;
        return $this;
    }

    public function getScrollId(): ?string
    {
        return $this->scrollId;
    }

    public function setScrollId(?string $scrollId): self
    {
        $this->scrollId = $scrollId;
        return $this;
    }

    public function getPageSize(): ?int
    {
        return $this->pageSize;
    }

    public function setPageSize(?int $pageSize): self
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function getTotalElements(): ?int
    {
        return $this->totalElements;
    }

    public function setTotalElements(?int $totalElements): self
    {
        $this->totalElements = $totalElements;
        return $this;
    }
}
