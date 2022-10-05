<?php

declare(strict_types=1);

namespace App\Module8;

final class Counter
{
    private function __construct(private readonly int $counter)
    {
    }

    public static function create(): self
    {
        return new self(0);
    }

    public function increment(): self
    {
        return new self($this->counter + 1);
    }

    public function getValue(): int
    {
        return $this->counter;
    }
}
