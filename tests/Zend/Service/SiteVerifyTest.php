<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/** Zend_Service_SiteVerify */
require_once 'Zend/Service/SiteVerify.php';

/** Zend_Http_Client */
require_once 'Zend/Http/Client.php';

/** Zend_Http_Client_Adapter_Test */
require_once 'Zend/Http/Client/Adapter/Test.php';

/**
 * @category   Zend
 * @package    Zend_Service
 * @subpackage UnitTests
 * @group      Zend_Service
 * @group      Zend_Service_SiteVerify
 */
class Zend_Service_SiteVerifyTest extends TestCase
{
    /**
     * @var Zend_Http_Client_Adapter_Test
     */
    protected $_adapter;

    /**
     * @var Zend_Service_SiteVerify
     */
    protected $_service;

    protected function set_up()
    {
        $this->_adapter = new Zend_Http_Client_Adapter_Test();
        $client         = new Zend_Http_Client(null, ['adapter' => $this->_adapter]);
        $this->_service = new Zend_Service_SiteVerify('secret-key', Zend_Service_SiteVerify::PROVIDER_TURNSTILE, $client);
    }

    public function testProviderSettings()
    {
        $this->assertSame('https://challenges.cloudflare.com/turnstile/v0/siteverify', $this->_service->getVerifyUrl());
        $this->assertSame([
            'verifyUrl'     => 'https://www.google.com/recaptcha/api/siteverify',
            'responseField' => 'g-recaptcha-response',
            'scriptUrl'     => 'https://www.google.com/recaptcha/api.js',
            'widgetClass'   => 'g-recaptcha',
        ], Zend_Service_SiteVerify::getProvider('RECAPTCHA'));
        $this->assertSame('h-captcha-response', Zend_Service_SiteVerify::getProviderSetting('hcaptcha', 'responseField'));
        $this->assertSame('https://example.com/verify', Zend_Service_SiteVerify::getProviderSetting('https://example.com/verify', 'verifyUrl'));

        $service = new Zend_Service_SiteVerify('s', 'https://example.com/verify');
        $this->assertSame('https://example.com/verify', $service->getVerifyUrl());
    }

    public function testUnknownProvider()
    {
        $this->expectException('Zend_Service_SiteVerify_Exception');
        Zend_Service_SiteVerify::getProvider('nope');
    }

    public function testVerifyPostsTheTokenAndDecodesTheAnswer()
    {
        $json = '{"success":true,"challenge_ts":"2026-01-01T00:00:00Z","hostname":"example.com","action":"login","score":0.8,"error-codes":[]}';
        $this->_adapter->setResponse("HTTP/1.1 200 OK\r\nContent-Type: application/json\r\nContent-Length: " . strlen($json) . "\r\n\r\n" . $json);

        $response = $this->_service->verify('tok en', '198.51.100.7');

        $this->assertTrue($response->isSuccess());
        $this->assertSame('example.com', $response->getHostname());
        $this->assertSame('login', $response->getAction());
        $this->assertSame(0.8, $response->getScore());
        $this->assertSame([], $response->getErrorCodes());
        $this->assertSame('2026-01-01T00:00:00Z', $response->getChallengeTs());
        $this->assertSame(true, $response->toArray()['success']);

        $request = $this->_service->getHttpClient()->getLastRequest();
        $this->assertStringContainsString('POST /turnstile/v0/siteverify HTTP/1.1', $request);
        $this->assertStringContainsString('Host: challenges.cloudflare.com', $request);
        $this->assertStringContainsString("\r\n\r\nsecret=secret-key&response=tok+en&remoteip=198.51.100.7", $request);
    }

    public function testVerifyWithoutRemoteIp()
    {
        $this->_adapter->setResponse("HTTP/1.1 200 OK\r\nContent-Length: 17\r\n\r\n{\"success\":false}");
        $response = $this->_service->verify('t');
        $this->assertFalse($response->isSuccess());
        $this->assertNull($response->getScore());
        $this->assertStringContainsString("\r\n\r\nsecret=secret-key&response=t", $this->_service->getHttpClient()->getLastRequest());
        $this->assertStringNotContainsString('remoteip', $this->_service->getHttpClient()->getLastRequest());
    }

    public function testFailureAnswer()
    {
        $json = '{"success":false,"error-codes":["missing-input-secret"]}';
        $this->_adapter->setResponse("HTTP/1.1 200 OK\r\nContent-Length: " . strlen($json) . "\r\n\r\n" . $json);
        $response = $this->_service->verify('t');
        $this->assertFalse($response->isSuccess());
        $this->assertSame(['missing-input-secret'], $response->getErrorCodes());
    }

    public function testHttpErrorThrows()
    {
        $this->_adapter->setResponse("HTTP/1.1 503 Service Unavailable\r\nContent-Length: 0\r\n\r\n");
        $this->expectException('Zend_Service_SiteVerify_Exception');
        $this->_service->verify('t');
    }

    public function testInvalidJsonThrows()
    {
        $this->_adapter->setResponse("HTTP/1.1 200 OK\r\nContent-Length: 4\r\n\r\nnope");
        $this->expectException('Zend_Service_SiteVerify_Exception');
        $this->_service->verify('t');
    }

    public function testMissingSecretThrows()
    {
        $service = new Zend_Service_SiteVerify('');
        $this->expectException('Zend_Service_SiteVerify_Exception');
        $service->verify('t');
    }
}
