<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum\Sales\Order;

use Gubee\SDK\Enum\AbstractEnum;

class AmbientEnum extends AbstractEnum
{
    private const PRD = 'PRD';

    private const HML = 'HML';

    public static function PRD(): self
    {
        return new self(self::PRD);
    }

    public static function HML(): self
    {
        return new self(self::HML);
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
