<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;

use Gubee\SDK\Enum\Catalog\Product\Attribute\Dimension\UnitTime\TypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class UnitTime extends AbstractModel
{
    protected TypeEnum $type;
    protected int $value;

    /**
     * @param string|TypeEnum $type
     */
    public function __construct(
        $type,
        int $value
    ) {
        if (is_string($type)) {
            $type = TypeEnum::fromValue($type);
        }
        $this->setType($type);
        $this->setValue($value);
    }

    public function getType(): TypeEnum
    {
        return $this->type;
    }

    public function setType(TypeEnum $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;
        return $this;
    }
}
