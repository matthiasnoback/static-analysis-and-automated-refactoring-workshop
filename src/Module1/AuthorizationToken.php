<?php
declare(strict_types=1);

namespace App\Module1;

final class AuthorizationToken
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
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
