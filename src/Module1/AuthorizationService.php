<?php
declare(strict_types=1);

namespace App\Module1;

final class AuthorizationService
{
    private RandomTokenGenerator $tokenGenerator;

    public function __construct(ClientRepository $clientRepository, TokenGenerator $tokenGenerator)
    {
        $this->clientRepository = $clientRepository;
        $this->tokenGenerator = $tokenGenerator;
    }

    public function authorize(string $clientId, string $clientSecret): AuthorizationToken
    {
        $client = $this->clientRepository->findClientById($clientId);

        if ($client->clientSecret() !== $clientSecret) {
            throw FailedToAuthorizeClient::becauseClientSecretIsInvalid($clientId);
        }

        $token = $this->tokenGenerator->generate();

        return $token;
    }
}
