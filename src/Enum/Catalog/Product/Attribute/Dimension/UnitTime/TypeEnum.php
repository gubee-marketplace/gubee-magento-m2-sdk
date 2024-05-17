<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product\Attribute\Dimension\UnitTime;

use Gubee\SDK\Enum\AbstractEnum;

class TypeEnum extends AbstractEnum
{
    private const DAYS  = 'DAYS';
    private const HOURS = 'HOURS';
    private const MONTH = 'MONTH';

    public static function DAYS(): self
    {
        return new self(self::DAYS);
    }

    public static function HOURS(): self
    {
        return new self(self::HOURS);
    }

    public static function MONTH(): self
    {
        return new self(self::MONTH);
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
