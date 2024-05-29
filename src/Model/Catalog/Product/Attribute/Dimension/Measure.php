<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;

use Gubee\SDK\Enum\Catalog\Product\Attribute\Dimension\Measure\TypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class Measure extends AbstractModel
{
    protected TypeEnum $type;
    protected float $value;

    /**
     * @param TypeEnum|string $type
     */
    public function __construct(
        $type,
        float $value
    ) {
        if (is_string($type)) {
            $type = TypeEnum::fromValue($type);
        }
        $this->type  = $type;
        $this->value = $value;
    }

    public function getType(): TypeEnum
    {
        return $this->type;
    }

    public function setType(TypeEnum $type)
    {
        $this->type = $type;
        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value)
    {
        $this->value = $value;
        return $this;
    }
}
