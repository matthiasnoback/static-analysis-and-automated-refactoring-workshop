<?php

declare(strict_types=1);

namespace App\Module10;

final class Workshop
{
    public function __construct(private string $title)
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
