<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = (new Finder())
    ->notPath('tests/Zend/Loader/_files/ParseError.php')
    ->in('.');

return (new Config())
    ->setRiskyAllowed(true)
    ->setFinder($finder)
    ->setRules([
        'array_syntax' => ['syntax' => 'short'],
        'logical_operators' => true,
        'modernize_types_casting' => true,
        'nullable_type_declaration_for_default_null_value' => true,
    ]);
