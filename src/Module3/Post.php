<?php

declare(strict_types=1);

namespace App\Module3;

use Assert\Assertion;

final class Post
{
    private function __construct(
        private string $title
    ) {
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        Assertion::keyExists($data, 'title'); // PHP notice: key 'title' does not exist
        Assertion::string($data['title']); // PHP type conversion error/strict type error

        return new self($data['title']);
    }

    /**
     * @return array<string,string>
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }
}
