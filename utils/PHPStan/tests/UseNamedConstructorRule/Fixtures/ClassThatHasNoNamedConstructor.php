<?php
declare(strict_types=1);

namespace Utils\PHPStan\Tests\UseNamedConstructorRule\Fixtures;

final class ClassThatHasNoNamedConstructor
{
    public function __construct()
    {

    }
}
