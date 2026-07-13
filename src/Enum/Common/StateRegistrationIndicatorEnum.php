<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Common;

use Gubee\SDK\Enum\AbstractEnum;

class StateRegistrationIndicatorEnum extends AbstractEnum
{
    private const CONTRIBUINTE_ICMS   = 'CONTRIBUINTE_ICMS';
    private const CONTRIBUINTE_ISENTO = 'CONTRIBUINTE_ISENTO';
    private const NAO_CONTRIBUINTE    = 'NAO_CONTRIBUINTE';

    public static function CONTRIBUINTE_ICMS(): self
    {
        return new self(self::CONTRIBUINTE_ICMS);
    }

    public static function CONTRIBUINTE_ISENTO(): self
    {
        return new self(self::CONTRIBUINTE_ISENTO);
    }

    public static function NAO_CONTRIBUINTE(): self
    {
        return new self(self::NAO_CONTRIBUINTE);
    }

    /**
     * @param mixed $value
     */
    public static function fromValue($value): self
    {
        return new self($value);
    }
}
