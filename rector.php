<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/library',
        __DIR__ . '/tests',
    ]);

    // register a single rule
    // https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#completedynamicpropertiesrector
    $rectorConfig->rule(CompleteDynamicPropertiesRector::class);

    // define sets of rules
    // $rectorConfig->sets([
    //     LevelSetList::UP_TO_PHP_82
    // ]);
};
