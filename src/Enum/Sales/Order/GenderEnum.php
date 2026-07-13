<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class GenderEnum extends AbstractEnum
{
    private const MALE = 'MALE';

    private const FEMALE = 'FEMALE';

    private const UNISEX = 'UNISEX';

    public static function MALE(): self
    {
        return new self(self::MALE);
    }

    public static function FEMALE(): self
    {
        return new self(self::FEMALE);
    }

    public static function UNISEX(): self
    {
        return new self(self::UNISEX);
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
