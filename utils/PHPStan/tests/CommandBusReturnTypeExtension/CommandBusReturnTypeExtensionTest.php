<?php
declare(strict_types=1);

namespace Utils\PHPStan\Tests\CommandBusReturnTypeExtension;

use PHPStan\Testing\TypeInferenceTestCase;

final class CommandBusReturnTypeExtensionTest extends TypeInferenceTestCase
{
    /**
     * @return iterable<mixed>
     */
    public function dataFileAsserts(): iterable
    {
        // path to a file with actual asserts of expected types:
        yield from $this->gatherAssertTypes(__DIR__ . '/Fixtures/command-bus-handle.php');
    }

    /**
     * @dataProvider dataFileAsserts
     */
    public function testFileAsserts(
        string $assertType,
        string $file,
        mixed ...$args
    ): void
    {
        $this->markTestIncomplete('Enable this test when working on Module10');

        $this->assertFileAsserts($assertType, $file, ...$args);
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [__DIR__ . '/../../src/command-bus-extension.neon'];
    }
}
