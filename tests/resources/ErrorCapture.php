<?php

use PHPUnit\Framework\Assert;

/**
 * Records the PHP errors (notices, warnings, user errors) a piece of code
 * triggers, so tests can assert on them without relying on PHPUnit
 * converting errors into exceptions, which PHPUnit 10 no longer does.
 */
class resources_ErrorCapture
{
    /**
     * Runs $callback and returns the errors it triggered
     *
     * @param  callable $callback
     * @param  int      $levels  error levels to record, others are passed on to the previous handler
     * @return array    list of ['level' => int, 'message' => string, 'file' => string, 'line' => int]
     */
    public static function capture(callable $callback, $levels = E_ALL)
    {
        $errors = [];
        set_error_handler(function ($level, $message, $file, $line) use (&$errors, $levels) {
            if (!($level & $levels)) {
                return false;
            }
            $errors[] = ['level' => $level, 'message' => $message, 'file' => $file, 'line' => $line];
            return true;
        }, $levels);

        try {
            $callback();
        } finally {
            restore_error_handler();
        }

        return $errors;
    }

    /**
     * Asserts that $callback triggers an error of $level whose message contains $message
     *
     * @param  callable    $callback
     * @param  int         $level   e.g. E_USER_NOTICE, E_USER_WARNING, E_USER_DEPRECATED
     * @param  string|null $message substring the error message must contain, null for any
     * @return array       the matching errors
     */
    public static function assertTriggers(callable $callback, $level, $message = null)
    {
        $errors   = self::capture($callback);
        $matching = array_values(array_filter($errors, function ($error) use ($level, $message) {
            return $error['level'] === $level
                && ($message === null || strpos($error['message'], $message) !== false);
        }));

        Assert::assertNotEmpty($matching, sprintf(
            "No %s%s was triggered; triggered errors: %s",
            self::levelName($level),
            $message === null ? '' : " containing '$message'",
            $errors ? "\n" . implode("\n", array_map(function ($error) {
                return '  ' . self::levelName($error['level']) . ': ' . $error['message'];
            }, $errors)) : 'none'
        ));

        return $matching;
    }

    /**
     * Asserts that $callback triggers no error of the given levels
     *
     * @param  callable $callback
     * @param  int      $levels
     * @return void
     */
    public static function assertTriggersNothing(callable $callback, $levels = E_ALL)
    {
        $errors = self::capture($callback, $levels);

        Assert::assertSame([], $errors, "Unexpected errors were triggered:\n" . implode("\n", array_map(function ($error) {
            return '  ' . self::levelName($error['level']) . ': ' . $error['message'] . ' in ' . $error['file'] . ':' . $error['line'];
        }, $errors)));
    }

    /**
     * Returns the active error handler, null without one
     *
     * Tests compare it before and after a call to check that the call restored
     * the error handlers it set.
     *
     * @return callable|null
     */
    public static function currentErrorHandler()
    {
        $handler = set_error_handler(function () {
            return false;
        });
        restore_error_handler();

        return $handler;
    }

    /**
     * @param  int $level
     * @return string
     */
    public static function levelName($level)
    {
        foreach (['E_ERROR', 'E_WARNING', 'E_NOTICE', 'E_DEPRECATED', 'E_USER_ERROR', 'E_USER_WARNING', 'E_USER_NOTICE', 'E_USER_DEPRECATED', 'E_STRICT', 'E_RECOVERABLE_ERROR'] as $name) {
            if (defined($name) && constant($name) === $level) {
                return $name;
            }
        }

        return 'error level ' . $level;
    }
}
