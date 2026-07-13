<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Ad;

use Gubee\SDK\Enum\AbstractEnum;

class TagsFilterModeEnum extends AbstractEnum
{
    private const ANY = 'ANY';

    private const ALL = 'ALL';

    public static function ANY(): self
    {
        return new self(self::ANY);
    }

    public static function ALL(): self
    {
        return new self(self::ALL);
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
