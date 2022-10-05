<?php

declare(strict_types=1);

namespace App\Module4;

use ArrayIterator;
use IteratorAggregate;

/**
 * @implements IteratorAggregate<int,mixed>
 */
final class Collection implements IteratorAggregate
{
    /**
     * @param array<int,mixed> $values
     */
    public function __construct(private array $values)
    {
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->values[array_key_first($this->values)];
    }

    public function add(mixed $value): void
    {
        $this->values[] = $value;
    }

    /**
     * @return ArrayIterator<int,mixed>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->values);
    }
}
