<?php

declare(strict_types=1);

namespace App\Module1;

final class Client
{
    private string $clientId;

    private string $apiKey;

    public function __construct(string $clientId, string $apiKey)
    {
        $this->clientId = $clientId;
        $this->apiKey = $apiKey;
    }

    public function clientId(): string
    {
        return $this->clientId;
    }

    public function clientSecret(): string
    {
        return $this->apiKey();
    }

    public function apiKey(): string
    {
        return $this->apiKey;
    }
}
