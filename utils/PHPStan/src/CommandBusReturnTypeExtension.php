<?php

declare(strict_types=1);

namespace Utils\PHPStan;

use App\Module10\CommandBus;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;

final class CommandBusReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public function __construct(
        private ReflectionProvider $reflectionProvider
    ) {
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
    ): Type {
        $defaultType = ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $methodCall->getArgs(),
            $methodReflection->getVariants()
        )->getReturnType();

        if (! isset($methodCall->getArgs()[0])) {
            // There's no first argument
            return $defaultType;
        }

        $firstArgument = $methodCall->getArgs()[0];
        $type = $scope->getType($firstArgument->value);
        if (! $type instanceof ObjectType) {
            // First argument is not an object
            return $defaultType;
        }

        $handlerClass = $type->getClassName() . 'Handler';
        if (! $this->reflectionProvider->hasClass($handlerClass)) {
            // There is no handler class
            return $defaultType;
        }

        $handlerReflection = $this->reflectionProvider->getClass($handlerClass);
        if (! $handlerReflection->hasMethod('handle')) {
            // The handler has no handle method
            return $defaultType;
        }

        // Return the return type of handler::handle()
        $handleMethodReflection = $handlerReflection->getMethod('handle', $scope);

        return ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $methodCall->getArgs(),
            $handleMethodReflection->getVariants()
        )->getReturnType();
    }
}
