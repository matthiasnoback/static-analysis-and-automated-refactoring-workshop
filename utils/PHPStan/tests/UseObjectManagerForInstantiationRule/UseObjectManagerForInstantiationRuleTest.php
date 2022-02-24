<?php
declare(strict_types=1);

namespace Utils\PHPStan\Tests\UseObjectManagerForInstantiationRule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Utils\PHPStan\UseObjectManagerForInstantiationRule;

/**
 * @extends RuleTestCase<UseObjectManagerForInstantiationRule>
 */
final class UseObjectManagerForInstantiationRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new UseObjectManagerForInstantiationRule();
    }

    public function testRulePreventsUsingGeneralUtilityMakeInstance(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/instantiation-using-general-utility.php'],
            [['Using GeneralUtility::makeInstance() is not allowed, use ObjectManager::get() instead', 10]]
        );
    }

    public function testRuleSkipsUsingObjectManagerGet(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/skip-instantiation-using-object-manager.php'],
            []
        );
    }
}
