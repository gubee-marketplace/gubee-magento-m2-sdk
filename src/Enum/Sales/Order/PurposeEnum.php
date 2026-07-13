<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class PurposeEnum extends AbstractEnum
{
    private const NORMAL = 'NORMAL';

    private const COMPLEMENTARY = 'COMPLEMENTARY';

    private const ADJUST_INVOICE = 'ADJUST_INVOICE';

    private const DEVOLUTION = 'DEVOLUTION';

    private const CREDIT = 'CREDIT';

    private const DEBIT = 'DEBIT';

    public static function NORMAL(): self
    {
        return new self(self::NORMAL);
    }

    public static function COMPLEMENTARY(): self
    {
        return new self(self::COMPLEMENTARY);
    }

    public static function ADJUST_INVOICE(): self
    {
        return new self(self::ADJUST_INVOICE);
    }

    public static function DEVOLUTION(): self
    {
        return new self(self::DEVOLUTION);
    }

    public static function CREDIT(): self
    {
        return new self(self::CREDIT);
    }

    public static function DEBIT(): self
    {
        return new self(self::DEBIT);
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
