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
        'modernize_types_casting' => true,
        'logical_operators' => true,
    ]);
