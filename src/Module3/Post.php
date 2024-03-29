<?php

declare(strict_types=1);

namespace App\Module3;

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
