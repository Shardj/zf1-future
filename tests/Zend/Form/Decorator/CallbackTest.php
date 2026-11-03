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

// Call Zend_Form_Decorator_CallbackTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Form_Decorator_CallbackTest::main");
}

require_once 'Zend/Form/Decorator/Callback.php';
require_once 'Zend/Form/Element.php';

/**
 * Test class for Zend_Form_Decorator_Callback
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Form
 */
class Zend_Form_Decorator_CallbackTest extends TestCase
{
    /**
     * @var Zend_Form_Decorator_Callback
     */
    protected $decorator;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_Form_Decorator_CallbackTest");
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
        $this->decorator = new Zend_Form_Decorator_Callback();
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

    public function testCanSetCallback()
    {
        $callback = 'Zend_Form_Decorator_CallbackTest_TestCallback';
        $this->decorator->setCallback($callback);
        $this->assertSame($callback, $this->decorator->getCallback());

        $callback = ['Zend_Form_Decorator_CallbackTest_TestCallbackClass', 'direct'];
        $this->decorator->setCallback($callback);
        $this->assertSame($callback, $this->decorator->getCallback());
    }

    public function testCanSetCallbackViaOptions()
    {
        $callback = 'Zend_Form_Decorator_CallbackTest_TestCallback';
        $this->decorator->setOptions(['callback' => $callback]);
        $this->assertSame($callback, $this->decorator->getCallback());
    }

    public function testInvalidCallbackRaisesException()
    {
        try {
            $this->decorator->setCallback(true);
            $this->fail('Only string or array callbacks should be allowed');
        } catch (Zend_Form_Exception $e) {
            $this->assertStringContainsString('Invalid', $e->getMessage());
        }

        try {
            $o = new stdClass();
            $this->decorator->setCallback($o);
            $this->fail('Only string or array callbacks should be allowed');
        } catch (Zend_Form_Exception $e) {
            $this->assertStringContainsString('Invalid', $e->getMessage());
        }

        try {
            $this->decorator->setCallback(['foo', 'bar', 'baz']);
            $this->fail('Only arrays of two elements should be allowed as callbacks');
        } catch (Zend_Form_Exception $e) {
            $this->assertStringContainsString('Invalid', $e->getMessage());
        }

        try {
            $this->decorator->setCallback(['foo']);
            $this->fail('Only arrays of two elements should be allowed as callbacks');
        } catch (Zend_Form_Exception $e) {
            $this->assertStringContainsString('Invalid', $e->getMessage());
        }
    }

    public function testRenderCallsFunctionCallback()
    {
        $callback = 'Zend_Form_Decorator_CallbackTest_TestCallback';
        $element = new Zend_Form_Element('foobar');
        $element->setLabel('Label Me');

        $this->decorator->setOptions(['callback' => $callback])
                        ->setElement($element);

        $content = $this->decorator->render('foo bar');
        $this->assertStringContainsString('foo bar', $content);
        $this->assertStringContainsString($element->getName(), $content);
        $this->assertStringContainsString($element->getLabel(), $content);
    }

    public function testRenderCallsMethodCallback()
    {
        $callback = ['Zend_Form_Decorator_CallbackTest_TestCallbackClass', 'direct'];
        $element = new Zend_Form_Element('foobar');
        $element->setLabel('Label Me');

        $this->decorator->setOptions(['callback' => $callback])
                        ->setElement($element);

        $content = $this->decorator->render('foo bar');
        $this->assertStringContainsString('foo bar', $content);
        $this->assertStringContainsString($element->getName(), $content);
        $this->assertStringContainsString($element->getLabel(), $content);
        $this->assertStringContainsString('Item ', $content);
    }

    public function testRenderCanPrepend()
    {
        $callback = 'Zend_Form_Decorator_CallbackTest_TestCallback';
        $element = new Zend_Form_Element('foobar');
        $element->setLabel('Label Me');

        $this->decorator->setOptions(['callback' => $callback, 'placement' => 'prepend'])
                        ->setElement($element);

        $content = $this->decorator->render('foo bar');
        $this->assertStringContainsString('foo bar', $content);
        $this->assertStringContainsString($element->getName(), $content);
        $this->assertStringContainsString($element->getLabel(), $content);
        $this->assertMatchesRegularExpression('/foo bar$/s', $content);
    }

    public function testRenderCanReplaceContent()
    {
        $callback = 'Zend_Form_Decorator_CallbackTest_TestCallback';
        $element = new Zend_Form_Element('foobar');
        $element->setLabel('Label Me');

        $this->decorator->setOptions(['callback' => $callback, 'placement' => false])
                        ->setElement($element);

        $content = $this->decorator->render('foo bar');
        $this->assertStringNotContainsString('foo bar', $content, $content);
        $this->assertStringContainsString($element->getName(), $content);
        $this->assertStringContainsString($element->getLabel(), $content);
    }
}

function Zend_Form_Decorator_CallbackTest_TestCallback($content, $element, array $options)
{
    $name = $element->getName();
    $label = '';
    if (method_exists($element, 'getLabel')) {
        $label = $element->getLabel();
    }
    $html = <<<EOH
$label: $name

EOH;
    return $html;
}

class Zend_Form_Decorator_CallbackTest_TestCallbackClass
{
    public static function direct($content, $element, array $options)
    {
        $name = $element->getName();
        $label = '';
        if (method_exists($element, 'getLabel')) {
            $label = $element->getLabel();
        }
        $html = <<<EOH
Item "$label": $name

EOH;
        return $html;
    }
}

// Call Zend_Form_Decorator_CallbackTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_Form_Decorator_CallbackTest::main") {
    Zend_Form_Decorator_CallbackTest::main();
}
