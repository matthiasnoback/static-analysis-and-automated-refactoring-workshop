<?php
declare(strict_types=1);

use App\Module10\CancelWorkshop;
use App\Module10\CommandBus;
use App\Module10\PlanWorkshop;

require __DIR__ . '/../../vendor/autoload.php';

$commandBus = new CommandBus();

$workshop = $commandBus->handle(new PlanWorkshop('PHPStan'));

$commandBus->handle(new CancelWorkshop());
