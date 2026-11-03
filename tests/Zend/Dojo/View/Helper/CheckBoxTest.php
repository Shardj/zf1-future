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

// Call Zend_Dojo_View_Helper_CheckBoxTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Dojo_View_Helper_CheckBoxTest::main");
}

/** Zend_Dojo_View_Helper_CheckBox */
require_once 'Zend/Dojo/View/Helper/CheckBox.php';

/** Zend_View */
require_once 'Zend/View.php';

/** Zend_Registry */
require_once 'Zend/Registry.php';

/** Zend_Dojo_View_Helper_Dojo */
require_once 'Zend/Dojo/View/Helper/Dojo.php';

/**
 * Test class for Zend_Dojo_View_Helper_CheckBox.
 *
 * @category   Zend
 * @package    Zend_Dojo
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Dojo
 * @group      Zend_Dojo_View
 */
class Zend_Dojo_View_Helper_CheckBoxTest extends TestCase
{
    /**
     * @var \Zend_View
     */
    protected $view;

    /**
     * @var \Zend_Dojo_View_Helper_CheckBox|mixed
     */
    protected $helper;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_Dojo_View_Helper_CheckBoxTest");
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
        $this->helper = new Zend_Dojo_View_Helper_CheckBox();
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

    public function getElement()
    {
        return $this->helper->checkBox(
            'elementId',
            'foo',
            [],
            [],
            [
                'checked' => 'foo',
                'unChecked' => 'bar',
            ]
        );
    }

    public function testShouldAllowDeclarativeDijitCreation()
    {
        $html = $this->getElement();
        $this->assertMatchesRegularExpression('/<input[^>]*(dojoType="dijit.form.CheckBox")/', $html, $html);
    }

    public function testShouldAllowProgrammaticDijitCreation()
    {
        Zend_Dojo_View_Helper_Dojo::setUseProgrammatic();
        $html = $this->getElement();
        $this->assertDoesNotMatchRegularExpression('/<input[^>]*(dojoType="dijit.form.CheckBox")/', $html);
        $this->assertNotNull($this->view->dojo()->getDijit('elementId'));
    }

    public function testShouldCreateHiddenElementWithUncheckedValue()
    {
        $html = $this->getElement();
        if (!preg_match('/(<input[^>]*(type="hidden")[^>]*>)/s', $html, $m)) {
            $this->fail('Missing hidden element with unchecked value');
        }
        $this->assertStringContainsString('value="bar"', $m[1]);
    }

    public function testShouldCheckElementWhenValueMatchesCheckedValue()
    {
        $html = $this->getElement();
        if (!preg_match('/(<input[^>]*(type="checkbox")[^>]*>)/s', $html, $m)) {
            $this->fail('Missing checkbox element: ' . $html);
        }
        $this->assertStringContainsString('checked="checked"', $m[1]);
    }

    /**
     * @group ZF-4006
     */
    public function testElementShouldUseCheckedValueForCheckboxInput()
    {
        $html = $this->helper->checkBox('foo', '0', [], [], [
            'checkedValue' => '1',
            'unCheckedValue' => '0',
        ]);
        if (!preg_match('#(<input[^>]*(?:type="checkbox")[^>]*>)#s', $html, $matches)) {
            $this->fail('Did not find checkbox in html: ' . $html);
        }
        $this->assertStringContainsString('value="1"', $matches[1]);
        $this->assertStringNotContainsString('checked', $matches[1]);
    }

    /**
     * @group ZF-3878
     */
    public function testElementShouldCreateAppropriateIdWhenNameIncludesArrayNotation()
    {
        $html = $this->helper->checkBox('foo[bar]', '0');
        $this->assertStringContainsString('id="foo-bar"', $html);
    }
}

// Call Zend_Dojo_View_Helper_CheckBoxTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_Dojo_View_Helper_CheckBoxTest::main") {
    Zend_Dojo_View_Helper_CheckBoxTest::main();
}
