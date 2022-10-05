<?php

declare(strict_types=1);

namespace App\Module1;

final class AuthorizationToken
{
    private string $clientId;

    private string $token;

    public function __construct(string $clientId, string $token)
    {
        $this->clientId = $clientId;
        $this->token = $token;
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
