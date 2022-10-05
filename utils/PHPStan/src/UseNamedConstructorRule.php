<?php
declare(strict_types=1);

namespace Utils\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;

final class UseNamedConstructorRule implements Rule
{
    public function __construct(private ReflectionProvider $reflectionProvider)
    {

    }

    public function getNodeType(): string
    {
        return New_::class;
    }

    /**
     * @param New_ $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node->class instanceof Name) {
            return [];
        }

        $fqcn = $node->class->toString();
        if (!$this->reflectionProvider->hasClass($fqcn)) {
            return [];
        }

        $classReflection = $this->reflectionProvider->getClass($fqcn);

        $namedConstructors = array_filter(
            $classReflection
                ->getNativeReflection()
                ->getMethods(),
            function (\ReflectionMethod $reflectionMethod) use ($scope) {
                if (!$reflectionMethod->isStatic()) {
                    return false;
                }

                $type = $reflectionMethod->getReturnType();
                if ($type === null) {
                    return false;
                }

                return $type->getName() === 'self';
            }
        );

        if ($namedConstructors === []) {
            return [];
        }

        $methodNames = implode(', ',
            array_map(
                fn(\ReflectionMethod $reflectionMethod) => $reflectionMethod->getName() . '()',
                $namedConstructors
            )
        );

        return ['Use a named constructor (e.g. ' . $methodNames . ')'];
    }
}
