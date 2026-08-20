<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class IntegrationTypeEnum extends AbstractEnum
{
    private const INTEGRATED = 'INTEGRATED';

    private const NOT_INTEGRATED = 'NOT_INTEGRATED';

    public static function INTEGRATED(): self
    {
        return new self(self::INTEGRATED);
    }

    public static function NOT_INTEGRATED(): self
    {
        return new self(self::NOT_INTEGRATED);
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
