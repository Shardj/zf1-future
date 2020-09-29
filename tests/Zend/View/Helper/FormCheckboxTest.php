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
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_View_Helper_FormCheckboxTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_View_Helper_FormCheckboxTest::main");
}

require_once 'Zend/View/Helper/FormCheckbox.php';
require_once 'Zend/View.php';
require_once 'Zend/Registry.php';

/**
 * Zend_View_Helper_FormCheckboxTest
 *
 * Tests formCheckbox helper
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_View
 * @group      Zend_View_Helper
 */
class Zend_View_Helper_FormCheckboxTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Zend_View_Helper_FormCheckboxTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        if (Zend_Registry::isRegistered('Zend_View_Helper_Doctype')) {
            $registry = Zend_Registry::getInstance();
            unset($registry['Zend_View_Helper_Doctype']);
        }
        $this->view   = new Zend_View();
        $this->helper = new Zend_View_Helper_FormCheckbox();
        $this->helper->setView($this->view);
    }

    public function testIdSetFromName()
    {
        $element = $this->helper->formCheckbox('foo');
        $this->assertContains('name="foo"', $element);
        $this->assertContains('id="foo"', $element);
    }

    public function testSetIdFromAttribs()
    {
        $element = $this->helper->formCheckbox('foo', null, ['id' => 'bar']);
        $this->assertContains('name="foo"', $element);
        $this->assertContains('id="bar"', $element);
    }

    /**
     * ZF-2513
     */
    public function testCanDisableCheckbox()
    {
        $html = $this->helper->formCheckbox([
            'name'   => 'foo',
            'value'  => 'bar',
            'attribs'=> ['disable' => true]
        ]);
        $this->assertRegexp('/<input[^>]*?(disabled="disabled")/', $html);
    }

    /**
     * ZF-3505
     */
    public function testCheckboxNotDisabled()
    {
        $html = $this->helper->formCheckbox([
            'name'   => 'foo',
            'value'  => 'bar',
            'attribs'=> ['disable' => false]
        ]);
        $this->assertNotContains('disabled="disabled"', $html);
    }

    public function testCanSelectCheckbox()
    {
        $html = $this->helper->formCheckbox([
            'name'   => 'foo',
            'value'  => 'bar',
            'attribs'=> ['checked' => true]
        ]);
        $this->assertRegexp('/<input[^>]*?(checked="checked")/', $html);
        $count = substr_count($html, 'checked');
        $this->assertEquals(2, $count);
    }

    /**
     * ZF-1955
     */
    public function testNameBracketsStrippedWhenCreatingId()
    {
        $html = $this->helper->formCheckbox([
            'name'  => 'foo[]',
            'value' => 'bar'
        ]);
        $this->assertRegexp('/<input[^>]*?(id="foo")/', $html);

        $html = $this->helper->formCheckbox([
            'name'  => 'foo[bar]',
            'value' => 'bar'
        ]);
        $this->assertRegexp('/<input[^>]*?(id="foo-bar")/', $html);

        $html = $this->helper->formCheckbox([
            'name'  => 'foo[bar][baz]',
            'value' => 'bar'
        ]);
        $this->assertRegexp('/<input[^>]*?(id="foo-bar-baz")/', $html);
    }

    /**
     * @group ZF-2230
     */
    public function testDoesNotRenderHiddenElementsForCheckboxArray()
    {
        $html = $this->helper->formCheckbox([
            'name'  => 'foo[]',
            'value' => 'bar'
        ]);
        $this->assertNotRegexp('/<input[^>]*?(type="hidden")/', $html);
    }

    /**
     * @group ZF-3149
     */
    public function testShouldRenderHiddenElementShowingUncheckedOptionForNonArrayNames()
    {
        $html1 = $this->helper->formCheckbox(
            'foo',
            'bar',
            ['checked' => true],
            [
                'checked'   => 'bar',
                'unChecked' => 'baz'
            ]
        );
        $html2 = $this->helper->formCheckbox(
            'foo',
            'bar',
            ['checked' => true],
            [
                'bar',
                'baz'
            ]
        );
        $html3 = $this->helper->formCheckbox(
            'foo',
            'bar',
            ['checked' => false],
            [
                'checked'   => 'bar',
                'unChecked' => 'baz'
            ]
        );
        $html4 = $this->helper->formCheckbox(
            'foo',
            'bar',
            ['checked' => false],
            [
                'bar',
                'baz'
            ]
        );
        foreach (['html1', 'html2', 'html3', 'html4'] as $html) {
            if (!preg_match_all('/(<input [^>]+>)/', $$html, $matches)) {
                $this->fail('Unexpected output generated by helper');
            }
            $this->assertEquals(2, count($matches[1]));
            foreach ($matches[1] as $element) {
                if (strstr($element, 'hidden')) {
                    $this->assertContains('baz', $element, 'Failed using ' . $html);
                } else {
                    $this->assertContains('bar', $element, 'Failed using ' . $html);
                    $this->assertContains('checked', $element, 'Failed using ' . $html);
                }
            }
        }
    }

    /**
     * @group ZF-3149
     */
    public function testCheckedAttributeNotRenderedIfItEvaluatesToFalse()
    {
        $test = $this->helper->formCheckbox('foo', 'value', ['checked' => false]);
        $this->assertNotContains('checked', $test);
    }

    public function testCanSpecifyValue()
    {
        $test = $this->helper->formCheckbox('foo', 'bar');
        $this->assertContains('value="bar"', $test);
    }

    /**
     * @group ZF-3149
     */
    public function testShouldCheckValueIfValueMatchesCheckedOption()
    {
        $test = $this->helper->formCheckbox('foo', 'bar', [], ['bar', 'baz']);
        $this->assertContains('value="bar"', $test);
        $this->assertContains('checked', $test);

        $test = $this->helper->formCheckbox('foo', 'bar', [], ['checked' => 'bar', 'unChecked' => 'baz']);
        $this->assertContains('value="bar"', $test);
        $this->assertContains('checked', $test);
    }

    /**
     * @group ZF-3149
     */
    public function testShouldOnlySetValueIfValueMatchesCheckedOption()
    {
        $test = $this->helper->formCheckbox('foo', 'baz', [], ['bar', 'baz']);
        $this->assertContains('value="bar"', $test);
    }

    /**
     * @group ZF-3149
     */
    public function testShouldNotCheckValueIfValueDoesNotMatchCheckedOption()
    {
        $test = $this->helper->formCheckbox('foo', 'baz', [], ['bar', 'baz']);
        $this->assertContains('value="bar"', $test);
        $this->assertNotContains('checked', $test);
    }

    public function testRendersAsHtmlByDefault()
    {
        $test = $this->helper->formCheckbox('foo', 'bar');
        $this->assertNotContains(' />', $test, $test);
    }

    public function testCanRendersAsXHtml()
    {
        $this->view->doctype('XHTML1_STRICT');
        $test = $this->helper->formCheckbox('foo', 'bar');
        $this->assertContains(' />', $test);
    }

    /**
     * @group ZF-6467
     */
    public function testShouldNotShowHiddenFieldIfDisableIsTrue()
    {
        $test = $this->helper->formCheckbox('foo', 'bar', ['disable' => true]);
        $this->assertNotContains('type="hidden"', $test);
    }

    public function testIntValueIsChecked()
    {
        $test = $this->helper->formCheckbox('foo', '1', [], ['checked'=>1, 'unchecked'=>0]);
        $this->assertContains('checked="checked"', $test);

        $test = $this->helper->formCheckbox('foo', '1', [], [1,0]);
        $this->assertContains('checked="checked"', $test);

        $test = $this->helper->formCheckbox('foo', 1, [], ['checked'=>1, 'unchecked'=>0]);
        $this->assertContains('checked="checked"', $test);

        $test = $this->helper->formCheckbox('foo', 1, [], [1,0]);
        $this->assertContains('checked="checked"', $test);

        $test = $this->helper->formCheckbox('foo', 0, [], ['checked'=>1, 'unchecked'=>0]);
        $this->assertNotContains('checked="checked"', $test);

        $test = $this->helper->formCheckbox('foo', 0, [], [1,0]);
        $this->assertNotContains('checked="checked"', $test);
    }

    /**
     * @group ZF-6624
     */
    public function testRenderingWithoutHiddenElement()
    {
        $html = $this->helper->formCheckbox(
            'foo',
            'bar',
            [
                 'disableHidden' => true,
            ]
        );
        $this->assertSame(
            '<input type="checkbox" name="foo" id="foo" value="bar">',
            $html
        );

        $html = $this->helper->formCheckbox(
            'foo',
            'bar');

        $this->assertSame(
            '<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" id="foo" value="bar">',
            $html
        );

        $html = $this->helper->formCheckbox(
            'foo',
            'bar',
            [
                 'disableHidden' => false,
            ]
        );

        $this->assertSame(
            '<input type="hidden" name="foo" value="0"><input type="checkbox" name="foo" id="foo" value="bar">',
            $html
        );
    }
}

// Call Zend_View_Helper_FormCheckboxTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_View_Helper_FormCheckboxTest::main") {
    Zend_View_Helper_FormCheckboxTest::main();
}

