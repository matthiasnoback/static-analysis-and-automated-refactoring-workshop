<?php

declare(strict_types=1);

namespace App\Module3;

use Assert\Assertion;

final class PostController
{
    public function __construct(
        private PostRepository $postRepository,
        private JsonEncoder $jsonEncoder
    ) {
    }

    public function create(): string
    {
        $requestBody = file_get_contents('php://input');
        Assertion::string($requestBody);

        $post = Post::fromArray($this->jsonEncoder->decode($requestBody));

        $this->postRepository->save($post);

        return $this->jsonEncoder->encode($post->toArray());
    }
}
