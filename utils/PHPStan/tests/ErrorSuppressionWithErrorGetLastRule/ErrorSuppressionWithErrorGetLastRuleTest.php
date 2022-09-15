<?php
declare(strict_types=1);

namespace Utils\PHPStan\Tests\ErrorSuppressionWithErrorGetLastRule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Utils\PHPStan\ErrorSuppressionWithErrorGetLastRule;

/**
 * @extends RuleTestCase<ErrorSuppressionWithErrorGetLastRule>
 */
final class ErrorSuppressionWithErrorGetLastRuleTest extends RuleTestCase
{
    public function testRuleNoIfStatement(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/if-statement-is-missing-after-error-suppressed-function-call.php'],
            [
                ['After a statement that suppresses errors with `@` there should be an if statement that checks for a false return value', 3]
            ]
        );
    }

    public function testRuleNoNextStatement(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/no-statement-after-error-suppressed-function-call.php'],
            [
                ['After a statement that suppresses errors with `@` there should be an if statement that checks for a false return value', 3]
            ]
        );
    }

    public function testRuleNoCheckForFalse(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/if-clause-does-not-check-for-false.php'],
            [
                ['After a statement that suppresses errors with `@` there should be an if statement that checks for a false return value', 3]
            ]
        );
    }

    public function testNoCallToErrorGetLast(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/if-clause-does-not-call-error_get_last.php'],
            [
                ['The if statement is expected to call error_get_last()', 3]
            ]
        );
    }

    public function testThrowException(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/if-statement-does-not-throw-exception.php'],
            [
                ['The if statement is expected to throw an exception', 3]
            ]
        );
    }

    public function testOkay(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/if-clause-checks-for-false-and-uses-error_get_last.php'],
            []
        );
    }

    public function testOkayFunctionNeverReturnsFalse(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/skip-function-never-returns-false.php'],
            []
        );
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [__DIR__ . '/error_suppression.neon'];
    }

    protected function getRule(): Rule
    {
        return self::getContainer()->getByType(ErrorSuppressionWithErrorGetLastRule::class);
    }
}
