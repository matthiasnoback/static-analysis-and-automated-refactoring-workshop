<?php

declare(strict_types=1);

namespace App\Module1;

final class AuthorizationService
{
    public function __construct(private ClientRepository $clientRepository, private TokenGenerator $tokenGenerator)
    {
    }

    public function authorize(string $clientId, string $clientSecret): string
    {
        $client = $this->clientRepository->findClientById($clientId);
        if ($client === null) {
            throw ClientNotFound::withId($clientId);
        }

        if ($client->apiKey() !== $clientSecret) {
            throw FailedToAuthorizeClient::becauseClientSecretIsInvalid($clientId);
        }

        $token = $this->tokenGenerator->generate();

        return $token;
    }
}
