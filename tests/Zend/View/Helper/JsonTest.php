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

// Call Zend_View_Helper_JsonTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_View_Helper_JsonTest::main");
}

require_once 'Zend/View/Helper/Json.php';
require_once 'Zend/Controller/Front.php';
require_once 'Zend/Controller/Response/Http.php';
require_once 'Zend/Json.php';
require_once 'Zend/Layout.php';

/**
 * Test class for Zend_View_Helper_Json
 *
 * @category   Zend
 * @package    Zend_View
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_View
 * @group      Zend_View_Helper
 */
class Zend_View_Helper_JsonTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {

        $suite  = new PHPUnit_Framework_TestSuite("Zend_View_Helper_JsonTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        Zend_View_Helper_JsonTest_Layout::resetMvcInstance();

        $this->response = new Zend_Controller_Response_Http();
        $this->response->headersSentThrowsException = false;

        $front = Zend_Controller_Front::getInstance();
        $front->resetInstance();
        $front->setResponse($this->response);

        $this->helper = new Zend_View_Helper_Json();
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    public function tearDown()
    {
    }

    public function verifyJsonHeader()
    {
        $headers = $this->response->getHeaders();

        $found = false;
        foreach ($headers as $header) {
            if ('Content-Type' == $header['name']) {
                if ($found) {
                    $this->fail('Content-Type header has been set twice.');
                    return null;
                }
                $found = true;
                $value = $header['value'];
            }
        }
        $this->assertTrue($found);
        $this->assertEquals('application/json', $value);
    }

    public function testJsonHelperSetsResponseHeader()
    {
        $this->helper->json('foobar');
        $this->verifyJsonHeader();
    }

    /**
     * @group ZF-10675
     */
    public function testJsonHelperReplacesContentTypeReponseHeaderIfAlreadySet()
    {
        $this->response->setHeader('Content-Type', 'text/html');
        $this->helper->json('foobar');
        $this->verifyJsonHeader();
    }

    public function testJsonHelperReturnsJsonEncodedString()
    {
        $data = $this->helper->json(['foobar']);
        $this->assertTrue(is_string($data));
        $this->assertEquals(['foobar'], Zend_Json::decode($data));
    }

    public function testJsonHelperDisablesLayoutsByDefault()
    {
        $layout = Zend_Layout::startMvc();
        $this->assertTrue($layout->isEnabled());
        $this->testJsonHelperReturnsJsonEncodedString();
        $this->assertFalse($layout->isEnabled());
    }

    public function testJsonHelperDoesNotDisableLayoutsWhenKeepLayoutFlagTrue()
    {
        $layout = Zend_Layout::startMvc();
        $this->assertTrue($layout->isEnabled());
        $data = $this->helper->json(['foobar'], true);
        $this->assertTrue($layout->isEnabled());
    }

    /**
     * @group ZF-12397
     */
    public function testJsonHelperWithKeepLayoutAsArray()
    {
        $layout = Zend_Layout::startMvc();
        $this->assertTrue($layout->isEnabled());
        $data = $this->helper->json(
            [
                 'foobar',
            ],
            [
                 'keepLayouts' => true,
                 'encodeData'  => false,
            ]
        );
        $this->assertTrue($layout->isEnabled());
        $this->assertSame(['foobar'], $data);
    }
    
    /**
     * @group ZF-10977
     */
    public function testJsonHelperWillAcceptPreencodedJson()
    {
        $data = $this->helper->json(Zend_Json::encode(['f']), false, false);
        $this->assertEquals('["f"]', $data);
    }
    
    /**
     * @group ZF-10977
     */
    public function testJsonHelperWillSendHeadersWhenProvidedWithPreencodedJson()
    {
        $data = $this->helper->json(Zend_Json::encode(['f']), false, false);
        $this->verifyJsonHeader();
    }
}

/**
 * Zend_Layout subclass to allow resetting MVC instance
 */
class Zend_View_Helper_JsonTest_Layout extends Zend_Layout
{
    public static function resetMvcInstance()
    {
        self::$_mvcInstance = null;
    }
}

// Call Zend_View_Helper_JsonTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_View_Helper_JsonTest::main") {
    Zend_View_Helper_JsonTest::main();
}
