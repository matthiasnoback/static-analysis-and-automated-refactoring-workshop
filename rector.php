<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $config): void {
    $config->paths(
        [
        __DIR__ . '/src',
        __DIR__ . '/utils'
        ]
    );
    $config->importNames();
};
