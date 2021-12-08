<?php

declare(strict_types=1);

namespace App\Module1;

class AuthorizationService
{
    private TokenGenerator $tokenGenerator;

    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository, TokenGenerator $tokenGenerator)
    {
        $this->clientRepository = $clientRepository;
        $this->tokenGenerator = $tokenGenerator;
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
