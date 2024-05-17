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

    public static function MULTISELECT(): self
    {
        return new self(self::MULTISELECT);
    }

    public static function SELECT(): self
    {
        return new self(self::SELECT);
    }

    public static function TEXT(): self
    {
        return new self(self::TEXT);
    }

    public static function TEXTAREA(): self
    {
        return new self(self::TEXTAREA);
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
