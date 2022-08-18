<?php

declare(strict_types=1);

namespace App\Module1;

class Client
{
    private int $clientId;

    /**
     * @var string
     */
    private $apiKey;

    public function __construct(string $clientId, ?string $apiKey)
    {
        $this->clientId = $clientId;
        $this->apiKey = $apiKey;
    }

    public function apiKey(): string
    {
        return $this->apiKey;
    }
}
