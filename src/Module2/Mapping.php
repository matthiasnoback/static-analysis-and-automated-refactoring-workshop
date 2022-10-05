<?php
declare(strict_types=1);

namespace App\Module2;

use Assert\Assertion;

final class Mapping
{
    /**
     * @param array<string,string|null> $record
     */
    public static function getString(array $record, string $key): string
    {
        Assertion::keyExists($record, $key);
        Assertion::string($record[$key]);

        return $record[$key];
    }

    /**
     * @param array<string,string|null> $record
     */
    public static function getInteger(array $record, string $key): int
    {
        Assertion::keyExists($record, $key);
        Assertion::string($record[$key]);

        return (int) $record[$key];
    }
}
