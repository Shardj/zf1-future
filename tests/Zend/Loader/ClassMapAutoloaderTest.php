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
 * @package    Loader
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Loader_ClassMapAutoloaderTest::main');
}

require_once 'Zend/Loader/ClassMapAutoloader.php';

/**
 * @category   Zend
 * @package    Loader
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Loader
 */
class Zend_Loader_ClassMapAutoloaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Zend_Loader_ClassMapAutoloader
     */
    private $loader;

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

        // Store original include_path
        $this->includePath = get_include_path();

        $this->loader = new Zend_Loader_ClassMapAutoloader();
    }

    public function tearDown()
    {
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

    public function testRegisteringNonExistentAutoloadMapRaisesInvalidArgumentException()
    {
        $dir = dirname(__FILE__) . '__foobar__';
        $this->setExpectedException('Zend_Loader_Exception_InvalidArgumentException');
        $this->loader->registerAutoloadMap($dir);
    }

    public function testValidMapFileNotReturningMapRaisesInvalidArgumentException()
    {
        $this->setExpectedException('Zend_Loader_Exception_InvalidArgumentException');
        $this->loader->registerAutoloadMap(dirname(__FILE__) . '/_files/badmap.php');
    }

    public function testAllowsRegisteringArrayAutoloadMapDirectly()
    {
        $map = [
            'Zend_Loader_Exception' => dirname(__FILE__) . '/../../../library/Zend/Loader/Exception.php',
        ];
        $this->loader->registerAutoloadMap($map);
        $test = $this->loader->getAutoloadMap();
        $this->assertSame($map, $test);
    }

    public function testAllowsRegisteringArrayAutoloadMapViaConstructor()
    {
        $map = [
            'Zend_Loader_Exception' => dirname(__FILE__) . '/../../../library/Zend/Loader/Exception.php',
        ];
        $loader = new Zend_Loader_ClassMapAutoloader([$map]);
        $test = $loader->getAutoloadMap();
        $this->assertSame($map, $test);
    }

    public function testRegisteringValidMapFilePopulatesAutoloader()
    {
        $this->loader->registerAutoloadMap(dirname(__FILE__) . '/_files/goodmap.php');
        $map = $this->loader->getAutoloadMap();
        $this->assertTrue(is_array($map));
        $this->assertEquals(2, count($map));
        // Just to make sure nothing changes after loading the same map again 
        // (loadMapFromFile should just return)
        $this->loader->registerAutoloadMap(dirname(__FILE__) . '/_files/goodmap.php');
        $map = $this->loader->getAutoloadMap();
        $this->assertTrue(is_array($map));
        $this->assertEquals(2, count($map));
    }

    public function testRegisteringMultipleMapsMergesThem()
    {
        $map = [
            'Zend_Loader_Exception' => dirname(__FILE__) . '/../../../library/Zend/Loader/Exception.php',
            'Zend_Loader_StandardAutoloaderTest' => 'some/bogus/path.php',
        ];
        $this->loader->registerAutoloadMap($map);
        $this->loader->registerAutoloadMap(dirname(__FILE__) . '/_files/goodmap.php');

        $test = $this->loader->getAutoloadMap();
        $this->assertTrue(is_array($test));
        $this->assertEquals(3, count($test));
        $this->assertNotEquals($map['Zend_Loader_StandardAutoloaderTest'], $test['Zend_Loader_StandardAutoloaderTest']);
    }

    public function testCanRegisterMultipleMapsAtOnce()
    {
        $map = [
            'Zend_Loader_Exception' => dirname(__FILE__) . '/../../../library/Zend/Loader/Exception.php',
            'Zend_Loader_StandardAutoloaderTest' => 'some/bogus/path.php',
        ];
        $maps = [$map, dirname(__FILE__) . '/_files/goodmap.php'];
        $this->loader->registerAutoloadMaps($maps);
        $test = $this->loader->getAutoloadMap();
        $this->assertTrue(is_array($test));
        $this->assertEquals(3, count($test));
    }

    public function testRegisterMapsThrowsExceptionForNonTraversableArguments()
    {
        $tests = [true, 'string', 1, 1.0, new stdClass];
        foreach ($tests as $test) {
            try {
                $this->loader->registerAutoloadMaps($test);
                $this->fail('Should not register non-traversable arguments');
            } catch (Zend_Loader_Exception_InvalidArgumentException $e) {
                $this->assertContains('array or implement Traversable', $e->getMessage());
            }
        }
    }

    public function testAutoloadLoadsClasses()
    {
        $map = ['Zend_UnusualNamespace_ClassMappedClass' => dirname(__FILE__) . '/TestAsset/ClassMappedClass.php'];
        $this->loader->registerAutoloadMap($map);
        $this->loader->autoload('Zend_UnusualNamespace_ClassMappedClass');
        $this->assertTrue(class_exists('Zend_UnusualNamespace_ClassMappedClass', false));
    }

    public function testIgnoresClassesNotInItsMap()
    {
        $map = ['Zend_UnusualNamespace_ClassMappedClass' => dirname(__FILE__) . '/TestAsset/ClassMappedClass.php'];
        $this->loader->registerAutoloadMap($map);
        $this->loader->autoload('Zend_UnusualNamespace_UnMappedClass');
        $this->assertFalse(class_exists('Zend_UnusualNamespace_UnMappedClass', false));
    }

    public function testRegisterRegistersCallbackWithSplAutoload()
    {
        $this->loader->register();
        $loaders = spl_autoload_functions();
        $this->assertTrue(count($this->loaders) < count($loaders));
        $found = false;
        foreach ($loaders as $loader) {
            if ($loader == [$this->loader, 'autoload']) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found, 'Autoloader not found in stack');
    }

    public function testCanLoadClassMapFromPhar()
    {
        if (!class_exists('Phar')) {
            $this->markTestSkipped('Test requires Phar extension');
        }
        $map = 'phar://' . dirname(__FILE__) . '/_files/classmap.phar/test/.//../autoload_classmap.php';
        $this->loader->registerAutoloadMap($map);
        $this->loader->autoload('some_loadedclass');
        $this->assertTrue(class_exists('some_loadedclass', false));
        $test = $this->loader->getAutoloadMap();
        $this->assertEquals(2, count($test));

        // will not register duplicate, even with a different relative path
        $map = 'phar://' . __DIR__ . '/_files/classmap.phar/test/./foo/../../autoload_classmap.php';
        $this->loader->registerAutoloadMap($map);
        $test = $this->loader->getAutoloadMap();
        $this->assertEquals(2, count($test));
    }

    public function testCanLoadNamespacedClassFromPhar()
    {
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            $this->markTestSkipped('Namespace support is valid for PHP >= 5.3.0 only');
        }

        $map = 'phar://' . __DIR__ . '/_files/classmap.phar/test/.//../autoload_classmap.php';
        $this->loader->registerAutoloadMap($map);
        $this->loader->autoload('some\namespacedclass');
        $this->assertTrue(class_exists('some\namespacedclass', false));
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Loader_ClassMapAutoloaderTest::main') {
    Zend_Loader_ClassMapAutoloaderTest::main();
}
