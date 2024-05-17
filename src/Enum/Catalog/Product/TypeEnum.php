<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product;

class TypeEnum extends StatusEnum
{
    private const KIT     = 'KIT';
    private const SIMPLE  = 'SIMPLE';
    private const VARIANT = 'VARIANT';
    private const VIRTUAL = 'VIRTUAL';

    public static function KIT(): self
    {
        return new self(self::KIT);
    }

    public static function SIMPLE(): self
    {
        return new self(self::SIMPLE);
    }

    public static function VARIANT(): self
    {
        return new self(self::VARIANT);
    }

    public static function VIRTUAL(): self
    {
        return new self(self::VIRTUAL);
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
