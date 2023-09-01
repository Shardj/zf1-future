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

// Call Zend_Dojo_Form_Element_TimeTextBoxTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Dojo_Form_Element_TimeTextBoxTest::main");
}

/** Zend_Dojo_Form_Element_TimeTextBox */
require_once 'Zend/Dojo/Form/Element/TimeTextBox.php';

/** Zend_View */
require_once 'Zend/View.php';

/** Zend_Registry */
require_once 'Zend/Registry.php';

/** Zend_Dojo_View_Helper_Dojo */
require_once 'Zend/Dojo/View/Helper/Dojo.php';

/**
 * Test class for Zend_Dojo_Form_Element_TimeTextBox.
 *
 * @category   Zend
 * @package    Zend_Dojo
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Dojo
 * @group      Zend_Dojo_Form
 */
class Zend_Dojo_Form_Element_TimeTextBoxTest extends TestCase
{
    /**
     * @var \Zend_View
     */
    protected $view;

    /**
     * @var \Zend_Dojo_Form_Element_TimeTextBox
     */
    protected $element;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_Dojo_Form_Element_TimeTextBoxTest");
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
        $this->element = $this->getElement();
        $this->element->setView($this->view);
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
        $element = new Zend_Dojo_Form_Element_TimeTextBox(
            'foo',
            [
                'value' => 'some text',
                'label' => 'TimeTextBox',
                'class' => 'someclass',
                'style' => 'width: 100px;',
            ]
        );
        return $element;
    }

    public function testShouldExtendDateTextBox()
    {
        $this->assertTrue($this->element instanceof Zend_Dojo_Form_Element_DateTextBox);
    }

    public function testTimePatternAccessorsShouldProxyToConstraints()
    {
        $this->assertNull($this->element->getTimePattern());
        $this->assertFalse($this->element->hasConstraint('timePattern'));
        $this->element->setTimePattern('h:mm a');
        $this->assertEquals('h:mm a', $this->element->getTimePattern());
        $this->assertTrue($this->element->hasConstraint('timePattern'));
        $this->assertEquals('h:mm a', $this->element->dijitParams['constraints']['timePattern']);
    }

    public function testClickableIncrementAccessorsShouldProxyToConstraints()
    {
        $this->assertNull($this->element->getClickableIncrement());
        $this->assertFalse($this->element->hasConstraint('clickableIncrement'));
        $this->element->setClickableIncrement('T00:15:00');
        $this->assertEquals('T00:15:00', $this->element->getClickableIncrement());
        $this->assertTrue($this->element->hasConstraint('clickableIncrement'));
        $this->assertEquals('T00:15:00', $this->element->dijitParams['constraints']['clickableIncrement']);
    }

    public function testClickableIncrementMutatorShouldRaiseExceptionOnInvalidFormat()
    {
        $this->expectException(Zend_Form_Element_Exception::class);
        $this->element->setClickableIncrement('en-US');
    }

    public function testVisibleIncrementAccessorsShouldProxyToDijitParams()
    {
        $this->assertNull($this->element->getVisibleIncrement());
        $this->assertFalse($this->element->hasConstraint('visibleIncrement'));
        $this->element->setVisibleIncrement('T00:15:00');
        $this->assertEquals('T00:15:00', $this->element->getVisibleIncrement());
        $this->assertTrue($this->element->hasConstraint('visibleIncrement'));
        $this->assertEquals('T00:15:00', $this->element->dijitParams['constraints']['visibleIncrement']);
    }

    public function testVisibleIncrementMutatorShouldRaiseExceptionOnInvalidFormat()
    {
        $this->expectException(Zend_Form_Element_Exception::class);
        $this->element->setVisibleIncrement('en-US');
    }

    public function testVisibleRangeAccessorsShouldProxyToDijitParams()
    {
        $this->assertNull($this->element->getVisibleRange());
        $this->assertFalse($this->element->hasConstraint('visibleRange'));
        $this->element->setVisibleRange('T00:15:00');
        $this->assertEquals('T00:15:00', $this->element->getVisibleRange());
        $this->assertTrue($this->element->hasConstraint('visibleRange'));
        $this->assertEquals('T00:15:00', $this->element->dijitParams['constraints']['visibleRange']);
    }

    public function testVisibleRangeMutatorShouldRaiseExceptionOnInvalidFormat()
    {
        $this->expectException(Zend_Form_Element_Exception::class);
        $this->element->setVisibleRange('en-US');
    }

    public function testShouldRenderTimeTextBoxDijit()
    {
        $html = $this->element->render();
        $this->assertStringContainsString('dojoType="dijit.form.TimeTextBox"', $html);
    }

    /**
     * @group ZF-7813
     */
    public function testCanSetValue()
    {
        $this->element->setValue('T08:00');
        $html = $this->element->render();
        
        $this->assertSame('T08:00', $this->element->getValue());
        $this->assertStringContainsString('value="T08:00"', $html);
    }
}

// Call Zend_Dojo_Form_Element_TimeTextBoxTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_Dojo_Form_Element_TimeTextBoxTest::main") {
    Zend_Dojo_Form_Element_TimeTextBoxTest::main();
}
