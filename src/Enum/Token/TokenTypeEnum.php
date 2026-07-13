<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Token;

use Gubee\SDK\Enum\AbstractEnum;

class TokenTypeEnum extends AbstractEnum
{
    private const API   = 'API';
    private const USER  = 'USER';
    private const ADMIN = 'ADMIN';

    public static function API(): self
    {
        return new self(self::API);
    }

    public static function USER(): self
    {
        return new self(self::USER);
    }

    public static function ADMIN(): self
    {
        return new self(self::ADMIN);
    }

    /**
     * @param mixed $value
     */
    public static function fromValue($value): self
    {
        return new self($value);
    }
}
