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
 * @package    Zend_Application
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Application_Resource_LocaleTest::main');
}

/**
 * Zend_Loader_Autoloader
 */
require_once 'Zend/Loader/Autoloader.php';

/**
 * @category   Zend
 * @package    Zend_Application
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Application
 */
class Zend_Application_Resource_LocaleTest extends PHPUnit_Framework_TestCase
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

        Zend_Loader_Autoloader::resetInstance();
        $this->autoloader = Zend_Loader_Autoloader::getInstance();

        $this->application = new Zend_Application('testing');

        $this->bootstrap = new Zend_Application_Bootstrap_Bootstrap($this->application);

        Zend_Registry::_unsetInstance();
    }

    public function tearDown()
    {
        // Restore original autoloaders
        $loaders = spl_autoload_functions();
        foreach ($loaders as $loader) {
            spl_autoload_unregister($loader);
        }

        foreach ($this->loaders as $loader) {
            spl_autoload_register($loader);
        }

        // Reset autoloader instance so it doesn't affect other tests
        Zend_Loader_Autoloader::resetInstance();
    }

    public function testInitializationInitializesLocaleObject()
    {
        $resource = new Zend_Application_Resource_Locale([]);
        $resource->init();
        $this->assertTrue($resource->getLocale() instanceof Zend_Locale);
    }

    public function testInitializationReturnsLocaleObject()
    {
        $resource = new Zend_Application_Resource_Locale([]);
        $resource->setBootstrap($this->bootstrap);
        $test = $resource->init();
        $this->assertTrue($test instanceof Zend_Locale);
    }

    public function testOptionsPassedToResourceAreUsedToSetLocaleState()
    {
        $options = [
            'default'      => 'kok_IN',
            'registry_key' => 'Foo_Bar',
            'force'        => true
        ];

        $resource = new Zend_Application_Resource_Locale($options);
        $resource->setBootstrap($this->bootstrap);
        $resource->init();
        $locale   = $resource->getLocale();
        $this->assertEquals('kok_IN', $locale->__toString());
        $this->assertTrue(Zend_Registry::isRegistered('Foo_Bar'));
        $this->assertSame(Zend_Registry::get('Foo_Bar'), $locale);
    }

    public function testOptionsPassedToResourceAreUsedToSetLocaleState1()
    {
        $options = [
            'default'      => 'kok_IN',
            'force' => true
        ];

        $resource = new Zend_Application_Resource_Locale($options);
        $resource->setBootstrap($this->bootstrap);
        $resource->init();
        $locale   = $resource->getLocale();

        // This test will fail if your configured locale is kok_IN
        $this->assertEquals('kok_IN', $locale->__toString());
        $this->assertSame(Zend_Registry::get('Zend_Locale'), $locale);
    }

    /**
     * @group ZF-7058
     */
    public function testSetCache()
    {
        $cache = Zend_Cache::factory('Core', 'Black Hole', [
            'lifetime' => 120,
            'automatic_serialization' => true
        ]);

        $config = [
            'default' => 'fr_FR',
            'cache' => $cache,
        ];
        $resource = new Zend_Application_Resource_Locale($config);
        $resource->init();
        $backend = Zend_Locale::getCache()->getBackend();
        $this->assertTrue($backend instanceof Zend_Cache_Backend_BlackHole);
        Zend_Locale::removeCache();
    }

    /**
     * @group ZF-7058
     */
    public function testSetCacheFromCacheManager()
    {
        $configCache = [
            'memory' => [
                'frontend' => [
                    'name' => 'Core',
                    'options' => [
                        'lifetime' => 120,
                        'automatic_serialization' => true
                    ]
                ],
                'backend' => [
                    'name' => 'Black Hole'
                ]
            ]
        ];
        $this->bootstrap->registerPluginResource('cachemanager', $configCache);
        $this->assertFalse(Zend_Locale::hasCache());

        $config = [
            'bootstrap' => $this->bootstrap,
            'cache' => 'memory',
        ];
        $resource = new Zend_Application_Resource_Locale($config);
        $resource->init();

        $this->assertTrue(Zend_Locale::hasCache());
        Zend_Locale::removeCache();
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Application_Resource_LocaleTest::main') {
    Zend_Application_Resource_LocaleTest::main();
}
