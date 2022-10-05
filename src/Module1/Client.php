<?php

declare(strict_types=1);

namespace App\Module1;

use InvalidArgumentException;

final class Client
{
    private readonly string $apiKey;

    public function __construct(?string $apiKey)
    {
        // $apiKey is string or null

        if ($apiKey === null) {
            // $apiKey is null
            throw new InvalidArgumentException('...');
        }

        // $apiKey is string

        $this->apiKey = $apiKey;
    }

    public function clientSecret(): string
    {
        return $this->apiKey;
    }
}
