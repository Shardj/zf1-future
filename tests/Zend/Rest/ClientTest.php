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
 * @package    Zend_Rest
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/** Zend_Rest_Client */
require_once 'Zend/Rest/Client.php';

/** Zend_Http_Client_Adapter_Test */
require_once 'Zend/Http/Client/Adapter/Test.php';

/**
 * Test cases for Zend_Rest_Client
 *
 * @category   Zend
 * @package    Zend_Rest
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Rest
 * @group      Zend_Rest_Client
 */
class Zend_Rest_ClientTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->path = dirname(__FILE__) . '/responses/';

        $this->adapter = new Zend_Http_Client_Adapter_Test();
        $client        = new Zend_Http_Client(null, [
            'adapter' => $this->adapter
        ]);
        Zend_Rest_Client::setHttpClient($client);

        $this->rest = new Zend_Rest_Client('http://framework.zend.com/');
    }
    
    /**
     * @group ZF-10664
     * 
     * Test that you can post a file using a preset 
     * Zend_Http_Client that has a file to post,
     * by calling $restClient->setNoReset() prior to issuing the
     * restPost() call.    
     */
    public function testCanPostFileInPresetHttpClient()
    {
        if (!defined('TESTS_ZEND_REST_ONLINE_ENABLED')
            || !constant('TESTS_ZEND_REST_ONLINE_ENABLED')
        ) {
            $this->markTestSkipped('Define TESTS_ZEND_REST_ONLINE_ENABLED to test Zend_Rest_ClientTest online.');
        }

        $client = new Zend_Rest_Client('http://framework.zend.com');
        $httpClient = new Zend_Http_Client();
        $text = 'this is some plain text';
        $httpClient->setFileUpload('some_text.txt', 'upload', $text, 'text/plain');
        $client->setHttpClient($httpClient);
        $client->setNoReset();
        $client->restPost('/file');
        $request = $httpClient->getLastRequest();
        $this->assertTrue(strpos($request, $text) !== false, 'The file is not in the request');
    }

    public function testUri()
    {
        if (!defined('TESTS_ZEND_REST_ONLINE_ENABLED')
            || !constant('TESTS_ZEND_REST_ONLINE_ENABLED')
        ) {
            $this->markTestSkipped('Define TESTS_ZEND_REST_ONLINE_ENABLED to test Zend_Rest_ClientTest online.');
        }

        $client = new Zend_Rest_Client('http://framework.zend.com/rest/');
        $uri = $client->getUri();
        $this->assertTrue($uri instanceof Zend_Uri_Http);
        $this->assertEquals('http://framework.zend.com/rest/', $uri->getUri());

        $client->setUri(Zend_Uri::factory('http://framework.zend.com/soap/'));
        $uri = $client->getUri();
        $this->assertTrue($uri instanceof Zend_Uri_Http);
        $this->assertEquals('http://framework.zend.com/soap/', $uri->getUri());

        $client->setUri('http://framework.zend.com/xmlrpc/');
        $uri = $client->getUri();
        $this->assertTrue($uri instanceof Zend_Uri_Http);
        $this->assertEquals('http://framework.zend.com/xmlrpc/', $uri->getUri());
    }

    public function testRestGetThrowsExceptionWithNoUri()
    {
        $expXml   = file_get_contents($this->path . 'returnString.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $rest = new Zend_Rest_Client();

        try {
            $response = $rest->restGet('/rest/');
            $this->fail('Should throw exception if no URI in object');
        } catch (Exception $e) {
            // success
        }
    }

    public function testRestFixesPathWithMissingSlashes()
    {
        $expXml   = file_get_contents($this->path . 'returnString.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $rest = new Zend_Rest_Client('http://framework.zend.com');

        $response = $rest->restGet('rest');
        $this->assertTrue($response instanceof Zend_Http_Response);
        $this->assertContains($expXml, $response->getBody());
    }

    public function testRestGet()
    {
        $expXml   = file_get_contents($this->path . 'returnString.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $response = $this->rest->restGet('/rest/');
        $this->assertTrue($response instanceof Zend_Http_Response);
        $this->assertContains($expXml, $response->getBody());
    }

    public function testRestPost()
    {
        $expXml   = file_get_contents($this->path . 'returnString.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $reqXml   = file_get_contents($this->path . 'returnInt.xml');
        $response = $this->rest->restPost('/rest/', $reqXml);
        $this->assertTrue($response instanceof Zend_Http_Response);
        $body = $response->getBody();
        $this->assertContains($expXml, $response->getBody());

        $request = Zend_Rest_Client::getHttpClient()->getLastRequest();
        $this->assertContains($reqXml, $request, $request);
    }

    public function testRestPostWithArrayData()
    {
        $expXml   = file_get_contents($this->path . 'returnString.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $response = $this->rest->restPost('/rest/', ['foo' => 'bar', 'baz' => 'bat']);
        $this->assertTrue($response instanceof Zend_Http_Response);
        $body = $response->getBody();
        $this->assertContains($expXml, $response->getBody());

        $request = Zend_Rest_Client::getHttpClient()->getLastRequest();
        $this->assertContains('foo=bar&baz=bat', $request, $request);
    }

    public function testRestPut()
    {
        $expXml   = file_get_contents($this->path . 'returnString.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $reqXml   = file_get_contents($this->path . 'returnInt.xml');
        $response = $this->rest->restPut('/rest/', $reqXml);
        $this->assertTrue($response instanceof Zend_Http_Response);
        $body = $response->getBody();
        $this->assertContains($expXml, $response->getBody());

        $request = Zend_Rest_Client::getHttpClient()->getLastRequest();
        $this->assertContains($reqXml, $request, $request);
    }

    public function testRestDelete()
    {
        $expXml   = file_get_contents($this->path . 'returnString.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $reqXml   = file_get_contents($this->path . 'returnInt.xml');
        $response = $this->rest->restDelete('/rest/', $reqXml);
        $this->assertTrue($response instanceof Zend_Http_Response);
        $body = $response->getBody();
        $this->assertContains($expXml, $response->getBody());
        
        $request = Zend_Rest_Client::getHttpClient()->getLastRequest();
        $this->assertContains($reqXml, $request, $request);
    }

    public function testCallWithHttpMethod()
    {
        $expXml   = file_get_contents($this->path . 'returnString.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $response = $this->rest->get('/rest/');
        $this->assertTrue($response instanceof Zend_Rest_Client_Result);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals('string', $response->response());
    }

    public function testCallAsObjectMethodReturnsClient()
    {
        $expXml   = file_get_contents($this->path . 'returnString.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $response = $this->rest->doStuff('why', 'not');
        $this->assertTrue($response instanceof Zend_Rest_Client);
        $this->assertSame($this->rest, $response);
    }

    public function testCallAsObjectMethodChainPerformsRequest()
    {
        $expXml   = file_get_contents($this->path . 'returnString.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $response = $this->rest->doStuff('why', 'not')->get();
        $this->assertTrue($response instanceof Zend_Rest_Client_Result);
        $this->assertEquals('string', $response->response());
    }

    /**
     * @group ZF-3705
     * @group ZF-3647
     */
    public function testInvalidXmlInClientResultLeadsToException()
    {
        try {
            $result = new Zend_Rest_Client_Result("invalidxml");
            $this->fail();
        } catch(Zend_Rest_Client_Result_Exception $e) {

        }
    }
    
    /**
     * @group ZF-11281
     */
    public function testCallStatusGetterOnResponseObjectWhenServerResponseHasNoStatusXmlElement()
    {
        $expXml   = file_get_contents($this->path . 'returnEmptyStatus.xml');
        $response = "HTTP/1.0 200 OK\r\n"
                  . "X-powered-by: PHP/5.2.0\r\n"
                  . "Content-type: text/xml\r\n"
                  . "Content-length: " . strlen($expXml) . "\r\n"
                  . "Server: Apache/1.3.34 (Unix) PHP/5.2.0)\r\n"
                  . "Date: Tue, 06 Feb 2007 15:01:47 GMT\r\n"
                  . "Connection: close\r\n"
                  . "\r\n"
                  . $expXml;
        $this->adapter->setResponse($response);

        $response = $this->rest->get('/rest/');
        $this->assertTrue($response instanceof Zend_Rest_Client_Result);
        $this->assertFalse($response->getStatus());
    }

}
