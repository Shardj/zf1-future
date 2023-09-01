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

// Call Zend_Form_Decorator_ImageTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Form_Decorator_ImageTest::main");
}

require_once 'Zend/Form/Decorator/Image.php';

require_once 'Zend/Form.php';
require_once 'Zend/Form/Element.php';
require_once 'Zend/Form/Element/Image.php';
require_once 'Zend/View.php';

/**
 * Test class for Zend_Form_Decorator_Image
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Form
 */
class Zend_Form_Decorator_ImageTest extends TestCase
{
    /**
     * @var Zend_Form_Decorator_Image
     */
    protected $decorator;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_Form_Decorator_ImageTest");
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
        $this->decorator = new Zend_Form_Decorator_Image();
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

    public function testPlacementInitiallyAppends()
    {
        $this->assertEquals(Zend_Form_Decorator_Abstract::APPEND, $this->decorator->getPlacement());
    }

    public function testRenderReturnsOriginalContentWhenNoViewPresentInElement()
    {
        $element = new Zend_Form_Element('foo');
        $this->decorator->setElement($element);
        $content = 'test content';
        $this->assertSame($content, $this->decorator->render($content));
    }

    public function testTagInitiallyNull()
    {
        $this->assertNull($this->decorator->getTag());
    }

    public function testCanSetTag()
    {
        $this->testTagInitiallyNull();
        $this->decorator->setTag('div');
        $this->assertEquals('div', $this->decorator->getTag());
    }

    public function testCanSetTagViaOptions()
    {
        $this->testTagInitiallyNull();
        $this->decorator->setOption('tag', 'div');
        $this->assertEquals('div', $this->decorator->getTag());
    }

    public function testRendersXhtmlImageTag()
    {
        $element = new Zend_Form_Element_Image('foo');
        $element->setImage('foobar')
                ->setView($this->getView());
        $this->decorator->setElement($element);

        $image = $this->decorator->render('');
        $this->assertStringContainsString('<input', $image, $image);
        $this->assertStringContainsString('src="foobar"', $image);
        $this->assertStringContainsString('name="foo"', $image);
        $this->assertStringContainsString('type="image"', $image);
    }

    public function testCanRenderImageWithinAdditionalTag()
    {
        $element = new Zend_Form_Element_Image('foo');
        $element->setValue('foobar')
                ->setView($this->getView());
        $this->decorator->setElement($element)
                        ->setOption('tag', 'div');

        $image = $this->decorator->render('');
        $this->assertMatchesRegularExpression('#<div>.*?<input[^>]*>.*?</div>#s', $image, $image);
    }

    public function testCanPrependImageToContent()
    {
        $element = new Zend_Form_Element_Image('foo');
        $element->setValue('foobar')
                ->setView($this->getView());
        $this->decorator->setElement($element)
                        ->setOption('placement', 'prepend');

        $image = $this->decorator->render('content');
        $this->assertMatchesRegularExpression('#<input[^>]*>.*?(content)#s', $image, $image);
    }

    /**
     * @group ZF-2714
     */
    public function testImageElementAttributesPassedWithDecoratorOptionsToViewHelper()
    {
        $element = new Zend_Form_Element_Image('foo');
        $element->setValue('foobar')
                ->setAttrib('onClick', 'foo()')
                ->setAttrib('id', 'foo-element')
                ->setView($this->getView());
        $this->decorator->setElement($element)
                        ->setOption('class', 'imageclass');

        $image = $this->decorator->render('');
        $this->assertStringContainsString('class="imageclass"', $image);
        $this->assertStringContainsString('onClick="foo()"', $image);
        $this->assertStringContainsString('id="foo-element"', $image);
    }
}

// Call Zend_Form_Decorator_ImageTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_Form_Decorator_ImageTest::main") {
    Zend_Form_Decorator_ImageTest::main();
}
