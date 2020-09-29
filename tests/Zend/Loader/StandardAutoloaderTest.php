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
    define('PHPUnit_MAIN_METHOD', 'Zend_Loader_StandardAutoloaderTest::main');
}

require_once 'Zend/Loader/StandardAutoloader.php';
require_once 'Zend/Loader/TestAsset/StandardAutoloader.php';

/**
 * @category   Zend
 * @package    Loader
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Loader
 */
class Zend_Loader_StandardAutoloaderTest extends PHPUnit_Framework_TestCase
{
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

    public function testFallbackAutoloaderFlagDefaultsToFalse()
    {
        $loader = new Zend_Loader_StandardAutoloader();
        $this->assertFalse($loader->isFallbackAutoloader());
    }

    public function testFallbackAutoloaderStateIsMutable()
    {
        $loader = new Zend_Loader_StandardAutoloader();
        $loader->setFallbackAutoloader(true);
        $this->assertTrue($loader->isFallbackAutoloader());
        $loader->setFallbackAutoloader(false);
        $this->assertFalse($loader->isFallbackAutoloader());
    }

    public function testPassingNonTraversableOptionsToSetOptionsRaisesException()
    {
        $loader = new Zend_Loader_StandardAutoloader();

        $obj  = new stdClass();
        foreach ([true, 'foo', $obj] as $arg) {
            try {
                $loader->setOptions(true);
                $this->fail('Setting options with invalid type should fail');
            } catch (Zend_Loader_Exception_InvalidArgumentException $e) {
                $this->assertContains('array or Traversable', $e->getMessage());
            }
        }
    }

    public function testPassingArrayOptionsPopulatesProperties()
    {
        $options = [
            'namespaces' => [
                'Zend\\'   => dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR,
            ],
            'prefixes'   => [
                'Zend_'  => dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR,
            ],
            'fallback_autoloader' => true,
        ];
        $loader = new Zend_Loader_TestAsset_StandardAutoloader();
        $loader->setOptions($options);
        $this->assertEquals($options['namespaces'], $loader->getNamespaces());
        $this->assertEquals($options['prefixes'], $loader->getPrefixes());
        $this->assertTrue($loader->isFallbackAutoloader());
    }

    public function testPassingTraversableOptionsPopulatesProperties()
    {
        $namespaces = new ArrayObject([
            'Zend\\' => dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR,
        ]);
        $prefixes = new ArrayObject([
            'Zend_' => dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR,
        ]);
        $options = new ArrayObject([
            'namespaces' => $namespaces,
            'prefixes'   => $prefixes,
            'fallback_autoloader' => true,
        ]);
        $loader = new Zend_Loader_TestAsset_StandardAutoloader();
        $loader->setOptions($options);
        $this->assertEquals((array) $options['namespaces'], $loader->getNamespaces());
        $this->assertEquals((array) $options['prefixes'], $loader->getPrefixes());
        $this->assertTrue($loader->isFallbackAutoloader());
    }

    public function testAutoloadsNamespacedClasses()
    {
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            $this->markTestSkipped();
        }
        $loader = new Zend_Loader_StandardAutoloader();
        $loader->registerNamespace('Zend\UnusualNamespace', dirname(__FILE__) . '/TestAsset');
        $loader->autoload('Zend\UnusualNamespace\NamespacedClass');
        $this->assertTrue(class_exists('Zend\UnusualNamespace\NamespacedClass', false));
    }

    public function testAutoloadsVendorPrefixedClasses()
    {
        $loader = new Zend_Loader_StandardAutoloader();
        $loader->registerPrefix('ZendTest_UnusualPrefix', dirname(__FILE__) . '/TestAsset/UnusualPrefix');
        $loader->autoload('ZendTest_UnusualPrefix_PrefixedClass');
        $this->assertTrue(class_exists('ZendTest_UnusualPrefix_PrefixedClass', false));
    }

    public function testCanActAsFallbackAutoloader()
    {
        $loader = new Zend_Loader_StandardAutoloader();
        $loader->setFallbackAutoloader(true);
        set_include_path(dirname(__FILE__) . '/TestAsset/' . PATH_SEPARATOR . $this->includePath);
        $loader->autoload('TestPrefix_FallbackCase');
        $this->assertTrue(class_exists('TestPrefix_FallbackCase', false));
    }

    public function testReturnsFalseForUnresolveableClassNames()
    {
        $loader = new Zend_Loader_StandardAutoloader();
        $this->assertFalse($loader->autoload('Some\Fake\Classname'));
    }

    public function testReturnsFalseForInvalidClassNames()
    {
        $loader = new Zend_Loader_StandardAutoloader();
        $loader->setFallbackAutoloader(true);
        $this->assertFalse($loader->autoload('Some_Invalid_Classname_'));
    }

    public function testRegisterRegistersCallbackWithSplAutoload()
    {
        $loader = new Zend_Loader_StandardAutoloader();
        $loader->register();
        $loaders = spl_autoload_functions();
        $this->assertTrue(count($this->loaders) < count($loaders));
        $test = array_pop($loaders);
        $this->assertEquals([$loader, 'autoload'], $test);
    }

    public function testAutoloadsNamespacedClassesWithUnderscores()
    {
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            $this->markTestSkipped('Test only relevant for PHP >= 5.3.0');
        }

        $loader = new Zend_Loader_StandardAutoloader();
        $loader->registerNamespace('ZendTest\UnusualNamespace', dirname(__FILE__) . '/TestAsset');
        $loader->autoload('ZendTest\UnusualNamespace\Name_Space\Namespaced_Class');
        $this->assertTrue(class_exists('ZendTest\UnusualNamespace\Name_Space\Namespaced_Class', false));
    }

    public function testZendFrameworkPrefixIsNotLoadedByDefault()
    {
        $loader = new Zend_Loader_StandardAutoloader();
        $expected = [];
        $this->assertAttributeEquals($expected, 'prefixes', $loader);
    }

    public function testCanTellAutoloaderToRegisterZfPrefixAtInstantiation()
    {
        $loader = new Zend_Loader_StandardAutoloader(['autoregister_zf' => true]);
        $r      = new ReflectionClass($loader);
        $file   = $r->getFileName();
        $expected = ['Zend_' => dirname(dirname($file)) . DIRECTORY_SEPARATOR];
        $this->assertAttributeEquals($expected, 'prefixes', $loader);
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Loader_StandardAutoloaderTest::main') {
    Zend_Loader_StandardAutoloaderTest::main();
}
