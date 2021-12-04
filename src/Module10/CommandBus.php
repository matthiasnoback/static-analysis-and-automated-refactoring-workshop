<?php

declare(strict_types=1);

namespace App\Module10;

use LogicException;

final class CommandBus
{
    public function handle(object $command): mixed
    {
        if ($command instanceof PlanWorkshop) {
            return (new PlanWorkshopHandler())->handle($command);
        }

        throw new LogicException('Could not find handler for command');
    }
}
