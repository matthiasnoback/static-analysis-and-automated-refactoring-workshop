<?php

declare(strict_types=1);

namespace App\Module2;

use UnexpectedValueException;

trait Mapping
{
    /**
     * @param array<string,mixed> $map
     */
    public static function getString(array $map, string $key): string
    {
        $value = $map[$key];
        if (! is_string($value)) {
            throw new UnexpectedValueException();
        }
        return $value;
    }

    /**
     * @param array<string,mixed> $map
     */
    public static function getInt(array $map, string $key): int
    {
        $value = $map[$key];
        if (! is_int($value)) {
            throw new UnexpectedValueException();
        }
        return $value;
    }
}
