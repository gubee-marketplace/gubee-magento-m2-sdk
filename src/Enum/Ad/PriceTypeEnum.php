<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Ad;

use Gubee\SDK\Enum\AbstractEnum;

class PriceTypeEnum extends AbstractEnum
{
    private const DEFAULT = 'DEFAULT';

    private const PROMOTION = 'PROMOTION';

    public static function DEFAULT(): self
    {
        return new self(self::DEFAULT);
    }

    public static function PROMOTION(): self
    {
        return new self(self::PROMOTION);
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
