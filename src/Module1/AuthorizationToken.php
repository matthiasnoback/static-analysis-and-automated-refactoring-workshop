<?php

declare(strict_types=1);

namespace App\Module1;

final class AuthorizationToken
{
    public function __construct(private string $token)
    {
    }

    public function isAuthorized(): bool
    {
        return true;
    }

    public function token(): string
    {
        return $this->token;
    }
}
