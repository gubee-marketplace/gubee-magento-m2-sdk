<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product\Attribute\Dimension\Measure;

use Gubee\SDK\Enum\AbstractEnum;

class TypeEnum extends AbstractEnum
{
    private const CENTIMETER = 'CENTIMETER';
    private const METER      = 'METER';
    private const MILLIMETER = 'MILLIMETER';

    public static function CENTIMETER()
    {
        return new self(self::CENTIMETER);
    }

    public static function METER()
    {
        return new self(self::METER);
    }

    public static function MILLIMETER()
    {
        return new self(self::MILLIMETER);
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
