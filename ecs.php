<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\PhpUnit\PhpUnitStrictFixer;

use Symplify\CodingStandard\Fixer\LineLength\LineLengthFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $config): void {
    $config->paths([__DIR__ . '/src', __DIR__ . '/utils', __DIR__ . '/rector.php', __DIR__ . '/ecs.php']);
    $config->skip(
        [
            PhpUnitStrictFixer::class,
            __DIR__ . '/utils/PHPStan/tests/DynamicInstantiationRule/Fixtures',
            __DIR__ . '/utils/PHPStan/tests/CommandBusReturnTypeExtension/Fixtures',
        ]
    );
    $config->ruleWithConfiguration(LineLengthFixer::class, [
        LineLengthFixer::LINE_LENGTH => 72,
    ]);

    $config->sets([SetList::CONTROL_STRUCTURES, SetList::PSR_12, SetList::COMMON, SetList::SYMPLIFY]);
};
