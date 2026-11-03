<?php

use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\TestRunner;

/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'AllTests::main');
}

require_once 'Zend/AllTests.php';
require_once 'resources/AllTests.php';

/**
 * @category   Zend
 * @package    Zend
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class AllTests
{
    public static function main()
    {
        $parameters = [
            'configuration' => __DIR__ . '/phpunit.xml',
            'extensions' => [],
            'unavailableExtensions' => [],
            'loadedExtensions' => [],
            'notLoadedExtensions' => [],
            'colors' => 'always',
            'verbose' => true,
            // 'printer' => \PHPUnit\Util\TestDox\CliTestDoxPrinter::class
        ];

        if (TESTS_GENERATE_REPORT && extension_loaded('xdebug')) {
            $parameters['reportDirectory'] = TESTS_GENERATE_REPORT_TARGET;
        }

        if (defined('TESTS_ZEND_LOCALE_FORMAT_SETLOCALE') && TESTS_ZEND_LOCALE_FORMAT_SETLOCALE) {
            // run all tests in a special locale
            setlocale(LC_ALL, TESTS_ZEND_LOCALE_FORMAT_SETLOCALE);
        }

        // Run buffered tests as a separate suite first
        // ob_start();
        // (new \PHPUnit\TextUI\TestRunner)->run(self::suiteBuffered(), $parameters);
        // if (ob_get_level()) {
        //     ob_end_flush();
        // }

        (new resources_Runner())->run(self::suite(), $parameters);
    }

    /**
     * Buffered test suites
     *
     * These tests require no output be sent prior to running as they rely
     * on internal PHP functions.
     *
     * @return TestSuite
     */
    public static function suiteBuffered()
    {
        $suite = new TestSuite('Zend Framework - Buffered');

        $suite->addTest(Zend_AllTests::suiteBuffered());

        return $suite;
    }

    /**
     * Regular suite
     *
     * All tests except those that require output buffering.
     *
     * @return TestSuite
     */
    public static function suite()
    {
        $suite = new TestSuite('Zend Framework');

        $suite->addTest(Zend_AllTests::suite());
        $suite->addTest(resources_AllTests::suite());

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'AllTests::main') {
    AllTests::main();
}
