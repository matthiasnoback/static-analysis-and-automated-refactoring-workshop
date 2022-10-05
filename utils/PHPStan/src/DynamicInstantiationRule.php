<?php

declare(strict_types=1);

namespace Utils\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\New_;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

/**
 * @implements Rule<New_>
 */
final class DynamicInstantiationRule implements Rule
{
    public function getNodeType(): string
    {
        return New_::class;
    }

    /**
     * @param New_ $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->class instanceof Expr) {
            return [
                'Dynamic class instantiation is not allowed'
            ];
        }

        // Everything is okay
        return [];
    }
}
