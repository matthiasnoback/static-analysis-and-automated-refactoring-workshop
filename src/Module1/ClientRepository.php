<?php
declare(strict_types=1);

namespace App\Module1;

interface ClientRepository
{
    public function findClientById(string $clientId): ?Client;
}
