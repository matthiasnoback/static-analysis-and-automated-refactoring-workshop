<?php

declare(strict_types=1);

namespace App\Module6;

use DateTimeImmutable;

final class Event
{
    public function __construct(
        private DateTimeImmutable $happenedAt
    ) {
    }

    public function happenedAt(): DateTimeImmutable
    {
        return $this->happenedAt;
    }
}
