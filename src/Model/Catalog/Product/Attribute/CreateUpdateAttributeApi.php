<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Attribute;

use Gubee\SDK\Model\AbstractModel;

class CreateUpdateAttributeApi extends AbstractModel
{
    protected ?string $name = null;

    /** @var array<string> */

    protected array $values;

    /**
     * @param array<string> $values
     */
    public function __construct(
        ?string $name = null,
        array $values
    ) {
        if ($name !== null) {
            $this->setName($name);
        }
        $this->setValues($values);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
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
