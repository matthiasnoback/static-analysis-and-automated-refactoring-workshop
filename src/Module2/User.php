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

    /**
     * @return array<string,string|int|null>
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
        return new self(Mapping::getString($record, 'username'), Mapping::getInteger($record, 'age'),);
    }
}
