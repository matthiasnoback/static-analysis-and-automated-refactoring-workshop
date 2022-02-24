<?php

declare(strict_types=1);

namespace App\Module7;

use Countable;

final class ExistingClass implements Countable
{
    public function count(): int
    {
        return 0;
    }
}
