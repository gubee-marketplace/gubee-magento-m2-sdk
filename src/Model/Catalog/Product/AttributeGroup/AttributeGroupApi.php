<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\AttributeGroup;

use Gubee\SDK\Model\AbstractModel;

class AttributeGroupApi extends AbstractModel
{
    protected string $name;

    /** @var array<string> */

    protected array $attributes;

    /**
     * @param array<string> $attributes
     */
    public function __construct(
        string $name,
        array $attributes
    ) {
        $this->setName($name);
        $this->setAttributes($attributes);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array<string> $attributes
     */
    public function setAttributes(array $attributes): self
    {
        $this->validateArrayElements($attributes, 'string');
        $this->attributes = $attributes;
        return $this;
    }
}
