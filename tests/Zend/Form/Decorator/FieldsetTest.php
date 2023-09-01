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
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Form_Decorator_FieldsetTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Form_Decorator_FieldsetTest::main");
}

require_once 'Zend/Form/Decorator/Fieldset.php';

require_once 'Zend/Form.php';
require_once 'Zend/Form/Element.php';
require_once 'Zend/View.php';
require_once 'Zend/Form/SubForm.php';
/**
 * Test class for Zend_Form_Decorator_Fieldset
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Form
 */
class Zend_Form_Decorator_FieldsetTest extends TestCase
{
    /**
     * @var Zend_Form_Decorator_Fieldset
     */
    protected $decorator;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_Form_Decorator_FieldsetTest");
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
        $this->decorator = new Zend_Form_Decorator_Fieldset();
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
        $view = new Zend_View();
        $view->addHelperPath(dirname(__FILE__) . '/../../../../library/Zend/View/Helper');
        return $view;
    }

    public function testPlacementInitiallyNull()
    {
        $this->assertNull($this->decorator->getPlacement());
    }

    public function testRenderReturnsOriginalContentWhenNoViewPresentInElement()
    {
        $element = new Zend_Form_Element('foo');
        $this->decorator->setElement($element);
        $content = 'test content';
        $this->assertSame($content, $this->decorator->render($content));
    }

    public function testLegendInitiallyNull()
    {
        $this->assertNull($this->decorator->getLegend());
    }

    public function testUsesLegendOptionWhenSetAndNoLegendInElement()
    {
        $this->testLegendInitiallyNull();
        $element = new Zend_Form_Element('foo');
        $this->decorator->setElement($element)
                        ->setOption('legend', 'this is a legend');
        $this->assertEquals('this is a legend', $this->decorator->getLegend());
    }

    public function testUsesElementLegendWhenPresent()
    {
        $this->testLegendInitiallyNull();
        $element = new Zend_Form();
        $element->setLegend('this is a legend');
        $this->decorator->setElement($element);
        $this->assertEquals('this is a legend', $this->decorator->getLegend());
    }

    public function testCanSetLegend()
    {
        $this->testLegendInitiallyNull();
        $this->decorator->setLegend('this is a legend');
        $this->assertEquals('this is a legend', $this->decorator->getLegend());
    }

    /**
     * @group ZF-7054
     */
    public function testCustomIdSupersedesElementId()
    {
        $form = new Zend_Form_SubForm();
        $form->setName('bar')
             ->setView($this->getView());
        $html = $this->decorator->setElement($form)
                                ->setOption('id', 'foo-id')
                                ->render('content');
        $this->assertStringContainsString('foo-id', $html);
    }

    /**
     * @group ZF-2981
     */
    public function testActionAndMethodAttributesShouldNotBePresentInFieldsetTag()
    {
        $form = new Zend_Form();
        $form->setAction('/foo/bar')
             ->setMethod('post')
             ->setView($this->getView());
        $this->decorator->setElement($form);
        $test = $this->decorator->render('content');
        $this->assertStringContainsString('<fieldset', $test, $test);
        $this->assertStringNotContainsString('action="', $test);
        $this->assertStringNotContainsString('method="', $test);
    }

    /**#@+
     * @group ZF-3731
     */
    public function testIdShouldBePrefixedWithFieldset()
    {
        $form = new Zend_Form();
        $form->setAction('/foo/bar')
             ->setMethod('post')
             ->setName('foobar')
             ->setView($this->getView());
        $this->decorator->setElement($form);
        $test = $this->decorator->render('content');
        $this->assertStringContainsString('id="fieldset-foobar"', $test);
    }

    public function testElementWithNoIdShouldNotCreateFieldsetId()
    {
        $form = new Zend_Form();
        $form->setAction('/foo/bar')
             ->setMethod('post')
             ->setView($this->getView());
        $this->decorator->setElement($form);
        $test = $this->decorator->render('content');
        $this->assertStringNotContainsString('id="', $test);
    }
    /**#@-*/

    /**
     * @group ZF-3728
     */
    public function testEnctypeAttributeShouldNotBePresentInFieldsetTag()
    {
        $form = new Zend_Form();
        $form->setAction('/foo/bar')
             ->setMethod('post')
             ->setAttrib('enctype', 'dojo/method')
             ->setView($this->getView());
        $this->decorator->setElement($form);
        $test = $this->decorator->render('content');
        $this->assertStringContainsString('<fieldset', $test, $test);
        $this->assertStringNotContainsString('enctype="', $test);
    }

    /**
     * @group ZF-3499
     */
    public function testHelperAttributeShouldNotBePresentInFieldsetTag()
    {
        $form = new Zend_Form();
        $form->setAction('/foo/bar')
             ->setMethod('post')
             ->setAttrib('helper', 'form')
             ->setView($this->getView());
        $this->decorator->setElement($form);
        $test = $this->decorator->render('content');
        $this->assertStringContainsString('<fieldset', $test, $test);
        $this->assertStringNotContainsString('helper="', $test);
    }

    /**
     * @group ZF-10679
     */
    public function testFieldsetIdOverridesFormId()
    {
        $form = new Zend_Form();
        $form->setName('bar')
             ->setAttrib('id', 'form-id')
             ->setView($this->getView());
        $html = $this->decorator->setElement($form)
                                ->setOption('id', 'fieldset-id')
                                ->render('content');
        $this->assertStringContainsString('<fieldset id="fieldset-id"', $html);
    }

    /**
     * @group ZF-8822
     */
    public function testStripAcceptCharsetAttribute()
    {
        $form = new Zend_Form();
        $form->setAttrib('accept-charset', 'ISO-8859-15');
        $form->setView($this->getView());

        $html = $this->decorator->setElement($form)->render('');

        $this->assertEquals('<fieldset></fieldset>', $html);
    }
    
    /**
     * @group ZF-10803
     */
    public function testFormIdOverridesFieldsetId()
    {
        $form = new Zend_Form();
        $form->setAttrib('id', 'form-id')
             ->setView($this->getView());
        
        $html = $this->decorator->setElement($form)->render('content');
        
        $this->assertStringContainsString('<fieldset id="fieldset-form-id"', $html);
    }
}

// Call Zend_Form_Decorator_FieldsetTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_Form_Decorator_FieldsetTest::main") {
    Zend_Form_Decorator_FieldsetTest::main();
}
