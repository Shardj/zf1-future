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
 * @package    Zend_Http
 * @subpackage UserAgent
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @see Zend_Http_UserAgent_Storage_Interface
 */
require_once 'Zend/Http/UserAgent/Storage.php';

/**
 * Non-Persistent Browser Storage
 *
 * Since HTTP Browserentication happens again on each request, this will always be
 * re-populated. So there's no need to use sessions, this simple value class
 * will hold the data for rest of the current request.
 *
 * @package    Zend_Http
 * @subpackage UserAgent
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Http_TestAsset_PopulatedStorage implements Zend_Http_UserAgent_Storage
{
    /**
     * Holds the actual Browser data
     * @var mixed
     */
    protected $_data = 'a:6:{s:12:"browser_type";s:7:"desktop";s:6:"config";a:4:{s:23:"identification_sequence";s:14:"mobile,desktop";s:26:"persistent_storage_adapter";s:13:"NonPersistent";s:8:"wurflapi";a:2:{s:13:"wurfl_lib_dir";s:63:"/home/matthew/git/zf-standard/tests/Zend/Http/_files/Wurfl/1.1/";s:17:"wurfl_config_file";s:85:"/home/matthew/git/zf-standard/tests/Zend/Http/_files/Wurfl/resources/wurfl-config.php";}s:7:"desktop";a:1:{s:7:"matcher";a:1:{s:9:"classname";s:33:"Zend_Http_TestAsset_DesktopDevice";}}}s:12:"device_class";s:33:"Zend_Http_TestAsset_DesktopDevice";s:6:"device";s:793:"a:5:{s:10:"_aFeatures";a:19:{s:12:"browser_name";s:7:"desktop";s:12:"product_name";s:7:"desktop";s:10:"user_agent";s:7:"desktop";s:18:"is_wireless_device";b:0;s:9:"is_mobile";b:0;s:10:"is_desktop";b:1;s:9:"is_tablet";b:0;s:6:"is_bot";b:0;s:8:"is_email";b:0;s:7:"is_text";b:0;s:25:"device_claims_web_support";b:0;s:9:"client_ip";s:9:"127.0.0.1";s:11:"php_version";s:5:"5.3.1";s:9:"server_os";s:6:"apache";s:17:"server_os_version";s:6:"2.2.12";s:18:"server_http_accept";s:3:"*/*";s:27:"server_http_accept_language";s:5:"fr-FR";s:9:"server_ip";s:9:"127.0.0.1";s:11:"server_name";s:8:"zfmobile";}s:8:"_browser";s:7:"desktop";s:15:"_browserVersion";s:0:"";s:10:"_userAgent";s:7:"desktop";s:7:"_images";a:6:{i:0;s:4:"jpeg";i:1;s:3:"gif";i:2;s:3:"png";i:3;s:5:"pjpeg";i:4;s:5:"x-png";i:5;s:3:"bmp";}}";s:10:"user_agent";s:7:"desktop";s:11:"http_accept";s:3:"*/*";}';

    /**
     * Returns true if and only if storage is empty
     *
     * @throws Zend_Http_UserAgent_Storage_Exception If it is impossible to determine whether storage is empty
     * @return boolean
     */
    public function isEmpty()
    {
        return empty($this->_data);
    }

    /**
     * Returns the contents of storage
     *
     * Behavior is undefined when storage is empty.
     *
     * @throws Zend_Http_UserAgent_Storage_Exception If reading contents from storage is impossible
     * @return mixed
     */
    public function read()
    {
        return $this->_data;
    }

    /**
     * Writes $contents to storage
     *
     * @param  mixed $contents
     * @throws Zend_Http_UserAgent_Storage_Exception If writing $contents to storage is impossible
     * @return void
     */
    public function write($contents)
    {
        $this->_data = $contents;
    }

    /**
     * Clears contents from storage
     *
     * @throws Zend_Http_UserAgent_Storage_Exception If clearing contents from storage is impossible
     * @return void
     */
    public function clear()
    {
        $this->_data = null;
    }
}
