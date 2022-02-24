<?php

declare(strict_types=1);

namespace App\Module2;

use InvalidArgumentException;

final class User
{
    private string $username;

    private int $age;

    public function __construct(string $username, int $age)
    {
        $this->username = $username;
        $this->age = $age;
    }

    /**
     * @return array<string,string|int|float|null|bool>
     */
    public function asDatabaseRecord(): array
    {
        return [
            'username' => $this->username,
            'age' => $this->age,
        ];
    }

    /**
     * @param array<string,string|null> $record
     */
    public static function fromDatabaseRecord(array $record): self
    {
        // $record['username'] could be null or string
        if (! isset($record['username'])) {
            // $record['username'] is null or key doesn't exist
            throw new InvalidArgumentException('undefined username');
        }

        // $record['username'] is a string

        if (! isset($record['age'])) {
            throw new InvalidArgumentException('undefined age');
        }

        return new self($record['username'], (int) $record['age']);
    }
}
