<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Resource;

use Gubee\SDK\Enum\AbstractEnum;

class SortEnum extends AbstractEnum
{
    private const ASC  = 'asc';
    private const DESC = 'desc';

    public static function ASC(): self
    {
        return new self(self::ASC);
    }

    public static function DESC(): self
    {
        return new self(self::DESC);
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
