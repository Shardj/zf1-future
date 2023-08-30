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
 * @package    Zend_EventManager
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_EventManager_AllTests::main');
}

require_once 'Zend/EventManager/EventManagerTest.php';
require_once 'Zend/EventManager/FilterChainTest.php';
require_once 'Zend/EventManager/GlobalEventManagerTest.php';
require_once 'Zend/EventManager/StaticEventManagerTest.php';
require_once 'Zend/EventManager/StaticIntegrationTest.php';

/**
 * @category   Zend
 * @package    Zend_EventManager
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_EventManager
 */
class Zend_EventManager_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_EventManager');

        $suite->addTestSuite('Zend_EventManager_EventManagerTest');
        $suite->addTestSuite('Zend_EventManager_FilterChainTest');
        $suite->addTestSuite('Zend_EventManager_GlobalEventManagerTest');
        $suite->addTestSuite('Zend_EventManager_StaticEventManagerTest');
        $suite->addTestSuite('Zend_EventManager_StaticIntegrationTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_EventManager_AllTests::main') {
    Zend_EventManager_AllTests::main();
}
