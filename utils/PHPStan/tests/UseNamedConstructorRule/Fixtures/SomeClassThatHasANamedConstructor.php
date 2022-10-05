<?php
declare(strict_types=1);

namespace Utils\PHPStan\Tests\UseNamedConstructorRule\Fixtures;

final class SomeClassThatHasANamedConstructor
{
    public function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }

    public static function createFrom(): self
    {
        return new self();
    }
}
