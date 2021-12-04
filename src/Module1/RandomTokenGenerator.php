<?php

declare(strict_types=1);

namespace App\Module1;

final class RandomTokenGenerator implements TokenGenerator
{
    public function generate(): string
    {
        return hash('sha256', random_bytes(20));
    }
}
