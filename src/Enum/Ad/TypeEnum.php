<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Ad;

use Gubee\SDK\Enum\AbstractEnum;

class TypeEnum extends AbstractEnum
{
    private const SIMPLE = 'SIMPLE';

    private const KIT = 'KIT';

    private const VARIATION = 'VARIATION';

    public static function SIMPLE(): self
    {
        return new self(self::SIMPLE);
    }

    public static function KIT(): self
    {
        return new self(self::KIT);
    }

    public static function VARIATION(): self
    {
        return new self(self::VARIATION);
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
