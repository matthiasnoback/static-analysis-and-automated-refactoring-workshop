<?php
declare(strict_types=1);

namespace App\Module5;

use ArrayIterator;
use IteratorAggregate;

/**
 * @template TValue
 * @implements IteratorAggregate<int,TValue>
 */
final class Collection implements IteratorAggregate
{
    /**
     * @var array<TValue>
     */
    private array $values;

    /**
     * @param array<TValue> $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @param TValue $value
     */
    public function add($value): void
    {
        $this->values[] = $value;
    }

    /**
     * @return TValue
     */
    public function first()
    {
        return $this->values[array_key_first($this->values)];
    }

    /**
     * @return ArrayIterator<int,TValue>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->values);
    }
}
