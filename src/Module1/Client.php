<?php
declare(strict_types=1);

namespace App\Module1;

class Client
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function apiKey(): string
    {
        return $this->apiKey;
    }
}
