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
        Assertion::string($data['title']);

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
