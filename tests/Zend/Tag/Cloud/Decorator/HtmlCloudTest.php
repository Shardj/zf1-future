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
 * @package    Zend_Tag
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Tag_Cloud_Decorator_HtmlCloudTest::main');
}

require_once 'Zend/Config.php';
require_once 'Zend/Tag/Cloud/Decorator/HtmlCloud.php';

/**
 * @category   Zend
 * @package    Zend_Tag
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Tag
 * @group      Zend_Tag_Cloud
 */
class Zend_Tag_Cloud_Decorator_HtmlCloudTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testDefaultOutput()
    {
        $decorator = new Zend_Tag_Cloud_Decorator_HtmlCloud();

        $this->assertEquals('<ul class="Zend_Tag_Cloud">foo bar</ul>', $decorator->render(['foo', 'bar']));
    }

    public function testNestedTags()
    {
        $decorator = new Zend_Tag_Cloud_Decorator_HtmlCloud();
        $decorator->setHtmlTags(['span', 'div' => ['id' => 'tag-cloud']]);

        $this->assertEquals('<div id="tag-cloud"><span>foo bar</span></div>', $decorator->render(['foo', 'bar']));
    }

    public function testSeparator()
    {
        $decorator = new Zend_Tag_Cloud_Decorator_HtmlCloud();
        $decorator->setSeparator('-');

        $this->assertEquals('<ul class="Zend_Tag_Cloud">foo-bar</ul>', $decorator->render(['foo', 'bar']));
    }

    public function testConstructorWithArray()
    {
        $decorator = new Zend_Tag_Cloud_Decorator_HtmlCloud(['htmlTags' => ['div'], 'separator' => ' ']);

        $this->assertEquals('<div>foo bar</div>', $decorator->render(['foo', 'bar']));
    }

    public function testConstructorWithConfig()
    {
        $decorator = new Zend_Tag_Cloud_Decorator_HtmlCloud(new Zend_Config(['htmlTags' => ['div'], 'separator' => ' ']));

        $this->assertEquals('<div>foo bar</div>', $decorator->render(['foo', 'bar']));
    }

    public function testSetOptions()
    {
        $decorator = new Zend_Tag_Cloud_Decorator_HtmlCloud();
        $decorator->setOptions(['htmlTags' => ['div'], 'separator' => ' ']);

        $this->assertEquals('<div>foo bar</div>', $decorator->render(['foo', 'bar']));
    }

    public function testSkipOptions()
    {
        $decorator = new Zend_Tag_Cloud_Decorator_HtmlCloud(['options' => 'foobar']);
        // In case would fail due to an error
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Tag_Cloud_Decorator_HtmlCloudTest::main') {
    Zend_Tag_Cloud_Decorator_HtmlCloudTest::main();
}
/**
 *
 */
