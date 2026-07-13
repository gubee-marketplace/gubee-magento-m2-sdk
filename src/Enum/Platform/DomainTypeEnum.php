<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Platform;

use Gubee\SDK\Enum\AbstractEnum;

class DomainTypeEnum extends AbstractEnum
{
    private const PRODUCT = 'PRODUCT';

    private const AD = 'AD';

    public static function PRODUCT(): self
    {
        return new self(self::PRODUCT);
    }

    public static function AD(): self
    {
        return new self(self::AD);
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
