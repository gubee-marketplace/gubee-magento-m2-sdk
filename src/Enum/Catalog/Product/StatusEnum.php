<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product;

use Gubee\SDK\Enum\AbstractEnum;

class StatusEnum extends AbstractEnum
{
    private const ACTIVE   = 'ACTIVE';
    private const INACTIVE = 'INACTIVE';

    public static function ACTIVE(): self
    {
        return new self(self::ACTIVE);
    }

    public static function INACTIVE(): self
    {
        return new self(self::INACTIVE);
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
