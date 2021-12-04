<?php
declare(strict_types=1);

namespace App\Module1;

final class Client
{
    private int $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    public function __construct(int $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function clientId(): int
    {
        return $this->clientId;
    }

    public function clientSecret(): string
    {
        return $this->clientSecret;
    }
}
