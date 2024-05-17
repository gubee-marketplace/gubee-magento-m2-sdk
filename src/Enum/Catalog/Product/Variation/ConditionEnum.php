<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product\Variation;

use Gubee\SDK\Enum\AbstractEnum;

class ConditionEnum extends AbstractEnum
{
    private const NEW  = 'NEW';
    private const USED = 'USED';

    public static function NEW(): self
    {
        return new self(self::NEW);
    }

    public static function USED(): self
    {
        return new self(self::USED);
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
