<?php
declare(strict_types=1);

namespace App\Module5;

use Exception;
use Traversable;
use ArrayIterator;
use IteratorAggregate;

/**
 * @implements IteratorAggregate<int,mixed>
 */
final class Collection implements IteratorAggregate
{
    /**
     * @var array<mixed>
     */
    private array $values;

    /**
     * @param array<mixed> $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @param mixed $value
     */
    public function add($value): void
    {
        $this->values[] = $value;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->values[array_key_first($this->values)];
    }

    /**
     * @return ArrayIterator<int,mixed>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->values);
    }
}
