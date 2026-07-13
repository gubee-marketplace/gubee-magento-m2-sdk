<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Common;

use Gubee\SDK\Model\AbstractModel;

class StringMap extends AbstractModel
{
    /** @var array<string, string> */
    protected array $values;

    /**
     * @param array<string, string> $values
     */
    public function __construct(array $values)
    {
        $this->setValues($values);
    }

    /**
     * @return array<string, string>
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array<string, string> $values
     */
    public function setValues(array $values): self
    {
        $this->validateArrayElements($values, 'string');
        $this->values = $values;
        return $this;
    }
}
