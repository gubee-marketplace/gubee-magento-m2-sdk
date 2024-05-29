<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product\Attribute;

use Gubee\SDK\Enum\AbstractEnum;

class TypeEnum extends AbstractEnum
{
    private const MULTISELECT = 'MULTISELECT';
    private const SELECT      = 'SELECT';
    private const TEXT        = 'TEXT';
    private const TEXTAREA    = 'TEXTAREA';

    public static function MULTISELECT()
    {
        return new self(self::MULTISELECT);
    }

    public static function SELECT()
    {
        return new self(self::SELECT);
    }

    public static function TEXT()
    {
        return new self(self::TEXT);
    }

    public static function TEXTAREA()
    {
        return new self(self::TEXTAREA);
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
