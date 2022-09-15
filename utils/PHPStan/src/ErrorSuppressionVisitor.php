<?php
declare(strict_types=1);

namespace Utils\PHPStan;

use PhpParser\Node;
use PhpParser\Node\Expr\ErrorSuppress;
use PhpParser\Node\Stmt;
use PhpParser\NodeVisitorAbstract;

final class ErrorSuppressionVisitor extends NodeVisitorAbstract
{
    private ?Stmt $currentStmt = null;

    /**
     * @var array<ErrorSuppress>
     */
    private array $currentStatementErrorSuppressNodes = [];

    public function enterNode(Node $node)
    {
        if ($node instanceof Stmt) {
            $this->currentStmt = $node;
        } elseif ($node instanceof ErrorSuppress) {
            $this->currentStatementErrorSuppressNodes[] = $node;
        }
    }

    public function leaveNode(Node $node)
    {
        if ($node === $this->currentStmt) {
            if ($this->currentStatementErrorSuppressNodes !== []) {
                $this->currentStmt->setAttribute('suppressedErrors', $this->currentStatementErrorSuppressNodes);
            }

            $this->currentStmt = null;
            $this->currentStatementErrorSuppressNodes = [];
        }
    }
}
