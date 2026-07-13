<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class FreightTypeEnum extends AbstractEnum
{
    private const NORMAL = 'NORMAL';

    private const EXPRESS = 'EXPRESS';

    private const PICKUP = 'PICKUP';

    private const SAME_DAY = 'SAME_DAY';

    private const NEXT_DAY = 'NEXT_DAY';

    private const SCHEDULED = 'SCHEDULED';

    public static function NORMAL(): self
    {
        return new self(self::NORMAL);
    }

    public static function EXPRESS(): self
    {
        return new self(self::EXPRESS);
    }

    public static function PICKUP(): self
    {
        return new self(self::PICKUP);
    }

    public static function SAME_DAY(): self
    {
        return new self(self::SAME_DAY);
    }

    public static function NEXT_DAY(): self
    {
        return new self(self::NEXT_DAY);
    }

    public static function SCHEDULED(): self
    {
        return new self(self::SCHEDULED);
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
