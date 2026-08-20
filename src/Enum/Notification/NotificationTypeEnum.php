<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Notification;

use Gubee\SDK\Enum\AbstractEnum;

class NotificationTypeEnum extends AbstractEnum
{
    private const WARNING = 'WARNING';
    private const ERROR   = 'ERROR';
    private const INFO    = 'INFO';

    public static function WARNING(): self
    {
        return new self(self::WARNING);
    }

    public static function ERROR(): self
    {
        return new self(self::ERROR);
    }

    public static function INFO(): self
    {
        return new self(self::INFO);
    }

    /**
     * @param mixed $value
     */
    public static function fromValue($value): self
    {
        return new self($value);
    }
}
