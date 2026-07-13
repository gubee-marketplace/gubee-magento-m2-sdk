<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\ProductV2;

use Gubee\SDK\Enum\AbstractEnum;

class PriceCalculationTypeEnum extends AbstractEnum
{
    private const BY_KIT_ITEMS_VALUE = 'BY_KIT_ITEMS_VALUE';

    private const BY_VALUE = 'BY_VALUE';

    public static function BY_KIT_ITEMS_VALUE(): self
    {
        return new self(self::BY_KIT_ITEMS_VALUE);
    }

    public static function BY_VALUE(): self
    {
        return new self(self::BY_VALUE);
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
