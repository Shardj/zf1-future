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
 * @package    Zend_Auth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Auth_Adapter_DbTable_AllTests::main');
}

require_once 'Zend/Auth/Adapter/DbTable/BasicSqliteTest.php';
require_once 'Zend/Auth/Adapter/DbTable/BasicSqliteTest/SkipTests.php';

/**
 * @category   Zend
 * @package    Zend_Auth
 * @subpackage UnitTests
 * @group      Zend_Auth
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Auth_Adapter_DbTable_AllTests
{
    /**
     * Runs this test suite
     *
     * @return void
     */
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    /**
     * Creates and returns this test suite
     *
     * @return TestSuite
     */
    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Auth_Adapter_DbTable');

        if (!defined('TESTS_ZEND_AUTH_ADAPTER_DBTABLE_PDO_SQLITE_ENABLED') ||
            constant('TESTS_ZEND_AUTH_ADAPTER_DBTABLE_PDO_SQLITE_ENABLED') === false) {
            $skipTest = new Zend_Auth_Adapter_DbTable_BasicSqliteTest_SkipTests();
            $skipTest->message = 'Tests are not enabled in TestConfiguration.php';
            $suite->addTest($skipTest);
        } elseif (!extension_loaded('pdo')) {
            $skipTest = new Zend_Auth_Adapter_DbTable_BasicSqliteTest_SkipTests();
            $skipTest->message = "Extension 'PDO' is not loaded";
            $suite->addTest($skipTest);
        } elseif (!in_array('sqlite', PDO::getAvailableDrivers())) {
            $skipTest = new Zend_Auth_Adapter_DbTable_BasicSqliteTest_SkipTests();
            $skipTest->message = "PDO driver 'sqlite' is not available";
            $suite->addTest($skipTest);
        } else {
            $suite->addTestSuite('Zend_Auth_Adapter_DbTable_BasicSqliteTest');
        }

        return $suite;
    }
}


if (PHPUnit_MAIN_METHOD === 'Zend_Auth_Adapter_DbTable_AllTests::main') {
    Zend_Auth_Adapter_DbTable_AllTests::main();
}
