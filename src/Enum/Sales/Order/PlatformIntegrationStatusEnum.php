<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class PlatformIntegrationStatusEnum extends AbstractEnum
{
    private const PENDING       = 'PENDING';
    private const READY         = 'READY';
    private const RUNNING       = 'RUNNING';
    private const IN_VALIDATION = 'IN_VALIDATION';
    private const INTEGRATED    = 'INTEGRATED';
    private const ERROR         = 'ERROR';

    public static function PENDING(): self
    {
        return new self(self::PENDING);
    }

    public static function READY(): self
    {
        return new self(self::READY);
    }

    public static function RUNNING(): self
    {
        return new self(self::RUNNING);
    }

    public static function IN_VALIDATION(): self
    {
        return new self(self::IN_VALIDATION);
    }

    public static function INTEGRATED(): self
    {
        return new self(self::INTEGRATED);
    }

    public static function ERROR(): self
    {
        return new self(self::ERROR);
    }

    /**
     * @param mixed $value
     */
    public static function fromValue($value): self
    {
        return new self($value);
    }
}
