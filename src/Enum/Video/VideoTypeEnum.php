<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Video;

use Gubee\SDK\Enum\AbstractEnum;

class VideoTypeEnum extends AbstractEnum
{
    private const SHORT = 'SHORT';

    private const LONG = 'LONG';

    public static function SHORT(): self
    {
        return new self(self::SHORT);
    }

    public static function LONG(): self
    {
        return new self(self::LONG);
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
