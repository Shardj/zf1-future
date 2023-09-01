<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

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
class Zend_Mobile_Push_ApnsTest extends TestCase
{
    /**
     * @var \Zend_Mobile_Push_Test_ApnsProxy|mixed
     */
    protected $apns;

    /**
     * @var \Zend_Mobile_Push_Message_Apns|mixed
     */
    protected $message;

    protected function set_up()
    {
        $this->apns = new Zend_Mobile_Push_Test_ApnsProxy();
        $this->message = new Zend_Mobile_Push_Message_Apns();
    }

    protected function _setupValidBase()
    {
        $this->message->setToken('AF0123DE');
        $this->message->setId(time());
        $this->message->setAlert('bar');
        $this->apns->setCertificate(__DIR__ . '/certificate.pem');
    }

    public function testConnectThrowsExceptionOnInvalidEnvironment()
    {
        $this->expectException(Zend_Mobile_Push_Exception::class);
        $this->apns->connect(5);
    }

    public function testConnectThrowsExceptionOnMissingCertificate()
    {
        $this->expectException(Zend_Mobile_Push_Exception::class);
        $this->apns->connect();
    }

    public function testSetCertificateThrowsExceptionOnNonString()
    {
        $this->expectException(Zend_Mobile_Push_Exception::class);
        $this->apns->setCertificate(['foo']);
    }

    public function testSetCertificateThrowsExceptionOnMissingFile()
    {
        $this->expectException(Zend_Mobile_Push_Exception::class);
        $this->apns->setCertificate('bar');
    }

    public function testSetCertificateReturnsInstance()
    {
        $ret = $this->apns->setCertificate(__DIR__ . '/certificate.pem');
        $this->assertEquals($this->apns, $ret);
    }

    public function testSetCertificatePassphraseThrowsExceptionOnNonString()
    {
        $this->expectException(Zend_Mobile_Push_Exception::class);
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
        $this->apns->setCertificate(__DIR__ . '/certificate.pem');
        $ret = $this->apns->connect();
        $this->assertEquals($this->apns, $ret);
    }

    public function testSendThrowsExceptionOnInvalidMessage()
    {
        $this->expectException(Zend_Mobile_Push_Exception::class);
        $this->apns->setCertificate(__DIR__ . '/certificate.pem');
        $this->apns->send($this->message);
    }

    public function testSendThrowsServerUnavailableExceptionOnFalseReturn()
    {
        $this->expectException(Zend_Mobile_Push_Exception_ServerUnavailable::class);
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

    public function testSendThrowsExceptionOnProcessingError()
    {
        $this->expectException(Zend_Mobile_Push_Exception::class);
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 1, 1, 012345));
        $this->apns->send($this->message);
    }

    public function testSendThrowsExceptionOnInvalidToken()
    {
        $this->expectException(Zend_Mobile_Push_Exception_InvalidToken::class);
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 2, 2, 012345));
        $this->apns->send($this->message);
    }

    public function testSendThrowsExceptionOnInvalidTopic()
    {
        $this->expectException(Zend_Mobile_Push_Exception_InvalidTopic::class);
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 3, 3, 012345));
        $this->apns->send($this->message);
    }

    public function testSendThrowsExceptionOnInvalidPayload()
    {
        $this->expectException(Zend_Mobile_Push_Exception_InvalidPayload::class);
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 4, 4, 012345));
        $this->apns->send($this->message);
    }

    public function testSendThrowsExceptionOnInvalidToken2()
    {
        $this->expectException(Zend_Mobile_Push_Exception_InvalidToken::class);
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 5, 5, 012345));
        $this->apns->send($this->message);
    }

    public function testSendThrowsExceptionOnInvalidTopic2()
    {
        $this->expectException(Zend_Mobile_Push_Exception_InvalidTopic::class);
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 6, 6, 012345));
        $this->apns->send($this->message);
    }

    public function testSendThrowsExceptionOnMessageTooBig()
    {
        $this->expectException(Zend_Mobile_Push_Exception_InvalidPayload::class);
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 7, 7, 012345));
        $this->apns->send($this->message);
    }

    public function testSendThrowsExceptionOnInvalidToken3()
    {
        $this->expectException(Zend_Mobile_Push_Exception_InvalidToken::class);
        $this->_setupValidBase();
        $this->apns->setReadResponse(pack('CCN*', 8, 8, 012345));
        $this->apns->send($this->message);
    }
}
