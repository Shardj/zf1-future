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
 * @package    Zend_Cloud_QueueService
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Cloud_QueueService_Adapter_AllTests::main');
}

/**
 * @see Zend_Cloud_QueueService_Adapter_SqsTest
 */
require_once 'Zend/Cloud/QueueService/Adapter/SqsTest.php';

/**
 * @see Zend_Cloud_QueueService_Adapter_WindowsAzureTest
 */
require_once 'Zend/Cloud/QueueService/Adapter/WindowsAzureTest.php';

/**
 * @see Zend_Cloud_QueueService_Adapter_ZendQueueTest
 */
require_once 'Zend/Cloud/QueueService/Adapter/ZendQueueTest.php';

/**
 * @category   Zend
 * @package    Zend_Cloud_QueueService_Adapter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Cloud_QueueService_Adapter_AllTests
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
        $suite = new TestSuite('Zend Framework - Zend_Cloud - QueueService - Adapter');

        $suite->addTestSuite('Zend_Cloud_QueueService_Adapter_SqsTest');
        $suite->addTestSuite('Zend_Cloud_QueueService_Adapter_WindowsAzureTest');
        $suite->addTestSuite('Zend_Cloud_QueueService_Adapter_ZendQueueTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Cloud_QueueService_Adapter_AllTests::main') {
    Zend_Cloud_QueueService_Adapter_AllTests::main();
}
