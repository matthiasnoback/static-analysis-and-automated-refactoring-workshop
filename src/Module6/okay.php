<?php

declare(strict_types=1);

namespace App\Module6;

use DateTimeImmutable;
use Assert\Assertion;

require __DIR__ . '/../../vendor/autoload.php';

$event = new Event(DateTimeImmutable::createFromFormat('Y-m-d', '1970-01-01'));

$date = DateTimeImmutable::createFromFormat('Y-m-d', $_GET['date']);
Assertion::isInstanceOf($date, DateTimeImmutable::class);
$event = new Event($date);
