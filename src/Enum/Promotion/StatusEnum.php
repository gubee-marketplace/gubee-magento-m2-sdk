<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Promotion;

use Gubee\SDK\Enum\AbstractEnum;

class StatusEnum extends AbstractEnum
{
    private const ACTIVE = 'ACTIVE';

    private const CREATED = 'CREATED';

    private const FINISHED = 'FINISHED';

    private const COMPLETED = 'COMPLETED';

    public static function ACTIVE(): self
    {
        return new self(self::ACTIVE);
    }

    public static function CREATED(): self
    {
        return new self(self::CREATED);
    }

    public static function FINISHED(): self
    {
        return new self(self::FINISHED);
    }

    public static function COMPLETED(): self
    {
        return new self(self::COMPLETED);
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
