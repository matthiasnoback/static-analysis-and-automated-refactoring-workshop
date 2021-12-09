<?php
declare(strict_types=1);

namespace App\Module5;

use DateTimeImmutable;
use Exception;

final class FlattenedException
{
    private Collection $exceptions;

    public function __construct(Collection $exceptions)
    {
        $this->exceptions = $exceptions;
        $this->exceptions->add(new DateTimeImmutable());
    }

    public function add(Exception $exception): void
    {
        $this->exceptions->add($exception);
    }

    public function getMessage(): string
    {
        $messages = [];

        foreach ($this->exceptions as $exception) {
            $messages[] = $exception->getMessage() . $exception->getTimestamp();
        }

        return implode("\n", $messages);
    }
}
