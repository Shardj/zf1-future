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

// Call Zend_View_Helper_HtmlListTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_View_Helper_HtmlListTest::main");
}

require_once 'Zend/View.php';
require_once 'Zend/View/Helper/HtmlList.php';

/**
 * @category   Zend
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_View
 * @group      Zend_View_Helper
 */
class Zend_View_Helper_HtmlListTest extends TestCase
{
    /**
     * @var Zend_View_Helper_HtmlList
     */
    public $helper;

    /**
     * @var Zend_View
     */
    protected $view;

    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_View_Helper_HtmlListTest");
        $result = (new resources_Runner())->run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function set_up()
    {
        $this->view = new Zend_View();
        $this->helper = new Zend_View_Helper_HtmlList();
        $this->helper->setView($this->view);
    }

    protected function tear_down()
    {
        unset($this->helper);
    }

    public function testMakeUnorderedList()
    {
        $items = ['one', 'two', 'three'];

        $list = $this->helper->htmlList($items);

        $this->assertStringContainsString('<ul>', $list);
        $this->assertStringContainsString('</ul>', $list);
        foreach ($items as $item) {
            $this->assertStringContainsString('<li>' . $item . '</li>', $list);
        }
    }

    public function testMakeOrderedList()
    {
        $items = ['one', 'two', 'three'];

        $list = $this->helper->htmlList($items, true);

        $this->assertStringContainsString('<ol>', $list);
        $this->assertStringContainsString('</ol>', $list);
        foreach ($items as $item) {
            $this->assertStringContainsString('<li>' . $item . '</li>', $list);
        }
    }

    public function testMakeUnorderedListWithAttribs()
    {
        $items = ['one', 'two', 'three'];
        $attribs = ['class' => 'selected', 'name' => 'list'];

        $list = $this->helper->htmlList($items, false, $attribs);

        $this->assertStringContainsString('<ul', $list);
        $this->assertStringContainsString('class="selected"', $list);
        $this->assertStringContainsString('name="list"', $list);
        $this->assertStringContainsString('</ul>', $list);
        foreach ($items as $item) {
            $this->assertStringContainsString('<li>' . $item . '</li>', $list);
        }
    }

    public function testMakeOrderedListWithAttribs()
    {
        $items = ['one', 'two', 'three'];
        $attribs = ['class' => 'selected', 'name' => 'list'];

        $list = $this->helper->htmlList($items, true, $attribs);

        $this->assertStringContainsString('<ol', $list);
        $this->assertStringContainsString('class="selected"', $list);
        $this->assertStringContainsString('name="list"', $list);
        $this->assertStringContainsString('</ol>', $list);
        foreach ($items as $item) {
            $this->assertStringContainsString('<li>' . $item . '</li>', $list);
        }
    }

    /*
     * @group ZF-5018
     */
    public function testMakeNestedUnorderedList()
    {
        $items = ['one', ['four', 'five', 'six'], 'two', 'three'];

        $list = $this->helper->htmlList($items);

        $this->assertStringContainsString('<ul>' . Zend_View_Helper_HtmlList::EOL, $list);
        $this->assertStringContainsString('</ul>' . Zend_View_Helper_HtmlList::EOL, $list);
        $this->assertStringContainsString('one<ul>' . Zend_View_Helper_HtmlList::EOL . '<li>four', $list);
        $this->assertStringContainsString('<li>six</li>' . Zend_View_Helper_HtmlList::EOL . '</ul>' .
            Zend_View_Helper_HtmlList::EOL . '</li>' . Zend_View_Helper_HtmlList::EOL . '<li>two', $list);
    }

    /*
     * @group ZF-5018
     */
    public function testMakeNestedDeepUnorderedList()
    {
        $items = ['one', ['four', ['six', 'seven', 'eight'], 'five'], 'two', 'three'];

        $list = $this->helper->htmlList($items);

        $this->assertStringContainsString('<ul>' . Zend_View_Helper_HtmlList::EOL, $list);
        $this->assertStringContainsString('</ul>' . Zend_View_Helper_HtmlList::EOL, $list);
        $this->assertStringContainsString('one<ul>' . Zend_View_Helper_HtmlList::EOL . '<li>four', $list);
        $this->assertStringContainsString('<li>four<ul>' . Zend_View_Helper_HtmlList::EOL . '<li>six', $list);
        $this->assertStringContainsString('<li>five</li>' . Zend_View_Helper_HtmlList::EOL . '</ul>' .
            Zend_View_Helper_HtmlList::EOL . '</li>' . Zend_View_Helper_HtmlList::EOL . '<li>two', $list);
    }

    public function testListWithValuesToEscapeForZF2283()
    {
        $items = ['one <small> test', 'second & third', 'And \'some\' "final" test'];

        $list = $this->helper->htmlList($items);

        $this->assertStringContainsString('<ul>', $list);
        $this->assertStringContainsString('</ul>', $list);

        $this->assertStringContainsString('<li>one &lt;small&gt; test</li>', $list);
        $this->assertStringContainsString('<li>second &amp; third</li>', $list);
        $this->assertStringContainsString('<li>And \'some\' &quot;final&quot; test</li>', $list);
    }

    public function testListEscapeSwitchedOffForZF2283()
    {
        $items = ['one <b>small</b> test'];

        $list = $this->helper->htmlList($items, false, false, false);

        $this->assertStringContainsString('<ul>', $list);
        $this->assertStringContainsString('</ul>', $list);

        $this->assertStringContainsString('<li>one <b>small</b> test</li>', $list);
    }

    /**
     * @group ZF-2527
     */
    public function testEscapeFlagHonoredForMultidimensionalLists()
    {
        $items = ['<b>one</b>', ['<b>four</b>', '<b>five</b>', '<b>six</b>'], '<b>two</b>', '<b>three</b>'];

        $list = $this->helper->htmlList($items, false, false, false);

        foreach ($items[1] as $item) {
            $this->assertStringContainsString($item, $list);
        }
    }

    /**
     * @group ZF-2527
     * Added the s modifier to match newlines after @see ZF-5018
     */
    public function testAttribsPassedIntoMultidimensionalLists()
    {
        $items = ['one', ['four', 'five', 'six'], 'two', 'three'];

        $list = $this->helper->htmlList($items, false, ['class' => 'foo']);

        foreach ($items[1] as $item) {
            $this->assertMatchesRegularExpression('#<ul[^>]*?class="foo"[^>]*>.*?(<li>' . $item . ')#s', $list);
        }
    }

    /**
     * @group ZF-2870
     */
    /*public function testEscapeFlagShouldBePassedRecursively()
    {
        $items = array(
            '<b>one</b>',
            array(
                '<b>four</b>',
                '<b>five</b>',
                '<b>six</b>',
                array(
                    '<b>two</b>',
                    '<b>three</b>',
                ),
            ),
        );

        $list = $this->helper->htmlList($items, false, false, false);

        $this->assertStringContainsString('<ul>', $list);
        $this->assertStringContainsString('</ul>', $list);

        $this->markTestSkipped('Wrong array_walk_recursive behavior.');

        array_walk_recursive($items, array($this, 'validateItems'), $list);
    }*/

    public function validateItems($value, $key, $userdata)
    {
        $this->assertStringContainsString('<li>' . $value, $userdata);
    }
}

// Call Zend_View_Helper_HtmlListTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_View_Helper_HtmlListTest::main") {
    Zend_View_Helper_HtmlListTest::main();
}
