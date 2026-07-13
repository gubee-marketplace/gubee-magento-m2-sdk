<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Catalog\Product;

use Gubee\SDK\Enum\AbstractEnum;

class DomainEnum extends AbstractEnum
{
    private const BRAND = 'BRAND';

    private const CATEGORY = 'CATEGORY';

    private const ATTRIBUTE = 'ATTRIBUTE';

    private const PRODUCT = 'PRODUCT';

    private const VARIATION = 'VARIATION';

    private const IMAGES = 'IMAGES';

    public static function BRAND(): self
    {
        return new self(self::BRAND);
    }

    public static function CATEGORY(): self
    {
        return new self(self::CATEGORY);
    }

    public static function ATTRIBUTE(): self
    {
        return new self(self::ATTRIBUTE);
    }

    public static function PRODUCT(): self
    {
        return new self(self::PRODUCT);
    }

    public static function VARIATION(): self
    {
        return new self(self::VARIATION);
    }

    public static function IMAGES(): self
    {
        return new self(self::IMAGES);
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
