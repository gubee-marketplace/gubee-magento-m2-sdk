<?php

declare(strict_types=1);

namespace Gubee\SDK\Enum;

use InvalidArgumentException;
use JsonSerializable;
use ReflectionClass;
use Stringable;

use function in_array;
use function sprintf;

abstract class AbstractEnum implements Stringable, JsonSerializable
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    protected function validate(string $value): void
    {
        $reflection = new ReflectionClass(static::class);
        $constants  = $reflection->getConstants();
        if (! in_array($value, $constants)) {
            throw new InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for enum %s",
                    $value,
                    static::class
                )
            );
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * Create a new instance of the enum based into a given value
     *
     * @param mixed $value
     */
    abstract public static function fromValue($value): self;

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->value;
    }
}
