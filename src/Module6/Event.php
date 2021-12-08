<?php

declare(strict_types=1);

namespace App\Module6;

use DateTimeImmutable;

final class Event
{
    private DateTimeImmutable $happenedAt;

    public function __construct(DateTimeImmutable $happenedAt)
    {
        $this->happenedAt = $happenedAt;
    }

    public function happenedAt(): DateTimeImmutable
    {
        return $this->happenedAt;
    }
}
