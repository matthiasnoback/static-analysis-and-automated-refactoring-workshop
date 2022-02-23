<?php

declare(strict_types=1);

namespace App\Module6;

use Assert\Assertion;

require 'vendor/autoload.php';

$happenedAt = \DateTimeImmutable::createFromFormat('Y-m-d', '1970-01-01');
$event = new Event($happenedAt);
