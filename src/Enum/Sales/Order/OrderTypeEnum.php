<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class OrderTypeEnum extends AbstractEnum
{
    private const SALE = 'SALE';

    private const RETURN = 'RETURN';

    private const EXCHANGE = 'EXCHANGE';

    public static function SALE(): self
    {
        return new self(self::SALE);
    }

    public static function RETURN(): self
    {
        return new self(self::RETURN);
    }

    public static function EXCHANGE(): self
    {
        return new self(self::EXCHANGE);
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
