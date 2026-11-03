<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;
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
 * @package    Zend_Application
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Application_Module_AutoloaderTest::main');
}

/**
 * @see Zend_Loader_Autoloader
 */
require_once 'Zend/Loader/Autoloader.php';

/**
 * @see Zend_Application_Module_Autoloader
 */
require_once 'Zend/Loader/Autoloader/Resource.php';

/**
 * @see Zend_Loader_Autoloader_Interface
 */
require_once 'Zend/Loader/Autoloader/Interface.php';

/** Zend_Config */
require_once 'Zend/Config.php';

/**
 * @category   Zend
 * @package    Zend_Application
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Application
 */
class Zend_Application_Module_AutoloaderTest extends TestCase
{
    protected $error;

    /**
     * @var array
     */
    protected $loaders;

    /**
     * @var Zend_Application_Module_Autoloader
     */
    protected $loader;

    /**
     * @var array
     */
    protected $includePath;

    /**
     * @var Zend_Loader_Autoloader
     */
    protected $autoloader;

    /**
     * @var Zend_Application
     */
    protected $application;

    public static function main()
    {
        $suite = new TestSuite(__CLASS__);
        $result = (new resources_Runner())->run($suite);
    }

    protected function set_up()
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

        Zend_Loader_Autoloader::resetInstance();
        $this->autoloader = Zend_Loader_Autoloader::getInstance();

        // initialize 'error' member for tests that utilize error handling
        $this->error = null;

        $this->loader = new Zend_Application_Module_Autoloader([
            'namespace' => 'FooBar',
            'basePath' => realpath(dirname(__FILE__) . '/_files'),
        ]);
    }

    protected function tear_down()
    {
        // Restore original autoloaders
        $loaders = spl_autoload_functions();
        foreach ($loaders as $loader) {
            spl_autoload_unregister($loader);
        }

        foreach ($this->loaders as $loader) {
            spl_autoload_register($loader);
        }

        // Retore original include_path
        set_include_path($this->includePath);

        // Reset autoloader instance so it doesn't affect other tests
        Zend_Loader_Autoloader::resetInstance();
    }

    public function testDbTableResourceTypeShouldBeLoadedByDefault()
    {
        $this->assertTrue($this->loader->hasResourceType('dbtable'));
    }

    public function testDbTableResourceTypeShouldPointToModelsDbTableSubdirectory()
    {
        $resources = $this->loader->getResourceTypes();
        $this->assertStringContainsString('models/DbTable', $resources['dbtable']['path']);
    }

    public function testFormResourceTypeShouldBeLoadedByDefault()
    {
        $this->assertTrue($this->loader->hasResourceType('form'));
    }

    public function testFormResourceTypeShouldPointToFormsSubdirectory()
    {
        $resources = $this->loader->getResourceTypes();
        $this->assertStringContainsString('forms', $resources['form']['path']);
    }

    public function testModelResourceTypeShouldBeLoadedByDefault()
    {
        $this->assertTrue($this->loader->hasResourceType('model'));
    }

    public function testModelResourceTypeShouldPointToModelsSubdirectory()
    {
        $resources = $this->loader->getResourceTypes();
        $this->assertStringContainsString('models', $resources['model']['path']);
    }

    public function testPluginResourceTypeShouldBeLoadedByDefault()
    {
        $this->assertTrue($this->loader->hasResourceType('plugin'));
    }

    public function testPluginResourceTypeShouldPointToPluginsSubdirectory()
    {
        $resources = $this->loader->getResourceTypes();
        $this->assertStringContainsString('plugins', $resources['plugin']['path']);
    }

    public function testServiceResourceTypeShouldBeLoadedByDefault()
    {
        $this->assertTrue($this->loader->hasResourceType('service'));
    }

    public function testServiceResourceTypeShouldPointToServicesSubdirectory()
    {
        $resources = $this->loader->getResourceTypes();
        $this->assertStringContainsString('services', $resources['service']['path']);
    }

    public function testViewHelperResourceTypeShouldBeLoadedByDefault()
    {
        $this->assertTrue($this->loader->hasResourceType('viewhelper'));
    }

    public function testViewHelperResourceTypeShouldPointToViewHelperSubdirectory()
    {
        $resources = $this->loader->getResourceTypes();
        $this->assertStringContainsString('views/helpers', $resources['viewhelper']['path']);
    }

    public function testViewFilterResourceTypeShouldBeLoadedByDefault()
    {
        $this->assertTrue($this->loader->hasResourceType('viewfilter'));
    }

    public function testViewFilterResourceTypeShouldPointToViewFilterSubdirectory()
    {
        $resources = $this->loader->getResourceTypes();
        $this->assertStringContainsString('views/filters', $resources['viewfilter']['path']);
    }

    public function testDefaultResourceShouldBeModel()
    {
        $this->assertEquals('model', $this->loader->getDefaultResourceType());
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Application_Module_AutoloaderTest::main') {
    Zend_Application_Module_AutoloaderTest::main();
}
