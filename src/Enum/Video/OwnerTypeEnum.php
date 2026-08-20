<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Video;

use Gubee\SDK\Enum\AbstractEnum;

class OwnerTypeEnum extends AbstractEnum
{
    private const PRODUCT = 'PRODUCT';

    private const ANNOUNCEMENT = 'ANNOUNCEMENT';

    public static function PRODUCT(): self
    {
        return new self(self::PRODUCT);
    }

    public static function ANNOUNCEMENT(): self
    {
        return new self(self::ANNOUNCEMENT);
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
