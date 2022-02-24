<?php

declare(strict_types=1);

namespace App\Module1;

final class AuthorizationToken
{
    public function __construct(
        private string $clientId,
        private string $token
    ) {
    }

    public function isAuthorized(): bool
    {
        return true;
    }

    public function clientId(): string
    {
        return $this->clientId;
    }

    public function token(): string
    {
        return $this->token;
    }
}
