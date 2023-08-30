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
 * @package    Zend_Service_WindowsAzure
 * @subpackage UnitTests
 * @version    $Id$
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Test helpers
 */
require_once dirname(__FILE__) . '/../../../TestHelper.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_WindowsAzure_AllTests::main');
}

require_once 'Zend/Service/WindowsAzure/Credentials/AllTests.php';
require_once 'Zend/Service/WindowsAzure/Diagnostics/AllTests.php';
require_once 'Zend/Service/WindowsAzure/Management/AllTests.php';
require_once 'Zend/Service/WindowsAzure/RetryPolicyTest.php';
require_once 'Zend/Service/WindowsAzure/StorageTest.php';
require_once 'Zend/Service/WindowsAzure/BlobStorageTest.php';
require_once 'Zend/Service/WindowsAzure/BlobStreamTest.php';
require_once 'Zend/Service/WindowsAzure/BlobStorageSharedAccessTest.php';
require_once 'Zend/Service/WindowsAzure/TableEntityTest.php';
require_once 'Zend/Service/WindowsAzure/DynamicTableEntityTest.php';
require_once 'Zend/Service/WindowsAzure/TableEntityQueryTest.php';
require_once 'Zend/Service/WindowsAzure/TableStorageTest.php';
require_once 'Zend/Service/WindowsAzure/QueueStorageTest.php';
require_once 'Zend/Service/WindowsAzure/TableSessionHandlerTest.php';
require_once 'Zend/Service/WindowsAzure/BlobSessionHandlerTest.php';

/**
 * @category   Zend
 * @package    Zend_Service_WindowsAzure
 * @subpackage UnitTests
 * @version    $Id$
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_WindowsAzure_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Service_WindowsAzure');

        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_CREDENTIALS_RUNTESTS) {
            $suite->addTest(Zend_Service_WindowsAzure_Credentials_AllTests::suite());
        }

        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_DIAGNOSTICS_RUNTESTS) {
            $suite->addTest(Zend_Service_WindowsAzure_Diagnostics_AllTests::suite());
        }
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_RUNTESTS) {
            $suite->addTest(Zend_Service_WindowsAzure_Management_AllTests::suite());
        }
        
        $suite->addTestSuite('Zend_Service_WindowsAzure_RetryPolicyTest');
        $suite->addTestSuite('Zend_Service_WindowsAzure_StorageTest');
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_BLOB_RUNTESTS) {
            $suite->addTestSuite('Zend_Service_WindowsAzure_BlobStorageTest');
            $suite->addTestSuite('Zend_Service_WindowsAzure_BlobStorageSharedAccessTest');
            $suite->addTestSuite('Zend_Service_WindowsAzure_BlobStreamTest');
        }
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_TABLE_RUNTESTS) {
            $suite->addTestSuite('Zend_Service_WindowsAzure_TableEntityTest');
            $suite->addTestSuite('Zend_Service_WindowsAzure_DynamicTableEntityTest');
            $suite->addTestSuite('Zend_Service_WindowsAzure_TableEntityQueryTest');
            $suite->addTestSuite('Zend_Service_WindowsAzure_TableStorageTest');
        }
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_QUEUE_RUNTESTS) {
            $suite->addTestSuite('Zend_Service_WindowsAzure_QueueStorageTest');
        }
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_SESSIONHANDLER_RUNTESTS) {
            $suite->addTestSuite('Zend_Service_WindowsAzure_TableSessionHandlerTest');
            $suite->addTestSuite('Zend_Service_WindowsAzure_BlobSessionHandlerTest');
        }
        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Service_WindowsAzure_AllTests::main') {
    Zend_Service_WindowsAzure_AllTests::main();
}
