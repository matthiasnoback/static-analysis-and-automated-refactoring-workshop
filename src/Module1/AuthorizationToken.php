<?php

declare(strict_types=1);

namespace App\Module1;

final class AuthorizationToken
{
    public function __construct(
        private readonly string $clientId,
        private readonly string $token
    ) {
    }

    public function isAuthorized(): bool
    {
        return $this->clientId !== null;
    }

    public function token(): string
    {
        return $this->token;
    }
}
