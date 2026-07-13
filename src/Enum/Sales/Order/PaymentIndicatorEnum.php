<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class PaymentIndicatorEnum extends AbstractEnum
{
    private const CASH = 'CASH';

    private const INSTALLMENT = 'INSTALLMENT';

    public static function CASH(): self
    {
        return new self(self::CASH);
    }

    public static function INSTALLMENT(): self
    {
        return new self(self::INSTALLMENT);
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
