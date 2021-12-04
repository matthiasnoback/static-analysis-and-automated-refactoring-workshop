<?php

declare(strict_types=1);

namespace App\Module1;

final class Client
{
    public function __construct(
        private int $clientId,
        private string $clientSecret
    ) {
    }

    public function clientId(): int
    {
        return $this->clientId;
    }

    public function clientSecret(): string
    {
        return $this->clientSecret;
    }
}
