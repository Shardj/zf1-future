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
 * @package    Zend_Mobile_Push
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: AllTests.php $
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Mobile_Push_AllTests::main');
}

require_once 'Zend/Mobile/Push/Message/AllTests.php';
require_once 'Zend/Mobile/Push/Response/AllTests.php';
require_once 'Zend/Mobile/Push/AbstractTest.php';
require_once 'Zend/Mobile/Push/ApnsTest.php';
require_once 'Zend/Mobile/Push/GcmTest.php';
require_once 'Zend/Mobile/Push/MpnsTest.php';

/**
 * @category   Zend
 * @package    Zend_Mobile_Push
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mobile
 */
class Zend_Mobile_Push_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Mobile_Push');

        $suite->addTest(Zend_Mobile_Push_Message_AllTests::suite());
         
        $suite->addTestSuite('Zend_Mobile_Push_AbstractTest');
        $suite->addTestSuite('Zend_Mobile_Push_ApnsTest');
        $suite->addTestSuite('Zend_Mobile_Push_GcmTest');
        $suite->addTestSuite('Zend_Mobile_Push_MpnsTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Mobile_Push_AllTests::main') {
    Zend_Mobile_Push_AllTests::main();
}
