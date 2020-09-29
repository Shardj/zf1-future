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

require_once 'Zend/Mobile/Push/Message/Gcm.php';

/**
 * @category   Zend
 * @package    Zend_Mobile
 * @subpackage Push
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mobile
 * @group      Zend_Mobile_Push
 * @group      Zend_Mobile_Push_Gcm
 */
class Zend_Mobile_Push_Message_GcmTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testAddDataThrowsExceptionOnNonStringKey()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->addData([], 'value');
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testAddDataThrowsExceptionOnNonScalarValue()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->addData('key', new stdClass);
    }

    public function testSetData()
    {
        $data = ['key' => 'value'];
        $data2 = ['key2' => 'value2'];
        $msg = new Zend_Mobile_Push_Message_Gcm();

        $msg->setData($data);
        $this->assertEquals($data, $msg->getData());

        $msg->setData($data2);
        $this->assertEquals($data2, $msg->getData());
    }

    public function testTokens()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->setToken('foo');
        $this->assertEquals(['foo'], $msg->getToken());

        $msg->setToken(['foo', 'bar']);
        $this->assertEquals(['foo', 'bar'], $msg->getToken());

        $msg->setToken('bar');
        $msg->addToken('foo');
        $this->assertEquals(['bar', 'foo'], $msg->getToken());

        $msg->clearToken();
        $this->assertEquals([], $msg->getToken());
    }

    public function testDelayWhileIdle()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->setDelayWhileIdle(true);
        $this->assertTrue($msg->getDelayWhileIdle());
        $msg->setDelayWhileIdle(false);
        $this->assertFalse($msg->getDelayWhileIdle());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testDelayWhileIdleThrowsExceptionOnInvalidValue()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->setDelayWhileIdle('true');
    }

    public function testTtl()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->setTtl(10);
        $this->assertEquals(10, $msg->getTtl());
    }

    public function testTtlSendMessageOnZero()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->setTtl(0);
        $this->assertEquals(0, $msg->getTtl());
        $this->assertEquals('{"time_to_live":0}', $msg->toJson());
    }

    /**
     * @expectedException Zend_Mobile_Push_Message_Exception
     */
    public function testTtlThrowsExceptionOnInvalidValue()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->setTtl('foo');
    }


    public function testValidateWithoutTokenReturnsFalse()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $this->assertFalse($msg->validate());
    }

    public function testValidateToken()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->setToken('a-token!');
        $this->assertTrue($msg->validate());
    }

    public function testValidateWithTtlAndNoIdReturnsFalse()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->setToken('foo');
        $msg->setTtl(10);
        $this->assertFalse($msg->validate());
    }

    public function testToJsonIntCollapseKeyEncodedAsString()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $msg->setId(10);
        $this->assertEquals('{"collapse_key":"10"}', $msg->toJson());
    }
}
