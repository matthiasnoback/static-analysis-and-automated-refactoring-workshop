<?php
declare(strict_types=1);

namespace App\Module1;

final class AuthorizationService
{
    public function __construct(private ClientRepository $clientRepository, private TokenGenerator $tokenGenerator)
    {
    }

    public function authorize(string $clientId, string $clientSecret): AuthorizationToken
    {
        $client = $this->clientRepository->findClientById($clientId);
        if ($client === null) {
            throw FailedToAuthorizeClient::becauseClientDoesNotExist($clientId);
        }

        if ($client->clientSecret() !== $clientSecret) {
            throw FailedToAuthorizeClient::becauseClientSecretIsInvalid($clientId);
        }

        $token = $this->tokenGenerator->generate();

        return new AuthorizationToken($token);
    }
}
