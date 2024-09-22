<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\Config\RectorConfig;
use Rector\Php53\Rector\FuncCall\DirNameFileConstantToDirConstantRector;
use Rector\Php53\Rector\Ternary\TernaryToElvisRector;
use Rector\Php54\Rector\Array_\LongArrayToShortArrayRector;
use Rector\Php55\Rector\Class_\ClassConstantToSelfClassRector;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Php56\Rector\FuncCall\PowToExpRector;
use Rector\Php70\Rector\FuncCall\MultiDirnameRector;
use Rector\Php70\Rector\FuncCall\RandomFunctionRector;
use Rector\Php70\Rector\StmtsAwareInterface\IfIssetToCoalescingRector;
use Rector\Php70\Rector\Ternary\TernaryToNullCoalescingRector;
use Rector\Php70\Rector\Variable\WrapVariableVariableNameInCurlyBracesRector;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\Php71\Rector\List_\ListToArrayDestructRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\ValueObject\PhpVersion;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/library',
        __DIR__ . '/tests',
    ]);

    // register a single rule
    // https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md#completedynamicpropertiesrector
    $rectorConfig->rule(CompleteDynamicPropertiesRector::class);
    $rectorConfig->skip([
        MultiDirnameRector::class,
        DirNameFileConstantToDirConstantRector::class,
        ListToArrayDestructRector::class,
        ClassConstantToSelfClassRector::class,
        RemoveExtraParametersRector::class,
        IfIssetToCoalescingRector::class,
        StringClassNameToClassConstantRector::class,
        TernaryToElvisRector::class,
        RandomFunctionRector::class,
        LongArrayToShortArrayRector::class,
        WrapVariableVariableNameInCurlyBracesRector::class,
        TernaryToNullCoalescingRector::class,
        PowToExpRector::class,
        __DIR__ . '/tests/Zend/Loader/_files/ParseError.php',
    ]);
    $a = pow(12, 23);

    // define sets of rules
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_82
    ]);
    $rectorConfig->phpVersion(PhpVersion::PHP_71);
};
