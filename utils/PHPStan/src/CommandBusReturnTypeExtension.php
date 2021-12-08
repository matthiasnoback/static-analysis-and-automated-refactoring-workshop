<?php
declare(strict_types=1);

namespace Utils\PHPStan;

use App\Module10\CommandBus;
use Assert\Assertion;
use PhpParser\Node\Arg;
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
        $defaultReturnType = ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $methodCall->getArgs(),
            $methodReflection->getVariants()
        )->getReturnType();

        if (!isset($methodCall->getArgs()[0])) {
            return $defaultReturnType;
        }

        $firstArgument = $methodCall->getArgs()[0];
        if (!$firstArgument instanceof Arg) {
            return $defaultReturnType;
        }

        $type = $scope->getType($firstArgument->value);
        if (!$type instanceof ObjectType) {
            return $defaultReturnType;
        }

        $handlerClassNameGuess = $type->getClassName() . 'Handler';
        if (!$this->reflectionProvider->hasClass($handlerClassNameGuess)) {
            return $defaultReturnType;
        }

        $handlerClass = $this->reflectionProvider->getClass($handlerClassNameGuess);

        if (!$handlerClass->hasMethod('handle')) {
            return $defaultReturnType;
        }

        return ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $methodCall->getArgs(),
            $handlerClass->getMethod('handle', $scope)->getVariants()
        )->getReturnType();
    }
}
