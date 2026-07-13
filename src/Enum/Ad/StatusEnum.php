<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Ad;

use Gubee\SDK\Enum\AbstractEnum;

class StatusEnum extends AbstractEnum
{
    private const ACTIVE = 'ACTIVE';

    private const INACTIVE = 'INACTIVE';

    private const PAUSED = 'PAUSED';

    private const FINISHED = 'FINISHED';

    public static function ACTIVE(): self
    {
        return new self(self::ACTIVE);
    }

    public static function INACTIVE(): self
    {
        return new self(self::INACTIVE);
    }

    public static function PAUSED(): self
    {
        return new self(self::PAUSED);
    }

    public static function FINISHED(): self
    {
        return new self(self::FINISHED);
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
