<?php
declare(strict_types=1);

namespace App\Module2;

final class User
{
    private string $username;
    private int $age;

    public function __construct(string $username, int $age)
    {
        $this->username = $username;
        $this->age = $age;
    }

    public function asDatabaseRecord(): array
    {
        return [
            'username' => $this->username,
            'age' => $this->age
        ];
    }

    public static function fromDatabaseRecord(array $record): self
    {
        return new self($record['username'], $record['age']);
    }
}
