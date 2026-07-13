<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Ad;

use Gubee\SDK\Enum\AbstractEnum;

class SearchTypeEnum extends AbstractEnum
{
    private const SKU = 'SKU';

    private const PRODUCT_SKU = 'PRODUCT_SKU';

    private const MARKETPLACE_ID = 'MARKETPLACE_ID';

    private const TITLE = 'TITLE';

    public static function SKU(): self
    {
        return new self(self::SKU);
    }

    public static function PRODUCT_SKU(): self
    {
        return new self(self::PRODUCT_SKU);
    }

    public static function MARKETPLACE_ID(): self
    {
        return new self(self::MARKETPLACE_ID);
    }

    public static function TITLE(): self
    {
        return new self(self::TITLE);
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
