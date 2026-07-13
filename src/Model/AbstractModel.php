<?php

declare(strict_types=1);

namespace Gubee\SDK\Model;

use Gubee\SDK\Api\ServiceProviderInterface;
use InvalidArgumentException;
use JsonSerializable;

use function array_filter;
use function array_key_exists;
use function array_map;
use function get_object_vars;
use function gettype;
use function is_array;
use function is_bool;
use function is_float;
use function is_int;
use function is_object;
use function is_string;
use function sprintf;

class AbstractModel implements JsonSerializable
{
    /**
     * Resolve raw constructor arguments into typed nested Models, per $typeMap.
     *
     * $typeMap maps a $data key to either a FQCN (single nested Model, hydrated
     * when the value is an array; passed through otherwise) or a one-element
     * array wrapping a FQCN (array of nested Models, each element resolved the
     * same way, keys preserved).
     *
     * @param array<string, mixed> $data
     * @param array<string, string|array<string>> $typeMap
     * @return array<string, mixed>
     */
    protected function hydrate(
        ServiceProviderInterface $serviceProvider,
        array $data,
        array $typeMap
    ): array {
        $resolved = $data;
        foreach ($typeMap as $key => $type) {
            if (! array_key_exists($key, $data) || $data[$key] === null) {
                continue;
            }
            if (is_array($type)) {
                $elementType    = $type[0];
                $resolved[$key] = array_map(
                    function ($element) use ($serviceProvider, $elementType) {
                        return is_array($element)
                            ? $serviceProvider->create($elementType, $element)
                            : $element;
                    },
                    $data[$key]
                );
                continue;
            }
            $resolved[$key] = is_array($data[$key])
                ? $serviceProvider->create($type, $data[$key])
                : $data[$key];
        }
        return $resolved;
    }

    /**
     * @return array<int|string, mixed>
     */
    public function jsonSerialize(): array
    {
        $values = get_object_vars($this);
        return array_filter(
            $values,
            function ($value) {
                return $value !== null;
            }
        );
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
            if ($type === 'string') {
                if (! is_string($element)) {
                    throw new InvalidArgumentException(
                        sprintf(
                            "The array contains elements of different types, expected '%s' got '%s'",
                            $type,
                            is_object($element) ? $element::class : gettype($element)
                        )
                    );
                }
            } elseif ($type === 'int') {
                if (! is_int($element)) {
                    throw new InvalidArgumentException(
                        sprintf(
                            "The array contains elements of different types, expected '%s' got '%s'",
                            $type,
                            is_object($element) ? $element::class : gettype($element)
                        )
                    );
                }
            } elseif ($type === 'float') {
                if (! is_float($element)) {
                    throw new InvalidArgumentException(
                        sprintf(
                            "The array contains elements of different types, expected '%s' got '%s'",
                            $type,
                            is_object($element) ? $element::class : gettype($element)
                        )
                    );
                }
            } elseif ($type === 'bool') {
                if (! is_bool($element)) {
                    throw new InvalidArgumentException(
                        sprintf(
                            "The array contains elements of different types, expected '%s' got '%s'",
                            $type,
                            is_object($element) ? $element::class : gettype($element)
                        )
                    );
                }
            } elseif (! $element instanceof $type) {
                throw new InvalidArgumentException(
                    sprintf(
                        "The array contains elements of different types, expected '%s' got '%s'",
                        $type,
                        is_object($element) ? $element::class : gettype($element)
                    )
                );
            }
        }
        return true;
    }
}
