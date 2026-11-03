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
 * @version    $Id: UserAgentTest.php $
 */

// Call Zend_View_Helper_UserAgentTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_View_Helper_UserAgentTest::main");
}

require_once 'Zend/View.php';
require_once 'Zend/View/Helper/UserAgent.php';
require_once 'Zend/Http/UserAgent.php';

/**
 * Zend_View_Helper_UserAgentTest
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_View
 * @group      Zend_View_Helper
 */
class Zend_View_Helper_UserAgentTest extends TestCase
{
    /**
     * @var Zend_View_Helper_UserAgent
     */
    protected $helper;

    /**
     * @var Zend_Http_UserAgent
     */
    protected $userAgent;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        $suite = new TestSuite("Zend_View_Helper_UrlTest");
        $result = (new resources_Runner())->run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function set_up()
    {
        $this->helper = new Zend_View_Helper_UserAgent();
        $this->userAgent = new Zend_Http_UserAgent();
    }

    public function testHelperMethod()
    {
        $this->assertTrue(
            $this->helper->userAgent() instanceof Zend_Http_UserAgent
        );
        $this->helper->userAgent($this->userAgent);
        $this->assertEquals(
            spl_object_hash($this->userAgent),
            spl_object_hash($this->helper->getUserAgent())
        );
    }

    public function testGetUserAgentDefault()
    {
        $this->assertTrue(
            $this->helper->getUserAgent() instanceof Zend_Http_UserAgent
        );
    }

    public function testSetAndGetUserAgent()
    {
        $this->helper->setUserAgent($this->userAgent);
        $this->assertEquals(
            spl_object_hash($this->userAgent),
            spl_object_hash($this->helper->getUserAgent())
        );
    }
}

// Call Zend_View_Helper_UrlTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_View_Helper_UserAgentTest::main") {
    Zend_View_Helper_UserAgentTest::main();
}
