<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Invoice;

use Gubee\SDK\Model\AbstractModel;

class SortParam extends AbstractModel
{
    protected ?string $field = null;

    protected ?string $direction = null;

    public function __construct(
        ?string $field = null,
        ?string $direction = null
    ) {
        if ($field !== null) {
            $this->setField($field);
        }
        if ($direction !== null) {
            $this->setDirection($direction);
        }
    }

    public function getField(): ?string
    {
        return $this->field;
    }

    public function setField(?string $field): self
    {
        $this->field = $field;
        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(?string $direction): self
    {
        $this->direction = $direction;
        return $this;
    }
}
