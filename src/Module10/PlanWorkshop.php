<?php

declare(strict_types=1);

namespace App\Module10;

final class PlanWorkshop
{
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function title(): string
    {
        return $this->title;
    }
}
