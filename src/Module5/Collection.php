<?php

declare(strict_types=1);

namespace App\Module5;

use ArrayIterator;
use IteratorAggregate;

/**
 * @implements IteratorAggregate<int,T>
 * @template T
 */
final class Collection implements IteratorAggregate
{
    /**
     * @param array<T> $values
     */
    public function __construct(
        private array $values
    ) {
    }

    /**
     * @param T $value
     */
    public function add($value): void
    {
        $this->values[] = $value;
    }

    /**
     * @return T
     */
    public function first()
    {
        return $this->values[array_key_first($this->values)];
    }

    /**
     * @return ArrayIterator<int,T>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->values);
    }
}
