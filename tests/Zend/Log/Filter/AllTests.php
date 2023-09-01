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
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Log_Filter_AllTests::main');
}

require_once 'Zend/Log/Filter/ChainingTest.php';
require_once 'Zend/Log/Filter/MessageTest.php';
require_once 'Zend/Log/Filter/PriorityTest.php';
require_once 'Zend/Log/Filter/SuppressTest.php';

/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Log
 * @group      Zend_Log_Filter
 */
class Zend_Log_Filter_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Log_Filter');

        $suite->addTestSuite('Zend_Log_Filter_ChainingTest');
        $suite->addTestSuite('Zend_Log_Filter_MessageTest');
        $suite->addTestSuite('Zend_Log_Filter_PriorityTest');
        $suite->addTestSuite('Zend_Log_Filter_SuppressTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Log_Filter_AllTests::main') {
    Zend_Log_Filter_AllTests::main();
}
