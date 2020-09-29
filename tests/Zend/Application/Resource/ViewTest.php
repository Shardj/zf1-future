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
    define('PHPUnit_MAIN_METHOD', 'Zend_Application_Resource_ViewTest::main');
}

/**
 * Zend_Loader_Autoloader
 */
require_once 'Zend/Loader/Autoloader.php';

require_once 'Zend/Application/Resource/View.php';

/**
 * @category   Zend
 * @package    Zend_Application
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Application
 */
class Zend_Application_Resource_ViewTest extends PHPUnit_Framework_TestCase
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

    public function testInitializationInitializesViewObject()
    {
        $resource = new Zend_Application_Resource_View([]);
        $resource->init();
        $this->assertTrue($resource->getView() instanceof Zend_View);
    }

    public function testInitializationInjectsViewIntoViewRenderer()
    {
        $resource = new Zend_Application_Resource_View([]);
        $resource->init();
        $view = $resource->getView();
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $this->assertSame($view, $viewRenderer->view);
    }

    public function testOptionsPassedToResourceAreUsedToSetViewState()
    {
        $options = [
            'scriptPath' => dirname(__FILE__),
        ];
        require_once 'Zend/Application/Resource/View.php';
        $resource = new Zend_Application_Resource_View($options);
        $resource->init();
        $view  = $resource->getView();
        $paths = $view->getScriptPaths();
        $this->assertContains(dirname(__FILE__) . '/', $paths, var_export($paths, 1));
    }

    public function testDoctypeIsSet()
    {
        $options = ['doctype' => 'XHTML1_FRAMESET'];
        $resource = new Zend_Application_Resource_View($options);
        $resource->init();
        $view  = $resource->getView();
        $this->assertEquals('XHTML1_FRAMESET', $view->doctype()->getDoctype());
    }

    /**
     * @group ZF-10343
     */
    public function testContentTypeIsSet()
    {
        $contentType = 'text/html; charset=UTF-8';
        $options = ['contentType' => $contentType];
        $resource = new Zend_Application_Resource_View($options);
        $headMetaHelper = $resource->init()->headMeta();

        $actual = null;
        $container = $headMetaHelper->getContainer();
        foreach ($container as $item) {
            if ('Content-Type' == $item->{$item->type}) {
                $actual = $item->content;
                break;
            }
        }

        $this->assertEquals($contentType, $actual);

        Zend_View_Helper_Placeholder_Registry::getRegistry()
            ->deleteContainer('Zend_View_Helper_HeadMeta');
    }

    /**
     * @group ZF-10343
     */
    public function testSetMetaCharsetForHtml5()
    {
        $charset = 'UTF-8';
        $options = [
            'doctype' => 'HTML5',
            'charset' => $charset,
        ];
        $resource = new Zend_Application_Resource_View($options);
        $view = $resource->init();
        $headMetaHelper = $view->headMeta();

        $actual = null;
        $container = $headMetaHelper->getContainer();
        foreach ($container as $item) {
            if ('charset' == $item->type) {
                $actual = $item->charset;
                break;
            }
        }

        $this->assertTrue($view->doctype()->isHtml5());
        $this->assertEquals($charset, $actual);

        $registry = Zend_View_Helper_Placeholder_Registry::getRegistry();
        $registry->deleteContainer('Zend_View_Helper_HeadMeta');
        $registry->deleteContainer('Zend_View_Helper_Doctype');
    }

    /**
     * @group ZF-10343
     */
    public function testSetMetaCharsetShouldOnlyAvailableForHtml5()
    {
    	$charset = 'UTF-8';
        $options = [
            'doctype' => 'XHTML1_STRICT',
            'charset' => $charset,
        ];
        $resource = new Zend_Application_Resource_View($options);
        $view = $resource->init();
        $headMetaHelper = $view->headMeta();

        $actual = null;
        $container = $headMetaHelper->getContainer();
        foreach ($container as $item) {
            if ('charset' == $item->type) {
                $actual = $item->charset;
                break;
            }
        }

        $this->assertFalse($view->doctype()->isHtml5());
        $this->assertNull($actual);

        $registry = Zend_View_Helper_Placeholder_Registry::getRegistry();
        $registry->deleteContainer('Zend_View_Helper_HeadMeta');
        $registry->deleteContainer('Zend_View_Helper_Doctype');
    }
    
    /**
     * @group ZF-10042
     */
    public function testAssignmentsAreSet()
    {
        $options = [
            'assign' => [
                'foo' => 'barbapapa',
                'bar' => 'barbazoo',
            ]
        ];
        $resource = new Zend_Application_Resource_View($options);
        $view = $resource->init();
 
        $this->assertEquals('barbapapa', $view->foo);
        $this->assertEquals('barbazoo', $view->bar);
    }

    /**
     * @group ZF-11579
     */
    public function testViewResourceDoesNotReinjectViewRenderer()
    {
        require_once dirname(__FILE__) . '/TestAsset/ViewRenderer.php';
        $viewRenderer = new Zend_Application_Resource_TestAsset_ViewRenderer();
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);

        $resource = new Zend_Application_Resource_View(['encoding' => 'UTF-8']);
        $view = $resource->init();

        $this->assertSame($view, $viewRenderer->view);
    }
}


if (PHPUnit_MAIN_METHOD == 'Zend_Application_Resource_ViewTest::main') {
    Zend_Application_Resource_ViewTest::main();
}
