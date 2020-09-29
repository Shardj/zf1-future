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

require_once 'Zend/Mobile/Push/Gcm.php';
require_once 'Zend/Http/Client.php';
require_once 'Zend/Http/Client/Adapter/Test.php';

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
class Zend_Mobile_Push_gcmTest extends PHPUnit_Framework_TestCase
{

    protected function _createJSONResponse($id, $success, $failure, $ids, $results)
    {
         return json_encode([
            'multicast_id' => $id,
            'success' => $success,
            'failure' => $failure,
            'canonical_ids' => $ids,
            'results' => $results
        ]);
    }

    public function setUp()
    {
        $this->adapter = new Zend_Http_Client_Adapter_Test();
        $this->client = new Zend_Http_Client();
        $this->client->setAdapter($this->adapter);
        $this->gcm = new Zend_Mobile_Push_Gcm();
        $this->gcm->setApiKey('testing');
        $this->gcm->setHttpClient($this->client);
        $this->message = new Zend_Mobile_Push_Message_Gcm();
        $this->message->addToken('testing');
        $this->message->addData('testKey', 'testValue');
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception
     */
    public function testSetApiKeyThrowsExceptionOnNonString()
    {
        $this->gcm->setApiKey([]);
    }

    public function testSetApiKey()
    {
        $key = 'a-login-token';
        $this->gcm->setApiKey($key);
        $this->assertEquals($key, $this->gcm->getApiKey());
    }

    public function testGetHttpClientReturnsDefault()
    {
        $gcm = new Zend_Mobile_Push_gcm();
        $this->assertEquals('Zend_Http_Client', get_class($gcm->getHttpClient()));
        $this->assertTrue($gcm->getHttpClient() instanceof Zend_Http_Client);
    }

    public function testSetHttpClient()
    {
        $client = new Zend_Http_Client();
        $this->gcm->setHttpClient($client);
        $this->assertEquals($client, $this->gcm->getHttpClient());
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception
     */
    public function testSendThrowsExceptionWithNonValidMessage()
    {
        $msg = new Zend_Mobile_Push_Message_Gcm();
        $this->gcm->send($msg);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception
     */
    public function testSendThrowsExceptionWithTtlNoId()
    {
        $msg = $this->message;
        $msg->setTtl(300);
        $this->gcm->send($msg);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_ServerUnavailable
     */
    public function testSendThrowsExceptionWhenServerUnavailable()
    {
        $this->adapter->setResponse('HTTP/1.1 500 Internal Server Error' . "\r\n\r\n");
        $this->gcm->send($this->message);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_InvalidAuthToken
     */
    public function testSendThrowsExceptionWhenInvalidAuthToken()
    {
        $this->adapter->setResponse('HTTP/1.1 401 Unauthorized' . "\r\n\r\n");
        $this->gcm->send($this->message);
    }

    /**
     * @expectedException Zend_Mobile_Push_Exception_InvalidPayload
     */
    public function testSendThrowsExceptionWhenInvalidPayload()
    {
        $this->adapter->setResponse('HTTP/1.1 400 Bad Request' . "\r\n\r\n");
        $this->gcm->send($this->message);
    }

    public function testSendResultInvalidRegistrationId()
    {
        $body = $this->_createJSONResponse(101, 0, 1, 0, [['error' => 'InvalidRegistration']]);
        $this->adapter->setResponse(
            'HTTP/1.1 200 OK' . "\r\n" .
            'Context-Type: text/html' . "\r\n\r\n" .
            $body
        );
        $response = $this->gcm->send($this->message);
        $result = $response->getResults();
        $result = array_shift($result);
        $this->assertEquals('InvalidRegistration', $result['error']);
        $this->assertEquals(0, $response->getSuccessCount());
        $this->assertEquals(0, $response->getCanonicalCount());
        $this->assertEquals(1, $response->getFailureCount());
    }

    public function testSendResultMismatchSenderId()
    {
        $body = $this->_createJSONResponse(101, 0, 1, 0, [['error' => 'MismatchSenderId']]);
        $this->adapter->setResponse(
            'HTTP/1.1 200 OK' . "\r\n" .
            'Context-Type: text/html' . "\r\n\r\n" .
            $body
        );
        $response = $this->gcm->send($this->message);
        $result = $response->getResults();
        $result = array_shift($result);
        $this->assertEquals('MismatchSenderId', $result['error']);
        $this->assertEquals(0, $response->getSuccessCount());
        $this->assertEquals(0, $response->getCanonicalCount());
        $this->assertEquals(1, $response->getFailureCount());
    }

    public function testSendResultNotRegistered()
    {
        $body = $this->_createJSONResponse(101, 0, 1, 0, [['error' => 'NotRegistered']]);
        $this->adapter->setResponse(
            'HTTP/1.1 200 OK' . "\r\n" .
            'Context-Type: text/html' . "\r\n\r\n" .
            $body
        );
        $response = $this->gcm->send($this->message);
        $result = $response->getResults();
        $result = array_shift($result);
        $this->assertEquals('NotRegistered', $result['error']);
        $this->assertEquals(0, $response->getSuccessCount());
        $this->assertEquals(0, $response->getCanonicalCount());
        $this->assertEquals(1, $response->getFailureCount());
    }

    public function testSendResultMessageTooBig()
    {
        $body = $this->_createJSONResponse(101, 0, 1, 0, [['error' => 'MessageTooBig']]);
        $this->adapter->setResponse(
            'HTTP/1.1 200 OK' . "\r\n" .
            'Context-Type: text/html' . "\r\n\r\n" .
            $body
        );
        $response = $this->gcm->send($this->message);
        $result = $response->getResults();
        $result = array_shift($result);
        $this->assertEquals('MessageTooBig', $result['error']);
        $this->assertEquals(0, $response->getSuccessCount());
        $this->assertEquals(0, $response->getCanonicalCount());
        $this->assertEquals(1, $response->getFailureCount());
    }

    public function testSendResultSuccessful()
    {
        $body = $this->_createJSONResponse(101, 1, 0, 0, [['message_id' => '1:2342']]);
        $this->adapter->setResponse(
            'HTTP/1.1 200 OK' . "\r\n" .
            'Context-Type: text/html' . "\r\n\r\n" .
            $body
        );
        $response = $this->gcm->send($this->message);
        $result = $response->getResults();
        $result = array_shift($result);
        $this->assertEquals('1:2342', $result['message_id']);
        $this->assertEquals(1, $response->getSuccessCount());
        $this->assertEquals(0, $response->getCanonicalCount());
        $this->assertEquals(0, $response->getFailureCount());
    }

    public function testSendResultSuccessfulWithRegistrationId()
    {
        $body = $this->_createJSONResponse(101, 1, 0, 1, [['message_id' => '1:2342', 'registration_id' => 'testfoo']]);
        $this->adapter->setResponse(
            'HTTP/1.1 200 OK' . "\r\n" .
            'Context-Type: text/html' . "\r\n\r\n" .
            $body
        );
        $response = $this->gcm->send($this->message);
        $result = $response->getResults();
        $result = array_shift($result);
        $this->assertEquals('1:2342', $result['message_id']);
        $this->assertEquals('testfoo', $result['registration_id']);
        $this->assertEquals(1, $response->getSuccessCount());
        $this->assertEquals(1, $response->getCanonicalCount());
        $this->assertEquals(0, $response->getFailureCount());
    }
}
