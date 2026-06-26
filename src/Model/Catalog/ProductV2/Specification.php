<?php

declare(strict_types=1);

namespace Gubee\Integration\Model\Catalog\ProductV2;

use Gubee\SDK\Model\AbstractModel;

class Specification extends AbstractModel
{
    protected string $name;
    /** @var array<string> */
    protected array $values;

    /**
     * @param array<string> $values
     */
    public function __construct(
        string $name,
        array $values = []
    ) {
        $this->name   = $name;
        $this->values = $values;
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
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array<string> $values
     */
    public function setValues(array $values): self
    {
        $this->values = $values;
        return $this;
    }
}
