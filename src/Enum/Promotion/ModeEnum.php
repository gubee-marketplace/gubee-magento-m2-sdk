<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Promotion;

use Gubee\SDK\Enum\AbstractEnum;

class ModeEnum extends AbstractEnum
{
    private const SUM_FIXED_PRICE = 'SUM_FIXED_PRICE';

    private const SUBTRACT_FIXED_PRICE = 'SUBTRACT_FIXED_PRICE';

    private const PERCENTUAL = 'PERCENTUAL';

    public static function SUM_FIXED_PRICE(): self
    {
        return new self(self::SUM_FIXED_PRICE);
    }

    public static function SUBTRACT_FIXED_PRICE(): self
    {
        return new self(self::SUBTRACT_FIXED_PRICE);
    }

    public static function PERCENTUAL(): self
    {
        return new self(self::PERCENTUAL);
    }

    /**
     * Create a new instance of the enum based into a given value
     *
     * @param mixed $value
     */
    public static function fromValue($value): self
    {
        return new self($value);
    }
}
