<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/** Zend_Captcha_SiteVerify */
require_once 'Zend/Captcha/SiteVerify.php';

/** Zend_Service_SiteVerify */
require_once 'Zend/Service/SiteVerify.php';

/** Zend_Http_Client */
require_once 'Zend/Http/Client.php';

/** Zend_Http_Client_Adapter_Test */
require_once 'Zend/Http/Client/Adapter/Test.php';

/** Zend_Form */
require_once 'Zend/Form.php';

/** Zend_Form_Element_Captcha */
require_once 'Zend/Form/Element/Captcha.php';

/** Zend_View */
require_once 'Zend/View.php';

/**
 * @category   Zend
 * @package    Zend_Captcha
 * @subpackage UnitTests
 * @group      Zend_Captcha
 */
class Zend_Captcha_SiteVerifyTest extends TestCase
{
    /**
     * @var Zend_Http_Client_Adapter_Test
     */
    protected $_adapter;

    /**
     * @var Zend_Captcha_SiteVerify
     */
    protected $_captcha;

    protected function set_up()
    {
        $this->_adapter = new Zend_Http_Client_Adapter_Test();
        $client         = new Zend_Http_Client(null, ['adapter' => $this->_adapter]);
        $service        = new Zend_Service_SiteVerify('secret-key', Zend_Service_SiteVerify::PROVIDER_RECAPTCHA, $client);

        $this->_captcha = new Zend_Captcha_SiteVerify([
            'siteKey'   => 'site-key',
            'secretKey' => 'secret-key',
            'remoteIp'  => '203.0.113.5',
        ]);
        $this->_captcha->setService($service);
    }

    /**
     * @param array $data
     * @return void
     */
    protected function _respondWith(array $data)
    {
        $json = json_encode($data);
        $this->_adapter->setResponse(
            "HTTP/1.1 200 OK\r\nContent-Type: application/json\r\nContent-Length: " . strlen($json) . "\r\n\r\n" . $json
        );
    }

    /**
     * @return string
     */
    protected function _lastRequestBody()
    {
        $request = $this->_captcha->getService()->getHttpClient()->getLastRequest();
        return substr($request, strpos($request, "\r\n\r\n") + 4);
    }

    public function testProviderPresets()
    {
        $this->assertSame('recaptcha', $this->_captcha->getProvider());
        $this->assertSame('https://www.google.com/recaptcha/api/siteverify', $this->_captcha->getVerifyUrl());
        $this->assertSame('g-recaptcha-response', $this->_captcha->getResponseField());
        $this->assertSame('https://www.google.com/recaptcha/api.js', $this->_captcha->getScriptUrl());
        $this->assertSame('g-recaptcha', $this->_captcha->getWidgetClass());

        $captcha = new Zend_Captcha_SiteVerify(['provider' => 'turnstile']);
        $this->assertSame('https://challenges.cloudflare.com/turnstile/v0/siteverify', $captcha->getVerifyUrl());
        $this->assertSame('cf-turnstile-response', $captcha->getResponseField());
        $this->assertSame('cf-turnstile', $captcha->getWidgetClass());

        $captcha = new Zend_Captcha_SiteVerify(['provider' => 'hcaptcha']);
        $this->assertSame('https://api.hcaptcha.com/siteverify', $captcha->getVerifyUrl());
        $this->assertSame('h-captcha-response', $captcha->getResponseField());
        $this->assertSame('https://js.hcaptcha.com/1/api.js', $captcha->getScriptUrl());
    }

    public function testPresetsCanBeOverriddenForACompatibleService()
    {
        $captcha = new Zend_Captcha_SiteVerify([
            'provider'      => 'recaptcha',
            'verifyUrl'     => 'https://captcha.example.com/siteverify',
            'responseField' => 'x-captcha-response',
            'scriptUrl'     => 'https://captcha.example.com/api.js',
            'widgetClass'   => 'x-captcha',
        ]);
        $this->assertSame('https://captcha.example.com/siteverify', $captcha->getVerifyUrl());
        $this->assertSame('x-captcha-response', $captcha->getResponseField());
        $this->assertSame('https://captcha.example.com/api.js', $captcha->getScriptUrl());
        $this->assertSame('x-captcha', $captcha->getWidgetClass());
        $this->assertSame('https://captcha.example.com/siteverify', $captcha->getService()->getVerifyUrl());
    }

    public function testUnknownProviderIsRejected()
    {
        $this->expectException('Zend_Service_SiteVerify_Exception');
        new Zend_Captcha_SiteVerify(['provider' => 'nope']);
    }

    public function testValidTokenPasses()
    {
        $this->_respondWith(['success' => true, 'hostname' => 'example.com', 'challenge_ts' => '2026-01-01T00:00:00Z']);

        $this->assertTrue($this->_captcha->isValid('', ['g-recaptcha-response' => 'the-token', 'other' => 'x']));
        $this->assertSame([], $this->_captcha->getMessages());

        $response = $this->_captcha->getLastResponse();
        $this->assertInstanceOf('Zend_Service_SiteVerify_Response', $response);
        $this->assertTrue($response->isSuccess());
        $this->assertSame('example.com', $response->getHostname());
        $this->assertSame('2026-01-01T00:00:00Z', $response->getChallengeTs());

        $body = $this->_lastRequestBody();
        parse_str($body, $posted);
        $this->assertSame(['secret' => 'secret-key', 'response' => 'the-token', 'remoteip' => '203.0.113.5'], $posted);
        $request = $this->_captcha->getService()->getHttpClient()->getLastRequest();
        $this->assertStringContainsString('POST /recaptcha/api/siteverify HTTP/1.1', $request);
        $this->assertStringContainsString('Host: www.google.com', $request);
    }

    public function testTokenCanBeGivenAsValue()
    {
        $this->_respondWith(['success' => true]);
        $this->assertTrue($this->_captcha->isValid('the-token'));
        $this->assertTrue($this->_captcha->isValid(['g-recaptcha-response' => 'the-token']));
    }

    public function testMissingTokenFailsWithoutCallingTheService()
    {
        $this->assertFalse($this->_captcha->isValid('', ['other' => 'x']));
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::MISSING_VALUE, $this->_captcha->getMessages());

        $this->assertFalse($this->_captcha->isValid('', ['g-recaptcha-response' => '   ']));
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::MISSING_VALUE, $this->_captcha->getMessages());

        $this->assertNull($this->_captcha->getService()->getHttpClient()->getLastRequest());
    }

    public function testRejectedTokenFailsWithTheErrorCodes()
    {
        $this->_respondWith(['success' => false, 'error-codes' => ['invalid-input-response', 'timeout-or-duplicate']]);

        $this->assertFalse($this->_captcha->isValid('', ['g-recaptcha-response' => 'the-token']));
        $messages = $this->_captcha->getMessages();
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::BAD_CAPTCHA, $messages);
        $this->assertSame('Captcha value is wrong: invalid-input-response, timeout-or-duplicate', $messages[Zend_Captcha_SiteVerify::BAD_CAPTCHA]);
        $this->assertSame(['invalid-input-response', 'timeout-or-duplicate'], $this->_captcha->getLastResponse()->getErrorCodes());
    }

    public function testServiceErrorFailsSoftly()
    {
        $this->_adapter->setResponse("HTTP/1.1 500 Internal Server Error\r\nContent-Length: 0\r\n\r\n");
        $this->assertFalse($this->_captcha->isValid('', ['g-recaptcha-response' => 'the-token']));
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::ERR_CAPTCHA, $this->_captcha->getMessages());
        $this->assertNull($this->_captcha->getLastResponse());

        $this->_adapter->setResponse("HTTP/1.1 200 OK\r\nContent-Length: 9\r\n\r\nnot json!");
        $this->assertFalse($this->_captcha->isValid('', ['g-recaptcha-response' => 'the-token']));
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::ERR_CAPTCHA, $this->_captcha->getMessages());
    }

    public function testScoreThresholdForRecaptchaV3()
    {
        $this->_captcha->setScoreThreshold(0.5);

        $this->_respondWith(['success' => true, 'score' => 0.9, 'action' => 'login']);
        $this->assertTrue($this->_captcha->isValid('', ['g-recaptcha-response' => 't']));
        $this->assertSame(0.9, $this->_captcha->getLastResponse()->getScore());

        $this->_respondWith(['success' => true, 'score' => 0.3, 'action' => 'login']);
        $this->assertFalse($this->_captcha->isValid('', ['g-recaptcha-response' => 't']));
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::LOW_SCORE, $this->_captcha->getMessages());

        // a service that reports no score cannot satisfy a threshold
        $this->_respondWith(['success' => true]);
        $this->assertFalse($this->_captcha->isValid('', ['g-recaptcha-response' => 't']));
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::LOW_SCORE, $this->_captcha->getMessages());
    }

    public function testExpectedActionAndHostname()
    {
        $this->_captcha->setAction('login')->setHostname('example.com');

        $this->_respondWith(['success' => true, 'action' => 'login', 'hostname' => 'EXAMPLE.com']);
        $this->assertTrue($this->_captcha->isValid('', ['g-recaptcha-response' => 't']));

        $this->_respondWith(['success' => true, 'action' => 'signup', 'hostname' => 'example.com']);
        $this->assertFalse($this->_captcha->isValid('', ['g-recaptcha-response' => 't']));
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::BAD_ACTION, $this->_captcha->getMessages());

        $this->_respondWith(['success' => true, 'action' => 'login', 'hostname' => 'evil.example.net']);
        $this->assertFalse($this->_captcha->isValid('', ['g-recaptcha-response' => 't']));
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::BAD_HOSTNAME, $this->_captcha->getMessages());
    }

    public function testRender()
    {
        $this->_captcha->setAttribs(['theme' => 'dark', 'size' => 'compact', 'callback' => 'onDone']);
        $html = $this->_captcha->render(new Zend_View());

        $this->assertSame(
            '<div class="g-recaptcha" data-sitekey="site-key" data-theme="dark" data-size="compact" data-callback="onDone"></div>' . "\n"
            . '<script src="https://www.google.com/recaptcha/api.js" async defer></script>',
            $html
        );

        $this->_captcha->setIncludeScript(false)->setAttribs([])->setAction('login');
        $this->assertSame('<div class="g-recaptcha" data-sitekey="site-key" data-action="login"></div>',
            $this->_captcha->render(new Zend_View()));
    }

    public function testRenderEscapesValues()
    {
        $captcha = new Zend_Captcha_SiteVerify(['siteKey' => 'a"b<c', 'includeScript' => false]);
        $this->assertSame('<div class="g-recaptcha" data-sitekey="a&quot;b&lt;c"></div>', $captcha->render(new Zend_View()));
    }

    public function testWorksAsFormElement()
    {
        $this->_respondWith(['success' => true]);

        $form = new Zend_Form();
        $form->addElement(new Zend_Form_Element_Captcha('captcha', [
            'label'   => 'Are you human?',
            'captcha' => $this->_captcha,
        ]));
        $form->setView(new Zend_View());

        $html = $form->render();
        $this->assertStringContainsString('<div class="g-recaptcha" id="captcha-widget" data-sitekey="site-key"></div>', $html);
        $this->assertStringContainsString('recaptcha/api.js', $html);
        $this->assertStringContainsString('Are you human?', $html);

        $this->assertTrue($form->isValid(['g-recaptcha-response' => 'the-token']));

        $this->_respondWith(['success' => false, 'error-codes' => ['invalid-input-response']]);
        $this->assertFalse($form->isValid(['g-recaptcha-response' => 'the-token']));
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::BAD_CAPTCHA, $form->getElement('captcha')->getMessages());

        $this->assertFalse($form->isValid([]));
        $this->assertArrayHasKey(Zend_Captcha_SiteVerify::MISSING_VALUE, $form->getElement('captcha')->getMessages());
    }

    public function testOptionsAreCaseInsensitiveLikeOtherAdapters()
    {
        $captcha = new Zend_Captcha_SiteVerify(['sitekey' => 'k1', 'secretkey' => 's1', 'scorethreshold' => '0.7']);
        $this->assertSame('k1', $captcha->getSiteKey());
        $this->assertSame('s1', $captcha->getSecretKey());
        $this->assertSame(0.7, $captcha->getScoreThreshold());
    }
}
