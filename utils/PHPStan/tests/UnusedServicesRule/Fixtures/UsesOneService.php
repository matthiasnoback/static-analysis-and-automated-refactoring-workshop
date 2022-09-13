<?php

declare(strict_types=1);

namespace Utils\PHPStan\Tests\UnusedServicesRule\Fixtures;

use Psr\Container\ContainerInterface;

final class UsesOneService
{
    private ContainerInterface $container;

    public function useService(): void
    {
        $this->container->get(ServiceOne::class);
    }
}
