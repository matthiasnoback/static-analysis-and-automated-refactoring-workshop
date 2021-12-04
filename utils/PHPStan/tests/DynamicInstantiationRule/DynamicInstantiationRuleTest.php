<?php

declare(strict_types=1);

namespace Utils\PHPStan\Tests\DynamicInstantiationRule;

use PHPStan\Testing\RuleTestCase;
use Utils\PHPStan\DynamicInstantiationRule;

/**
 * @extends RuleTestCase<DynamicInstantiationRule>
 */
final class DynamicInstantiationRuleTest extends RuleTestCase
{
    public function testRulePreventsDynamicInstantiation(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/dynamic-instantiation.php'],
            [['Dynamic class instantiation is not allowed', 3]]
        );
    }

    public function testRuleSkipsNormalClassNameInstantiation(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/skip-class-name-instantiation.php'],
            [] // no errors
        );
    }

    protected function getRule(): DynamicInstantiationRule
    {
        return new DynamicInstantiationRule();
    }
}
