<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\ProductV2;

use Gubee\SDK\Model\AbstractModel;

class AttributeValue extends AbstractModel
{
    protected ?string $attributeId = null;

    /** @var array<string> */

    protected array $values;

    /**
     * @param array<string> $values
     */
    public function __construct(
        ?string $attributeId = null,
        array $values
    ) {
        if ($attributeId !== null) {
            $this->setAttributeId($attributeId);
        }
        $this->setValues($values);
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

    /**
     * @return array<string>
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array<string> $values
     */
    public function setValues(array $values): self
    {
        $this->validateArrayElements($values, 'string');
        $this->values = $values;
        return $this;
    }
}
