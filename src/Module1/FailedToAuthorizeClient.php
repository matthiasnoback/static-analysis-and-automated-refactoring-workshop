<?php
declare(strict_types=1);

namespace App\Module1;

use RuntimeException;
class FailedToAuthorizeClient extends RuntimeException
{
    public static function becauseClientSecretIsInvalid(string $clientId): self
    {
        return new self(sprintf('Invalid client secret provided for client %s', $clientId));
    }
}
