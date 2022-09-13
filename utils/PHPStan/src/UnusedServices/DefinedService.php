<?php

declare(strict_types=1);

namespace Utils\PHPStan\UnusedServices;

final class DefinedService
{
    public function __construct(
        public readonly string $serviceId,
        public readonly string $file,
        public readonly int $line,
    ) {
    }
}
