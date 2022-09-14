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
 * @package    Zend_Http_Client
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once dirname(__FILE__) . '/SocketTest.php';

require_once 'Zend/Http/Client/Adapter/Proxy.php';

/**
 * Zend_Http_Client_Adapter_Proxy test suite.
 *
 * In order to run, TESTS_ZEND_HTTP_CLIENT_HTTP_PROXY must point to a working
 * proxy server, which can access TESTS_ZEND_HTTP_CLIENT_BASEURI.
 *
 * See TestConfiguration.dist.php for more information.
 *
 * @category   Zend
 * @package    Zend_Http_Client
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Http
 * @group      Zend_Http_Client
 */
class Zend_Http_Client_ProxyAdapterTest extends Zend_Http_Client_SocketTest
{
    /**
     * Configuration array
     *
     * @var array
     */
    protected function setUp()
    {
        if (defined('TESTS_ZEND_HTTP_CLIENT_HTTP_PROXY') &&
              TESTS_ZEND_HTTP_CLIENT_HTTP_PROXY) {

            list($host, $port) = explode(':', TESTS_ZEND_HTTP_CLIENT_HTTP_PROXY, 2);

            if (! $host)
                $this->markTestSkipped("No valid proxy host name or address specified.");

            $port = (int) $port;
            if ($port == 0) {
                $port = 8080;
            } else {
                if (($port < 1 || $port > 65535))
                    $this->markTestSkipped("$port is not a valid proxy port number. Should be between 1 and 65535.");
            }

            $user = '';
            $pass = '';
            if (defined('TESTS_ZEND_HTTP_CLIENT_HTTP_PROXY_USER') &&
                TESTS_ZEND_HTTP_CLIENT_HTTP_PROXY_USER)
                    $user = TESTS_ZEND_HTTP_CLIENT_HTTP_PROXY_USER;

            if (defined('TESTS_ZEND_HTTP_CLIENT_HTTP_PROXY_PASS') &&
                TESTS_ZEND_HTTP_CLIENT_HTTP_PROXY_PASS)
                    $pass = TESTS_ZEND_HTTP_CLIENT_HTTP_PROXY_PASS;


            $this->config = [
                'adapter'    => 'Zend_Http_Client_Adapter_Proxy',
                'proxy_host' => $host,
                'proxy_port' => $port,
                'proxy_user' => $user,
                'proxy_pass' => $pass,
            ];

            parent::setUp();

        } else {
            $this->markTestSkipped("Zend_Http_Client proxy server tests are not enabled in TestConfiguration.php");
        }
    }

    /**
     * Test that when no proxy is set the adapter falls back to direct connection
     *
     */
    public function testFallbackToSocket()
    {
        $this->_adapter->setConfig([
            'proxy_host' => null,
        ]);

        $this->client->setUri($this->baseuri . 'testGetLastRequest.php');
        $res = $this->client->request(Zend_Http_Client::TRACE);
        if ($res->getStatus() == 405 || $res->getStatus() == 501) {
            $this->markTestSkipped("Server does not allow the TRACE method");
        }

        $this->assertEquals($this->client->getLastRequest(), $res->getBody(), 'Response body should be exactly like the last request');
    }

    public function testGetLastRequest()
    {
        /**
         * This test will never work for the proxy adapter (and shouldn't!)
         * because the proxy server modifies the request which is sent back in
         * the TRACE response
         */
    }
    
    /**
     * @group ZF-3189
     */
    public function testConnectHandshakeSendsCustomUserAgentHeader()
    {      
        // Change the adapter
        $this->config['adapter'] = 'ZF3189_ProxyAdapter';
        $this->config['useragent'] = 'ZendTest';
        parent::setUp();
        
        $base = preg_replace("/^http:/", "https:", $this->baseuri);
        $this->client->setUri($base . 'testSimpleRequests.php');

        // Ensure we're proxying a HTTPS request
        $this->assertEquals('https', $this->client->getUri()->getScheme());
        
        // Perform the request
        $this->client->request();

        $this->assertRegExp(
            "/\r\nUser-Agent: {$this->config['useragent']}\r\n/i",
            $this->client->getAdapter()->getLastConnectHandshakeRequest()
        );
    }
    
    /**
     * @group ZF-3189
     */
    public function testConnectHandshakeSendsCustomUserAgentHeaderWhenSetInHeaders()
    {      
        // Change the adapter
        $this->config['adapter'] = 'ZF3189_ProxyAdapter';
        parent::setUp();
        
        $base = preg_replace("/^http:/", "https:", $this->baseuri);
        $this->client->setUri($base . 'testSimpleRequests.php');
        $this->client->setHeaders('User-Agent', 'ZendTest');

        // Ensure we're proxying a HTTPS request
        $this->assertEquals('https', $this->client->getUri()->getScheme());
        
        // Perform the request
        $this->client->request();
        print_r($this->client->getAdapter()->getLastConnectHandshakeRequest());
        $this->assertRegExp(
            "/\r\nUser-Agent: ZendTest\r\n/i",
            $this->client->getAdapter()->getLastConnectHandshakeRequest()
        );
    }
    
    /**
     * @group ZF-3189
     */
    public function testProxyAdapterDoesNotOverwriteExistingProxyAuthorizationHeader()
    {      
        // Change the adapter
        $this->config['adapter'] = 'ZF3189_ProxyAdapter';
        parent::setUp();
        
        $base = preg_replace("/^http:/", "https:", $this->baseuri);
        $this->client->setUri($base . 'testSimpleRequests.php');
        $this->client->setHeaders('Proxy-Authorization', 'FooBarBaz');

        // Ensure we're proxying a HTTPS request
        $this->assertEquals('https', $this->client->getUri()->getScheme());
        
        // Perform the request
        $this->client->request();
        print_r($this->client->getAdapter()->getLastConnectHandshakeRequest());
        
        $resp = $this->client->getAdapter()->getLastConnectHandshakeRequest();
        $this->assertEquals(1, preg_match_all('/\r\nProxy-Authorization: ([^\r\n]+)\r\n/i', $resp, $matches));
        $this->assertEquals('FooBarBaz', $matches[1][0]);
    }
    
}

/**
 * Exposes internal variable connectHandshakeRequest for test purposes
 * @see ZF-3189
 */
class ZF3189_ProxyAdapter extends Zend_Http_Client_Adapter_Proxy
{
    
    /**
     * Retrieve the request data from last CONNECT handshake
     * @return string
     */
    public function getLastConnectHandshakeRequest()
    {
        return $this->connectHandshakeRequest;
    }
    
}
