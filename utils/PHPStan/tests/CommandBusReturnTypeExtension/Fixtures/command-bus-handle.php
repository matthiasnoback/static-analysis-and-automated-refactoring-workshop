<?php
declare(strict_types=1);

use App\Module10\CancelWorkshop;
use App\Module10\CommandBus;
use App\Module10\PlanWorkshop;
use App\Module10\Workshop;
use function PHPStan\Testing\assertType;

/** @var CommandBus $commandBus */

assertType(Workshop::class, $commandBus->handle(new PlanWorkshop('Title')));
assertType('void', $commandBus->handle(new CancelWorkshop()));
