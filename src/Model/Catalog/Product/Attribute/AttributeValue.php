<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Attribute;

use Gubee\SDK\Model\AbstractModel;

class AttributeValue extends AbstractModel
{
    protected string $attribute;
    /** @var array<mixed> */
    protected array $values;

    /**
     * @param array<mixed> $values
     */
    public function __construct(
        string $attribute,
        array $values = []
    ) {
        $this->attribute = $attribute;
        $this->values    = $values;
    }

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function setAttribute(string $attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * @return array<mixed>
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array<mixed> $values
     */
    public function setValues(array $values)
    {
        $this->values = $values;
        return $this;
    }
}
