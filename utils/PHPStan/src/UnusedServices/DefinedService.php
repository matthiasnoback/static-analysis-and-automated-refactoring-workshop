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

    /**
     * @return array<string,string|int>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param array<mixed> $array
     * @return static
     */
    public static function fromArray(array $array): self
    {
        return new self(...$array);
    }
}
