<?php
declare(strict_types=1);

namespace App\Module2;

final class User
{
    private string $username;
    private \DateTimeImmutable $lastModified;

    public function __construct(string $username, \DateTimeImmutable $lastModified)
    {
        $this->username = $username;
        $this->lastModified = $lastModified;
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'lastModified' => $this->lastModified
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self($data['username'], $data['lastModified']);
    }
}
