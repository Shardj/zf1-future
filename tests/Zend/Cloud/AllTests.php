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
 * @package    Zend_Cloud
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Cloud_AllTests::main');
}

/**
 * @see Zend_Cloud_DocumentService_AllTests
 */
require_once 'Zend/Cloud/DocumentService/AllTests.php';

/**
 * @see Zend_Cloud_QueueService_AllTests
 */
require_once 'Zend/Cloud/QueueService/AllTests.php';

/**
 * @see Zend_Cloud_StorageService_AllTests
 */
require_once 'Zend/Cloud/StorageService/AllTests.php';

/**
 * @see Zend_Cloud_Infrastructure_AllTests
 */
require_once 'Zend/Cloud/Infrastructure/AllTests.php';

/**
 * @category   Zend
 * @package    Zend_Cloud
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Cloud
 */
class Zend_Cloud_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Cloud');

        $suite->addTest(Zend_Cloud_DocumentService_AllTests::suite());
        $suite->addTest(Zend_Cloud_QueueService_AllTests::suite());
        $suite->addTest(Zend_Cloud_StorageService_AllTests::suite());
        $suite->addTest(Zend_Cloud_Infrastructure_AllTests::suite());
        
        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Cloud_AllTests::main') {
    Zend_Cloud_AllTests::main();
}
