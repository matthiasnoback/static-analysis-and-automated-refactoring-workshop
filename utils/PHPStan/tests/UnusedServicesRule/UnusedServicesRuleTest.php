<?php

declare(strict_types=1);

namespace Utils\PHPStan\Tests\UnusedServicesRule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Utils\PHPStan\UnusedServices\DefinedServiceIdCollector;
use Utils\PHPStan\UnusedServices\UnusedServicesRule;
use Utils\PHPStan\UnusedServices\UsedServiceIdCollector;

/**
 * @extends RuleTestCase<UnusedServicesRule>
 */
final class UnusedServicesRuleTest extends RuleTestCase
{
    public function testUnusedServiceId(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/DefinesTwoServices.php', __DIR__ . '/Fixtures/UsesOneService.php'],
            [
                [
                    'Service Utils\PHPStan\Tests\UnusedServicesRule\Fixtures\ServiceTwo is defined here but never used',
                    16,
                ],
            ]
        );
    }

    public function testUsesAllServices(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/DefinesTwoServices.php', __DIR__ . '/Fixtures/UsesTwoServices.php'],
            []
        );
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [__DIR__ . '/../../src/UnusedServices/unused_services.neon'];
    }

    protected function getCollectors(): array
    {
        return [
            self::getContainer()->getByType(DefinedServiceIdCollector::class),
            self::getContainer()->getByType(UsedServiceIdCollector::class),
        ];
    }

    protected function getRule(): Rule
    {
        return self::getContainer()->getByType(UnusedServicesRule::class);
    }
}
