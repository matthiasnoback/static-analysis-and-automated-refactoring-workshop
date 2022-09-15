<?php
declare(strict_types=1);

namespace Utils\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Expr\BooleanNot;
use PhpParser\Node\Expr\ErrorSuppress;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\Throw_;
use PhpParser\NodeFinder;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Type\BooleanType;
use PHPStan\Type\Constant\ConstantBooleanType;

/**
 * @implements Rule<Stmt>
 */
final class ErrorSuppressionWithErrorGetLastRule implements Rule
{
    public function __construct(private readonly ReflectionProvider $reflectionProvider)
    {

    }
    public function getNodeType(): string
    {
        return Stmt::class;
    }

    /**
     * @param Stmt $node
     */
    public function processNode(Node $node, Scope $scope): array
    {
        $errorSuppressNodes = $node->getAttribute('suppressedErrors') ?: [];
        if ($errorSuppressNodes === []) {
            return [];
        }

        $suppressedCallsToFunctionsThatMayReturnFalse = array_filter(
            $errorSuppressNodes,
            function (ErrorSuppress $errorSuppress) use ($scope): bool {
                if (!$errorSuppress->expr instanceof FuncCall) {
                    return false;
                }

                if (!$errorSuppress->expr->name instanceof Name) {
                    return false;
                }

                $returnType = ParametersAcceptorSelector::selectFromArgs(
                    $scope,
                    $errorSuppress->expr->getArgs(),
                    $this->reflectionProvider->getFunction($errorSuppress->expr->name, $scope)->getVariants(),
                )->getReturnType();

                if (!$returnType->isSuperTypeOf(new ConstantBooleanType(false))->yes()){
                    return false;
                }

                return true;
            }
        );

        if ($suppressedCallsToFunctionsThatMayReturnFalse === []) {
            return [];
        }

        $ifStmt = $node->getAttribute('next');
        if (!$ifStmt instanceof If_ || !$ifStmt->cond instanceof BooleanNot) {
            return [
                RuleErrorBuilder::message('After a statement that suppresses errors with `@` there should be an if statement that checks for a false return value')->build()
            ];
        }

        $throwNode = (new NodeFinder())->findFirstInstanceOf($ifStmt->stmts, Throw_::class);
        if ($throwNode === null) {
            return [
                RuleErrorBuilder::message('The if statement is expected to throw an exception')->build()
            ];
        }

        $callToErrorGetLast = (new NodeFinder())->findFirst(
            $ifStmt->stmts,
            fn(Node $node
            ) => $node instanceof FuncCall && $node->name instanceof Name && $node->name->toString() === 'error_get_last'
        );
        if ($callToErrorGetLast === null) {
            return [
                RuleErrorBuilder::message('The if statement is expected to call error_get_last()')->build()
            ];
        }

        return [];
    }
}
