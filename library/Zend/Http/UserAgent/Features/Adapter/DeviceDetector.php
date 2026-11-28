<?php
require_once 'Zend/Http/UserAgent/Features/Adapter.php';

/**
 * Features adapter for the matomo/device-detector package
 *
 * The package is not part of Zend Framework: install it with Composer
 * (composer require matomo/device-detector) and make its classes loadable.
 * It reads the User-Agent header together with the User-Agent Client Hints
 * (Sec-CH-UA-* headers), so it also knows what current browsers no longer
 * put into the User-Agent, when the server asks for the hints.
 *
 * Configuration, for every browser type that should use it:
 *
 *     'desktop' => [
 *         'features' => ['classname' => 'Zend_Http_UserAgent_Features_Adapter_DeviceDetector'],
 *     ],
 *
 * @package    Zend_Http
 * @subpackage UserAgent
 */
class Zend_Http_UserAgent_Features_Adapter_DeviceDetector
    implements Zend_Http_UserAgent_Features_Adapter
{
    /**
     * Get features from request
     *
     * The browser and system features use the names of
     * Zend_Http_UserAgent_AbstractDevice (browser_name, browser_version,
     * browser_engine, device_os_name, device_os_version) and replace its
     * values; mobile_browser, mobile_browser_version, device_os, brand_name,
     * model_name and is_tablet are the names the other adapters use.
     *
     * @param  array $request $_SERVER variable, with lower case keys
     * @param  array $config
     * @return array
     * @throws Zend_Http_UserAgent_Features_Exception When the package is not installed
     */
    public static function getFromRequest($request, array $config)
    {
        if (!class_exists('DeviceDetector\DeviceDetector')) {
            require_once 'Zend/Http/UserAgent/Features/Exception.php';
            throw new Zend_Http_UserAgent_Features_Exception(
                __CLASS__ . ' requires the matomo/device-detector package (composer require matomo/device-detector)'
            );
        }

        $userAgent = isset($request['http_user_agent']) ? (string) $request['http_user_agent'] : '';

        $detector = new \DeviceDetector\DeviceDetector($userAgent, \DeviceDetector\ClientHints::factory($request));
        $detector->parse();

        $features = ['is_bot' => $detector->isBot()];

        if ($detector->isBot()) {
            $bot = $detector->getBot();
            if (is_array($bot)) {
                $features['bot_name'] = isset($bot['name']) ? $bot['name'] : '';
                if (isset($bot['category'])) {
                    $features['bot_category'] = $bot['category'];
                }
            }

            return $features;
        }

        $client = $detector->getClient();
        if (is_array($client) && !empty($client['name'])) {
            $features['client_type']            = isset($client['type']) ? $client['type'] : '';
            $features['browser_name']           = $client['name'];
            $features['browser_version']        = isset($client['version']) ? $client['version'] : '';
            $features['mobile_browser']         = $features['browser_name'];
            $features['mobile_browser_version'] = $features['browser_version'];
            if (!empty($client['engine'])) {
                $features['browser_engine'] = $client['engine'];
            }
            if (!empty($client['engine_version'])) {
                $features['browser_engine_version'] = $client['engine_version'];
            }
        }

        $os = $detector->getOs();
        if (is_array($os) && !empty($os['name'])) {
            $features['device_os']         = $os['name'];
            $features['device_os_name']    = $os['name'];
            $features['device_os_version'] = isset($os['version']) ? $os['version'] : '';
        }

        $features['device_type'] = $detector->getDeviceName();
        $features['is_tablet']   = $features['device_type'] === 'tablet';
        if ($detector->getBrandName() !== '') {
            $features['brand_name'] = $detector->getBrandName();
        }
        if ($detector->getModel() !== '') {
            $features['model_name'] = $detector->getModel();
        }

        return $features;
    }
}
