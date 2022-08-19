<?php

declare(strict_types=1);

namespace Utils\PHPStan;

use App\Module10\CommandBus;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;

final class CommandBusReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public function __construct()
    {
    }

    public function getClass(): string
    {
        // This type extension can resolve the return type for a method of the class CommandBus
        return CommandBus::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        // This type extension can resolve the return type for the handle() method of CommandBus
        return $methodReflection->getName() === 'handle';
    }

    public function getTypeFromMethodCall(
        MethodReflection $methodReflection,
        MethodCall $methodCall,
        Scope $scope
    ): ?Type {
        // TODO: return the return type of [CommandClass]Handler::handle() instead

        // By default, return the return type of CommandBus::handle() (or just null)
        return ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $methodCall->getArgs(),
            $methodReflection->getVariants()
        )->getReturnType();
    }
}
