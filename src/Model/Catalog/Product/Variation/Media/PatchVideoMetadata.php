<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation\Media;

use Gubee\SDK\Model\AbstractModel;

class PatchVideoMetadata extends AbstractModel
{
    protected ?string $sellerId = null;

    protected ?bool $main = null;

    protected ?int $order = null;

    public function __construct(
        ?string $sellerId = null,
        ?bool $main = null,
        ?int $order = null
    ) {
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($main !== null) {
            $this->setMain($main);
        }
        if ($order !== null) {
            $this->setOrder($order);
        }
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

    public function getMain(): ?bool
    {
        return $this->main;
    }

    public function setMain(?bool $main): self
    {
        $this->main = $main;
        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): self
    {
        $this->order = $order;
        return $this;
    }
}
