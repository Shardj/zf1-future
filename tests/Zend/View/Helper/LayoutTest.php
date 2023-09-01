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
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_LayoutTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_View_Helper_LayoutTest::main");
}

require_once 'Zend/View/Helper/Layout.php';
require_once 'Zend/Layout.php';
require_once 'Zend/Controller/Front.php';
require_once 'Zend/Controller/Action/HelperBroker.php';

/**
 * Test class for Zend_View_Helper_Layout
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_View
 * @group      Zend_View_Helper
 */
class Zend_View_Helper_LayoutTest extends TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_View_Helper_LayoutTest");
        $result = (new resources_Runner())->run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function set_up()
    {
        Zend_Controller_Front::getInstance()->resetInstance();
        if (Zend_Controller_Action_HelperBroker::hasHelper('Layout')) {
            Zend_Controller_Action_HelperBroker::removeHelper('Layout');
        }
        if (Zend_Controller_Action_HelperBroker::hasHelper('viewRenderer')) {
            Zend_Controller_Action_HelperBroker::removeHelper('viewRenderer');
        }

        Zend_View_Helper_LayoutTest_Layout::resetMvcInstance();
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tear_down()
    {
    }

    public function testGetLayoutCreatesLayoutObjectWhenNoPluginRegistered()
    {
        $helper = new Zend_View_Helper_Layout();
        $layout = $helper->getLayout();
        $this->assertTrue($layout instanceof Zend_Layout);
    }

    public function testGetLayoutPullsLayoutObjectFromRegisteredPlugin()
    {
        $layout = Zend_Layout::startMvc();
        $helper = new Zend_View_Helper_Layout();
        $this->assertSame($layout, $helper->getLayout());
    }

    public function testSetLayoutReplacesExistingLayoutObject()
    {
        $layout = Zend_Layout::startMvc();
        $helper = new Zend_View_Helper_Layout();
        $this->assertSame($layout, $helper->getLayout());

        $newLayout = new Zend_Layout();
        $this->assertNotSame($layout, $newLayout);

        $helper->setLayout($newLayout);
        $this->assertSame($newLayout, $helper->getLayout());
    }

    public function testHelperMethodFetchesLayoutObject()
    {
        $layout = Zend_Layout::startMvc();
        $helper = new Zend_View_Helper_Layout();

        $received = $helper->layout();
        $this->assertSame($layout, $received);
    }
}

/**
 * Zend_Layout extension to allow resetting MVC instance
 */
class Zend_View_Helper_LayoutTest_Layout extends Zend_Layout
{
    public static function resetMvcInstance()
    {
        self::$_mvcInstance = null;
    }
}

// Call Zend_View_Helper_LayoutTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_View_Helper_LayoutTest::main") {
    Zend_View_Helper_LayoutTest::main();
}
