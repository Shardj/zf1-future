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

// Call Zend_View_Helper_FormSelectTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_View_Helper_FormSelectTest::main");
}

require_once 'Zend/View/Helper/FormSelect.php';
require_once 'Zend/View.php';

/**
 * Test class for Zend_View_Helper_FormSelect.
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_View
 * @group      Zend_View_Helper
 */
class Zend_View_Helper_FormSelectTest extends TestCase
{
    /**
     * @var Zend_View
     */
    protected $view;

    /**
     * @var Zend_View_Helper_FormSelect
     */
    protected $helper;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_View_Helper_FormSelectTest");
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
        $this->view = new Zend_View();
        $this->helper = new Zend_View_Helper_FormSelect();
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
        unset($this->helper, $this->view);
    }

    /**
     * @group ZF-10661
     */
    public function testRenderingWithOptions()
    {
        $html = $this->helper->formSelect(
            'foo',
            null,
            null,
            [
                 'bar' => 'Bar',
                 'baz' => 'Baz',
            ]
        );

        $expected = '<select name="foo" id="foo">'
                  . "\n"
                  . '    <option value="bar">Bar</option>'
                  . "\n"
                  . '    <option value="baz">Baz</option>'
                  . "\n"
                  . '</select>';

        $this->assertSame($expected, $html);
    }

    public function testFormSelectWithNameOnlyCreatesEmptySelect()
    {
        $html = $this->helper->formSelect('foo');
        $this->assertMatchesRegularExpression('#<select[^>]+name="foo"#', $html);
        $this->assertStringContainsString('</select>', $html);
        $this->assertStringNotContainsString('<option', $html);
    }

    public function testFormSelectWithOptionsCreatesPopulatedSelect()
    {
        $html = $this->helper->formSelect('foo', null, null, ['foo' => 'Foobar', 'baz' => 'Bazbat']);
        $this->assertMatchesRegularExpression('#<select[^>]+name="foo"#', $html);
        $this->assertStringContainsString('</select>', $html);
        $this->assertMatchesRegularExpression('#<option[^>]+value="foo".*?>Foobar</option>#', $html);
        $this->assertMatchesRegularExpression('#<option[^>]+value="baz".*?>Bazbat</option>#', $html);
        $this->assertEquals(2, substr_count($html, '<option'));
    }

    public function testFormSelectWithOptionsAndValueSelectsAppropriateValue()
    {
        $html = $this->helper->formSelect('foo', 'baz', null, ['foo' => 'Foobar', 'baz' => 'Bazbat']);
        $this->assertMatchesRegularExpression('#<option[^>]+value="baz"[^>]*selected.*?>Bazbat</option>#', $html);
    }

    public function testFormSelectWithMultipleAttributeCreatesMultiSelect()
    {
        $html = $this->helper->formSelect('foo', null, ['multiple' => true], ['foo' => 'Foobar', 'baz' => 'Bazbat']);
        $this->assertMatchesRegularExpression('#<select[^>]+name="foo\[\]"#', $html);
        $this->assertMatchesRegularExpression('#<select[^>]+multiple="multiple"#', $html);
    }

    public function testFormSelectWithMultipleAttributeAndValuesCreatesMultiSelectWithSelectedValues()
    {
        $html = $this->helper->formSelect('foo', ['foo', 'baz'], ['multiple' => true], ['foo' => 'Foobar', 'baz' => 'Bazbat']);
        $this->assertMatchesRegularExpression('#<option[^>]+value="foo"[^>]*selected.*?>Foobar</option>#', $html);
        $this->assertMatchesRegularExpression('#<option[^>]+value="baz"[^>]*selected.*?>Bazbat</option>#', $html);
    }

    /**
     * ZF-1930
     * @return void
     */
    public function testFormSelectWithZeroValueSelectsValue()
    {
        $html = $this->helper->formSelect('foo', 0, null, ['foo' => 'Foobar', 0 => 'Bazbat']);
        $this->assertMatchesRegularExpression('#<option[^>]+value="0"[^>]*selected.*?>Bazbat</option>#', $html);
    }

    /**
     * ZF-2513
     */
    public function testCanDisableEntireSelect()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz',
            'options' => [
                'foo' => 'Foo',
                'bar' => 'Bar'
            ],
            'attribs' => [
               'disable' => true
            ],
        ]);
        $this->assertMatchesRegularExpression('/<select[^>]*?disabled/', $html, $html);
        $this->assertDoesNotMatchRegularExpression('/<option[^>]*?disabled="disabled"/', $html, $html);
    }

    /**
     * ZF-2513
     */
    public function testCanDisableIndividualSelectOptionsOnly()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz',
            'options' => [
                'foo' => 'Foo',
                'bar' => 'Bar'
            ],
            'attribs' => [
               'disable' => ['bar']
            ],
        ]);
        $this->assertDoesNotMatchRegularExpression('/<select[^>]*?disabled/', $html, $html);
        $this->assertMatchesRegularExpression('/<option value="bar"[^>]*?disabled="disabled"/', $html, $html);

        $html = $this->helper->formSelect(
            'baz',
            'foo',
            [
               'disable' => ['bar']
            ],
            [
                'foo' => 'Foo',
                'bar' => 'Bar'
            ]
        );
        $this->assertDoesNotMatchRegularExpression('/<select[^>]*?disabled/', $html, $html);
        $this->assertMatchesRegularExpression('/<option value="bar"[^>]*?disabled="disabled"/', $html, $html);
    }

    /**
     * ZF-2513
     */
    public function testCanDisableMultipleSelectOptions()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz',
            'options' => [
                'foo' => 'Foo',
                'bar' => 'Bar',
                'baz' => 'Baz,'
            ],
            'attribs' => [
               'disable' => ['foo', 'baz']
            ],
        ]);
        $this->assertDoesNotMatchRegularExpression('/<select[^>]*?disabled/', $html, $html);
        $this->assertMatchesRegularExpression('/<option value="foo"[^>]*?disabled="disabled"/', $html, $html);
        $this->assertMatchesRegularExpression('/<option value="baz"[^>]*?disabled="disabled"/', $html, $html);
    }

    /**
     * ZF-2513
     */
    public function testCanDisableOptGroups()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz',
            'options' => [
                'foo' => 'Foo',
                'bar' => [
                    '1' => 'one',
                    '2' => 'two'
                ],
                'baz' => 'Baz,'
            ],
            'attribs' => [
               'disable' => ['bar']
            ],
        ]);
        $this->assertDoesNotMatchRegularExpression('/<select[^>]*?disabled/', $html, $html);
        $this->assertMatchesRegularExpression('/<optgroup[^>]*?disabled="disabled"[^>]*?"bar"[^>]*?/', $html, $html);
        $this->assertDoesNotMatchRegularExpression('/<option value="1"[^>]*?disabled="disabled"/', $html, $html);
        $this->assertDoesNotMatchRegularExpression('/<option value="2"[^>]*?disabled="disabled"/', $html, $html);
    }

    /**
     * ZF-2513
     */
    public function testCanDisableOptGroupOptions()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz',
            'options' => [
                'foo' => 'Foo',
                'bar' => [
                    '1' => 'one',
                    '2' => 'two'
                ],
                'baz' => 'Baz,'
            ],
            'attribs' => [
               'disable' => ['2']
            ],
        ]);
        $this->assertDoesNotMatchRegularExpression('/<select[^>]*?disabled/', $html, $html);
        $this->assertDoesNotMatchRegularExpression('/<optgroup[^>]*?disabled="disabled"[^>]*?"bar"[^>]*?/', $html, $html);
        $this->assertDoesNotMatchRegularExpression('/<option value="1"[^>]*?disabled="disabled"/', $html, $html);
        $this->assertMatchesRegularExpression('/<option value="2"[^>]*?disabled="disabled"/', $html, $html);
    }

    public function testCanSpecifySelectMultipleThroughAttribute()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz',
            'options' => [
                'foo' => 'Foo',
                'bar' => 'Bar',
                'baz' => 'Baz,'
            ],
            'attribs' => [
               'multiple' => true
            ],
        ]);
        $this->assertMatchesRegularExpression('/<select[^>]*?(multiple="multiple")/', $html, $html);
    }

    public function testSpecifyingSelectMultipleThroughAttributeAppendsNameWithBrackets()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz',
            'options' => [
                'foo' => 'Foo',
                'bar' => 'Bar',
                'baz' => 'Baz,'
            ],
            'attribs' => [
               'multiple' => true
            ],
        ]);
        $this->assertMatchesRegularExpression('/<select[^>]*?(name="baz\[\]")/', $html, $html);
    }

    public function testCanSpecifySelectMultipleThroughName()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz[]',
            'options' => [
                'foo' => 'Foo',
                'bar' => 'Bar',
                'baz' => 'Baz,'
            ],
        ]);
        $this->assertMatchesRegularExpression('/<select[^>]*?(multiple="multiple")/', $html, $html);
    }

    /**
     * ZF-1639
     */
    public function testNameCanContainBracketsButNotBeMultiple()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz[]',
            'options' => [
                'foo' => 'Foo',
                'bar' => 'Bar',
                'baz' => 'Baz,'
            ],
            'attribs' => [
               'multiple' => false
            ],
        ]);
        $this->assertMatchesRegularExpression('/<select[^>]*?(name="baz\[\]")/', $html, $html);
        $this->assertDoesNotMatchRegularExpression('/<select[^>]*?(multiple="multiple")/', $html, $html);
    }

    /**
     * @group ZF-8252
     */
    public function testOptGroupHasAnId()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz',
            'options' => [
                'foo' => 'Foo',
                'bar' => [
                    '1' => 'one',
                    '2' => 'two'
                ],
                'baz' => 'Baz,'
            ]
        ]);
        $this->assertMatchesRegularExpression('/<optgroup[^>]*?id="baz-optgroup-bar"[^>]*?"bar"[^>]*?/', $html, $html);
    }
 
    public function testCanApplyOptionClasses()
    {
        $html = $this->helper->formSelect([
            'name' => 'baz[]',
            'options' => [
                'foo' => 'Foo',
                'bar' => 'Bar',
                'baz' => 'Baz,'
            ],
            'attribs' => [
               'multiple' => false,
               'optionClasses' => ['foo' => 'fooClass',
                                        'bar' => 'barClass',
                                        'baz' => 'bazClass']
            ],
        ]);
        $this->assertMatchesRegularExpression('/.*<option[^>]*?(value="foo")?(class="fooClass").*/', $html, $html);
        $this->assertMatchesRegularExpression('/.*<option[^>]*?(value="bar")?(class="barClass").*/', $html, $html);
    }
}

// Call Zend_View_Helper_FormSelectTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_View_Helper_FormSelectTest::main") {
    Zend_View_Helper_FormSelectTest::main();
}
