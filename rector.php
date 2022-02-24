<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Privatization\Rector\Class_\FinalizeClassesWithoutChildrenRector;
use Rector\Set\ValueObject\LevelSetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/utils'
    ]);

    $parameters->set(Option::AUTO_IMPORT_NAMES, true);

    $services = $containerConfigurator->services();

    $services->set(FinalizeClassesWithoutChildrenRector::class);

    $containerConfigurator->import(
        LevelSetList::UP_TO_PHP_80
    );

//    $containerConfigurator->import(Typo3LevelSetList::UP_TO_TYPO3_11);
};
