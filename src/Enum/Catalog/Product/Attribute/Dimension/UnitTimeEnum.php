<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product\Attribute\Dimension;

use Gubee\SDK\Enum\AbstractEnum;

class UnitTimeEnum extends AbstractEnum
{
    private const DAYS  = 'DAYS';
    private const HOURS = 'HOURS';
    private const MONTH = 'MONTH';

    public static function DAYS()
    {
        return new self(self::DAYS);
    }

    public static function HOURS()
    {
        return new self(self::HOURS);
    }

    public static function MONTH()
    {
        return new self(self::MONTH);
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
