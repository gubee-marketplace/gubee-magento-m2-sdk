<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product\Variation;

use Gubee\SDK\Enum\AbstractEnum;

class StockTypeEnum extends AbstractEnum
{
    private const DEFAULT = 'DEFAULT';
    private const KIT     = 'KIT';

    public static function DEFAULT(): self
    {
        return new self(self::DEFAULT);
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
