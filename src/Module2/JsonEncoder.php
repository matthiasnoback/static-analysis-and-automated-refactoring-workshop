<?php
declare(strict_types=1);

namespace App\Module2;

final class JsonEncoder
{
    public function encode(array $data): string
    {
        return json_encode($data);
    }

    public function decode(string $encodedData): array
    {
        return json_decode($encodedData, true);
    }
}
