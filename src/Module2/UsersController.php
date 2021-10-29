<?php
declare(strict_types=1);

namespace App\Module2;

use App\Module1\AuthorizationService;
use App\Module1\ClientRepository;

final class UsersController
{
    public function __construct(
        private UserRepository $userRepository,
        private JsonEncoder $jsonEncoder
    ) {
    }

    public function get(array $getData): void
    {
        $user = $this->userRepository->getById($getData['userId']);

        echo $this->jsonEncoder->encode($user->toArray());
    }

    public function create(): void
    {
        $user = User::fromArray(
            $this->jsonEncoder->decode(
                file_get_contents('php://input')
            )
        );

        $this->userRepository->save($user);

        echo $this->jsonEncoder->encode($user->toArray());
    }
}
