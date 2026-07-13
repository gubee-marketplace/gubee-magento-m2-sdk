<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Model\AbstractModel;

class PagedResult extends AbstractModel
{
    /** @var array<int|string, mixed> */
    protected array $items;

    protected ?PageMetadata $page = null;

    /** @var array<string, mixed>|null */
    protected ?array $links = null;

    /**
     * @param array<int|string, mixed> $items
     * @param array<string, mixed>|null $links
     */
    public function __construct(
        array $items = [],
        ?PageMetadata $page = null,
        ?array $links = null
    ) {
        $this->setItems($items);
        if ($page !== null) {
            $this->setPage($page);
        }
        if ($links !== null) {
            $this->setLinks($links);
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

    public function getPage(): ?PageMetadata
    {
        return $this->page;
    }

    public function setPage(?PageMetadata $page): self
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getLinks(): ?array
    {
        return $this->links;
    }

    /**
     * @param array<string, mixed>|null $links
     */
    public function setLinks(?array $links): self
    {
        $this->links = $links;
        return $this;
    }
}
