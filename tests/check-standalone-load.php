<?php

/**
 * Loads every file of the library alone, in its own PHP process and without an autoloader.
 *
 * A file has to bring its parent class and its interfaces with it, and the require_once
 * statements at the top of the files must not lead back to a file whose class is not declared yet.
 *
 * Usage: php tests/check-standalone-load.php
 */

$library = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'library';

// one file, called by the loop below
if (isset($argv[1])) {
    set_include_path($library);
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
    ini_set('display_errors', '0');

    register_shutdown_function(function () {
        $error = error_get_last();
        if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
            ob_end_clean();
            fwrite(STDOUT, preg_replace('/\s+/', ' ', $error['message']));
        }
    });

    ob_start();
    try {
        require_once $argv[1];
    } catch (Throwable $e) {
        ob_end_clean();
        fwrite(STDOUT, get_class($e) . ': ' . preg_replace('/\s+/', ' ', $e->getMessage()));
        exit(1);
    }
    ob_end_clean();
    exit(0);
}

// files that cannot be loaded alone, with the reason
$known = [
    'Zend/Locale/Math/PhpMath.php' => 'loaded by Zend/Locale/Math.php, which calls it while it is loaded',
    'Zend/Search/Lucene/Interface/MultiSearcher.php' => 'requires Zend_Search_Lucene_MultiSearcher, whose '
        . 'setDefaultSearchField() is not static although the interface declares it static',
];

// not checked: what the static analysis leaves out as well (deprecated components, classes for missing
// extensions), and command line scripts that run when they are loaded
$skip = ['Zend/Service/WindowsAzure/CommandLine/'];
$inExcludePaths = false;
foreach (file(dirname(__DIR__) . '/.phpstan.dist.neon', FILE_IGNORE_NEW_LINES) as $line) {
    if (preg_match('/^\s*excludePaths:/', $line)) {
        $inExcludePaths = true;
    } elseif ($inExcludePaths && preg_match('~^\s*-\s*library/(Zend/\S+)~', $line, $match)) {
        $skip[] = $match[1];
    } elseif ($inExcludePaths && trim($line) !== '' && !preg_match('/^\s*[-#]/', $line)) {
        $inExcludePaths = false;
    }
}

$files = [];
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($library . DIRECTORY_SEPARATOR . 'Zend', FilesystemIterator::SKIP_DOTS)
);
foreach ($iterator as $file) {
    if (substr((string) $file, -4) !== '.php') {
        continue;
    }
    $relative = str_replace(DIRECTORY_SEPARATOR, '/', substr((string) $file, strlen($library) + 1));
    foreach ($skip as $prefix) {
        if (strpos($relative, $prefix) === 0) {
            continue 2;
        }
    }
    $files[] = $relative;
}
sort($files);

$failed = [];
$fixed  = [];
foreach ($files as $relative) {
    $output = [];
    exec(
        escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg(__FILE__) . ' ' . escapeshellarg($relative) . ' 2>&1',
        $output,
        $exitCode
    );
    $message = trim(implode(' ', $output));

    if ($exitCode === 0 && $message === '') {
        if (isset($known[$relative])) {
            $fixed[] = $relative;
        }
        continue;
    }
    if (!isset($known[$relative])) {
        $failed[$relative] = $message !== '' ? $message : 'exit code ' . $exitCode;
    }
}

echo count($files) . ' files, ' . count($failed) . ' cannot be loaded alone, ' . count($known) . " known exceptions\n";
foreach ($failed as $relative => $message) {
    echo "\n$relative\n    " . substr($message, 0, 300) . "\n";
}
foreach ($fixed as $relative) {
    echo "\n$relative\n    loads alone now, remove it from the list of known exceptions\n";
}

exit(($failed || $fixed) ? 1 : 0);
