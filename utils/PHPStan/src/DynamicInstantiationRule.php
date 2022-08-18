<?php

declare(strict_types=1);

namespace Utils\PHPStan;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

final class DynamicInstantiationRule implements Rule
{
    public function getNodeType(): string
    {
        // What node type is this rule interested in? For now: any node type
        return Node::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        // Return errors for this node. For now: nothing, just print the type of the node
        echo get_class($node) . "\n";

        return [];
    }
}
