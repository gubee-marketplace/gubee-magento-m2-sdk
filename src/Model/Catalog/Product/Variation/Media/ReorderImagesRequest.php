<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Variation\Media;

use Gubee\SDK\Model\AbstractModel;

class ReorderImagesRequest extends AbstractModel
{
    protected ?string $sellerId = null;

    /** @var array<string>|null */

    protected ?array $orderedUuids = null;

    /**
     * @param array<string>|null $orderedUuids
     */
    public function __construct(
        ?string $sellerId = null,
        ?array $orderedUuids = null
    ) {
        if ($sellerId !== null) {
            $this->setSellerId($sellerId);
        }
        if ($orderedUuids !== null) {
            $this->setOrderedUuids($orderedUuids);
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

    /**
     * @return array<string>|null
     */
    public function getOrderedUuids(): ?array
    {
        return $this->orderedUuids;
    }

    /**
     * @param array<string> $orderedUuids
     */
    public function setOrderedUuids(?array $orderedUuids): self
    {
        if ($orderedUuids !== null) {
            $this->validateArrayElements($orderedUuids, 'string');
        }
        $this->orderedUuids = $orderedUuids;
        return $this;
    }
}
