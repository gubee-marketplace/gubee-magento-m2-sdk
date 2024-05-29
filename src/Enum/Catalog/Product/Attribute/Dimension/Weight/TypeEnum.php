<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product\Attribute\Dimension\Weight;

use Gubee\SDK\Enum\AbstractEnum;

class TypeEnum extends AbstractEnum
{
    private const POUND    = 'POUND';
    private const GRAM     = 'GRAM';
    private const KILOGRAM = 'KILOGRAM';

    public static function POUND()
    {
        return new self(self::POUND);
    }

    public static function GRAM()
    {
        return new self(self::GRAM);
    }

    public static function KILOGRAM()
    {
        return new self(self::KILOGRAM);
    }

    /**
     * Create a new instance of the enum based into a given value
     *
     * @param mixed $value
     */
    public static function fromValue($value)
    {
        return new self($value);
    }
}
