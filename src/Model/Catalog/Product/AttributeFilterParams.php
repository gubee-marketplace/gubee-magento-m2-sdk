<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product;

use Gubee\SDK\Model\AbstractModel;

class AttributeFilterParams extends AbstractModel
{
    protected ?string $attributeId = null;

    protected ?string $attributeValue = null;

    public function __construct(
        ?string $attributeId = null,
        ?string $attributeValue = null
    ) {
        if ($attributeId !== null) {
            $this->setAttributeId($attributeId);
        }
        if ($attributeValue !== null) {
            $this->setAttributeValue($attributeValue);
        }
    }

    public function getAttributeId(): ?string
    {
        return $this->attributeId;
    }

    public function setAttributeId(?string $attributeId): self
    {
        $this->attributeId = $attributeId;
        return $this;
    }

    public function getAttributeValue(): ?string
    {
        return $this->attributeValue;
    }

    public function setAttributeValue(?string $attributeValue): self
    {
        $this->attributeValue = $attributeValue;
        return $this;
    }
}
