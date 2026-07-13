<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Model\AbstractModel;

class Specification extends AbstractModel
{
    protected ?string $id = null;

    protected string $name;

    /** @var array<string> */

    protected array $values;

    /**
     * @param array<string> $values
     */
    public function __construct(
        ?string $id = null,
        string $name,
        array $values
    ) {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setName($name);
        $this->setValues($values);
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
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
        $this->validateArrayElements($values, 'string');
        $this->values = $values;
        return $this;
    }
}
