<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Privatization\Rector\Class_\FinalizeClassesWithoutChildrenRector;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $config): void {
    $config->paths([__DIR__ . '/src', __DIR__ . '/utils']);
    $config->importNames();

    $config->rule(FinalizeClassesWithoutChildrenRector::class);

    $config->sets([
        LevelSetList::UP_TO_PHP_81
    ]);
};
