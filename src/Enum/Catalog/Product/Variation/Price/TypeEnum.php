<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product\Variation\Price;

use Gubee\SDK\Enum\AbstractEnum;

class TypeEnum extends AbstractEnum
{
    private const DEFAULT   = 'DEFAULT';
    private const PROMOTION = 'PROMOTION';

    public static function DEFAULT()
    {
        return new self(self::DEFAULT);
    }

    public static function PROMOTION()
    {
        return new self(self::PROMOTION);
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
