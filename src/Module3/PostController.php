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
        $post = Post::fromArray(
            json_decode(
                file_get_contents('php://input')
            )
        );

        $this->postRepository->save($post);

        $encoded = json_encode($post->toArray());
        Assertion::string($encoded);

        return $encoded;
    }
}
