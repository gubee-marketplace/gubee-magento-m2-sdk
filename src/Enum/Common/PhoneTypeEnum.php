<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Common;

use Gubee\SDK\Enum\AbstractEnum;

class PhoneTypeEnum extends AbstractEnum
{
    private const CELLPHONE  = 'CELLPHONE';
    private const COMMERCIAL = 'COMMERCIAL';
    private const HOME       = 'HOME';

    public static function CELLPHONE(): self
    {
        return new self(self::CELLPHONE);
    }

    public static function COMMERCIAL(): self
    {
        return new self(self::COMMERCIAL);
    }

    public static function HOME(): self
    {
        return new self(self::HOME);
    }

    /**
     * @param mixed $value
     */
    public static function fromValue($value): self
    {
        return new self($value);
    }
}
