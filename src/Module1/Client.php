<?php

declare(strict_types=1);

namespace App\Module1;

final class Client
{
    public function __construct(private string $apiKey)
    {
    }

    public function apiKey(): string
    {
        return $this->apiKey;
    }
}
