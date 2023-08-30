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
 * @package    Zend_Service_Ebay
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: AllTests.php 22813 2010-08-08 14:34:42Z ramon $
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_Ebay_AllTests::main');
}

/**
 * @see Zend_Service_Ebay_AllTests
 */
require_once 'Zend/Service/Ebay/Finding/AllTests.php';

/**
 * @see Zend_Service_Ebay_AbstractTest
 */
require_once 'Zend/Service/Ebay/AbstractTest.php';

/**
 * @category   Zend
 * @package    Zend_Service_Ebay
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service
 */
class Zend_Service_Ebay_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Service_Ebay');
        $suite->addTestSuite('Zend_Service_Ebay_AbstractTest');
        $suite->addTest(Zend_Service_Ebay_Finding_AllTests::suite());
        return $suite;
    }
}
if (PHPUnit_MAIN_METHOD === 'Zend_Service_Ebay_AllTests::main') {
    Zend_Service_AllTests::main();
}
