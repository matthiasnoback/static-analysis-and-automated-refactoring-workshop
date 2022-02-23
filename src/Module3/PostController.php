<?php
declare(strict_types=1);

namespace App\Module3;

use Assert\Assertion;
use Assert\AssertionFailedException;

final class PostController
{
    public function __construct(
        private PostRepository $postRepository
    ) {
    }

    public function create(): string
    {
        $requestBody = file_get_contents('php://input');

        // $requestBody is a string or false
        if ($requestBody === false) {
            throw new \InvalidArgumentException('Expected a request body');
        }
        // $requestBody is a string

        $decodedData = json_decode(
            $requestBody,
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        if (!is_array($decodedData)) {
            throw new \InvalidArgumentException('Request body should be JSON-encoded array');
        }
        // $decodedData is array<mixed>

        try {
            $post = Post::fromArray($decodedData);
        } catch (AssertionFailedException $exception) {
            // return error response
            throw $exception;
        }

        $this->postRepository->save($post);

        $encoded = json_encode($post->toArray());
        Assertion::string($encoded);
        // $encoded is a string and not false

        return $encoded;
    }
}
