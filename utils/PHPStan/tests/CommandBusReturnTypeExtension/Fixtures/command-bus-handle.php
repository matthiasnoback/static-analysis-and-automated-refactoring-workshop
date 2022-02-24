<?php
declare(strict_types=1);

use App\Module10\CancelWorkshop;
use App\Module10\CommandBus;
use App\Module10\HandlerExistsButHasNoHandleMethod;
use App\Module10\PlanWorkshop;
use App\Module10\Workshop;
use App\Module10\NoHandlerExists;
use function PHPStan\Testing\assertType;

/** @var CommandBus $commandBus */

assertType(Workshop::class, $commandBus->handle(new PlanWorkshop('Title')));
assertType('void', $commandBus->handle(new CancelWorkshop()));
assertType('mixed', $commandBus->handle(new NoHandlerExists()));
assertType('mixed', $commandBus->handle(new HandlerExistsButHasNoHandleMethod()));
assertType('mixed', $commandBus->handle(new ClassDoesNotExist()));
assertType('mixed', $commandBus->handle());
assertType('mixed', $commandBus->handle('string'));
