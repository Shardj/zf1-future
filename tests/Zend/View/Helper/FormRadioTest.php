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

// Call Zend_View_Helper_FormRadioTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_View_Helper_FormRadioTest::main");
}

require_once 'Zend/View/Helper/FormRadio.php';
require_once 'Zend/View.php';

/**
 * Zend_View_Helper_FormRadioTest
 *
 * Tests formRadio helper
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_View
 * @group      Zend_View_Helper
 */
class Zend_View_Helper_FormRadioTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main()
    {

        $suite  = new PHPUnit_Framework_TestSuite("Zend_View_Helper_FormRadioTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        $this->view   = new Zend_View();
        $this->view->doctype('HTML4_LOOSE'); // Set default doctype
        $this->helper = new Zend_View_Helper_FormRadio();
        $this->helper->setView($this->view);
    }

    public function testRendersRadioLabelsWhenRenderingMultipleOptions()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
        ]);
        foreach ($options as $key => $value) {
            $this->assertRegexp('#<label.*?>.*?' . $value . '.*?</label>#', $html, $html);
            $this->assertRegexp('#<label.*?>.*?<input.*?</label>#', $html, $html);
        }
    }

    public function testCanSpecifyRadioLabelPlacement()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
            'attribs' => ['labelPlacement' => 'append']
        ]);
        foreach ($options as $key => $value) {
            $this->assertRegexp('#<label.*?>.*?<input .*?' . $value . '</label>#', $html, $html);
        }

        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
            'attribs' => ['labelPlacement' => 'prepend']
        ]);
        foreach ($options as $key => $value) {
            $this->assertRegexp('#<label.*?>' . $value . '<input .*?</label>#', $html, $html);
        }
    }

    /**
     * @group ZF-3206
     */
    public function testSpecifyingLabelPlacementShouldNotOverwriteValue()
    {
        $options = [
            'bar' => 'Bar',
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
            'attribs' => [
                'labelPlacement' => 'append',
            ]
        ]);
        $this->assertRegexp('#<input[^>]*(checked="checked")#', $html, $html);
    }

    public function testCanSpecifyRadioLabelAttribs()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
            'attribs' => ['labelClass' => 'testclass', 'label_id' => 'testid']
        ]);

        foreach ($options as $key => $value) {
            $this->assertRegexp('#<label[^>]*?class="testclass"[^>]*>.*?' . $value . '#', $html, $html);
            $this->assertRegexp('#<label[^>]*?id="testid"[^>]*>.*?' . $value . '#', $html, $html);
        }
    }

    public function testCanSpecifyRadioSeparator()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
            'listsep' => '--FunkySep--',
        ]);

        $this->assertContains('--FunkySep--', $html);
        $count = substr_count($html, '--FunkySep--');
        $this->assertEquals(2, $count);
    }

    /**
     * ZF-2513
     */
    public function testCanDisableAllRadios()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
            'attribs' => ['disable' => true]
        ]);

        $this->assertRegexp('/<input[^>]*?(disabled="disabled")/', $html, $html);
        $count = substr_count($html, 'disabled="disabled"');
        $this->assertEquals(3, $count);
    }

    /**
     * ZF-2513
     */
    public function testCanDisableIndividualRadios()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
            'attribs' => ['disable' => ['bar']]
        ]);

        $this->assertRegexp('/<input[^>]*?(value="bar")[^>]*(disabled="disabled")/', $html, $html);
        $count = substr_count($html, 'disabled="disabled"');
        $this->assertEquals(1, $count);
    }

    /**
     * ZF-2513
     */
    public function testCanDisableMultipleRadios()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
            'attribs' => ['disable' => ['foo', 'baz']]
        ]);

        foreach (['foo', 'baz'] as $test) {
            $this->assertRegexp('/<input[^>]*?(value="' . $test . '")[^>]*?(disabled="disabled")/', $html, $html);
        }
        $this->assertNotRegexp('/<input[^>]*?(value="bar")[^>]*?(disabled="disabled")/', $html, $html);
        $count = substr_count($html, 'disabled="disabled"');
        $this->assertEquals(2, $count);
    }

    public function testLabelsAreEscapedByDefault()
    {
        $options = [
            'bar' => '<b>Bar</b>',
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'options' => $options,
        ]);

        $this->assertNotContains($options['bar'], $html);
        $this->assertContains('&lt;b&gt;Bar&lt;/b&gt;', $html);
    }

    public function testXhtmlLabelsAreAllowed()
    {
        $options = [
            'bar' => '<b>Bar</b>',
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'options' => $options,
            'attribs' => ['escape' => false]
        ]);

        $this->assertContains($options['bar'], $html);
    }

    /**
     * ZF-1666
     */
    public function testDoesNotRenderHiddenElements()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'options' => $options,
        ]);

        $this->assertNotRegexp('/<input[^>]*?(type="hidden")/', $html);
    }

    public function testSpecifyingAValueThatMatchesAnOptionChecksIt()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
        ]);

        if (!preg_match('/(<input[^>]*?(value="bar")[^>]*>)/', $html, $matches)) {
            $this->fail('Radio for a given option was not found?');
        }
        $this->assertContains('checked="checked"', $matches[1], var_export($matches, 1));
    }

    public function testOptionsWithMatchesInAnArrayOfValuesAreChecked()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => ['foo', 'baz'],
            'options' => $options,
        ]);

        foreach (['foo', 'baz'] as $value) {
            if (!preg_match('/(<input[^>]*?(value="' . $value . '")[^>]*>)/', $html, $matches)) {
                $this->fail('Radio for a given option was not found?');
            }
            $this->assertContains('checked="checked"', $matches[1], var_export($matches, 1));
        }
    }

    public function testEachRadioShouldHaveIdCreatedByAppendingFilteredValue()
    {
        $options = [
            'foo bar' => 'Foo',
            'bar baz' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo[]',
            'value'   => 'bar',
            'options' => $options,
        ]);

        require_once 'Zend/Filter/Alnum.php';
        $filter = new Zend_Filter_Alnum();
        foreach ($options as $key => $value) {
            $id = 'foo-' . $filter->filter($key);
            $this->assertRegexp('/<input([^>]*)(id="' . $id . '")/', $html);
        }
    }

    public function testEachRadioShouldUseAttributeIdWhenSpecified()
    {
        $options = [
            'foo bar' => 'Foo',
            'bar baz' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo[bar]',
            'value'   => 'bar',
            'attribs' => ['id' => 'foo-bar'],
            'options' => $options,
        ]);

        require_once 'Zend/Filter/Alnum.php';
        $filter = new Zend_Filter_Alnum();
        foreach ($options as $key => $value) {
            $id = 'foo-bar-' . $filter->filter($key);
            $this->assertRegexp('/<input([^>]*)(id="' . $id . '")/', $html);
        }
    }

    /**
     * @group ZF-5681
     */
    public function testRadioLabelDoesNotContainHardCodedStyle()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'value'   => 'bar',
            'options' => $options,
        ]);
        $this->assertNotContains('style="white-space: nowrap;"', $html);
    }

    /**
     * @group ZF-8709
     */
    public function testRadioLabelContainsNotForAttributeTag()
    {
        $actual = $this->helper->formRadio(
            [
                 'name'    => 'foo',
                 'options' => [
                     'bar' => 'Bar',
                     'baz' => 'Baz'
                 ],
            ]
        );

        $expected = '<label><input type="radio" name="foo" id="foo-bar" value="bar">Bar</label><br>'
                  . "\n"
                  . '<label><input type="radio" name="foo" id="foo-baz" value="baz">Baz</label>';

        $this->assertSame($expected, $actual);
    }
    
    /**
     * @group ZF-4191
     */
    public function testDashesShouldNotBeFilteredFromId()
    {
        $name = "Foo";
        $options = [
            -1 => 'Test -1',
             0 => 'Test 0',
             1 => 'Test 1'
        ];
        
        $formRadio = new Zend_View_Helper_FormRadio();
        $formRadio->setView(new Zend_View());
        $html = $formRadio->formRadio($name, -1, null, $options);
        foreach ( $options as $key=>$value ) {
            $fid = "{$name}-{$key}";
            $this->assertRegExp('/<input([^>]*)(id="'.$fid.'")/', $html);
        }
        
        // Assert that radio for value -1 is the selected one
        $this->assertRegExp('/<input([^>]*)(id="'.$name.'--1")([^>]*)(checked="checked")/', $html);
    }
    
    /**
     * @group ZF-11477
     */
    public function testRendersAsHtmlByDefault()
    {
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'options' => $options,
        ]);

        $this->assertContains('value="foo">', $html);
        $this->assertContains('value="bar">', $html);
        $this->assertContains('value="baz">', $html);
    }

    /**
     * @group ZF-11477
     */
    public function testCanRendersAsXHtml()
    {
        $this->view->doctype('XHTML1_STRICT');
        $options = [
            'foo' => 'Foo',
            'bar' => 'Bar',
            'baz' => 'Baz'
        ];
        $html = $this->helper->formRadio([
            'name'    => 'foo',
            'options' => $options,
        ]);
        $this->assertContains('value="foo" />', $html);
        $this->assertContains('value="bar" />', $html);
        $this->assertContains('value="baz" />', $html);
    }

     /**
      * @group ZF-11620
      */
     public function testSeparatorCanRendersAsXhtmlByDefault()
     {
         $this->view->doctype('XHTML1_STRICT');
         $options = [
             'foo' => 'Foo',
             'bar' => 'Bar',
             'baz' => 'Baz'
         ];
         $html = $this->helper->formRadio([
             'name'    => 'foo',
             'value'   => 'bar',
             'options' => $options,
         ]);
 
         $this->assertContains('<br />', $html);
         $count = substr_count($html, '<br />');
         $this->assertEquals(2, $count);
     }
 
     /**
      * @group ZF-11620
      */
     public function testeparatorCanRendersAsHtml()
     {
         $this->view->doctype('HTML4_STRICT');
         $options = [
             'foo' => 'Foo',
             'bar' => 'Bar',
             'baz' => 'Baz'
         ];
         $html = $this->helper->formRadio([
             'name'    => 'foo',
             'value'   => 'bar',
             'options' => $options,
         ]);
 
         $this->assertContains('<br>', $html);
         $count = substr_count($html, '<br>');
         $this->assertEquals(2, $count);
     }

}

// Call Zend_View_Helper_FormRadioTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_View_Helper_FormRadioTest::main") {
    Zend_View_Helper_FormRadioTest::main();
}

