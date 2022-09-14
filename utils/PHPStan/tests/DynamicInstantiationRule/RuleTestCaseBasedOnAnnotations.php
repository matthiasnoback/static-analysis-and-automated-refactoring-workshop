<?php
declare(strict_types=1);

namespace Utils\PHPStan\Tests\DynamicInstantiationRule;

use PhpParser\Comment;
use PhpParser\Node\Stmt\Nop;
use PhpParser\NodeFinder;
use PHPStan\Parser\RichParser;
use PHPStan\PhpDoc\PhpDocStringResolver;
use PHPStan\Testing\RuleTestCase;

/**
 * @template TRule of \PHPStan\Rules\Rule
 * @extends RuleTestCase<TRule>
 */
abstract class RuleTestCaseBasedOnAnnotations extends RuleTestCase
{
    /**
     * @return array<string>
     */
    abstract public function filesToAnalyse(): array;

    /**
     * @dataProvider provideFilesToAnalyse
     */
    final public function testRule(string $file): void
    {
        $this->analyseWithAnnotations($file);
    }

    /**
     * @return array<array{string}>
     */
    final public function provideFilesToAnalyse(): array
    {
        return array_map(fn (string $file) => [$file], $this->filesToAnalyse());
    }

    public function analyseWithAnnotations(string $file): void
    {
        parent::analyse([$file], $this->getExpectedErrors($file));
    }

    /**
     * @return array<array{string,int}>
     */
    public function getExpectedErrors(string $filePath): array
    {
        /** @var RichParser $parser */
        $parser = self::getContainer()->getService('currentPhpVersionRichParser');
        $nodes = $parser->parseFile($filePath);
        $nopNodes = (new NodeFinder())->findInstanceOf($nodes, Nop::class);

        $docStringResolver = self::getContainer()->getByType(PhpDocStringResolver::class);
        $expectedErrors = [];
        foreach ($nopNodes as $nopNode) {
            /** @var array<Comment> $comments */
            $comments = $nopNode->getAttribute('comments');
            foreach ($comments as $comment) {
                $docNode = $docStringResolver->resolve($comment->getText());
                foreach ($docNode->getTagsByName('@phpstan-error') as $phpstanError) {
                    $expectedErrors[] = [$phpstanError->value->__toString(), $comment->getStartLine()];
                }
            }
        }

        return $expectedErrors;
    }
}
