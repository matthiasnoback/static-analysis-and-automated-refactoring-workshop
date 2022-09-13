<?php

declare(strict_types=1);

namespace Utils\PHPStan\UnusedServices;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Node\CollectedDataNode;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<CollectedDataNode>
 */
final class UnusedServicesRule implements Rule
{
    public function getNodeType(): string
    {
        return CollectedDataNode::class;
    }

    /**
     * @param CollectedDataNode $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        /** @var array<string,array<array<mixed>>> $definedServiceIdCollectedData */
        $definedServiceIdCollectedData = $node->get(DefinedServiceIdCollector::class);
        $serviceDefinitions = [];

        foreach ($definedServiceIdCollectedData as $definitions) {
            foreach ($definitions as $definitionArray) {
                $definedService = DefinedService::fromArray($definitionArray);
                $serviceDefinitions[$definedService->serviceId] = $definedService;
            }
        }

        /** @var array<string,array<array{string}>> $usedServiceIdData */
        $usedServiceIdData = $node->get(UsedServiceIdCollector::class);
        foreach ($usedServiceIdData as $usages) {
            foreach ($usages as $usage) {
                list($serviceId) = $usage;

                unset($serviceDefinitions[$serviceId]);
            }
        }

        if ($serviceDefinitions === []) {
            return [];
        }

        $errors = [];

        foreach ($serviceDefinitions as $serviceId => $definition) {
            $errors[] = RuleErrorBuilder::message(
                sprintf('Service %s is defined here but never used', $serviceId)
            )->file($definition->file)
                ->line($definition->line)
                ->build();
        }

        return $errors;
    }
}
