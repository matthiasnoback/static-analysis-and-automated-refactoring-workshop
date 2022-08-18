<?php

declare(strict_types=1);

namespace App\Module1;

interface TokenGenerator
{
    public function generate(): string;
}
