<?php

declare(strict_types=1);

namespace App\Module8;

require __DIR__ . '/../../vendor/autoload.php';

$counter = tap(Counter::create(), function (Counter $counter): void {
    echo $counter->getValue();
});

$counter = $counter->increment();

echo tap($counter, function (Counter $counter): Counter {
    echo $counter->getValue();

    return $counter->increment();
})->getValue();
