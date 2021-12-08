<?php
declare(strict_types=1);

namespace App\Module2;

final class User
{
    use Mapping;
    private string $username;
    private int $age;

    public function __construct(string $username, int $age)
    {
        $this->username = $username;
        $this->age = $age;
    }

    /**
     * @return array<string,string|int>
     */
    public function asDatabaseRecord(): array
    {
        return [
            'username' => $this->username,
            'age' => $this->age
        ];
    }

    /**
     * @param array<string,string|null> $record
     */
    public static function fromDatabaseRecord(array $record): self
    {
        return new self(self::getString($record, 'username'), self::getInt($record, 'age'));
    }
}
