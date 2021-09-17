<?php
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
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Loader_AutoloaderFactoryTest::main');
}

/*
 * Preload a number of classes to ensure they're available once we've disabled
 * other autoloaders.
 */
require_once 'Zend/Loader/AutoloaderFactory.php';
require_once 'Zend/Loader/ClassMapAutoloader.php';
require_once 'Zend/Loader/StandardAutoloader.php';

/**
 * @package    Zend_Loader
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Loader
 */
class Zend_Loader_AutoloaderFactoryTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        // Store original autoloaders
        $this->loaders = spl_autoload_functions();
        if (!is_array($this->loaders)) {
            // spl_autoload_functions does not return empty array when no
            // autoloaders registered...
            $this->loaders = [];
        }

        // Clear out other autoloaders to ensure those being tested are at the
        // top of the stack
        foreach ($this->loaders as $loader) {
            spl_autoload_unregister($loader);
        }

        // Store original include_path
        $this->includePath = get_include_path();
    }

    public function tearDown()
    {
        Zend_Loader_AutoloaderFactory::unregisterAutoloaders();
        // Restore original autoloaders
        $loaders = spl_autoload_functions();
        if (is_array($loaders)) {
            foreach ($loaders as $loader) {
                spl_autoload_unregister($loader);
            }
        }

        foreach ($this->loaders as $loader) {
            spl_autoload_register($loader);
        }

        // Restore original include_path
        set_include_path($this->includePath);
    }

    public function testRegisteringValidMapFilePopulatesAutoloader()
    {
        Zend_Loader_AutoloaderFactory::factory([
            'Zend_Loader_ClassMapAutoloader' => [
                dirname(__FILE__) . '/_files/goodmap.php',
            ],
        ]);
        $loader = Zend_Loader_AutoloaderFactory::getRegisteredAutoloader('Zend_Loader_ClassMapAutoloader');
        $map = $loader->getAutoloadMap();
        $this->assertTrue(is_array($map));
        $this->assertEquals(2, count($map));
    }

    /**
     * This tests checks if invalid autoloaders cause exceptions
     *
     * @expectedException Zend_Loader_Exception_InvalidArgumentException
     */
    public function testFactoryCatchesInvalidClasses()
    {
        if (!version_compare(PHP_VERSION, '5.3.7', '>=')) {
            $this->markTestSkipped('Cannot test invalid interface loader with versions less than 5.3.7');
        }
        include dirname(__FILE__) . '/_files/InvalidInterfaceAutoloader.php';
        Zend_Loader_AutoloaderFactory::factory([
            'InvalidInterfaceAutoloader' => []
        ]);
    }

    public function testFactoryDoesNotRegisterDuplicateAutoloaders()
    {
        Zend_Loader_AutoloaderFactory::factory([
            'Zend_Loader_StandardAutoloader' => [
                'prefixes' => [
                    'TestPrefix' => dirname(__FILE__) . '/TestAsset/TestPrefix',
                ],
            ],
        ]);
        $this->assertEquals(1, count(Zend_Loader_AutoloaderFactory::getRegisteredAutoloaders()));
        Zend_Loader_AutoloaderFactory::factory([
            'Zend_Loader_StandardAutoloader' => [
                'prefixes' => [
                    'ZendTest_Loader_TestAsset_TestPlugins' => dirname(__FILE__) . '/TestAsset/TestPlugins',
                ],
            ],
        ]);
        $this->assertEquals(1, count(Zend_Loader_AutoloaderFactory::getRegisteredAutoloaders()));
        $this->assertTrue(class_exists('TestPrefix_NoDuplicateAutoloadersCase'));
        $this->assertTrue(class_exists('ZendTest_Loader_TestAsset_TestPlugins_Foo'));
    }

    public function testCanUnregisterAutoloaders()
    {
        Zend_Loader_AutoloaderFactory::factory([
            'Zend_Loader_StandardAutoloader' => [
                'prefixes' => [
                    'TestPrefix' => dirname(__FILE__) . '/TestAsset/TestPrefix',
                ],
            ],
        ]);
        Zend_Loader_AutoloaderFactory::unregisterAutoloaders();
        $this->assertEquals(0, count(Zend_Loader_AutoloaderFactory::getRegisteredAutoloaders()));
    }

    public function testCanUnregisterAutoloadersByClassName()
    {
        Zend_Loader_AutoloaderFactory::factory([
            'Zend_Loader_StandardAutoloader' => [
                'namespaces' => [
                    'TestPrefix' => dirname(__FILE__) . '/TestAsset/TestPrefix',
                ],
            ],
        ]);
        Zend_Loader_AutoloaderFactory::unregisterAutoloader('Zend_Loader_StandardAutoloader');
        $this->assertEquals(0, count(Zend_Loader_AutoloaderFactory::getRegisteredAutoloaders()));
    }

    public function testCanGetValidRegisteredAutoloader()
    {
        Zend_Loader_AutoloaderFactory::factory([
            'Zend_Loader_StandardAutoloader' => [
                'namespaces' => [
                    'TestPrefix' => dirname(__FILE__) . '/TestAsset/TestPrefix',
                ],
            ],
        ]);
        $autoloader = Zend_Loader_AutoloaderFactory::getRegisteredAutoloader('Zend_Loader_StandardAutoloader');
        $this->assertTrue($autoloader instanceof Zend_Loader_StandardAutoloader);
    }

    public function testDefaultAutoloader()
    {
        Zend_Loader_AutoloaderFactory::factory();
        $autoloader = Zend_Loader_AutoloaderFactory::getRegisteredAutoloader('Zend_Loader_StandardAutoloader');
        $this->assertTrue($autoloader instanceof Zend_Loader_StandardAutoloader);
        $this->assertEquals(1, count(Zend_Loader_AutoloaderFactory::getRegisteredAutoloaders()));
    }

    public function testGetInvalidAutoloaderThrowsException()
    {
        $this->setExpectedException('Zend_Loader_Exception_InvalidArgumentException');
        $loader = Zend_Loader_AutoloaderFactory::getRegisteredAutoloader('InvalidAutoloader');
    }

    public function testFactoryWithInvalidArgumentThrowsException()
    {
        $this->setExpectedException('Zend_Loader_Exception_InvalidArgumentException');
        Zend_Loader_AutoloaderFactory::factory('InvalidArgument');
    }

    public function testFactoryWithInvalidAutoloaderClassThrowsException()
    {
        $this->setExpectedException('Zend_Loader_Exception_InvalidArgumentException');
        Zend_Loader_AutoloaderFactory::factory(['InvalidAutoloader' => []]);
    }

    public function testCannotBeInstantiatedViaConstructor()
    {
        $reflection = new ReflectionClass('Zend_Loader_AutoloaderFactory');
        $constructor = $reflection->getConstructor();
        $this->assertNull($constructor);
    }

    public function testPassingNoArgumentsToFactoryInstantiatesAndRegistersStandardAutoloader()
    {
        Zend_Loader_AutoloaderFactory::factory();
        $loaders = Zend_Loader_AutoloaderFactory::getRegisteredAutoloaders();
        $this->assertEquals(1, count($loaders));
        $loader = array_shift($loaders);
        $this->assertTrue($loader instanceof Zend_Loader_StandardAutoloader);

        $test  = [$loader, 'autoload'];
        $found = false;
        foreach (spl_autoload_functions() as $function) {
            if ($function === $test) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found, 'StandardAutoloader not registered with spl_autoload');
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Loader_AutoloaderFactoryTest::main') {
    Zend_Loader_AutoloaderFactoryTest::main();
}
