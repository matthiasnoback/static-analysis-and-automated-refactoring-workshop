<?php

namespace App\Module2;

use InvalidArgumentException;
trait Mapping
{
    /**
     * @param array<mixed> $data
     */
    private static function getString(array $data, string $key): string
    {
        if (!isset($data[$key])) {
            throw new InvalidArgumentException();
        }

        $value = $data[$key];
        if (!is_string($value)) {
            throw new InvalidArgumentException();
        }

        return $value;
    }

    /**
     * @param array<mixed> $data
     */
    private static function getInt(array $data, string $key): int
    {
        if (!isset($data[$key])) {
            throw new InvalidArgumentException();
        }

        $value = $data[$key];
        if (is_string($value)) {
            return (int) $value;
        }

        if (is_int($value)) {
            return $value;
        }

        throw new InvalidArgumentException();
    }
}
