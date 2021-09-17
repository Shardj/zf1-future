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
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Application_Resource_UseragentTest::main');
}

/**
 * Zend_Loader_Autoloader
 */
require_once 'Zend/Loader/Autoloader.php';
require_once 'Zend/Application/Resource/ResourceAbstract.php';
require_once 'Zend/Application/Resource/UserAgent.php';

/**
 * @category   Zend
 * @package    Zend_Application
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Application
 */
class Zend_Application_Resource_UseragentTest extends PHPUnit_Framework_TestCase
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

        require_once dirname(__FILE__) . '/../_files/ZfAppBootstrap.php';
        $this->bootstrap = new ZfAppBootstrap($this->application);

        Zend_Controller_Action_HelperBroker::resetHelpers();
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

    public function testInitializationInitializesUserAgentObject()
    {
        $resource = new Zend_Application_Resource_Useragent([]);
        $resource->setBootstrap($this->bootstrap);
        $resource->init();
        $this->assertTrue($resource->getUserAgent() instanceof Zend_Http_UserAgent);
    }

    public function testOptionsPassedToResourceAreUsedToSetUserAgentState()
    {
        $options = [
            'storage' => ['adapter' => 'NonPersistent'],
        ];
        $resource = new Zend_Application_Resource_Useragent($options);
        $resource->setBootstrap($this->bootstrap);
        $resource->init();
        $ua      = $resource->getUserAgent();
        $storage = $ua->getStorage();
        $this->assertTrue($storage instanceof Zend_Http_UserAgent_Storage_NonPersistent);
    }

    public function testInjectsUserAgentIntoViewHelperWhenViewResourcePresent()
    {
        $this->bootstrap->registerPluginResource('view', []);
        $resource = new Zend_Application_Resource_Useragent([]);
        $resource->setBootstrap($this->bootstrap);
        $resource->init();

        $view   = $this->bootstrap->getResource('view');
        $helper = $view->getHelper('userAgent');

        $expected = $resource->getUserAgent();
        $this->assertSame($expected, $helper->getUserAgent());
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Application_Resource_UseragentTest::main') {
    Zend_Application_Resource_UseragentTest::main();
}
