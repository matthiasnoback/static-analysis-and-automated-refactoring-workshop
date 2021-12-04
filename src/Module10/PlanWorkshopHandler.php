<?php

declare(strict_types=1);

namespace App\Module10;

final class PlanWorkshopHandler
{
    public function handle(PlanWorkshop $command): Workshop
    {
        return new Workshop($command->title());
    }
}
