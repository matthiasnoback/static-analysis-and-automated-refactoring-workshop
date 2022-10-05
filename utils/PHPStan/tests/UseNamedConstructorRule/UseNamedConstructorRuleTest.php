<?php
declare(strict_types=1);

namespace Utils\PHPStan\Tests\UseNamedConstructorRule;

use PHPStan\Testing\RuleTestCase;
use Utils\PHPStan\UseNamedConstructorRule;

/**
 * @group wip
 */
final class UseNamedConstructorRuleTest extends RuleTestCase
{
    public function testRulePreventsUsageOfConstructorIfNamedConstructorExists(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/named-constructor-exists.php'],
            [['Use a named constructor (e.g. create(), createFrom())', 5]]
        );
    }

    public function testRuleSkipsNormalClassNameInstantiation(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/skip-no-named-constructor-exists.php'],
            [] // no errors
        );
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [
            __DIR__ . '/../../src/UseNamedConstructorRule.neon'
        ];
    }

    protected function getRule(): \PHPStan\Rules\Rule
    {
        return self::getContainer()->getByType(UseNamedConstructorRule::class);
    }

}
