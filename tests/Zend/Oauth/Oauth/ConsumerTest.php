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
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Oauth/Consumer.php';

/**
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Oauth
 */
class Zend_Oauth_ConsumerTest extends TestCase
{
    protected function tear_down()
    {
        Zend_Oauth::clearHttpClient();
    }

    public function testConstructorSetsConsumerKey()
    {
        $config = ['consumerKey' => '1234567890'];
        $consumer = new Zend_Oauth_Consumer($config);
        $this->assertEquals('1234567890', $consumer->getConsumerKey());
    }

    public function testConstructorSetsConsumerSecret()
    {
        $config = ['consumerSecret' => '0987654321'];
        $consumer = new Zend_Oauth_Consumer($config);
        $this->assertEquals('0987654321', $consumer->getConsumerSecret());
    }

    public function testSetsSignatureMethodFromOptionsArray()
    {
        $options = [
            'signatureMethod' => 'rsa-sha1'
        ];
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('RSA-SHA1', $consumer->getSignatureMethod());
    }

    public function testSetsRequestMethodFromOptionsArray() // add back
    {
        $options = [
            'requestMethod' => Zend_Oauth::GET
        ];
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals(Zend_Oauth::GET, $consumer->getRequestMethod());
    }

    public function testSetsRequestSchemeFromOptionsArray()
    {
        $options = [
            'requestScheme' => Zend_Oauth::REQUEST_SCHEME_POSTBODY
        ];
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals(Zend_Oauth::REQUEST_SCHEME_POSTBODY, $consumer->getRequestScheme());
    }

    public function testSetsVersionFromOptionsArray()
    {
        $options = [
            'version' => '1.1'
        ];
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('1.1', $consumer->getVersion());
    }

    public function testSetsCallbackUrlFromOptionsArray()
    {
        $options = [
            'callbackUrl' => 'http://www.example.com/local'
        ];
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('http://www.example.com/local', $consumer->getCallbackUrl());
    }

    public function testSetsRequestTokenUrlFromOptionsArray()
    {
        $options = [
            'requestTokenUrl' => 'http://www.example.com/request'
        ];
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('http://www.example.com/request', $consumer->getRequestTokenUrl());
    }

    public function testSetsUserAuthorizationUrlFromOptionsArray()
    {
        $options = [
            'userAuthorizationUrl' => 'http://www.example.com/authorize'
        ];
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('http://www.example.com/authorize', $consumer->getUserAuthorizationUrl());
    }

    public function testSetsAccessTokenUrlFromOptionsArray()
    {
        $options = [
            'accessTokenUrl' => 'http://www.example.com/access'
        ];
        $consumer = new Zend_Oauth_Consumer($options);
        $this->assertEquals('http://www.example.com/access', $consumer->getAccessTokenUrl());
    }

    public function testSetSignatureMethodThrowsExceptionForInvalidMethod()
    {
        $this->expectException(Zend_Oauth_Exception::class);
        $this->expectExceptionMessage("Unsupported signature method: BUCKYBALL. Supported are HMAC-SHA1, RSA-SHA1, PLAINTEXT and HMAC-SHA256");
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Zend_Oauth_Consumer($config);
        $consumer->setSignatureMethod('buckyball');
    }

    public function testSetRequestMethodThrowsExceptionForInvalidMethod()
    {
        $this->expectException(Zend_Oauth_Exception::class);
        $this->expectExceptionMessage("Invalid method: BUCKYBALL");
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Zend_Oauth_Consumer($config);
        $consumer->setRequestMethod('buckyball');
    }

    public function testSetRequestSchemeThrowsExceptionForInvalidMethod()
    {
        $this->expectException(Zend_Oauth_Exception::class);
        $this->expectExceptionMessage("'buckyball' is an unsupported request scheme");
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Zend_Oauth_Consumer($config);
        $consumer->setRequestScheme('buckyball');
    }

    public function testSetLocalUrlThrowsExceptionForInvalidUrl()
    {
        $this->expectException(Zend_Oauth_Exception::class);
        $this->expectExceptionMessage("Method does not exist: setLocalUrl");
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Zend_Oauth_Consumer($config);
        $consumer->setLocalUrl('buckyball');
    }

    public function testSetRequestTokenUrlThrowsExceptionForInvalidUrl()
    {
        $this->expectException(Zend_Oauth_Exception::class);
        $this->expectExceptionMessage("'buckyball' is not a valid URI");
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Zend_Oauth_Consumer($config);
        $consumer->setRequestTokenUrl('buckyball');
    }

    public function testSetUserAuthorizationUrlThrowsExceptionForInvalidUrl()
    {
        $this->expectException(Zend_Oauth_Exception::class);
        $this->expectExceptionMessage("'buckyball' is not a valid URI");
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Zend_Oauth_Consumer($config);
        $consumer->setUserAuthorizationUrl('buckyball');
    }

    public function testSetAccessTokenUrlThrowsExceptionForInvalidUrl()
    {
        $this->expectException(Zend_Oauth_Exception::class);
        $this->expectExceptionMessage("'buckyball' is not a valid URI");
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Zend_Oauth_Consumer($config);
        $consumer->setAccessTokenUrl('buckyball');
    }

    public function testGetRequestTokenReturnsInstanceOfOauthTokenRequest()
    {
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Zend_Oauth_Consumer($config);
        $token = $consumer->getRequestToken(null, null, new Test_Http_RequestToken_48231());
        $this->assertTrue($token instanceof Zend_Oauth_Token_Request);
    }

    public function testGetRedirectUrlReturnsUserAuthorizationUrlWithParameters()
    {
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321',
            'userAuthorizationUrl' => 'http://www.example.com/authorize'];
        $consumer = new Test_Consumer_48231($config);
        $params = ['foo' => 'bar'];
        $uauth = new Zend_Oauth_Http_UserAuthorization($consumer, $params);
        $token = new Zend_Oauth_Token_Request();
        $token->setParams(['oauth_token' => '123456', 'oauth_token_secret' => '654321']);
        $redirectUrl = $consumer->getRedirectUrl($params, $token, $uauth);
        $this->assertEquals(
            'http://www.example.com/authorize?oauth_token=123456&oauth_callback=http%3A%2F%2Fwww.example.com%2Flocal&foo=bar',
            $redirectUrl
        );
    }

    public function testGetAccessTokenReturnsInstanceOfOauthTokenAccess()
    {
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Zend_Oauth_Consumer($config);
        $rtoken = new Zend_Oauth_Token_Request();
        $rtoken->setToken('token');
        $token = $consumer->getAccessToken(['oauth_token' => 'token'], $rtoken, null, new Test_Http_AccessToken_48231());
        $this->assertTrue($token instanceof Zend_Oauth_Token_Access);
    }

    public function testGetLastRequestTokenReturnsInstanceWhenExists()
    {
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Test_Consumer_48231($config);
        $this->assertTrue($consumer->getLastRequestToken() instanceof Zend_Oauth_Token_Request);
    }

    public function testGetLastAccessTokenReturnsInstanceWhenExists()
    {
        $config = ['consumerKey' => '12345', 'consumerSecret' => '54321'];
        $consumer = new Test_Consumer_48231($config);
        $this->assertTrue($consumer->getLastAccessToken() instanceof Zend_Oauth_Token_Access);
    }
}

class Test_Http_RequestToken_48231 extends Zend_Oauth_Http_RequestToken
{
    public function __construct()
    {
    }
    public function execute(?array $params = null)
    {
        $return = new Zend_Oauth_Token_Request();
        return $return;
    }
    public function setParams(array $customServiceParameters)
    {
    }
}

class Test_Http_AccessToken_48231 extends Zend_Oauth_Http_AccessToken
{
    public function __construct()
    {
    }
    public function execute(?array $params = null)
    {
        $return = new Zend_Oauth_Token_Access();
        return $return;
    }
    public function setParams(array $customServiceParameters)
    {
    }
}

class Test_Consumer_48231 extends Zend_Oauth_Consumer
{
    public function __construct(array $options = [])
    {
        $this->_requestToken = new Zend_Oauth_Token_Request();
        $this->_accessToken = new Zend_Oauth_Token_Access();
        parent::__construct($options);
    }
    public function getCallbackUrl()
    {
        return 'http://www.example.com/local';
    }
}
