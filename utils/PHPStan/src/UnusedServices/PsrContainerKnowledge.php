<?php

declare(strict_types=1);

namespace Utils\PHPStan\UnusedServices;

use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Type\ObjectType;
use Psr\Container\ContainerInterface;

trait PsrContainerKnowledge
{
    private function extractServiceIdFromMethodCall(MethodCall $node, Scope $scope): ?string
    {
        if (! $node->name instanceof Identifier) {
            return null;
        }

        if (! in_array($node->name->toString(), ['get', 'has'], true)) {
            return null;
        }

        if (! (new ObjectType(ContainerInterface::class))->isSuperTypeOf($scope->getType($node->var))->yes()) {
            return null;
        }

        if (! isset($node->args[0])) {
            return null;
        }

        if (! $node->args[0]->value instanceof ClassConstFetch) {
            return null;
        }

        if (! $node->args[0]->value->class instanceof Name) {
            return null;
        }

        return $node->args[0]->value->class->toString();
    }

    private function extractServiceIdFromServiceDefinition(ArrayDimFetch $node, Scope $scope): ?string
    {
        if (! $node->dim instanceof ClassConstFetch) {
            return null;
        }

        if (! (new ObjectType(ContainerInterface::class))->isSuperTypeOf($scope->getType($node->var))->yes()) {
            return null;
        }

        if (! $node->dim->class instanceof Name) {
            return null;
        }

        return $node->dim->class->toString();
    }
}
