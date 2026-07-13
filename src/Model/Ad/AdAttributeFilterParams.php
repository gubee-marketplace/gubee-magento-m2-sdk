<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Ad;

use Gubee\SDK\Model\AbstractModel;

class AdAttributeFilterParams extends AbstractModel
{
    protected string $attributeName;

    protected string $attributeValue;

    public function __construct(
        string $attributeName,
        string $attributeValue
    ) {
        $this->setAttributeName($attributeName);
        $this->setAttributeValue($attributeValue);
    }

    public function getAttributeName(): string
    {
        return $this->attributeName;
    }

    public function setAttributeName(string $attributeName): self
    {
        $this->attributeName = $attributeName;
        return $this;
    }

    public function getAttributeValue(): string
    {
        return $this->attributeValue;
    }

    public function setAttributeValue(string $attributeValue): self
    {
        $this->attributeValue = $attributeValue;
        return $this;
    }
}
