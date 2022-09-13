<?php

declare(strict_types=1);

namespace Utils\PHPStan\Tests\UnusedServicesRule\Fixtures;

use Psr\Container\ContainerInterface;

final class UsesTwoServices
{
    private ContainerInterface $container;

    public function useService(): void
    {
        $this->container->get(ServiceOne::class);
        $this->container->get(ServiceTwo::class);
    }
}
