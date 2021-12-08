<?php
declare(strict_types=1);

namespace App\Module1;

use RuntimeException;
final class ClientNotFound extends RuntimeException
{
    public static function withId(string $clientId): self
    {
        return new self('Client not found with ID ' . $clientId);
    }
}
