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
 * @package    Zend_Mobile
 * @subpackage Push
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id $
 */

require_once 'Zend/Mobile/Push/Message/Mpns/Raw.php';

/**
 * @category   Zend
 * @package    Zend_Mobile
 * @subpackage Push
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mobile
 * @group      Zend_Mobile_Push
 * @group      Zend_Mobile_Push_Mpns
 */
class Zend_Mobile_Push_Message_Mpns_RawTest extends PHPUnit_Framework_TestCase
{
    private $_msg;

    public function setUp()
    {
        $this->_msg = new Zend_Mobile_Push_Message_Mpns_Raw();
    }

    public function testSetToken()
    {
        $token = 'http://sn1.notify.live.net/throttledthirdparty/bogusdata';
        $this->_msg->setToken($token);
        $this->assertEquals($token, $this->_msg->getToken());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetTokenNonStringThrowsException()
    {
        $token = ['foo' => 'bar'];
        $this->_msg->setToken($token);
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetTokenInvalidUrlThrowsException()
    {
        $token = 'notaurl';
        $this->_msg->setToken($token);
    }

    public function testGetNotificationType()
    {
        $this->assertEquals(Zend_Mobile_Push_Message_Mpns::TYPE_RAW, $this->_msg->getNotificationType());
    }

    public function testSetMessage()
    {
        $msg = '<root><foo /></root>';
        $this->_msg->setMessage($msg);
        $this->assertEquals($msg, $this->_msg->getMessage());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetMessageThrowsExceptionOnNonString()
    {
        $msg = ['foo' => 'bar'];
        $this->_msg->setMessage($msg);
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception 
     */
    public function testSetMessageThrowsExceptionOnNonXml()
    {
        $msg = 'foo';
        $this->_msg->setMessage($msg);
    }

    public function testGetDelayHasDefaultOfImmediate()
    {
        $this->assertEquals(Zend_Mobile_Push_Message_Mpns_Raw::DELAY_IMMEDIATE, $this->_msg->getDelay());
    }

    public function testSetDelay()
    {
        $this->_msg->setDelay(Zend_Mobile_Push_Message_Mpns_Raw::DELAY_450S);
        $this->assertEquals(Zend_Mobile_Push_Message_Mpns_Raw::DELAY_450S, $this->_msg->getDelay());
        $this->_msg->setDelay(Zend_Mobile_Push_Message_Mpns_Raw::DELAY_900S);
        $this->assertEquals(Zend_Mobile_Push_Message_Mpns_Raw::DELAY_900S, $this->_msg->getDelay());
        $this->_msg->setDelay(Zend_Mobile_Push_Message_Mpns_Raw::DELAY_IMMEDIATE);
        $this->assertEquals(Zend_Mobile_Push_Message_Mpns_Raw::DELAY_IMMEDIATE, $this->_msg->getDelay());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testSetDelayThrowsExceptionOnInvalidDelay()
    {
        $delay = 'foo';
        $this->_msg->setDelay($delay);
    }

    public function testValidate()
    {
        $this->assertFalse($this->_msg->validate());
        $this->_msg->setToken('http://sn1.notify.live.net/throttledthirdparty/bogusdata');
        $this->assertFalse($this->_msg->validate());
        $this->_msg->setMessage('<root><bar>foo</bar></root>');
        $this->assertTrue($this->_msg->validate());
    }

    public function testGetXmlPayload()
    {
        $raw = '<root><bar>foo</bar></root>';
        $this->_msg->setToken('http://sn1.notify.live.net/throttledthirdparty/abcdef1234567890');
        $this->_msg->setMessage($raw);
        $this->assertEquals($this->_msg->getXmlPayload(), $raw);
    }
}
