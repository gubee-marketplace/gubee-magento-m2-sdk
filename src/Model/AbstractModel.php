<?php

declare(strict_types=1);

namespace Gubee\SDK\Model;

use InvalidArgumentException;
use JsonSerializable;

use function array_filter;
use function get_class;
use function get_object_vars;
use function gettype;
use function is_bool;
use function is_float;
use function is_int;
use function is_object;
use function is_string;
use function sprintf;

class AbstractModel implements JsonSerializable
{
    /**
     * @return array<int|string, mixed>
     */
    public function jsonSerialize(): array
    {
        $values = get_object_vars($this);
        $values = array_filter(
            $values,
            function ($value) {
                return $value !== null;
            }
        );
        return $values;
    }

    /**
     * Validate if all elements inside a array is from a specific type
     *
     * @param array<int|string, mixed> $array The array to be validated
     * @param string $type Can be a scalar or class name to be validated
     * @throws InvalidArgumentException If the array contains elements of
     * different types.
     */
    protected function validateArrayElements(array $array, string $type): bool
    {
        foreach ($array as $element) {
            if ($type == 'string') {
                if (! is_string($element)) {
                    throw new InvalidArgumentException(
                        sprintf(
                            "The array contains elements of different types, expected '%s' got '%s'",
                            $type,
                            is_object($element) ? get_class($element) : gettype($element)
                        )
                    );
                }
            } elseif ($type == 'int') {
                if (! is_int($element)) {
                    throw new InvalidArgumentException(
                        sprintf(
                            "The array contains elements of different types, expected '%s' got '%s'",
                            $type,
                            is_object($element) ? get_class($element) : gettype($element)
                        )
                    );
                }
            } elseif ($type == 'float') {
                if (! is_float($element)) {
                    throw new InvalidArgumentException(
                        sprintf(
                            "The array contains elements of different types, expected '%s' got '%s'",
                            $type,
                            is_object($element) ? get_class($element) : gettype($element)
                        )
                    );
                }
            } elseif ($type == 'bool') {
                if (! is_bool($element)) {
                    throw new InvalidArgumentException(
                        sprintf(
                            "The array contains elements of different types, expected '%s' got '%s'",
                            $type,
                            is_object($element) ? get_class($element) : gettype($element)
                        )
                    );
                }
            } elseif (! $element instanceof $type) {
                throw new InvalidArgumentException(
                    sprintf(
                        "The array contains elements of different types, expected '%s' got '%s'",
                        $type,
                        is_object($element) ? get_class($element) : gettype($element)
                    )
                );
            }
        }
        return true;
    }
}
