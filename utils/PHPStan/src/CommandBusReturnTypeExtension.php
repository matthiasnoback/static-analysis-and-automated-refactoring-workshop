<?php
declare(strict_types=1);

namespace Utils\PHPStan;

use App\Module10\CommandBus;
use Assert\Assertion;
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
    public function __construct(private ReflectionProvider $reflectionProvider)
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
    ): Type {
        $firstArgument = $methodCall->getArgs()[0];
        $typeOfFirstArgument = $scope->getType($firstArgument->value);
        if ($typeOfFirstArgument instanceof ObjectType) {
            // Assuming it's a command, now look for the handler
            $handlerClass = $this->reflectionProvider->getClass($typeOfFirstArgument->getClassName() . 'Handler');
            $handlerMethodReflection = $handlerClass->getMethod('handle', $scope);
            return ParametersAcceptorSelector::selectFromArgs(
                $scope,
                $methodCall->getArgs(),
                $handlerMethodReflection->getVariants()
            )->getReturnType();
        }

        // By default, return the return type of CommandBus::handle()
        return ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $methodCall->getArgs(),
            $methodReflection->getVariants()
        )->getReturnType();
    }
}
