<?php

use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;

/**
 * Reports error handlers and error_reporting levels a test leaves behind
 *
 * PHPUnit 9 registers its own error handler only when no other handler is
 * active, so a leaked handler stops the conversion of deprecations, notices
 * and warnings for all following tests. The listener removes the leaked
 * handlers and restores E_ALL after reporting them.
 */
final class Zend_ErrorHandlerLeakListener implements TestListener
{
    use TestListenerDefaultImplementation;

    public function endTest(Test $test, float $time): void
    {
        $name = get_class($test) . ($test instanceof TestCase ? '::' . $test->getName() : '');

        $handlers = [];
        while (true) {
            $previous = set_error_handler(static function () {
                return false;
            });
            restore_error_handler();
            if ($previous === null) {
                break;
            }
            $handlers[] = self::describe($previous);
            restore_error_handler();
        }
        if ($handlers) {
            fwrite(STDERR, 'ERROR HANDLER LEAK after ' . $name . ': ' . implode(' | ', $handlers) . PHP_EOL);
        }

        $level = error_reporting();
        if ($level !== E_ALL) {
            fwrite(STDERR, 'ERROR_REPORTING LEAK after ' . $name . ': ' . $level . PHP_EOL);
            error_reporting(E_ALL);
        }
    }

    private static function describe($handler): string
    {
        if ($handler instanceof Closure) {
            $reflection = new ReflectionFunction($handler);
            return 'Closure ' . $reflection->getFileName() . ':' . $reflection->getStartLine();
        }
        if (is_array($handler)) {
            return (is_object($handler[0]) ? get_class($handler[0]) : $handler[0]) . '::' . $handler[1];
        }
        if (is_object($handler)) {
            return get_class($handler);
        }
        return (string) $handler;
    }
}
