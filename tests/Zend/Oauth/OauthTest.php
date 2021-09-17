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
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Oauth.php';

class Test_Http_Client_19485876 extends Zend_Http_Client {}

/**
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Oauth
 */
class Zend_OauthTest extends PHPUnit_Framework_TestCase
{

    public function teardown()
    {
        Zend_Oauth::clearHttpClient();
    }

    public function testCanSetCustomHttpClient()
    {
        Zend_Oauth::setHttpClient(new Test_Http_Client_19485876());
        $this->assertTrue(Zend_Oauth::getHttpClient() instanceof Test_Http_Client_19485876);
    }

    public function testGetHttpClientResetsParameters()
    {
        $client = new Test_Http_Client_19485876();
        $client->setParameterGet(['key'=>'value']);
        Zend_Oauth::setHttpClient($client);
        $resetClient = Zend_Oauth::getHttpClient();
        $resetClient->setUri('http://www.example.com');
        $this->assertEquals('http://www.example.com:80', $resetClient->getUri(true));
    }

    public function testGetHttpClientResetsAuthorizationHeader()
    {
        $client = new Test_Http_Client_19485876();
        $client->setHeaders('Authorization', 'realm="http://www.example.com",oauth_version="1.0"');
        Zend_Oauth::setHttpClient($client);
        $resetClient = Zend_Oauth::getHttpClient();
        $this->assertEquals(null, $resetClient->getHeader('Authorization'));
    }

    /**
     * @group ZF-10182
     * @dataProvider providerOauthClientOauthOptions
     */
    public function testOauthClientOauthOptionsInConstructor($oauthOptions)
    {
        require_once 'Zend/Oauth/Client.php';
        $client = new Zend_Oauth_Client($oauthOptions);
        $this->assertEquals('GET', $client->getRequestMethod());
        $this->assertEquals('http://www.example.com', $client->getSiteUrl());
    }

    /**
     * @group ZF-10182
     * @dataProvider providerOauthClientConfigHttpClient
     */
    public function testOauthClientConfigHttpClientInConstructor($configHttpClient, $expected)
    {
        require_once 'Zend/Oauth/Client.php';
        $client = new Zend_Oauth_Client(null, null, $configHttpClient);
        $config = $client->getAdapter()->getConfig();
        $this->assertEquals($expected['rfc'], $config['rfc3986_strict']);
        $this->assertEquals($expected['useragent'], $config['useragent']);
        $this->assertEquals($expected['timeout'], $config['timeout']);
    }

    public function providerOauthClientOauthOptions()
    {
        $options = [
            'requestMethod' => 'GET',
            'siteUrl'       => 'http://www.example.com'
        ];

        require_once 'Zend/Config.php';
        return [
            [$options],
            [new Zend_Config($options)]
        ];
    }

    public function providerOauthClientConfigHttpClient()
    {
        return [
            [
                ['adapter' => 'Zend_Http_Client_Adapter_Test'],
                ['rfc' => true,
                      'timeout' => 10,
                      'useragent' => 'Zend_Http_Client'
                ]
            ],
            [
                new Zend_Config(['adapter' => 'Zend_Http_Client_Adapter_Test']),
                ['rfc' => true,
                      'timeout' => 10,
                      'useragent' => 'Zend_Http_Client'
                ]
            ],
            [
                new Zend_Config([
                   'adapter' => 'Zend_Http_Client_Adapter_Test',
                   'rfc3986_strict' => false,
                   'timeout'        => 100,
                   'useragent' => 'Zend_Http_ClientCustom'
                ]),
                ['rfc' => false,
                      'timeout' => 100,
                      'useragent' => 'Zend_Http_ClientCustom'
                ]
            ],
            [
                null,
                ['rfc'       => true,
                      'timeout'   => 10,
                      'useragent' => 'Zend_Http_Client'
                ]
            ],
        ];
    }

    /**
     * @group ZF-10851
     */
    public function testOauthClientAcceptsRealmConfigurationOption()
    {
        $options = [
            'realm'			=> 'http://www.example.com'
        ];

        require_once 'Zend/Oauth/Client.php';
        $client = new Zend_Oauth_Client($options);
        $this->assertEquals('http://www.example.com', $client->getRealm());
    }

    /**
     * @group ZF-10851
     */
    public function testOauthClientPreparationWithRealmConfigurationOption()
    {
        require_once "Zend/Oauth/Token/Access.php";

        $options = [
            'requestMethod' => 'GET',
            'siteUrl'       => 'http://www.example.com',
            'realm'			=> 'someRealm'
        ];
        $token = new Zend_Oauth_Token_Access();

        require_once 'Zend/Oauth/Client.php';
        $client = new Zend_Oauth_Client($options);
        $this->assertEquals(NULL,$client->getHeader('Authorization'));

        $client->setToken($token);
        $client->setUri('http://oauth.example.com');
        $client->prepareOauth();

        $this->assertNotContains('realm=""',$client->getHeader('Authorization'));
        $this->assertContains('realm="someRealm"',$client->getHeader('Authorization'));
    }
    
    /**
     * @group ZF-11663
     */
    public function testOauthClientAcceptsGetParametersThroughSetter()
    {
        require_once "Zend/Oauth/Token/Access.php";
        $token = new Zend_Oauth_Token_Access();
        
        $options = [
            'requestMethod' => 'GET',
            'requestScheme' => Zend_Oauth::REQUEST_SCHEME_QUERYSTRING,
            'realm'			=> 'someRealm'
        ];
        
        require_once 'Zend/Oauth/Client.php';
        $client = new Zend_Oauth_Client($options);
        $client->setToken($token);
        $client->setUri('http://www.example.com/?test=FooBar');
        $queryString = $client->getUri()->getQuery();
        
        // Check that query string was set properly
        $this->assertSame('test=FooBar', $queryString);        
        
        // Change the GET parameters
        $client->setParameterGet('test', 'FooBaz');
        $client->setParameterGet('second', 'TestTest');
        
        // Prepare the OAuth request
        $client->prepareOauth();        
        $queryString = $client->getUri()->getQuery();
        
        // Ensure that parameter 'test' is unchanged, as URI parameters
        // should take precedence over ones set with setParameterGet
        $this->assertContains('test=FooBar', $queryString);
        
        // Ensure that new parameter was added
        $this->assertContains('second=TestTest', $queryString);
    }
}
