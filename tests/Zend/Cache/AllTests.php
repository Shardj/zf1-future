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
 * @package    Zend_Cache
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id $
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Cache_AllTests::main');
}

require_once 'Zend/Cache/ApcBackendTest.php';
require_once 'Zend/Cache/ClassFrontendTest.php';
require_once 'Zend/Cache/CoreTest.php';
require_once 'Zend/Cache/FactoryTest.php';
require_once 'Zend/Cache/FileBackendTest.php';
require_once 'Zend/Cache/FileFrontendTest.php';
require_once 'Zend/Cache/FunctionFrontendTest.php';
require_once 'Zend/Cache/ManagerTest.php';
require_once 'Zend/Cache/MemcachedBackendTest.php';
require_once 'Zend/Cache/LibmemcachedBackendTest.php';
require_once 'Zend/Cache/OutputFrontendTest.php';
require_once 'Zend/Cache/PageFrontendTest.php';
require_once 'Zend/Cache/SkipTests.php';
require_once 'Zend/Cache/StaticBackendTest.php';
require_once 'Zend/Cache/TwoLevelsBackendTest.php';

/**
 * @category   Zend
 * @package    Zend_Cache
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Cache
 */
class Zend_Cache_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Cache');

        $suite->addTestSuite('Zend_Cache_FactoryTest');
        $suite->addTestSuite('Zend_Cache_CoreTest');
        $suite->addTestSuite('Zend_Cache_FileBackendTest');
        $suite->addTestSuite('Zend_Cache_StaticBackendTest');
        $suite->addTestSuite('Zend_Cache_OutputFrontendTest');
        $suite->addTestSuite('Zend_Cache_FunctionFrontendTest');
        $suite->addTestSuite('Zend_Cache_ClassFrontendTest');
        $suite->addTestSuite('Zend_Cache_FileFrontendTest');
        $suite->addTestSuite('Zend_Cache_PageFrontendTest');
        $suite->addTestSuite('Zend_Cache_ManagerTest');

        /*
         * Check if APC tests are enabled, and if extension is available.
         */
        if (!defined('TESTS_ZEND_CACHE_APC_ENABLED') ||
            constant('TESTS_ZEND_CACHE_APC_ENABLED') === false) {
            $skipTest = new Zend_Cache_ApcBackendTest_SkipTests();
            $skipTest->message = 'Tests are not enabled in TestConfiguration.php';
            $suite->addTest($skipTest);
        } elseif (!extension_loaded('apcu')) {
            $skipTest = new Zend_Cache_ApcBackendTest_SkipTests();
            $skipTest->message = "Extension 'apcu' is not loaded";
            $suite->addTest($skipTest);
        } else {
            $suite->addTestSuite('Zend_Cache_ApcBackendTest');
        }

        
        /*
         * Check if Memcached tests are enabled, and if extension is available.
         */
        if (!defined('TESTS_ZEND_CACHE_MEMCACHED_ENABLED') ||
            constant('TESTS_ZEND_CACHE_MEMCACHED_ENABLED') === false) {
            $skipTest = new Zend_Cache_MemcachedBackendTest_SkipTests();
            $skipTest->message = 'Tests are not enabled in TestConfiguration.php';
            $suite->addTest($skipTest);
        } elseif (!extension_loaded('memcache')) {
            $skipTest = new Zend_Cache_MemcachedBackendTest_SkipTests();
            $skipTest->message = "Extension 'memcache' is not loaded";
            $suite->addTest($skipTest);
        } else {
            if (!defined('TESTS_ZEND_CACHE_MEMCACHED_HOST')) {
                define('TESTS_ZEND_CACHE_MEMCACHED_HOST', '127.0.0.1');
            }
            if (!defined('TESTS_ZEND_CACHE_MEMCACHED_PORT')) {
                define('TESTS_ZEND_CACHE_MEMCACHED_PORT', 11211);
            }
            if (!defined('TESTS_ZEND_CACHE_MEMCACHED_PERSISTENT')) {
                define('TESTS_ZEND_CACHE_MEMCACHED_PERSISTENT', true);
            }
            $suite->addTestSuite('Zend_Cache_MemcachedBackendTest');
        }

        /*
         * Check if Memcached2 tests are enabled, and if extension is available.
         */
        if (!defined('TESTS_ZEND_CACHE_LIBMEMCACHED_ENABLED') ||
            constant('TESTS_ZEND_CACHE_LIBMEMCACHED_ENABLED') === false) {
            $skipTest = new Zend_Cache_LibmemcachedBackendTest_SkipTests();
            $skipTest->message = 'Tests are not enabled in TestConfiguration.php';
            $suite->addTest($skipTest);
        } elseif (!extension_loaded('memcached')) {
            $skipTest = new Zend_Cache_LibmemcachedBackendTest_SkipTests();
            $skipTest->message = "Extension 'Memcached' is not loaded";
            $suite->addTest($skipTest);
        } else {
            if (!defined('TESTS_ZEND_CACHE_LIBMEMCACHED_HOST')) {
                define('TESTS_ZEND_CACHE_LIBMEMCACHED_HOST', '127.0.0.1');
            }
            if (!defined('TESTS_ZEND_CACHE_LIBMEMCACHED_PORT')) {
                define('TESTS_ZEND_CACHE_LIBMEMCACHED_PORT', 11211);
            }
            if (!defined('TESTS_ZEND_CACHE_LIBMEMCACHED_WEIGHT')) {
                define('TESTS_ZEND_CACHE_LIBMEMCACHED_WEIGHT', 1);
            }
            $suite->addTestSuite('Zend_Cache_LibmemcachedBackendTest');
        }

        /*
         * Check if APC tests are enabled, and if extension is available.
         */
        if (!defined('TESTS_ZEND_CACHE_APC_ENABLED') ||
            constant('TESTS_ZEND_CACHE_APC_ENABLED') === false) {
            $skipTest = new Zend_Cache_TwoLevelsBackendTest_SkipTests();
            $skipTest->message = 'Tests are not enabled in TestConfiguration.php';
            $suite->addTest($skipTest);
        } elseif (!extension_loaded('apcu')) {
            $skipTest = new Zend_Cache_TwoLevelsBackendTest_SkipTests();
            $skipTest->message = "Extension 'apcu' is not loaded";
            $suite->addTest($skipTest);
        } else {
            $suite->addTestSuite('Zend_Cache_TwoLevelsBackendTest');
        }

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Cache_AllTests::main') {
    Zend_Cache_AllTests::main();
}
