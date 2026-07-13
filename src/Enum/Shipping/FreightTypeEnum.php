<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Shipping;

use Gubee\SDK\Enum\AbstractEnum;

class FreightTypeEnum extends AbstractEnum
{
    private const ECONOMIC           = 'ECONOMIC';
    private const NORMAL             = 'NORMAL';
    private const EXPRESS            = 'EXPRESS';
    private const MARKETPLACE        = 'MARKETPLACE';
    private const SCHEDULED_DELIVERY = 'SCHEDULED_DELIVERY';

    public static function ECONOMIC(): self
    {
        return new self(self::ECONOMIC);
    }

    public static function NORMAL(): self
    {
        return new self(self::NORMAL);
    }

    public static function EXPRESS(): self
    {
        return new self(self::EXPRESS);
    }

    public static function MARKETPLACE(): self
    {
        return new self(self::MARKETPLACE);
    }

    public static function SCHEDULED_DELIVERY(): self
    {
        return new self(self::SCHEDULED_DELIVERY);
    }

    /**
     * @param mixed $value
     */
    public static function fromValue($value): self
    {
        return new self($value);
    }
}
