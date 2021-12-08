<?php
declare(strict_types=1);

namespace App\Module10;

final class Workshop
{
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
