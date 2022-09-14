<?php

declare(strict_types=1);

namespace Utils\PHPStan\Tests\DynamicInstantiationRule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Utils\PHPStan\DynamicInstantiationRule;

/**
 * @extends RuleTestCaseBasedOnAnnotations<DynamicInstantiationRule>
 */
final class DynamicInstantiationRuleTest extends RuleTestCaseBasedOnAnnotations
{
    public function filesToAnalyse(): array
    {
        return [
            __DIR__ . '/Fixtures/dynamic-instantiation.php',
            __DIR__ . '/Fixtures/skip-class-name-instantiation.php',
        ];
    }

    protected function getRule(): Rule
    {
        return new DynamicInstantiationRule();
    }
}
