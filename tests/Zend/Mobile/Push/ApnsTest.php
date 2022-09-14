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

/** Zend_Mobile_Push_Test_ApnsProxy **/
require_once 'Zend/Mobile/Push/Test/ApnsProxy.php';

/**
 * @category   Zend
 * @package    Zend_Mobile
 * @subpackage Push
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mobile
 * @group      Zend_Mobile_Push
 * @group      Zend_Mobile_Push_Apns
 */
class Zend_Mobile_Push_ApnsTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->apns = new Zend_Mobile_Push_Test_ApnsProxy();
        $this->message = new Zend_Mobile_Push_Message_Apns();
    }

    protected function _setupValidBase()
    {
        $this->message->setToken('AF0123DE');
        $this->message->setId(time());
        $this->message->setAlert('bar');
        $this->apns->setCertificate('Zend/Mobile/Push/certificate.pem');
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception
     */
    public function testConnectThrowsExceptionOnInvalidEnvironment()
    {
        $this->apns->connect(5);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception
     */
    public function testConnectThrowsExceptionOnMissingCertificate()
    {
        $this->apns->connect();
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception
     */
    public function testSetCertificateThrowsExceptionOnNonString()
    {
        $this->apns->setCertificate(['foo']);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception
     */
    public function testSetCertificateThrowsExceptionOnMissingFile()
    {
        $this->apns->setCertificate('bar');
    }

    public function testSetCertificateReturnsInstance()
    {
        $ret = $this->apns->setCertificate('Zend/Mobile/Push/certificate.pem');
        $this->assertEquals($this->apns, $ret);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception
     */
    public function testSetCertificatePassphraseThrowsExceptionOnNonString()
    {
        $this->apns->setCertificatePassphrase(['foo']);
    }

    public function testSetCertificatePassphraseReturnsInstance()
    {
        $ret = $this->apns->setCertificatePassphrase('foobar');
        $this->assertEquals($this->apns, $ret);
    }

    public function testSetCertificatePassphraseSetsPassphrase()
    {
        $this->apns->setCertificatePassphrase('foobar');
        $this->assertEquals('foobar', $this->apns->getCertificatePassphrase());
    }

    public function testConnectReturnsThis()
    {
        $this->apns->setCertificate('Zend/Mobile/Push/certificate.pem');
        $ret = $this->apns->connect();
        $this->assertEquals($this->apns, $ret);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception
     */
    public function testSendThrowsExceptionOnInvalidMessage()
    {
        $this->apns->setCertificate('Zend/Mobile/Push/certificate.pem');
        $this->apns->send($this->message);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_ServerUnavailable
     */
    public function testSendThrowsServerUnavailableExceptionOnFalseReturn()
    {
        $this->_setupValidBase();
        $this->apns->setWriteResponse(false);
        $this->apns->send($this->message);
    }

    public function testSendReturnsTrueOnSuccess()
    {
        $this->_setupValidBase();
        $this->assertTrue($this->apns->send($this->message));
    }

    public function testSendReturnsTrueOnErr0()
    {
        $this->_setupValidBase();
        $this->assertTrue($this->apns->send($this->message));
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception
     */
    public function testSendThrowsExceptionOnProcessingError()
    {
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 1, 1, 012345));
        $this->apns->send($this->message);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_InvalidToken
     */
    public function testSendThrowsExceptionOnInvalidToken()
    {
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 2, 2, 012345));
        $this->apns->send($this->message);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_InvalidTopic
     */
    public function testSendThrowsExceptionOnInvalidTopic()
    {
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 3, 3, 012345));
        $this->apns->send($this->message);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_InvalidPayload
     */
    public function testSendThrowsExceptionOnInvalidPayload()
    {
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 4, 4, 012345));
        $this->apns->send($this->message);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_InvalidToken
     */
    public function testSendThrowsExceptionOnInvalidToken2()
    {
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 5, 5, 012345));
        $this->apns->send($this->message);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_InvalidTopic
     */
    public function testSendThrowsExceptionOnInvalidTopic2()
    {
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 6, 6, 012345));
        $this->apns->send($this->message);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_InvalidPayload
     */
    public function testSendThrowsExceptionOnMessageTooBig()
    {
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 7, 7, 012345));
        $this->apns->send($this->message);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_InvalidToken
     */
    public function testSendThrowsExceptionOnInvalidToken3()
    {
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 8, 8, 012345));
        $this->apns->send($this->message);
    }
}
