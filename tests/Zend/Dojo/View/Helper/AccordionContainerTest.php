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
 * @package    Zend_Dojo
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Dojo_View_Helper_AccordionContainerTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Dojo_View_Helper_AccordionContainerTest::main");
}

/** Zend_Dojo_View_Helper_AccordionContainer */
require_once 'Zend/Dojo/View/Helper/AccordionContainer.php';

/** Zend_View */
require_once 'Zend/View.php';

/** Zend_Registry */
require_once 'Zend/Registry.php';

/** Zend_Dojo_View_Helper_Dojo */
require_once 'Zend/Dojo/View/Helper/Dojo.php';

/**
 * Test class for Zend_Dojo_View_Helper_AccordionContainer.
 *
 * @category   Zend
 * @package    Zend_Dojo
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Dojo
 * @group      Zend_Dojo_View
 */
class Zend_Dojo_View_Helper_AccordionContainerTest extends TestCase
{
    /**
     * @var \Zend_View
     */
    protected $view;

    /**
     * @var \Zend_Dojo_View_Helper_AccordionContainer|mixed
     */
    protected $helper;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_Dojo_View_Helper_AccordionContainerTest");
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
        Zend_Registry::_unsetInstance();
        Zend_Dojo_View_Helper_Dojo::setUseDeclarative();

        $this->view = $this->getView();
        $this->helper = new Zend_Dojo_View_Helper_AccordionContainer();
        $this->helper->setView($this->view);
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

    public function getView()
    {
        require_once 'Zend/View.php';
        $view = new Zend_View();
        $view->addHelperPath('Zend/Dojo/View/Helper/', 'Zend_Dojo_View_Helper');
        return $view;
    }

    public function getContainer()
    {
        $html = '';
        for ($i = 1; $i < 6; ++$i) {
            $id = 'pane' . $i;
            $title = 'Pane ' . $i;
            $content = 'This is the content of pane ' . $i;
            $html .= $this->view->accordionPane($id, $content, ['title' => $title]);
        }
        return $this->helper->accordionContainer('container', $html, [], ['style' => 'height: 200px; width: 100px;']);
    }

    public function testShouldAllowDeclarativeDijitCreation()
    {
        $html = $this->getContainer();
        $this->assertMatchesRegularExpression('/<div[^>]*(dojoType="dijit.layout.AccordionContainer")/', $html, $html);
    }

    public function testShouldAllowProgrammaticDijitCreation()
    {
        Zend_Dojo_View_Helper_Dojo::setUseProgrammatic();
        $html = $this->getContainer();
        $this->assertDoesNotMatchRegularExpression('/<div[^>]*(dojoType="dijit.layout.AccordionContainer")/', $html);
        $this->assertNotNull($this->view->dojo()->getDijit('container'));
    }

    public function testShouldAllowCapturingNestedContent()
    {
        $this->helper->captureStart('foo', [], ['style' => 'height: 200px; width: 100px;']);
        $this->view->accordionPane()->captureStart('bar', ['title' => 'Captured Pane']);
        echo "Captured content started\n";
        $this->view->accordionPane()->captureStart('baz', ['title' => 'Nested Pane']);
        echo 'Nested Content';
        echo $this->view->accordionPane()->captureEnd('baz');
        echo "Captured content ended\n";
        echo $this->view->accordionPane()->captureEnd('bar');
        $html = $this->helper->captureEnd('foo');
        $this->assertMatchesRegularExpression('/<div[^>]*(id="bar")/', $html);
        $this->assertMatchesRegularExpression('/<div[^>]*(id="baz")/', $html);
        $this->assertMatchesRegularExpression('/<div[^>]*(id="foo")/', $html);
        $this->assertEquals(2, substr_count($html, 'dijit.layout.AccordionPane'));
        $this->assertEquals(1, substr_count($html, 'dijit.layout.AccordionContainer'));
        $this->assertStringContainsString('started', $html);
        $this->assertStringContainsString('ended', $html);
        $this->assertStringContainsString('Nested Content', $html);
    }

    public function testCapturingShouldRaiseErrorWhenDuplicateIdDiscovered()
    {
        $this->expectException(Zend_Dojo_View_Exception::class);
        $this->helper->captureStart('foo', [], ['style' => 'height: 200px; width: 100px;']);
        $this->view->accordionPane()->captureStart('bar', ['title' => 'Captured Pane']);
        $this->view->accordionPane()->captureStart('bar', ['title' => 'Captured Pane']);
        echo 'Captured Content';
        echo $this->view->accordionPane()->captureEnd('bar');
        echo $this->view->accordionPane()->captureEnd('bar');
        $html = $this->helper->captureEnd('foo');
    }

    public function testCapturingShouldRaiseErrorWhenNonexistentIdPassedToEnd()
    {
        $this->expectException(Zend_Dojo_View_Exception::class);
        $this->helper->captureStart('foo', [], ['style' => 'height: 200px; width: 100px;']);
        $html = $this->helper->captureEnd('bar');
    }
}

// Call Zend_Dojo_View_Helper_AccordionContainerTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_Dojo_View_Helper_AccordionContainerTest::main") {
    Zend_Dojo_View_Helper_AccordionContainerTest::main();
}
