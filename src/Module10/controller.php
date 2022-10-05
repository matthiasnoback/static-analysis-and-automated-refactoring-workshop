<?php

declare(strict_types=1);
use App\Module10\Workshop;

use App\Module10\CancelWorkshop;
use App\Module10\CommandBus;
use App\Module10\PlanWorkshop;

require __DIR__ . '/../../vendor/autoload.php';

$commandBus = new CommandBus();

/** @var Workshop $workshop */
$workshop = $commandBus->handle(new PlanWorkshop('PHPStan'));

echo $workshop->title();

$commandBus->handle(new CancelWorkshop());
