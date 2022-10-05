<?php

declare(strict_types=1);

namespace App\Module3;

use Assert\Assertion;

final class PostController
{
    public function __construct(
        private PostRepository $postRepository
    ) {
    }

    public function create(): string
    {
        $contents = file_get_contents('php://input');
        Assertion::string($contents);

        $decoded = json_decode($contents, true);
        Assertion::isArray($decoded);

        $post = Post::fromArray($decoded);

        $this->postRepository->save($post);

        $encoded = json_encode($post->toArray());
        Assertion::string($encoded);

        return $encoded;
    }
}
