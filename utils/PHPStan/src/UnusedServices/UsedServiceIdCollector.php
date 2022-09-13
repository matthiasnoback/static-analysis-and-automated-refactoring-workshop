<?php

declare(strict_types=1);

namespace Utils\PHPStan\UnusedServices;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Collectors\Collector;

final class UsedServiceIdCollector implements Collector
{
    use PsrContainerKnowledge;

    public function getNodeType(): string
    {
        return MethodCall::class;
    }

    /**
     * @param MethodCall $node
     * @return null|array{string}
     */
    public function processNode(Node $node, Scope $scope): ?array
    {
        $serviceId = $this->extractServiceIdFromMethodCall($node, $scope);

        if ($serviceId === null) {
            return null;
        }

        return [$serviceId];
    }
}
