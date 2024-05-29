<?php

declare(strict_types=1);

namespace Gubee\SDK\Model\Catalog\Product\Attribute\Dimension;

use Gubee\SDK\Enum\Catalog\Product\Attribute\Dimension\Weight\TypeEnum;
use Gubee\SDK\Model\AbstractModel;

use function is_string;

class Weight extends AbstractModel
{
    protected TypeEnum $type;

    protected float $value;

    /**
     * @param string|TypeEnum $type
     */
    public function __construct($type, float $value)
    {
        if (is_string($type)) {
            $type = TypeEnum::fromValue($type);
        }
        $this->setType($type);
        $this->setValue($value);
    }

    public function getType(): TypeEnum
    {
        if ($this->type == TypeEnum::POUND()) {
            return TypeEnum::KILOGRAM();
        }

        return $this->type;
    }

    public function setType(TypeEnum $type)
    {
        $this->type = $type;
        return $this;
    }

    public function getValue(): float
    {
        if ($this->getType() === TypeEnum::POUND()) {
            return $this->value * 0.453592;
        }

        return $this->value;
    }

    public function setValue(float $value)
    {
        $this->value = $value;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'type'  => $this->getType()->__toString(),
            'value' => $this->getValue(),
        ];
    }
}
