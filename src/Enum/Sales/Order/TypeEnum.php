<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class TypeEnum extends AbstractEnum
{
    private const OUT = 'OUT';

    private const IN = 'IN';

    public static function OUT(): self
    {
        return new self(self::OUT);
    }

    public static function IN(): self
    {
        return new self(self::IN);
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
