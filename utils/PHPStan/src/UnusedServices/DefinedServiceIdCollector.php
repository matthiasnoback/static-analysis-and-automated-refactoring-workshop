<?php

declare(strict_types=1);

namespace Utils\PHPStan\UnusedServices;

use PhpParser\Node;
use PhpParser\Node\Expr\ArrayDimFetch;
use PHPStan\Analyser\Scope;
use PHPStan\Collectors\Collector;

final class DefinedServiceIdCollector implements Collector
{
    use PsrContainerKnowledge;

    public function getNodeType(): string
    {
        return ArrayDimFetch::class;
    }

    /**
     * @param ArrayDimFetch $node
     * @return null|array{string, int}
     */
    public function processNode(Node $node, Scope $scope): ?array
    {
        $serviceId = $this->extractServiceIdFromServiceDefinition($node, $scope);

        if ($serviceId === null) {
            return null;
        }

        return (new DefinedService($serviceId, $scope->getFile(), $node->getLine()))->toArray();
    }
}
