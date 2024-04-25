<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use RectorLaravel\Set\LaravelSetList;

return RectorConfig::configure()
    ->withSets([
        LaravelSetList::LARAVEL_110,
    ])
    ->withPaths([
        __DIR__.'/config',
        __DIR__.'/app',
        __DIR__.'/tests',
    ])->withSkip([
        __DIR__.'/app/Migrations',
    ])->withPreparedSets(deadCode: true, codeQuality: true, naming: true, privatization: true);
