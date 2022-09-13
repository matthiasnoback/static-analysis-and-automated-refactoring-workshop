<?php

declare(strict_types=1);

namespace Utils\PHPStan\Tests\UnusedServicesRule\Fixtures;

use Psr\Container\ContainerInterface;

final class DefinesTwoServices
{
    private ContainerInterface $container;

    public function defineServices(): void
    {
        $this->container[ServiceOne::class] = fn () => new ServiceOne();
        $this->container[ServiceTwo::class] = fn () => new ServiceTwo();
    }
}
