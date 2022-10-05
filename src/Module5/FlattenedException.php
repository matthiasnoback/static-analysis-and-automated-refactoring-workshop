<?php

declare(strict_types=1);

namespace App\Module5;

use Exception;

final class FlattenedException
{
    /**
     * @param Collection<Exception> $exceptions
     */
    public function __construct(private readonly Collection $exceptions)
    {
    }

    public function add(Exception $exception): void
    {
        $this->exceptions->add($exception);
    }

    public function getMessage(): string
    {
        $messages = [];

        foreach ($this->exceptions as $exception) {
            $messages[] = $exception->getMessage();
        }

        return implode("\n", $messages);
    }
}
