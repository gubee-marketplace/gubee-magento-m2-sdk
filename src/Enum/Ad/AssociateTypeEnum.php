<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Ad;

use Gubee\SDK\Enum\AbstractEnum;

class AssociateTypeEnum extends AbstractEnum
{
    private const VARIANT = 'VARIANT';
    private const KIT     = 'KIT';

    public static function VARIANT(): self
    {
        return new self(self::VARIANT);
    }

    public static function KIT(): self
    {
        return new self(self::KIT);
    }

    /**
     * @param mixed $value
     */
    public static function fromValue($value): self
    {
        return new self($value);
    }
}
