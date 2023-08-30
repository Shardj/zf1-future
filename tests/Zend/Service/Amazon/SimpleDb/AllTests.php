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
 * @package    Zend_Service_Amazon_SimpleDb
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_Amazon_SimpleDb_AllTests::main');
}

/**
 * @see Zend_Service_Amazon_SimpleDb_OfflineTest
 */
require_once 'Zend/Service/Amazon/SimpleDb/OfflineTest.php';

/**
 * @see Zend_Service_Amazon_SimpleDb_OnlineTest
 */
require_once 'Zend/Service/Amazon/SimpleDb/OnlineTest.php';

/**
 * @see Zend_Service_Amazon_SimpleDb_PageTest
 */
require_once 'Zend/Service/Amazon/SimpleDb/PageTest.php';

/**
 * @category   Zend
 * @package    Zend_Service_Amazon_SimpleDb
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Amazon_SimpleDb_AllTests
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
        $suite = new TestSuite('Zend Framework - Zend_Service - Amazon - SimpleDB');

        if (defined('TESTS_ZEND_SERVICE_AMAZON_ONLINE_ENABLED')
            && constant('TESTS_ZEND_SERVICE_AMAZON_ONLINE_ENABLED')
            && defined('TESTS_ZEND_SERVICE_AMAZON_ONLINE_ACCESSKEYID')
            && defined('TESTS_ZEND_SERVICE_AMAZON_ONLINE_SECRETKEY')
        ) {
            $suite->addTestSuite('Zend_Service_Amazon_SimpleDb_OnlineTest');
        } else {
            $suite->addTestSuite('Zend_Service_Amazon_SimpleDb_OfflineTest');
        }

        $suite->addTestSuite('Zend_Service_Amazon_SimpleDb_PageTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Service_Amazon_SimpleDb_AllTests::main') {
    Zend_Service_Amazon_SimpleDb_AllTests::main();
}
