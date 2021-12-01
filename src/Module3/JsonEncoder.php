<?php
declare(strict_types=1);

namespace App\Module3;

use Assert\Assertion;

final class JsonEncoder
{
    /**
     * @param array<mixed> $values
     */
    public function encode(array $values): string
    {
        $encoded = json_encode($values);
        Assertion::string($encoded);

        return $encoded;
    }

    /**
     * @return array<mixed>
     */
    public function decode(string $encoded): array
    {
        $decoded = json_decode($encoded);
        Assertion::isArray($decoded);

        return $decoded;
    }
}
