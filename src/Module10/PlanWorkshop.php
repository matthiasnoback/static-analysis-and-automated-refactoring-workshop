<?php
declare(strict_types=1);

namespace App\Module10;

final class PlanWorkshop
{
    public function __construct(private string $title)
    {
    }

    public function title(): string
    {
        return $this->title;
    }
}
