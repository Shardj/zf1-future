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
 * @package    Zend_Loader
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Loader_AllTests::main');
}

require_once 'Zend/Loader/AutoloaderTest.php';
require_once 'Zend/Loader/AutoloaderFactoryClassMapLoaderTest.php';
require_once 'Zend/Loader/AutoloaderFactoryTest.php';
require_once 'Zend/Loader/AutoloaderMultiVersionTest.php';
require_once 'Zend/Loader/Autoloader/ResourceTest.php';
require_once 'Zend/Loader/ClassMapAutoloaderTest.php';
require_once 'Zend/Loader/PluginLoaderTest.php';
require_once 'Zend/Loader/StandardAutoloaderTest.php';

/**
 * @category   Zend
 * @package    Zend_Loader
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Loader
 */
class Zend_Loader_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Loader');

        $suite->addTestSuite('Zend_Loader_AutoloaderTest');
        $suite->addTestSuite('Zend_Loader_AutoloaderFactoryClassMapLoaderTest');
        $suite->addTestSuite('Zend_Loader_AutoloaderFactoryTest');
        $suite->addTestSuite('Zend_Loader_AutoloaderMultiVersionTest');
        $suite->addTestSuite('Zend_Loader_Autoloader_ResourceTest');
        $suite->addTestSuite('Zend_Loader_ClassMapAutoloaderTest');
        $suite->addTestSuite('Zend_Loader_PluginLoaderTest');
        $suite->addTestSuite('Zend_Loader_StandardAutoloaderTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Loader_AllTests::main') {
    Zend_Loader_AllTests::main();
}
