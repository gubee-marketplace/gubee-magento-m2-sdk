<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use Gubee\SDK\Enum\Ad\AssociateTypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class AssociateAd extends AbstractModel
{
    protected string $id;

    protected ?int $qty = null;

    protected AssociateTypeEnum $type;

    protected ?string $mainImg = null;

    /** @var array<string>|null */

    protected ?array $tags = null;

    protected ?string $sku = null;

    /**
     * @param array<string>|null $tags
     */
    public function __construct(
        string $id,
        ?int $qty = null,
        AssociateTypeEnum|string $type,
        ?string $mainImg = null,
        ?array $tags = null,
        ?string $sku = null
    ) {
        $this->setId($id);
        if ($qty !== null) {
            $this->setQty($qty);
        }
        if (is_string($type)) {
            $type = AssociateTypeEnum::fromValue($type);
        }
        $this->setType($type);
        if ($mainImg !== null) {
            $this->setMainImg($mainImg);
        }
        if ($tags !== null) {
            $this->setTags($tags);
        }
        if ($sku !== null) {
            $this->setSku($sku);
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

    public function getQty(): ?int
    {
        return $this->qty;
    }

    public function setQty(?int $qty): self
    {
        $this->qty = $qty;
        return $this;
    }

    public function getType(): AssociateTypeEnum
    {
        return $this->type;
    }

    public function setType(AssociateTypeEnum $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getMainImg(): ?string
    {
        return $this->mainImg;
    }

    public function setMainImg(?string $mainImg): self
    {
        $this->mainImg = $mainImg;
        return $this;
    }

    /**
     * @return array<string>|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param array<string> $tags
     */
    public function setTags(?array $tags): self
    {
        if ($tags !== null) {
            $this->validateArrayElements($tags, 'string');
        }
        $this->tags = $tags;
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
}
