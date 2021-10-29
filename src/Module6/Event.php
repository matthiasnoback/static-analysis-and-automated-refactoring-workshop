<?php
declare(strict_types=1);

namespace App\Module6;

final class Event
{
    private \DateTimeImmutable $happenedAt;

    public function __construct(\DateTimeImmutable $happenedAt)
    {
        $this->happenedAt = $happenedAt;
    }
}
