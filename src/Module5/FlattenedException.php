<?php
declare(strict_types=1);

namespace App\Module5;

use DateTimeImmutable;
use Exception;

final class FlattenedException
{
    /**
     * @var Collection<\Exception>
     */
    private Collection $exceptions;

    /**
     * @param Collection<\Exception> $exceptions
     */
    public function __construct(Collection $exceptions)
    {
        $this->exceptions = $exceptions;
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
