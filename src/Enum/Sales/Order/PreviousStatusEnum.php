<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class PreviousStatusEnum extends AbstractEnum
{
    private const CREATED = 'CREATED';

    private const PAYED = 'PAYED';

    private const INVOICED = 'INVOICED';

    private const SHIPPED = 'SHIPPED';

    private const DELIVERED = 'DELIVERED';

    private const CONCLUDED = 'CONCLUDED';

    private const RETURNED = 'RETURNED';

    private const CANCELED = 'CANCELED';

    private const SHIPMENT_EXCEPTION = 'SHIPMENT_EXCEPTION';

    public static function CREATED(): self
    {
        return new self(self::CREATED);
    }

    public static function PAYED(): self
    {
        return new self(self::PAYED);
    }

    public static function INVOICED(): self
    {
        return new self(self::INVOICED);
    }

    public static function SHIPPED(): self
    {
        return new self(self::SHIPPED);
    }

    public static function DELIVERED(): self
    {
        return new self(self::DELIVERED);
    }

    public static function CONCLUDED(): self
    {
        return new self(self::CONCLUDED);
    }

    public static function RETURNED(): self
    {
        return new self(self::RETURNED);
    }

    public static function CANCELED(): self
    {
        return new self(self::CANCELED);
    }

    public static function SHIPMENT_EXCEPTION(): self
    {
        return new self(self::SHIPMENT_EXCEPTION);
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
