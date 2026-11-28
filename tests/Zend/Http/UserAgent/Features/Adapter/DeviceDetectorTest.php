<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

require_once 'Zend/Http/UserAgent/Features/Adapter/DeviceDetector.php';

/**
 * @category   Zend
 * @package    Zend_Http
 * @subpackage UnitTests
 * @group      Zend_Http
 * @group      Zend_Http_UserAgent
 */
class Zend_Http_UserAgent_Features_Adapter_DeviceDetectorTest extends TestCase
{
    protected function set_up()
    {
        if (!class_exists('DeviceDetector\DeviceDetector')) {
            $this->markTestSkipped('Requires the matomo/device-detector package');
        }
    }

    public function testBrowserAndSystemFromTheUserAgent()
    {
        $request = [
            'http_user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)'
                . ' Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0',
        ];

        $features = Zend_Http_UserAgent_Features_Adapter_DeviceDetector::getFromRequest($request, []);

        $this->assertFalse($features['is_bot']);
        $this->assertSame('Microsoft Edge', $features['browser_name']);
        $this->assertSame('Microsoft Edge', $features['mobile_browser']);
        $this->assertStringStartsWith('131', $features['browser_version']);
        $this->assertSame('Blink', $features['browser_engine']);
        $this->assertSame('Windows', $features['device_os_name']);
        $this->assertSame('Windows', $features['device_os']);
        $this->assertSame('10', $features['device_os_version']);
        $this->assertSame('desktop', $features['device_type']);
        $this->assertFalse($features['is_tablet']);
    }

    /**
     * The User-Agent of Windows 11 says "Windows NT 10.0"; the platform version comes from the client hints
     */
    public function testClientHintsOfTheRequestAreUsed()
    {
        $request = [
            'http_user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)'
                . ' Chrome/131.0.0.0 Safari/537.36',
            'http_sec_ch_ua'                  => '"Google Chrome";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
            'http_sec_ch_ua_platform'         => '"Windows"',
            'http_sec_ch_ua_platform_version' => '"15.0.0"',
        ];

        $features = Zend_Http_UserAgent_Features_Adapter_DeviceDetector::getFromRequest($request, []);

        $this->assertSame('Windows', $features['device_os_name']);
        $this->assertSame('11', $features['device_os_version']);
    }

    public function testTabletWithBrandAndModel()
    {
        $request = [
            'http_user_agent' => 'Mozilla/5.0 (iPad; CPU OS 17_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko)'
                . ' Version/17.6 Mobile/15E148 Safari/604.1',
        ];

        $features = Zend_Http_UserAgent_Features_Adapter_DeviceDetector::getFromRequest($request, []);

        $this->assertTrue($features['is_tablet']);
        $this->assertSame('tablet', $features['device_type']);
        $this->assertSame('Apple', $features['brand_name']);
        $this->assertSame('iPad', $features['model_name']);
    }

    public function testBot()
    {
        $request = ['http_user_agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)'];

        $features = Zend_Http_UserAgent_Features_Adapter_DeviceDetector::getFromRequest($request, []);

        $this->assertTrue($features['is_bot']);
        $this->assertSame('Googlebot', $features['bot_name']);
        $this->assertArrayNotHasKey('browser_name', $features);
    }

    public function testRequestWithoutUserAgent()
    {
        $features = Zend_Http_UserAgent_Features_Adapter_DeviceDetector::getFromRequest([], []);

        $this->assertFalse($features['is_bot']);
        $this->assertArrayNotHasKey('browser_name', $features);
        $this->assertArrayNotHasKey('device_os_name', $features);
    }

    /**
     * The adapter replaces the browser features of the built-in parser
     */
    public function testAdapterFeaturesReachTheDevice()
    {
        require_once 'Zend/Http/UserAgent.php';

        $config = [
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)'
                . ' Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0',
            'storage'    => ['adapter' => 'NonPersistent'],
            'desktop'    => [
                'features' => ['classname' => 'Zend_Http_UserAgent_Features_Adapter_DeviceDetector'],
            ],
        ];
        $userAgent = new Zend_Http_UserAgent($config);
        $device    = $userAgent->getDevice();

        $this->assertSame('desktop', $userAgent->getBrowserType());
        $this->assertSame('Microsoft Edge', $device->getFeature('browser_name'));
        $this->assertSame('Windows', $device->getFeature('device_os_name'));
    }

    public function testPackageIsUsedWithoutConfiguration()
    {
        require_once 'Zend/Http/UserAgent.php';

        $userAgent = new Zend_Http_UserAgent($this->_edgeConfig());

        $this->assertSame('Microsoft Edge', $userAgent->getDevice()->getFeature('browser_name'));
    }

    public function testFeaturesFalseKeepsTheBuiltInParser()
    {
        require_once 'Zend/Http/UserAgent.php';

        $config = $this->_edgeConfig();
        $config['desktop']['features'] = false;
        $userAgent = new Zend_Http_UserAgent($config);

        $this->assertSame('Edge', $userAgent->getDevice()->getFeature('browser_name'));
    }

    /**
     * @return array
     */
    protected function _edgeConfig()
    {
        return [
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)'
                . ' Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0',
            'storage'    => ['adapter' => 'NonPersistent'],
        ];
    }
}
