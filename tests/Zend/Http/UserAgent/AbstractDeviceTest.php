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
 * @package    Zend_Http_UserAgent
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Zend_Http_UserAgent
 */
require_once 'Zend/Http/UserAgent.php';
require_once 'Zend/Http/UserAgent/AbstractDevice.php';
require_once 'Zend/Http/UserAgent/Bot.php';
require_once 'Zend/Http/UserAgent/Checker.php';
require_once 'Zend/Http/UserAgent/Console.php';
require_once 'Zend/Http/UserAgent/Desktop.php';
require_once 'Zend/Http/UserAgent/Email.php';
require_once 'Zend/Http/UserAgent/Feed.php';
require_once 'Zend/Http/UserAgent/Mobile.php';
require_once 'Zend/Http/UserAgent/Offline.php';
require_once 'Zend/Http/UserAgent/Probe.php';
require_once 'Zend/Http/UserAgent/Spam.php';
require_once 'Zend/Http/UserAgent/Text.php';
require_once 'Zend/Http/UserAgent/Validator.php';

/**
 * @category   Zend
 * @package    Zend_Http_UserAgent
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Http_UserAgent_AbstractDeviceTest extends PHPUnit_Framework_TestCase
{
    public function testUserAgentSafari()
    {
        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US) AppleWebKit/533.17.8 (KHTML, like Gecko) Version/5.0.1 Safari/533.17.8';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleWebKit', $extract['browser_engine']);
        $this->assertEquals('Safari', $extract['browser_name']);
        $this->assertEquals('5.0.1', $extract['browser_version']);
        $this->assertEquals('Windows Server 2003', $extract['device_os_name']);

        $userAgent = 'Mozilla/5.0 (iPad; U; CPU iPhone OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B314 Safari/531.21.10gin_lib.cc';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleWebKit', $extract['browser_engine']);
        $this->assertEquals('Safari Mobile', $extract['browser_name']);
        $this->assertEquals('4.0.4', $extract['browser_version']);
        $this->assertEquals('iPhone OS', $extract['device_os_token']);

        $userAgent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_4_11; hu-hu) AppleWebKit/531.21.8 (KHTML, like Gecko) Version/4.0.4 Safari/531.21.10';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleWebKit', $extract['browser_engine']);
        $this->assertEquals('Safari', $extract['browser_name']);
        $this->assertEquals('4.0.4', $extract['browser_version']);
        $this->assertEquals('PPC Mac OS X 10_4_11', $extract['device_os_token']);

        $userAgent = 'Mozilla/5.0 (iPad; U; CPU iPhone OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B314';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleWebKit', $extract['browser_engine']);
        $this->assertEquals('Safari Mobile', $extract['browser_name']);
        $this->assertEquals('4.0.4', $extract['browser_version']);
        $this->assertEquals('iPhone OS', $extract['device_os_token']);

        $userAgent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; pt-pt) AppleWebKit/418.9.1 (KHTML, like Gecko) Safari/419.3';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleWebKit', $extract['browser_engine']);
        $this->assertEquals('Safari', $extract['browser_name']);
        $this->assertEquals('2.0', $extract['browser_version']);
        $this->assertEquals('PPC Mac OS X', $extract['device_os_token']);

        $userAgent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; fr-ch) AppleWebKit/312.1.1 (KHTML, like Gecko) Safari/312';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Safari', $extract['browser_name']);
        $this->assertEquals('1.3', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; fr) AppleWebKit/312.5.2 (KHTML, like Gecko) Safari/312.3.3';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Safari', $extract['browser_name']);
        $this->assertEquals('1.3', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; fr-fr) AppleWebKit/85.7 (KHTML, like Gecko) Safari/85.5';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Safari', $extract['browser_name']);
        $this->assertEquals('1.0', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en-gb) AppleWebKit/85.8.5 (KHTML, like Gecko) Safari/85.8.1';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Safari', $extract['browser_name']);
        $this->assertEquals('1.0', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/124 (KHTML, like Gecko) Safari/125';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Safari', $extract['browser_name']);
        $this->assertEquals('1.2', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en-us) AppleWebKit/418.9 (KHTML, like Gecko) Safari/419.3';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Safari', $extract['browser_name']);
        $this->assertEquals('2.0', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/412.6.2 (KHTML, like Gecko) Safari/412.2.2';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Safari', $extract['browser_name']);
        $this->assertEquals('2.0', $extract['browser_version']);
    }

    public function testUserAgentInternetExplorer()
    {
        $userAgent = 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Internet Explorer', $extract['browser_name']);
        $this->assertEquals('9.0', $extract['browser_version']);
        $this->assertEquals('Windows 7', $extract['device_os_name']);

        $userAgent = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.2; FDM; OfficeLiveConnector.1.4; OfficeLivePatch.1.3; .NET CLR 1.1.4322)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Internet Explorer', $extract['browser_name']);
        $this->assertEquals('8.0', $extract['browser_version']);
        $this->assertEquals('Windows 7', $extract['device_os_name']);

        $userAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Internet Explorer', $extract['browser_name']);
        $this->assertEquals('7.0', $extract['browser_version']);
        $this->assertEquals('Windows 7', $extract['device_os_name']);

        $userAgent = 'Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0; en-US)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Internet Explorer', $extract['browser_name']);
        $this->assertEquals('7.0', $extract['browser_version']);
        $this->assertEquals('Windows Vista', $extract['device_os_name']);

        $userAgent = 'Mozilla/4.0 (Windows; MSIE 7.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Internet Explorer', $extract['browser_name']);
        $this->assertEquals('7.0', $extract['browser_version']);
        $this->assertEquals('Windows XP', $extract['device_os_name']);

        $userAgent = 'Mozilla/45.0 (compatible; MSIE 6.0; Windows NT 5.1)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Internet Explorer', $extract['browser_name']);
        $this->assertEquals('6.0', $extract['browser_version']);
        $this->assertEquals('Windows XP', $extract['device_os_name']);

        $userAgent = 'Mozilla/4.0 (compatible; MSIE 5.5; Windows NT 5.2; .NET CLR 1.1.4322)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Internet Explorer', $extract['browser_name']);
        $this->assertEquals('5.5', $extract['browser_version']);
        $this->assertEquals('Windows Server 2003', $extract['device_os_name']);

        $userAgent = 'Mozilla/4.0 (compatible; MSIE 5.12; Mac_PowerPC)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Internet Explorer', $extract['browser_name']);
        $this->assertEquals('5.12', $extract['browser_version']);
        $this->assertEquals('Mac_PowerPC', $extract['device_os_token']);

        $userAgent = 'Mozilla/4.0 (compatible; MSIE 4.5; Windows 98; )';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Internet Explorer', $extract['browser_name']);
        $this->assertEquals('4.5', $extract['browser_version']);
        $this->assertEquals('Windows 98', $extract['device_os_name']);
    }

    public function testUserAgentFirefox()
    {
        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; ru; rv:1.9.2.3) Gecko/20100401 Firefox/4.0 (.NET CLR 3.5.30729)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Firefox', $extract['browser_name']);
        $this->assertEquals('4.0', $extract['browser_version']);
        $this->assertEquals('Windows 7', $extract['device_os_name']);

        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; nb-NO; rv:1.9.2.4) Gecko/20100611 Firefox/3.6.4 (.NET CLR 3.5.30729)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Firefox', $extract['browser_name']);
        $this->assertEquals('3.6.4', $extract['browser_version']);
        $this->assertEquals('Windows XP', $extract['device_os_name']);

        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.6) Gecko/2009020518 Ubuntu/9.04 (jaunty) Firefox/3.0.6';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Firefox', $extract['browser_name']);
        $this->assertEquals('3.0.6', $extract['browser_version']);
        $this->assertEquals('Linux i686', $extract['device_os_token']);

        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686 (x86_64); en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Firefox', $extract['browser_name']);
        $this->assertEquals('2.0.0.9', $extract['browser_version']);
        $this->assertEquals('Linux i686 (x86_64)', $extract['device_os_token']);

        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.8) Gecko/20071019 Fedora/2.0.0.8-1.fc7 Firefox/2.0.0.8';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Firefox', $extract['browser_name']);
        $this->assertEquals('2.0.0.8', $extract['browser_version']);
        $this->assertEquals('Linux i686', $extract['device_os_token']);

        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.0.1) Gecko/20060313 Debian/1.5.dfsg+1.5.0.1-4 Firefox/1.5.0.1';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Firefox', $extract['browser_name']);
        $this->assertEquals('1.5.0.1', $extract['browser_version']);
        $this->assertEquals('Linux i686', $extract['device_os_token']);
    }

    public function testUserAgentMozilla()
    {
        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; it; rv:2.0b4) Gecko/20100818';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Mozilla', $extract['browser_name']);
        $this->assertEquals('2.0b4', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en; rv:1.8.1.4pre) Gecko/20070521 Camino/1.6a1pre';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Camino', $extract['browser_name']);
        $this->assertEquals('1.6a1pre', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-GB; rv:1.9.0.7) Gecko/2009021910 MEGAUPLOAD 1.0';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Mozilla', $extract['browser_name']);
        $this->assertEquals('1.9.0.7', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; pl-PL; rv:1.9.0.6) Gecko/2009020911';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Mozilla', $extract['browser_name']);
        $this->assertEquals('1.9.0.6', $extract['browser_version']);

        $userAgent = 'Mozilla/5.001 (X11; U; Linux i686; rv:1.8.1.6; de-ch) Gecko/25250101 (ubuntu-feisty)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Mozilla', $extract['browser_name']);
        $this->assertEquals('1.8.1.6', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.18) Gecko/20081029';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Mozilla', $extract['browser_name']);
        $this->assertEquals('1.8.1.18', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (X11; U; Linux i586; de-AT; rv:1.4) Gecko/20030908 Debian/1.4-4';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Mozilla', $extract['browser_name']);
        $this->assertEquals('1.4', $extract['browser_version']);
    }

    public function testUserAgentChrome()
    {
        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US) AppleWebKit/534.4 (KHTML, like Gecko) Chrome/6.0.481.0 Safari/534.4';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleWebKit', $extract['browser_engine']);
        $this->assertEquals('Chrome', $extract['browser_name']);
        $this->assertEquals('6.0.481.0', $extract['browser_version']);
        $this->assertEquals('Windows Server 2003', $extract['device_os_name']);

        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Chrome/7.0.514.0 Safari/534.7';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleWebKit', $extract['browser_engine']);
        $this->assertEquals('Chrome', $extract['browser_name']);
        $this->assertEquals('7.0.514.0', $extract['browser_version']);
        $this->assertEquals('Windows XP', $extract['device_os_name']);

        $userAgent = 'Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/534.1 (KHTML, like Gecko) Chrome/6.0.416.0 Safari/534.1';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleWebKit', $extract['browser_engine']);
        $this->assertEquals('Chrome', $extract['browser_name']);
        $this->assertEquals('6.0.416.0', $extract['browser_version']);
        $this->assertEquals('Linux i686', $extract['device_os_token']);
    }

    public function testUserAgentNetscape()
    {
        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9pre) Gecko/20071102 Firefox/2.0.0.9 Navigator/9.0.0.3';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Gecko', $extract['browser_engine']);
        $this->assertEquals('Netscape', $extract['browser_name']);
        $this->assertEquals('9.0.0.3', $extract['browser_version']);
        $this->assertEquals('Windows XP', $extract['device_os_name']);

        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.2) Gecko/20050208 Netscape/7.20';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Gecko', $extract['browser_engine']);
        $this->assertEquals('Netscape', $extract['browser_name']);
        $this->assertEquals('7.20', $extract['browser_version']);
        $this->assertEquals('Windows 2000', $extract['device_os_name']);

        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.0; fr-FR; rv:0.9.4) Gecko/20011128 Netscape6/6.2.1';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Gecko', $extract['browser_engine']);
        $this->assertEquals('Netscape', $extract['browser_name']);
        $this->assertEquals('6.2.1', $extract['browser_version']);
        $this->assertEquals('Windows 2000', $extract['device_os_name']);

        $userAgent = 'Mozilla/4.79 [en] (X11; U; SunOS 5.7 sun4u)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Netscape', $extract['browser_name']);
        $this->assertEquals('4.79', $extract['browser_version']);
        $this->assertEquals('SunOS 5.7 sun4u', $extract['device_os_token']);

        $userAgent = 'Mozilla/4.04 [fr] (Macintosh; I; PPC, Nav)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Netscape', $extract['browser_name']);
        $this->assertEquals('4.04', $extract['browser_version']);
        $this->assertEquals('Macintosh', $extract['compatibility_flag']);
    }

    public function testUserAgentOpera()
    {
        $userAgent = 'Opera/9.99 (Windows NT 5.1; U; pl) Presto/9.9.9';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Presto', $extract['browser_engine']);
        $this->assertEquals('Opera', $extract['browser_name']);
        $this->assertEquals('9.99', $extract['browser_version']);

        $userAgent = 'Opera/9.80 (J2ME/MIDP; Opera Mini/5.0 (Windows; U; Windows NT 5.1; en) AppleWebKit/886; U; en) Presto/2.4.15';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Presto', $extract['browser_engine']);
        $this->assertEquals('opera mini', strtolower($extract['browser_name']));

        $userAgent = 'Opera/9.70 (Linux ppc64 ; U; en) Presto/2.2.1';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Presto', $extract['browser_engine']);
        $this->assertEquals('Opera', $extract['browser_name']);
        $this->assertEquals('9.70', $extract['browser_version']);

        $userAgent = 'Mozilla/5.0 (Windows NT 5.1; U; en-GB; rv:1.8.1) Gecko/20061208 Firefox/2.0.0 Opera 9.61';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Gecko', $extract['browser_engine']);
        $this->assertEquals('Opera', $extract['browser_name']);
        $this->assertEquals('9.61', $extract['browser_version']);

        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; X11; Linux x86_64; en) Opera 9.60';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Opera', $extract['browser_name']);
        $this->assertEquals('9.60', $extract['browser_version']);

        $userAgent = 'Opera/9.52 (Windows NT 6.0; U; Opera/9.52 (X11; Linux x86_64; U); en)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Opera', $extract['browser_name']);
        $this->assertEquals('9.52', $extract['browser_version']);

        $userAgent = 'Opera/9.20 (Windows NT 6.0; U; de)';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Opera', $extract['browser_name']);
        $this->assertEquals('9.20', $extract['browser_version']);

        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; ru) Opera 8.54';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('MSIE', $extract['browser_engine']);
        $this->assertEquals('Opera', $extract['browser_name']);
        $this->assertEquals('8.54', $extract['browser_version']);

        $userAgent = 'Opera/9.80 (Windows NT 5.1; U; zh-cn) Presto/2.2.15 Version/10.00';
        $extract = Zend_Http_UserAgent_Desktop::extractFromUserAgent($userAgent);
        $this->assertEquals('Presto', $extract['browser_engine']);
        $this->assertEquals('Opera', $extract['browser_name']);
        $this->assertEquals('10.00', $extract['browser_version']);
    }

    public function testMatchMobileOtherHeaders()
    {

        $userAgent = 'xxxxx';
        $server = [
            'all_http' => '. opera Mini'
        ];
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, $server));
        $server = [
            'http_x_wap_profile' => 'http://device.sprintpcs.com/Sanyo/PL3100/1003QW.rdf'
        ];
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, $server));

        $server = [
            'http_profile' => ''
        ];
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, $server));

        $server = [
            'http_accept' => 'midp'
        ];
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, $server));

        $server = [
            'http_accept' => 'text/html, image/vnd.wap.wbmp, image/png, image/jpeg,
image/gif, image/bmp, application/vnd.wap.wmlc,
application/vnd.wap.xhtml+xml, application/xhtml+xml,
application/vnd.wap.multipart.mixed, multipart/mixed,
text/vnd.wap.wml, application/vnd.oma.dd+xml,
text/vnd.sun.j2me.app-descriptor, application/java-archive,
*,text/x-hdml,image/mng,image/x-mng,video/mng,video/x-mng,image/bmp,text/html'
        ];
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, $server));

        $server = [
            'http_accept' => 'vnd.rim'
        ];
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, $server));

        $server = [
            'http_accept' => 'application/xhtml+xml, application/vnd.wap.xhtml+xml,
application/x-pmd, application/vnd.phonecom.mmc-xml, audio/midi,
audio/vnd.qcelp, application/xhtml+xml'
        ];
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, $server));
    }

    /**
     * examples from http://en.wikipedia.org/wiki/List_of_user_agents_for_mobile_phones
     */
    public function testMatchMobile()
    {
        $userAgent = 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleW1ebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/4A102 Safari/419.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HTC-8500/1.2 Mozilla/4.0 (compatible; MSIE 5.5; Windows CE; PPC; 240x320) ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HTC-8500/1.2 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.6) UP.Link/6.3.1.17.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-OT-708/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ObigoInternetBrowser/Q03C ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.5; de-; sdk Build/CUPCAKE) AppleWebkit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B367 Safari/531.21.10 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_0 like Mac OS X; en-us) AppleWebKit/532.9 (KHTML, like Gecko) Version/4.0.5 Mobile/8A293 Safari/6531.22.7 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/1A542a Safari/419.3 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry7100i/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/103 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry7130e/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/104 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry7230/3.7.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry7250/4.0.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry7520/4.0.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry7730/3.7.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 BlackBerry8100/4.2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/100 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry8130/4.3.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/109 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry8310/4.2.2 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/121 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry8320/4.3.1 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry8700/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/100 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry8703e/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/105 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry8820/4.2.2 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/102 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry8830/4.2.2 Profile/MIDP-2.0 Configuration/CLOC-1.1 VendorID/105 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry8900/4.5.1.231 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/100 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry9000/4.6.0.65 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/102 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry9530/4.7.0.167 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/102 UP.Link/6.3.1.20.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry 9630 Tour BlackBerry9630/4.7.1.40 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/104 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry9700/5.0.0.423 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/100 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (BlackBerry; U; BlackBerry 9800; en) AppleWebKit/534.1+ (KHTML, Like Gecko) Version/6.0.0.141 Mobile Safari/534.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry9530/5.0.0.328 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/105 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.1-update1; fr-fr; desire_A8181 Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-EF81/58 UP.Browser/7.0.0.1.181 (GUI) MMP/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.1-update1; en-us; T-Mobile_Espresso Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.1-update1; en-us; Sprint APA9292KT Build/ERE27) AppleWebKit/530.17 (KHTML, like Gecko) ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.5; en-za; HTC Hero Build/CUPCAKE) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (iPod; U; CPU iPhone OS 3_1_1 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Mobile/7C145 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.1; fr-fr; HTC Legend 1.32.163.1 Build/ERD79) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-B2050 MIC/WAP2.0 MIDP-2.0/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-C1100 MIC/WAP2.0 MIDP-2.0/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-CU720/V1.0|Obigo/Q05A Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-CU8080/1.0 UP.Browser/4.1.26l ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G1800 MIC/WAP2.0 MIDP-2.0/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G210/SW100/WAP2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G220/V100/WAP2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G232/V100/WAP2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G262/V100/WAP2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G5200 AU/4.10 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G5600 MIC/WAP2.0 MIDP-2.0/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G610 V100 AU/4.10 Profile/MIDP-1.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G622/V100/WAP2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G650 V100 AU/4.10 Profile/MIDP-1.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G660/V100/WAP2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G672/V100/WAP2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G682 /V100/WAP2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G688 MIC/V100/WAP2.0 MIDP-2.0/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G7000 AU/4.10 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G7050 UP.Browser/6.2.2 (GUI) MMP/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G7100 AU/4.10 Profile/MIDP-1.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G7200 UP.Browser/6.2.2 (GUI) MMP/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G822/SW100/WAP2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G850 V100 UP.Browser/6.2.2 (GUI) MMP/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G920/V122/WAP2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G922 Obigo/WAP2.0 MIDP-2.0/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G932 UP.Browser/6.2.3(GUI)MMP/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-KP500 Teleca/WAP2.0 MIDP-2.0/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-KS360 Teleca/WAP2.0 MIDP-2.0/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-L1100 UP.Browser/6.2.2 (GUI) MMP/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-MX8700/1.0 UP.Browser/6.2.3.2 (GUI) MMP/2.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-T5100 UP.Browser/6.2.3 (GUI) MMP/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG/U8120/v1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG/U8130/v1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG/U8138/v2.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG/U8180/v1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG/U880/v1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-VX9100/1.0 UP.Browser/6.2.3.2 (GUI) MMP/2.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.5; en-dk; HTC Magic Build/CUPCAKE) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.5; en-us; MB200 Build/CUPCAKE) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mob ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.0.1; en-us; Droid Build/ESD56) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Motorola Droid X Mozilla/5.0 (Linux; U; Android 2.1-update1; en-us; DROIDX Build/VZW) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17 480X854 motorola DROIDX ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-E398/0E.20.59R MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-EM30/R6716_G_71.01.24R Mozilla/5.0 (compatible; OSS/1.0; Chameleon; Linux) BER/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 [es-co] ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-K1/08.03.08R MIB/BER2.2 Profile/MIDP-2.0 Configuration/CLDC-1.1 EGE/1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.0.1; ko-kr; XT720 Build/STSKT_N_79.11.31R) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.1-update1; ko-kr; XT720 Build/STSKT_N_79.11.33R) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V3/0E.42.0ER MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V3r/08.BD.43R MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-RAZRV3xx/96.64.21P BER2.2 Mozilla/4.0 (compatible; MSIE 6.0; 11003002) Profile/MIDP-2.0 Configuration/CLDC-1.1 Opera 8.00 [en] UP.Link/6.3.0.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'motorazrV8/R601_G_80.42.0FRP Mozilla/4.0 (compatible; MSIE 6.0 Linux; Motorola V8;nnn) Profile/MIDP-2.0 Configuration/CLDC-1.1 Opera 8.50[yy] ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-MOTORAZRV9/4 BER2.2 Mozilla/4.0 (compatible; MSIE 6.0; 14003181) Profile/MIDP-2.0 Configuration/CLDC-1.1 Op! era 8.00 [en] UP.Link/6.3.0.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-MOTORAZRV9x/9E.03.15R BER2.2 Mozilla/4.0 (compatible; MSIE 6.0; 13003337) Profile/MIDP-2.0 Configuration/CLDC-1.1 Opera 8.60 [en] UP.Link/6.3.0.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (compatible; OSS/1.0; Chameleon; Linux) MOT-E8/R6713_G_71.02.07R BER/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOTOROKR Z6/R60_G_80.xx.yyl Mozilla/4.0 (compatible; MSIE 6.0 Linux; MOTOROKRZ6;nnn) Profile/MIDP-2.0 Configuration/CLDC-1.1 Opera 8.50[yy] ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-L6/0A.52.2BR MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-L7/NA.ACR_RB MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (compatible; OSS/1.0; Chameleon; Linux) MOT-U9/R6632_G_81.11.29R BER/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-MOTOZ9/9E.01.03R BER2.2 Mozilla/4.0 (compatible; MSIE 6.0; 11003002) Profile/MIDP-2.0 Configuration/CLDC-1.1 Opera 8.60 [en] UP.Link/6.3.0.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-ZN5/R6637_G_81.03.05R Mozilla/4.0 (compatible; OSS/1.0; Linux MOTOZINE ZN5) Profile/MIDP-2.0 Configuration/CLDC-1.1 Symphony 1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (SymbianOS/9.1; U; en-us) AppleWebKit/413 (KHTML, like Gecko) Safari/413 es65';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.2; en-us; Nexus One Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia2610/2.0 (07.04a) Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Link/6.3.1.20.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5300/2.0 (05.51) Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (SymbianOS/9.4; U; Series60/5.0 Nokia5530c-2/10.0.050; Profile MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/525 (KHTML, like Gecko) Safari/525 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (SymbianOS/9.3; U; Series60/3.2 Nokia5630d-1/012.020; Profile MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/413 (KHTML, like Gecko) Safari/413 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (SymbianOS/9.4; U; Series60/5.0 Nokia5800d-1/31.0.101; Profile MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/413 (KHTML, like Gecko) Safari/413 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6030/2.0 (y3.44) Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6230i/2.0 (03.40) Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6280/2.0 (03.60) Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6650d-1bh/ATT.2.15 Mozilla/5.0 (SymbianOS/9.3; U; [en]; Series60/3.2; Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/413 (KHTML, like Gecko) Safari/413 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 NokiaE51-1/220.34.37; Profile/MIDP-2.0 Configuration/CLDC-1.1) AppleWebKit/413 (KHTML, like Gecko) Safari/413 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NokiaE71x/ATT.03.11.1 Mozilla/5.0 SymbianOS/9.3; U; [en]; Series60/3.2; Profile/MIDP-2.1 Configuration/CLDC-1.1 AppleWebKit/413 KHTML, like Gecko) Safari/413 UP.Link/6.3.0.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NokiaN70-1/5.0616.2.0.3 Series60/2.8 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NokiaN75-3/3.0 (1.0635.0.0.6); SymbianOS/9.1 Series60/3.0 Profile/MIDP-2.0 Configuration/CLDC-1.1) UP.Link/6.3.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (SymbianOS/9.3; U; Series60/3.2 NokiaN78-1/12.046; Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebKit/413 (KHTML, like Gecko) Safari/413 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NokiaN80-1/3.0(4.0632.0.10) Series60/3.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NokiaN90-1/5.0607.7.3 Series60/2.8 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (X11; U; Linux armv7l; en-GB; rv:1.9.2b6pre) Gecko/20100318 Firefox/3.5 Maemo Browser 1.7.4.8 RX-51 N900 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (SymbianOS/9.2; U; Series60/3.1 NokiaN95/11.0.026; Profile MIDP-2.0 Configuration/CLDC-1.1) AppleWebKit/413 (KHTML, like Gecko) Safari/413 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (SymbianOS/9.4; Series60/5.0 NokiaN97-3/21.2.045; Profile/MIDP-2.1 Configuration/CLDC-1.1;) AppleWebKit/525 (KHTML, like Gecko) BrowserNG/7.1.4 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'nokia_e65 (partial string)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Note that Nokia Symbian phones may have two different user-agent strings, one for the classical WAP like:';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Opera/9.50 (J2ME/MIDP; Opera Mini/4.1.11355/542; U; en) ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 6.12) PPC; 240x320; HTC P3450; OpVer 23.116.1.611 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HTC_P3650 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.6) ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (webOS/Palm webOS 1.2.9; U; en-US) AppleWebKit/525.27.1 (KHTML, like Gecko) Version/1.0 Safari/525.27.1 Pixi/1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (webOS/1.4.0; U; en-US) AppleWebKit/532.2 (KHTML, like Gecko) Version/1.0 Safari/532.2 Pre/1.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S68/36 UP.Browser/7.1.0.e.18 (GUI) MMP/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.6) SP; 240x320; HTC_S710/1.0 ... ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A737/1.0 SHP/VPP/R5 NetFront/3.3 SMM-MMS/1.2.0 profile/MIDP-2.0 configuration/CLDC-1.1 UP.Link/6.3.0.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A737/UCGI3 SHP/VPP/R5 NetFront/3.4 SMM-MMS/1.2.0 profile/MIDP-2.0 configuration/CLDC-1.1 UP.Link/6.3.1.17.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A767/A767UCHG2 SHP/VPP/R5 NetFront/3.4 SMM-MMS/1.2.0 profile/MIDP-2.0 configuration/CLDC-1.1 UP.Link/6.3.0.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A867/A867UCHG5 SHP/VPP/R5 NetFront/3.4 SMM-MMS/1.2.0 profile/MIDP-2.0 configuration/CLDC-1.1 UP.Link/6.3.0.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A877/A877UCHK1 SHP/VPP/R5 NetFront/3.5 SMM-MMS/1.2.0 profile/MIDP-2.1 configuration/CLDC-1.1 UP.Link/6.3.0.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.1-update1; en-us; SAMSUNG-SGH-I897/I897UCJF6 Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-D600/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Browser/6.2.3.3.c.1.101 (GUI) MMP/2.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-GT-S5230/S523MXEIL2 SHP/VPP/R5 Jasmine/1.0 Nextreaming SMM-MMS/1.2.0 profile/MIDP-2.1 configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-I617/1.0 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 6.12) UP.Link/6.3.0.0.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.5; de-de; Galaxy Build/CUPCAKE) AppleWebkit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 2.1-update1; fr-fr; GT-I9000 Build/ECLAIR) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-E250/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Browser/6.2.3.3.c.1.101 (GUI) MMP/2.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-i900/1.0 Opera 9.5 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-i907/UCHI5 Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T919/919UVHL3SHP/VPP/R5NetFront/3.5SMM-MMS/1.2.0profile/MIDP-2.1configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHU600/1.0 NetFront/3.2 Profile ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-U900-Vodafone/U900BUHD6 SHP/VPP/R5 NetFront/3.4 Qtv5.3 SMM-MMS/1.2.0 profile/MIDP-2.0 configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-Z720/1.0 SHP/VPR/R5 NetFront/3.3 SMM-MMS/1.2.0 profile/MIDP-2.0 configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HTC_Smart_F3188 Mozilla/5.0 (like Gecko) Obigo/Q7 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonC901/R1EA Browser/NetFront/3.4 Profile/MIDP-2.1 Configuration/CLDC-1.1 JavaPlatform/JP-8.4.2 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonC905/R1FA Browser/NetFront/3.4 Profile/MIDP-2.1 Configuration/CLDC-1.1 JavaPlatform/JP-8.4.3 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonC905a/R1FA Browser/NetFront/3.4 Profile/MIDP-2.1 Configuration/CLDC-1.1 JavaPlatform/JP-8.4.3 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonK510i/R4CJ Browser/NetFront/3.3 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonK550i/R8BA Browser/NetFront/3.3 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonK600i/R2BA Browser/SEMC-Browser/4.2 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonK610i/R1CB Browser/NetFront/3.3 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonK630i/R1CA Browser/NetFront/3.4 Profile/MIDP-2.1 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonK700/R1A Profile/MIDP-1.0 MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonK750i/R1CA Browser/SEMC-Browser/4.2 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonK790i/R8BF Browser/NetFront/3.3 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonK800i/R8BF Browser/NetFront/3.3 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonW800i/R1AA Browser/SEMC-Browser/4.2 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonW810i/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonW900i/R5AH Browser/NetFront/3.3 Profile/MIDP-2.0 Configuration/CLDC-1.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonW995/R1DB Browser/NetFront/3.4 Profile/MIDP-2.1 Configuration/CLDC-1.1 JavaPlatform/JP-8.4.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.6; es-es; SonyEricssonX10i Build/R1FA016) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonZ500a/R1A SEMC-Browser/4.0.1 Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Link/6.3.1.20.0 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/5.0 (Linux; U; Android 1.6; en-us; HTC_TATTOO_A3288 Build/DRC79) AppleWebKit/528.5+ (KHTML, like Gecko) Version/3.1.2 Mobile Safari/525.20.1 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'The string that is presented depends on the APN settings that are used for browsing (WAP/ISP). As the traditional browser string does not usually give any clues as to the type of device, the user-agent alone is not a guaranteed method of identifying Nokia devices. However, when the traditional browser user-agent is used, Nokia devices also provide the x-Device-User-Agent header, which contains the device specific user-agent.';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows 98; PalmSource/hspr-H102; Blazer/4.0) 16;320x320 ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'ZTE-V8301/MB6801_V1_Z1_VN_F1BPa101 Profile/MIDP-2.0 Configuration/CLDC-1.1 Obigo/Q03C ';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
// others
        $userAgent = '4thpass KBrowser/2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = '4thpass KBrowser/2.1 j2me';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = '4thpass.com KBrowser 1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = '6310i/1.0 (3.05) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'ACER-Pro80/1.02 UP/4.1.20i UP.Browser/4.1.20i-XXXX';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'ALAV UP/4.0.10 UP.Browser/4.0.10-XXXX UP.Link/4.1.HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'ALAV UP/4.1.20a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'ALAV UP/4.1.20a UP.Browser/4.1.20a-XXXX UP.Link/4.1.HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'AUDIOVOX-9155GPX/07.13 UP.Browser/4.1.26c3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'AUDIOVOX-CDM9100/05.89 UP.Browser/4.1.24c UP.Link/5.0.2.7a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'AUDIOVOX-CDM9500/111.030 UP.Browser/5.0.4.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'AUDIOVOX-CDM9500/111.030 UP.Browser/5.0.4.1 (GUI) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'AUR PALM WAPPER (WAP 1.1)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'AUS PALM WAPPER';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'AUS PALM WAPPER 2.37.7.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'AUS WAPPER';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE3/1.0 UP/4.1.8d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE3/1.0 UP/4.1.8d UP.Browser/4.1.8d-XXXX UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE3/1.0 UP/4.1.8h';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE4/1.0 UP/4.1.16f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE4/1.0 UP/4.1.16m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE4/1.0 UP/4.1.19e';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE4/1.0 UP/4.1.19e UP.Browser/4.1.19e-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE4/2.0 UP/4.1.19e';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE4/2.0 UP/4.1.19e UP.Browser/4.1.19e-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE4/2.0 UP/4.1.19e UP.Browser/4.1.19e-XXXX UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE5/1.0 UP/4.1.19e';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE5/1.0 UP/4.1.19e UP.Browser/4.1.19e-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE5/1.5 UP/4.1.19e';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE5/1.5 UP/4.1.19e UP.Browser/4.1.19e-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE5/2.0 UP.Browser/4.1.21d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE5/2.0 UP/4.1.19e';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BE5/2.0 UP/4.1.19e UP.Browser/4.1.19e-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF3/1.0 UP.Browser/4.1.23a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF3/1.0 UP.Browser/4.1.23a UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF3/1.0 UP.Browser/4.1.23a UP.Link/5.01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF3/1.0 UP.Browser/4.1.23a UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF3/1.0 UP.Browser/4.1.23a UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF4/1.0 UP.Browser/4.1.23a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF4/1.0 UP.Browser/4.1.23a UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF4/1.0 UP.Browser/4.1.23a UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF4/2.0 UP.Browser/5.0.1.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF4/2.0 UP.Browser/5.0.1.10.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF4/2.0 UP.Browser/5.0.1.10.1 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF4/2.0 UP.Browser/5.0.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF4/2.0 UP.Browser/5.0.1.8.100';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF4/2.0 UP.Browser/5.0.1.8.100 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/4.1.23a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.2.1.100';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.2.1.103';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.3 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.3.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.3.1 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.3.1 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.3.1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.3.1.2 UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.3.1.2 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BF5/1.0 UP.Browser/5.0.3.521';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3-color/1.0 UP.Browser/5.0.3.3.11';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3.1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3.1.2 UP.Link/4.2.1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3.1.2 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3.1.2 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3.3.11';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3.3.11 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3.3.11 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BG3/1.0 UP.Browser/5.0.3.x';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BH4/1.0 UP.Browser/6.1.0.4.123 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BH4/1.0 UP.Browser/6.1.0.5 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BH4/1.0 UP.Browser/6.1.0.6.1 (GUI)+JPEG Patch MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BH4/1.0 UP.Browser/6.2.ALCATEL MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BH4/1.0 UP.Browser/6.2.ALCATEL MMP/1.0 UP.Link/5.01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-BH4R/1.0 UP.Browser/6.2.ALCATEL MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-TH3/1.0 UP.Browser/6.2.ALCATEL MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Alcatel-TH4/1.0 UP.Browser/6.2.ALCATEL MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'AnnyWay WAP/1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Aptus WAP.INFO.PL search engine';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'ArgogroupWAPDevice/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BECKER-OP/10.41 UP.Browser/4.1.24c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry/3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry/3.2.1 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry/3.3.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry/3.5.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry/3.6.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry5820/3.6.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry6210/3.6.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry6210/3.6.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry6710/3.6.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'BlackBerry7230/3.7.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Boonda WAP Browser 1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'CDM-8150/P15 UP.Browser/4.1.26c4 UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'CDM-8150/P15 UP.Browser/4.1.26c4 UP.Link/4.3.3.4a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'CDM-8300/T10 UP.Browser/4.1.26l UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'CDM-8300/T10 UP.Browser/4.1.26l UP.Link/4.3.4.4d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/D209i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/D209i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/D210i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/D211i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/D501i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/D502i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/D502i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/D503i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/D503iS/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/ER209i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/ER209i/c15';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F209i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F209i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F210i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F211i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F501i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F502i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F502i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F502it';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F502it/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F503i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F503iS/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/F671i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/KO209i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/KO210i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/KO210i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N209i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N209i/c08';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N210i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N210i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N211i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N501i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N502i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N502i/c08';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N502it';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N502it/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N503i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N503iS/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N821i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/N821i/c08';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/NM502i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/NM502i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P209i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P209i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P209is';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P209is/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P210i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P210i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P211i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P501i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P502i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P502i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P502i/c10 (Google CHTML Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P503i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P503iS/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P821i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/P821i/c08';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/R209i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/R691i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/R691i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/SH505iS/c20/TB/W24H12';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/SH821i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/SH821i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/SO210i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/SO502i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/SO502iWM/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/SO503i/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/SO503iS/c10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/1.0/SO505i/c20/TB/W21H09';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/2.0 D2101V(c100)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/2.0 N2001(c10)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/2.0 N2002(c100)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'DoCoMo/2.0 P2101V(c100)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EPOC32-WTL/2.2 Crystal/6.0 STNC-WTL/6.0(611)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EZOS - EricssonT68/R1 (embedded)SAAB_1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EZOS - EzWAP 1.0 for Pocket PC';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EZOS - EzWAP 2.1 for HPC/2000';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EZOS - EzWAP 2.1 for Pocket PC';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EZOS - EzWAP 2.5 for Pocket PC';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EZOS - EzWAP 2.5 for Pocket PC UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Ericsson/R1A, Nokia7110/1.0 (4.73)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonA2618s/R1A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonA2628s/R2A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR320/R1A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR320/R1A (Fast WAP Crawler)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR320/R1A UP.Link/4.1.0.1 (Fast Mobile Crawler)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR520/R1A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR520/R1A UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR520/R201';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR520/R201 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR520/R202';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR520/R202 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR520/R202 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonR520/R202 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT20/R2A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT20/R2A UP.Link/4.1.0.9b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT20/R2A UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT20/R2A UP.Link/5.02';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT20/R2A UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT200/R101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT200/R101 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R201';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R201 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R201 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R201 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R201 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R201 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R202';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R202 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R202 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R202 UP.Link/5.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R202 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R202 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R202 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT39/R202 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/4.2.3.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/5.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT65/R101 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 (;; ;; ;; ;)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 (;; ;; ;; Smartphone; 176x220)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/4.2.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/4.2.3.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/5.0.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/5.01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/5.1.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R101-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68/R1A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EricssonT68_NIL';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EzWAPBrowser1.0-WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EzWAPBrowser2.0-WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'EzWAPBrowserCE1.0-WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HCI-HGC610E/001.1a UP/4.1.20i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HD-MMD1010/001.1a UP/4.1.20i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HD-MMD1010/001.1a UP/4.1.20i UP.Browser/4.1.20i-XXXX UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HD-MMP1020/001.1a UP/4.1.20i UP.Browser/4.1.20i-XXXX UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HD-TX20B001.1a/ UP.Browser/4.1.22b UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HD-TX20B001.1a/ UP.Browser/4.1.22b UP.Link/4.3.3.4a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HD-TX20B001.1a/ UP.Browser/4.1.22b UP.Link/4.3.4.4d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HD-TX20B001.1a/ UP/4.1.20i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'HEI-HGC610E/001.1a UP/4.1.20i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Jataayu WAP 2 Toolkit, Jataayu WAP 2 Toolkit';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Java/1.4.1_02';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Java1.2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Java1.3.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Java1.3.1_01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Jigsaw/2.0beta2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Jingo Wapd 2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'KDDI-SN24 UP.Browser/6.0.8.2 (GUI) MMP/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.1 UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.12 (HTTP Win)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.50';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.50 (HTTP Win32)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.50 (WSP Win32)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.51 (HTTP PPC3)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.60 (HTTP PPC3)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.60 (WSP PPC3)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.61 (HTTP PPC3)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.61 (WSP PPC3)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.62 (HTTP PPC3)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.62 (WSP PPC3)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.70 (HTTP PPC3)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Klondike/1.70 (WSP PPC3)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG G8000/1.0 PDK/2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG G8000/1.0 PDK/2.5 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-C1200 MIC/WAP2.0 MIDP-2.0/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-C1200 MIC/WAP2.0 MIDP-2.0/CLDC-1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-C3100 AU/4.10 Profile MIDP-1.0 Configuration CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G510 AU/4.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G510 AU/4.2 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G5200';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G5200 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G5300 AU/4.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G5300 AU/4.10 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G5300i/JM AU/4.10 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G5400 AU/4.10 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G5400 AU/4.10 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G7000 AU/4.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G7020';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G7050 UP.Browser/6.2.2 (GUI) MMP/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G7100 AU/4.10 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G7100 AU/4.10 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LG-G7200 UP.Browser/6.2.2 (GUI) MMP/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-CU8080/1.0 UP.Browser/4.1.26l UP.Link/5.1.1.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-DB520/1.0 UP.Browser/4.1.22b1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-DB525/1.0 UP.Browser/4.1.24f UP.Link/5.0.2.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-DM310/1.0 UP.Browser/4.1.26l UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-DM310/1.0 UP.Browser/4.1.26l UP.Link/4.3.4.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-DM515H/1.0 UP.Browser/4.1.22b UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-LX5350/1.0 UP.Browser/6.1.0.2.135 (GUI) MMP/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-TM540C/1.0 UP.Browser/4.1.26l';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE-TM540C/1.0 UP.Browser/4.1.26l UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE/U8150/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'LGE510W-V137-AU4.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MC218 2.0 WAP1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MO02 UP/4.1.17r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = "MOCOCO's WapBrowser";
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-2000./10.01 UP/4.1.21b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-2000./10.01 UP/4.1.21b UP.Browser/4.1.21b-XXXX UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-2100./11.03 UP.Browser/4.1.24f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-2100./11.03 UP.Browser/4.1.24f UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-2100./11.03 UP.Browser/4.1.25i UP.Link/5.0.2.7a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-2102./11.03 UP.Browser/4.1.24f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-2200./11.03 UP.Browser/4.1.25i UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-2200./11.03 UP.Browser/4.1.25i UP.Link/5.1.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-2200./11.03 UP.Browser/4.1.25i UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-28/04.02 UP/4.1.17r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-28/04.04 UP/4.1.17r UP.Browser/4.1.17r-XXXX UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-32/00.03 UP/4.1.21b UP.Browser/4.1.21b-XXXX UP.Link/4.3.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-32/01.00 UP.Browser/4.1.23';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-32/01.00 UP.Browser/4.1.23 UP.Link/4.2.3.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-40/04.04 UP/4.1.17r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-43/04.05 UP/4.1.17r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-61/04.02 UP/4.1.17r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-61/04.02 UP/4.1.17r UP.Browser/4.1.17r-XXXX UP.Link/4.3.4.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-61/04.05 UP/4.1.17r UP.Browser/4.1.17r-XXXX UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-62/04.05 UP/4.1.17r UP.Browser/4.1.17r-XXXX';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-62/04.05 UP/4.1.17r UP.Browser/4.1.17r-XXXX UP.Link/4.3.4.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-70/00.01 UP/4.1.21b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-76/00.01 UP.Browser/4.1.23';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-76/00.01 UP.Browser/4.1.23 UP.Link/4.3.4.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-76/01.01 UP.Browser/4.1.26m.737 UP.Link/4.2.3.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-76/02.01 UP.Browser/4.1.26m.737 UP.Link/4.2.3.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-76/02.01 UP.Browser/4.1.26m.737 UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-820/00.00.00 MIB/2.2 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-8300_/11.03 UP.Browser/4.1.25i UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-85/00.00 UP.Browser/4.1.26m.737 UP.Link/4.2.3.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-85/01.00 UP.Browser/4.1.26m.737 UP.Link/4.2.3.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-85/01.01 UP.Browser/4.1.26m.737 UP.Link/4.2.3.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-A-88/01.02 UP.Browser/4.1.26m.737 UP.Link/4.2.3.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-A-88/01.04 UP.Browser/4.1.26m.737 UP.Link/4.2.3.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-A835/72.32.05I MIB/2.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-AF/0.0.22 UP/4.0.5n';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-AF/4.1.8 UP/4.1.16s';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-AF/4.1.9 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-AF/4.1.9 UP.Browser/4.1.23c UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-AF/4.1.9 UP.Browser/4.1.23c UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-AF/4.1.9 UP.Browser/4.1.23c UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-AF/4.1.9 UP/4.1.19i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-AF/4.1.9 UP/4.1.19i UP.Browser/4.1.19i-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-AF/4.1.9 UP/4.1.19i UP.Browser/4.1.19i-XXXX UP.Link/4.2.2.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-AF/4.1.9 UP/4.1.19i UP.Browser/4.1.19i-XXXX UP.Link/5.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-BC/4.1.9 UP.Browser/4.1.23';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C2/4.1.8 UP/4.1.16s';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C350M/G_09.04.23R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C350M/G_09.04.23R MIB/2.0-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C350M/G_09.04.24R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C385/0B.D1.09R MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C4/0.0.21 UP/4.0.5m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C4/0.0.23 UP/4.0.5o';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C4/0.0.23 UP/4.0.5o UP.Browser/4.0.5o-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C4/4.1.5 UP/4.1.16f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C4/4.1.6 UP/4.1.16g';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C4/4.1.8 UP/4.1.16s';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C4/4.1.8 UP/4.1.16s UP.Browser/4.1.16s-XXXX UP.Link/5.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C4/4.1.9 UP/4.1.16s';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C4/4.1.9 UP/4.1.19i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-C650/0B.D0.1FR MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CB/0.0.18 UP/4.1.20a UP.Browser/4.1.20a-XXXX UP.Link/4.1.HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CB/0.0.19 UP/4.0.5j UP.Browser/4.0.5j-XXXX UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CB/0.0.21 UP/4.0.5m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CB/0.0.23 UP/4.0.5o';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CB/0.0.23 UP/4.0.5o UP.Browser/4.0.5o-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CB/4.1.5 UP/4.1.16f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CB/4.1.6 UP/4.1.16g';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CB/4.1.6+UP/4.1.16g';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CB/4.1.6+UP/4.1.16g UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CB/4.1.7 UP/4.1.16p';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CF/00.12.13 UP/4.1.9m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-CF/00.26.31 UP/4.1.16f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D1/0.0.22 UP/4.0.5n';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D3/0.0.22 UP/4.0.5n';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D4/4.1.4 UP/4.1.16a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D4/4.1.5 UP/4.1.16f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D4/4.1.8 UP/4.1.16s';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D5/0.0.22 UP/4.0.5n';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D5/4.1.5 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D5/4.1.5 UP.Browser/4.1.23c UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D5/4.1.5 UP.Browser/4.1.23c UP.Link/5.0.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D5/4.1.5 UP.Browser/4.1.23c UP.Link/5.01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D5/4.1.5 UP/4.1.20i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D5/5.0.2 UP.Browser/5.0.2.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D5/5.0.2 UP.Browser/5.0.2.3 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D8/4.1.8 UP/4.1.16s';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D8/4.1.9 UP.Browser/4.1.23';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-D8/4.1.9 UP/4.1.19i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-DC/4.1.9 UP/4.1.19i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-DD/0.0.22 UP/4.0.5n';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-DF/0.0.22 UP/4.0.5n';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-E380/0A.03.29R MIB/2.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-E380/0A.04.02I MIB/2.2 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F0/4.1.8 UP.Browser/4.1.23';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F0/4.1.8 UP.Browser/4.1.23 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F0/4.1.8 UP.Browser/4.1.23 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F0/4.1.8 UP/4.1.16s';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F0/4.1.9 UP.Browser/4.1.23';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F0/4.1.9 UP.Browser/4.1.23 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F4/4.1.7 UP/4.1.16p';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F5 4.1.9 UP.Browser';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F5/4.1.9 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F5/4.1.9 UP.Browser/4.1.23c UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F5/4.1.9 UP.Browser/4.1.23c UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F6/10.36.32 UP.Browser/4.1.23d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F6/10.36.32 UP.Browser/4.1.23d UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F6/10.36.32 UP.Browser/4.1.23i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-F6/10.36.32 UP.Browser/4.1.23i UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-FE/20.16.13 UP.Browser/4.1.23i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-P2K-C/10.01 UP/4.1.21b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-P2K-T/13.02 UP.Browser/4.1.25i UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-P2K-T/14.02 UP.Browser/4.1.25i UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-PAN4_/11.03 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-PHX4_/11.03 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-PHX4_/11.03 UP.Browser/4.1.23c UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-PHX4_/11.03 UP.Browser/4.1.23c UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-PHX4_/11.03 UP.Browser/4.1.23c UP.Link/5.1.2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-PHX8/02.27.00.n1 MIB/1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-PHX8A/11.03 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-SAP4H/11.03 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-SAP4_/11.03 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-SAP4_/11.03 UP.Browser/4.1.23c UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-SAP4_/11.03 UP.Browser/4.1.23c UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-SAP4_/11.03 UP.Browser/4.1.23c UP.Link/5.1.2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-SAP4_/11.03 UP.Browser/4.1.23c UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-SAP8A/11.03 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-SAP8A/11.03 UP.Browser/4.1.23c UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T280M/02.12.00I MIB/1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T280M/02.27.00I MIB/1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.05.1DI MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.05.21R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.05.21R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.06.04I MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.06.12R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.06.18R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.06.18R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.00R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.00R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.00R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.00R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.00R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.00R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.10R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.21R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.22R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.40R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/05.08.41R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/3.1ER MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/A_G_05.06.22R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.01.43R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.01.48R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.01.65R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.01.66R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.07.1DR MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.07.23R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.07.41R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.08.40R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.08.52R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.08.80R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.08.81R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.20.09R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.20.09R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.20.0BR MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.20.0BR MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.20.0BR MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.20.0CR MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/G_05.31.05R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PMHA_G_05.31.09R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PMHA_G_05.31.1CR MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.31.09R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.31.09R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.31.18R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.31.1CR MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.40.0CR MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.40.0CR MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.40.45R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.40.52R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.40.52R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.41.54R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T720/PM_G_05.41.54R MIB/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-T725E/08.03.30I MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.1FR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.23BR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.23BR MIB/1.2.1 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.23BR MIB/1.2.1 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.23BR MIB/1.2.1,MOT-TA02/06.03.23BR';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.23BR MIB/1.2.1,MOT-TA02/06.03.23BR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.23CR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.23R MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.25BR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.25BR MIB/1.2.1,MOT-TA02/06.03.25BR';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.25BR MIB/1.2.1,MOT-TA02/06.03.25BR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.25CR MIB/1.2.1 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.28R MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.28R MIB/1.2.1 UP.Link/5.1.2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.2EAR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.03.2ER MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.14R MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.1AAR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.1FR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.1FR MIB/1.2.1 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.2BR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.2BR MIB/1.2.1 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.2DR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.2ER MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.2FR MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.31R MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.34R MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.34R MIB/1.2.1,MOT-TA02/06.04.34R MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-TA02/06.04.36R MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V3/0E.40.3ER MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V300/0B.08.85R MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V300/0B.08.86R MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V300/0B.08.8BR MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V300/0B.08.8DR MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V300/0B.08.8F5 MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V500/0B.08.74R MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V500/0B.08.82R MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V500/0B.08.8DR MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V500/0B.08.8ER MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V500/0B.08.8F5 MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V525M/0B.09.38R MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V525M/0B.09.38R MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.08.29I MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.08.61I MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.08.62R MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.08.72R MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.08.86R MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.08.8CR MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.08.8DR MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.08.8DR MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Link/5.1.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.08.8ER MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.08.8FR MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V600/0B.09.1DR MIB/2.2 Profile/MIDP-2.0 Configuration/CLDC-1.0.';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V60M/03.07.24I MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V60M/03.09.0BR MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V60M/03.09.0DR MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V60M/03.09.14R MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V60M/03.11.11R MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V60M/G_03.00.05R MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V66M/02.27.00I MIB/1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V66M/03.08.09R MIB/1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V66M/03.09.0BR MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V66M/03.09.0BR MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V66M/03.09.0DR MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V66M/03.09.14R MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V66M/03.12.03R MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V66M/03.12.03R MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0,MOT-V66M/03.12.03R MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V66M/05.05.13I MIB/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V708_/11.03 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V708_/11.03 UP.Browser/4.1.23c UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V708_/11.03 UP.Browser/4.1.23c UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V708_/11.03 UP.Browser/4.1.25i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V708_/11.03 UP.Browser/4.1.25i UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-V708_/11.03+UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350/G_09.04.70R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350/G_09.04.74R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350/G_09.04.75R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/AS_G_09.04.24R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/AS_G_09.04.37R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/A_G_09.04.37R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.26R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.34R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.35R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.35R MIB/2.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.35R MIB/2.0 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.35R MIB/2.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.37R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.66R MIB/2.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.74R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.74R MIB/2.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/G_09.04.75R MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/ULS_G_09.10.1AR MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/g_09.04.61i MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-c350M/g_09.05.01i MIB/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MOT-v200./10.01 UP/4.1.21b UP.Browser/4.1.21b-XXXX';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MTP1 UP/4.1.20a UP.Browser/4.1.20a-XXXX UP.Link/4.1.HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MY X-5/2.0 UP.Browser/5.0.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Materna-WAPPreview 1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Materna-WAPPreview/1.2.5.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Materna-WAPPreview/1.2.8.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Materna-WAPPreview/1.2.8.6';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.1.A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.1.A (Mondo)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.1.A (Mondo) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.1.A UP.Link/4.1.0.6';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.1.A UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.1.A UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.1.A UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.1.A(Geo@i)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.A (Eclipse)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.A (Eclipse) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.A (Eclipse) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.A UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (Eclipse)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (Eclipse) MMP/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (Eclipse) MMP/1.1 UP.Link/5.1.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (Eclipse) MMP/1.1 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (Eclipse) MMP/1.1 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (Eclipse) MMP/1.1 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (Eclipse) MMP/1.1 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (Eclipse) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (MT560)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (MT560) MMP/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (MT560) MMP/1.1 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (OT531)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (OT531) MMP/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.B (OT531) MMP/1.1 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.2.C (MT330)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mitsu/1.3.A (M172)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MobileExplorer/3.00 (MMEF300; Sendo; Wap)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'MobileExplorer/3.00 (Mozilla/1.22; compatible; MMEF300; Microsoft; Windows; GenericLarge)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Motorola-E365 UP.Browser/6.1.0.7 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; CellPhone; Benefon Q)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-J5)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-J5) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-J7/J70)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-J7/J70) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-J7/J70) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-J7/J70) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z5)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z5) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z5) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z5) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z5;Pj020e)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z5;Pj020e) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z5;Pz060e+wt16)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z5;Pz060e+wt16) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z5;Pz063e+wt16)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z5;Pz063e+wt16) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z7)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MMEF20; Cellphone; Sony CMD-Z7) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/1.22 (compatible; MSIE 5.01; PalmOS 3.0) EudoraWeb 2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/2.0 (compatible; Go.Web/6.2; HandHTTP 1.1; Elaine/1.0; RIM957 )';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/2.0 (compatible; MSIE 3.02; Windows CE; 240x320)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/2.0 (compatible; MSIE 3.02; Windows CE; 240x320) (via IBM Transcoding Publisher 3.5)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/2.0 (compatible; MSIE 3.02; Windows CE; 240x320; PPC)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/2.0 (compatible; MSIE 3.02; Windows CE; PPC; 240x320)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/2.0 (compatible; MSIE 3.02; Windows CE; Smartphone; 176x220)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/2.0 (compatible; MSIE 3.02; Windows CE; Smartphone; 176x220; 240x320)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/2.0 (compatible; MSIE 4.02; Windows CE; Default)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/2.0 (compatible; MSIE 4.02; Windows CE; Smartphone; 176x220)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/2.0(compatible; MSIE 3.02; Windows CE; Smartphone; 176x220)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/3.0 (compatible; AvantGo 3.2)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (MobilePhone PM-8200/US/1.0) NetFront/3.1 MMP/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (MobilePhone SCP-4900/1.0) NetFront/3.0 MMP/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (MobilePhone SCP-5300/1.0) NetFront/3.0 MMP/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (MobilePhone SCP-8100/US/1.0) NetFront/3.0 MMP/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (MobilePhone; Avantg/1.0) NetFront/3.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (PDA; PalmOS/sony/model crdb/Revision:1.1.27(fr)) NetFront/3.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (PDA; PalmOS/sony/model crdb/Revision:1.1.36 (fr)) NetFront/3.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (PDA; Windows CE/1.0.1) NetFront/3.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 3.02 3.0 2.0; Windows CE) Opera 5.02 [fr]';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 4.01; Windows CE; PPC; 240x320)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 4.01; Windows CE; SmartPhone; 176x220)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/4.0 (compatible; MSIE 5.0; PalmOS) PLink 2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/SMB3(Z105)/Samsung';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla/SMB3(Z105)/Samsung UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Mozilla\SAMSUNG-XHTML 1.0 UP.Link/5.1.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NEC-525/1.0 up.Browser/6.1.0.6.1 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NEC-525/1.0 up.Browser/6.1.0.6.1 (GUI) MMP/1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NEC-525/1.0 up.Browser/6.1.0.6.1 (GUI) MMP/1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NEC-530/1.0 UP.Browser/6.1.0.7 (GUI) MMP/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NEC-DB7000/1.0 UP.Browser/4.1.23c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NEC-DB7000/1.0 UP.Browser/4.1.23c UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NEC-N8/1.0 UP.Browser/6.1.0.4.128 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NEC-N8/1.0 UP.Browser/6.1.0.5 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NEC-N8000/1.0 UP.Browser/5.0.2.1.103 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NEC-N8000/1.0 UP.Browser/5.0.3.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NOKIA-NHP-2AX/V A100V0201.nep.0 UP.Browser/4.1.26l1 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NOKIA-RH-10/V C100v0401.nep.0 UP.Browser/4.1.26l1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NOKIA-RH-10/V C100v0401.nep.0 UP.Browser/4.1.26l1 UP.Link/4.3.4.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NOKIA-RH-17/V F100V0901.nep.0 UP.Browser/4.1.26l1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NOKIA-RH-17/V F100V0901.nep.0 UP.Browser/4.1.26l1 UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NOKIA-RH-44/V D126V0600.nep.0 UP.Browser/4.1.26l1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NOKIA-RH-44/V D126V0600.nep.0 UP.Browser/4.1.26l1 UP.Link/5.0.2.7a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia 9210/Symbian Crystal 6.0 (1.00)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia Mobile Browser 3.01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia Mobile Browser 4.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia Mobile Browser 4.0,Sony EricssonT610: SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia-MIT-Browser/3.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia-MIT-Browser/3.0 (via IBM Transcoding Publisher 3.5)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3100/1.0 (03.10) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3100/1.0 (03.10) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3100/1.0 (03.12) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3100/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3100/1.0 (05.02) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3100/1.0 (05.02) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3200/1.0 (4.16) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3220/2.0 (03.30) Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3300/1.0 (4.05) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3300/1.0 (4.05) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3300/1.0 (4.07) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3300/1.0 (4.25) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3320/1.2.1 (03.04)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3320/1.2.1 (2.06)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3320/1.2.1 (2.06) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (03.05)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (03.05) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (03.05) UP.Link/5.0.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (03.05) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (03.05) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (03.10)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (03.12)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (03.12) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (03.12) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.12)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.16)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.16) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.16) UP.Link/4.2.2.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.16) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.16) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.30)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.30) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.30) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.30) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.50)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.50) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.50) UP.Link/4.2.2.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.50) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.50) UP.Link/5.0.2.3e';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.50) UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.50) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.50) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.50) UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (04.50) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3330/1.0 (05.06)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3350/1.0 (05.11)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3350/1.0 (05.15)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3360/1.2.1 (03.04) UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3360/1.2.1 (1.04)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3360/1.2.1 (2.06) UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3395/1.0 (04.02) UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (03.06)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (03.06) UP.Link/4.3.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (03.06) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (03.09)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (03.09) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.08)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.09)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.09) (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.09) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.09) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.09) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.09) UP.Link/5.1.1.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.09) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.11)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.26)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.26) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (04.26) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (05.06)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (05.06) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (05.30)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (05.30) (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3410/1.0 (05.42)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.02)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.02) UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.02) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.02) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.02) UP.Link/5.0.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.02) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.02) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.02) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.02) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.02) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.11)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.11) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.11) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.11) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.11) UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.34)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.34) UP.Link/5.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.34) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.36)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.37)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.37)  UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.37) UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.37) UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.37) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.37) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.37) UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (3.37) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (4.24)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (4.24) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (4.24) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (5.00)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (5.00) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (5.00) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510/1.0 (5.02)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.25) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.40) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.40) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.40) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.40) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.40) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.51) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.51) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.51) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.51) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.51) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.51) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.54) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.54) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (03.54) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.42) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.42) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.42) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3510i/1.0 (04.44) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3560/1.0 (02.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3590/1.0(7.14) UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3590/1.0(7.58) UP.Link/5.1.2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3595/1.0 (7.00) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3595/1.0 (7.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3595/1.0 (7.02) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3595/1.0 (7.02) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3595/1.0 (7.20) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3595/1.0 (7.20) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3610/1.0 (05.11)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 (4.13) SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 (4.13) SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3650/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.1 Configuration/CLDC-1.0Nokia 3650 (;; ;; ;; ;)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia3660/1.0 (4.57) SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5100/1.0 (3.02) Profile/MIDP 1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5100/1.0 (3.02) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5100/1.0 (3.02) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5100/1.0 (3.02) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5100/1.0 (3.02) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5100/1.0 (3.02) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5100/1.0 (3.02) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5100/1.0 (3.02) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5100/1.0 (4.05) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5100/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5210/1.0 ()';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5210/1.0 () UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5210/1.0 () UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5210/1.0 () UP.Link/5.0.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5210/1.0 () UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5210/1.0 () UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5210/1.0 () UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5210/1.0 () UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.25)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.42)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.43)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.45)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.45) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.47)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.48)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.50)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.50) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.53)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia5510/1.0 (03.53) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (03.22) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.70) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.70) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.70) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.70) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.70) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.70) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.70) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.70) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (04.98) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6100/1.0 (05.16) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6108/1.0 (03.20) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6200/1.0 (3.05) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (03.01)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (03.01) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (03.01) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (03.04)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (03.60)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.08)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.08) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.08) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.27)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.27) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.27) UP.Link/5.01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.27) UP.Link/5.02';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.27) UP.Link/5.1.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.27) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.36)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.36) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (04.36) UP.Link/5.0.0.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.01)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.02)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.02) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.02) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.02) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.17)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.17) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.17) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.17) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.17) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.27)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.27) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.27) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.36)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.36) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.44)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.56)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.56) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (05.56) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6210/1.0 (ccWAP-Browser)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6220/2.0 (5.15) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6220/2.0 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6230/2.0 (03.14) Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6230/2.0 (03.15) Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6230/2.0 (04.28) Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6230/2.0 (04.44) Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6250/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6250/1.0 (03.00)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6250/1.0 (03.12)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6250/1.0 (04.01)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6250/1.0 (05.02)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 ()';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (03.03)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.03)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.10)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.10) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.10) UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.10) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.10) UP.Link/5.02';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.10) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.15)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.15) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.15) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.20)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.20) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.20) UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.20) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.20) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.20) UP.Link/5.1.1.3 (Google WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.20) UP.Link/5.1.1.3 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.20) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.20) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.20) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (04.31)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310/1.0 (05.01)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.06) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.07) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.07) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.07) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.07) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.0.2.3d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.07) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.07) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.07) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.50) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.80) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.80) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.80) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.80) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (4.80) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (5.10) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (5.10) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (5.10) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (5.10) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (5.22) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (5.22) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (5.50) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (5.50) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (5.51) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6310i/1.0 (5.52) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6340i/1.2.1 (8.03.1) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6340i/1.2.1 (8.04.1) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6340i/1.2.1 (8.05.3) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6500/1.0 (05.57)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (02.40)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (02.50)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.21)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.22)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.22) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.22) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.22) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.30)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.30) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.35)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.35) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.35) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (03.35) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.00)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.00) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.00) UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.00) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.00) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.00) UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.05)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.05) UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.06)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.06) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.06) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.06) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.06) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.06) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.06) UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.12)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.12) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.12) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.12) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.12) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.12) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.12) UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.12) UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6510/1.0 (04.21) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6590/1.0(40.44)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6600/1.0 (3.42.1) SymbianOS/7.0s Series60/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6600/1.0 (4.09.1) SymbianOS/7.0s Series60/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6600/1.0 (5.27.0) SymbianOS/7.0s Series60/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 (Google W';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.28) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.28) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610/1.0 (5.52) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610I/1.0 (3.10) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6610I/1.0 (3.10) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6650/1.0 (1.101) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6650/1.0 (12.89) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6650/1.0 (13.88) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6650/1.0 (13.88) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6650/1.0 (13.89) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6650/1.0 (13.89) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6800/1.0 (3.14) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6800/1.0 (3.14) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6800/1.0 (3.14) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6800/1.0 (3.14) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6800/1.0(2.81)Profile/MIDP-1.0Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6800/2.0 (4.16) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6800/2.0 (4.17) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6820/2.0 (3.19) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6820/2.0 (3.21) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6820/2.0 (3.70) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6820/2.0 (4.22) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia6820/2.0 (4.25) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110 (DeckIt/1.2.1)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110 (DeckIt/1.2.3)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110 (compatible; NG/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110 CES';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.67)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.70)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.73)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.76)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.76) UP.Link/4.1.0.7';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.76) aplpi.com v0.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.77)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.77) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.77) UP.Link/5.0.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.77) UP.Link/5.0.2.3d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.78)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.80)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.84)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.84) UP.Link/4.1.0.6';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.84) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.84) UP.Link/5.1.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.84; mostly compatible; Mobone 1.05)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.88)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.88) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (04.94)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (05.00)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (05.01)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (05.01) UP.Link/5.1.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (05.01) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (4.80)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (WAPTOO)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 (Waptoo DT)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0 1551.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0+(04.73);';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0+(04.77)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7110/1.0+(Waptoo+DT)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7160/1.1 (01.05)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7160/1.1 (01.07)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7160/1.1 (01.07) UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (2.01) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.08) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.08) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (3.09) Profile/MIDP-1.0 Configuration/CLDC-1.0-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.18) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.24) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.24) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (4.74) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (5.52) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7210/1.0 (81.73)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (2.15) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.12) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.12) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.12) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.12) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.12) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.12) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.12) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.12) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.12) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.14) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.14) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250/1.0 (3.62) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (3.22) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (3.22) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (3.22) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (3.22) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (3.22) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (3.22) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (3.22) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (3.22) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (3.22) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (4.22) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7250I/1.0 (4.63) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7610/2.0 (4.0421.4) SymbianOS/7.0s Series60/2.1 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650 [XIDRIS WML Browser 2.2]';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 RPT-HTTPClient/0.3-3E';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 Symbian-QP/6.1 Nokia/2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 Symbian-QP/6.1 Nokia/2.1 (;; ;; ;; ;)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 Symbian-QP/6.1 Nokia/2.1 (;; ;; ;; ;; 240x320)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 (compatible; YOSPACE SmartPhone Emulator Website Edition 1.11)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 (compatible; YOSPACE SmartPhone Emulator Website Edition 1.14)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.2.1-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.3.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/1.0 SymbianOS/6.1 Series60/0.9 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650/4.0 UQ.Browser/6.2.0.1.185 (GUI) MMP/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650_Laurence (via IBM Transcoding Publisher';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia7650_blb';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (03.05)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (03.05) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (03.07)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (03.07) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (03.07) UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.04)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.04) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.04) UP.Link/4.2.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.04) UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.04) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.04) UP.Link/5.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.04) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.53)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.53) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.53) UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.53) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.53) UP.Link/4.3.4.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.53) UP.Link/5.0.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (04.53) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.05)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.06)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.06) UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.06) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.06) UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.06) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.06) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.06) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.06) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.06) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.06) UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.11)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.11) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.11) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.11) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.11) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.11) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.34)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.54)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.54) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.54) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.55)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.57)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.57) (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.57) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.57) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.57) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.80)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.80) UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (05.80) UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (06.01)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (06.04)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (06.04) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (06.04) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (06.04) UP.Link/5.1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (06.04) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (06.04) UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (06.20)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8310/1.0 (06.20) UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8390/1.0 (7.00) UP.Link/5.1.2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8910/1.0 (03.04)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8910/1.0 (03.04) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8910/1.0 (03.06)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8910/1.0 (03.57)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8910/1.0 (04.02)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8910i/1.0 (02.61) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8910i/1.0 (03.01) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8910i/1.0 (03.01) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia8910i/1.0 (03.02) Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9110/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9110/1.0 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9210/1.0 Symbian-Crystal/6.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9210/1.0 Symbian-Crystal/6.0 UP.Link/4.2.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9210/1.0 Symbian-Crystal/6.0 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9210/1.0 Symbian-Crystal/6.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9210/1.0 Symbian-Crystal/6.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9210/1.0 Symbian-Crystal/6.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9210/2.0 Symbian-Crystal/6.1 Nokia/2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9210i/1.0 Symbian-Crystal/6.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia9210i/1.0 Symbian-Crystal/6.0 UP.Link/4.2.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NokiaN-Gage/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NokiaN-Gage/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Nokia_Yahoo_WML_VIEWER_1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'NzPhone/0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV-GEN-99/UNI10 UP.Browser/6.0.2.224 (GUI) MMP/HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV-SDK/51 UP.Browser/5.0.2.1.103 (GUI) UP.Link/5.1.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV-SDK/51 UP.Browser/6.0.2.273 (GUI) MMP/HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV-SDK/51 UP/5.0.2.1.103 (GUI) UP.Browser/5.0.2.1.103 (GUI)-XXXX UP.Link/5.0.HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV-SDK/61 UP.Browser/6.1.0.3.121c (GUI) MMP/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV-SDK/62 UP.Browser/6.2.0.1.185 (GUI) MMP/1.0 UP.Link/5.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV-SDK/62 UP.Browser/6.2.0.1.185 (GUI) MMP/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV-SDK/62 UP.Browser/6.2.2.1.208 (GUI) MMP/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV1/4.0 UP.Browser/5.0.1.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV1/4.0 UP/5.0.1.2 (GUI) UP.Browser/5.0.1.2 (GUI)-XXXX';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV1/4.0 UP/5.0.1.2 (GUI) UP.Browser/5.0.1.2 (GUI)-XXXX UP.Link/5.0.HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OPWV1/4.0 UP/5.0.1.2 (GUI) UP.Browser/5.0.1.2 (GUI)-XXXX UP.Link/5.0.HTTP-DIRECT (via IBM Transcoding Publisher 3.5)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OWG1 UP/4.1.20a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OWG1 UP/4.1.20a UP.Browser/4.1.20a-XXXX UP.Link/4.1.HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OWG1 UP/4.1.20a UP.Browser/4.1.20a-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'OWG1 UP/4.1.20a UP.Browser/4.1.20a-XXXX UP.Link/4.2.3.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS 530 / Obigo Internet Browser 2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS 535/Obigo Internet Browser 2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Az@lis288 UP/4.1.19l';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Az@lis288 UP/4.1.19m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Az@lis288/2.1 UP/4.1.19m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 318 UP/4.1.19m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 318/3.8 UP.Browser/5.0.1.235';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 318/3.8 UP.Browser/5.0.1.3.101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 330/3.14 UP.Browser/5.0.3.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 620 UP/4.1.19m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 620/3.14 UP.Browser/5.0.1.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 620/3.14 UP.Browser/5.0.1.11';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 620/3.14 UP.Browser/5.0.1.11 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 620/3.14 UP.Browser/5.0.1.11 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 620/3.14 UP.Browser/5.0.1.6';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 620/3.14 UP.Browser/5.0.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 620/3.14 UP.Browser/5.0.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 620/3.8 UP.Browser/5.0.1.3.101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 625/3.14 UP.Browser/5.0.3.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 820/3.14 UP.Browser/5.0.1.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 820/3.14 UP.Browser/5.0.1.10 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 820/3.14 UP.Browser/5.0.1.11';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 820/3.14 UP.Browser/5.0.1.11 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 820/3.14 UP.Browser/5.0.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 822/3.14 UP.Browser/5.0.3.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 822/3.14 UP.Browser/5.0.3.5 (GUI) (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 825/3.14 UP.Browser/5.0.3.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 825/3.14 UP.Browser/5.0.3.5 (GUI) (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 825/3.14 UP.Browser/5.0.3.5 (GUI) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-FISIO 826/3.14 UP.Browser/5.0.3.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Fisio 121/2.1 UP/4.1.19m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Fisio 121/2.1 UP/4.1.19m UP.Browser/4.1.19m-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Fisio311/2.1 UP/4.1.19m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Fisio311/316 /2.1 UP/4.1.19m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-GPRS/3.8 UP.Browser/5.0.1.3.101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Ozeo UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Ozeo UP/4.1.16r UP.Browser/4.1.16r-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-SYSOL2/3.11 UP.Browser/5.0.1.11';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-SYSOL2/3.11 UP.Browser/5.0.1.6.101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-V21WAP UP/4.1.16g';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-V21WAP UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-V21WAPCHN UP/4.1.16f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-VTHIN_WAP UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-W@B/3.13 UP/5.0.1.232';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-W@B/3.14 UP.Browser/5.0.1.6';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-W@B/3.14 UP.Browser/5.0.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-W@B/3.14.01 UP.Browser/5.0.1.6';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-X38 UP/4.1.16g';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-XENIUM 9660/2.1 UP/4.1.19m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-XENIUM 9@9/2.1 UP/4.1.19m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Xenium 9@9++/3.14 UP.Browser/5.0.3.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Xenium9@9 UP/4.1.16f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Xenium9@9 UP/4.1.16g';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Xenium9@9 UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Xenium9@9 UP/4.1.19l';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-Xenium9@9 UP/4.1.19m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-az@lis238 UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-az@lis268 UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-az@lis268 UP/4.1.16r UP.Browser/4.1.16r-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'PHILIPS-az@lis288_4 UP/4.1.19l';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = "PLM's WapBrowser";
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Palmscape/3.1.3E [en] (v. 4.1; 153x130; c8)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic WAP UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic WAP UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-G50/1.0 UP.Browser/6.1.0.6.d.2.100 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-G60/1.0 UP.Browser/6.1.0.7 MMP/1.0 UP.Browser/6.1.0.7 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD35/1.0 UP.Browser/4.1.22j';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD35/1.1 UP.Browser/4.1.24d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD35/1.1 UP.Browser/4.1.24g';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD6*/1.0 UP.Browser/5.0.3.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD67 (SimulateurWAPVizzavi)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD67/1.0 UP.Browser/5.0.3.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD67/1.0 UP.Browser/5.0.3.5 (GUI) UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD67/1.0 UP.Browser/5.0.3.5 (GUI) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD67/1.0 UP.Browser/5.0.3.5 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD67/1.0 UP.Browser/5.0.3.5 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD67/1.0 UP.Browser/5.0.3.5 (GUI) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD75';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD75 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD75 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD75 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A19';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A19 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A19 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A20';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A21';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A21 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A21 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A21 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A22';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A22 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A22 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A22 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A37';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A38';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A38 UP.Link/5.1.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A38 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A38 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A39';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A39 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A39 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A39 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A51';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A51 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A51 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A51 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD87/A53';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD95';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD95 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD96';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD96 UP.Link/5.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-GAD96 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-X60/R01 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Panasonic-X60/R01 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Psion Cpw/1.00f(RV) War/1.00f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Psion Cpw/1.00f(S5) War/1.00f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Psion Cpw/1.00f(S7) War/1.00f';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QC-2235/1.0.52 UP.Browser/4.1.22b1 UP.Link/5.1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QC-2235/1.0.52 UP.Browser/4.1.22b1 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QC-2255/1.0.08 UP.Browser/4.1.22b1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QC-5135/1.0.06 UP.Browser/4.1.22b1 UP.Link/5.0.2.7a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QC-5135/1.0.17 UP.Browser/4.1.22b1 UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QC07 UP.Browser/4.1.22b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QC2135 UP.Browser/4.1.22b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QC2135 UP.Browser/4.1.22b UP.Link/4.3.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QC2135 UP.Browser/4.1.22b UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QCI-23/1.0 UP.Browser/5.0.2.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QCI-24/1.0 UP.Browser/5.0.2.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QCI-31/1.0 UP.Browser/6.1.0.6.d.2.100 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'QWAPPER/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'R380 2.0 WAP1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'R380 2.0 WAP1.1 UP.Link/4.1.0.9d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'R380 2.0 WAP1.1 UP.Link/5.0.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'R380 2.1 WAP1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'R380 2.1 WAP1.1 UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'R600 1.0 WAP1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'R600 1.0 WAP1.2.1 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'R600 1.0 WAP1.2.1 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'R600 1.0 WAP1.2.1 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'R600 1.0 WAP1.2.1 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'ReqwirelessWeb/2.0.0 MIDP-1.0 CLDC-1.0 Nokia7250/3.12, Nokia7250/1.0 (3.12) Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Rover 1.5 (Palm; IP; OS v. 3.5.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Rover 1.5 (Palm; IP; OS v. 3.5.2)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Rover 1.5 (Palm; IP; OS v. 3.5.2H5.8)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Rover 1.5 (Palm; IP; OS v. 4.1)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Rover 2.0 (Palm; IP; OS v. 3.5.2H5.7)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Rover 2.0 (Palm; IP; OS v. 3.5.2H5.8)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Rover 2.0 (Palm; IP; OS v. 4.1)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Rover 3.11 (RIM Handheld; Mobitex; OS v. 2.1)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM myX-5m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/0.0 UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/0.0 UP/4.1.16r UP.Browser/4.1.16r-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/0.0 UP/4.1.19i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/0.0 UP/4.1.19is';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/0.0 UP/4.1.19is UP.Browser/4.1.19is-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/0.0 UP/4.1.19is UP.Browser/4.1.19is-XXXX UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/0.0 UP/4.1.19is UP.Browser/4.1.19is-XXXX UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/0.0 UP/4.1.19is UP.Browser/4.1.19is-XXXX UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/1.0 UP.Browser/5.0.1.12 (GUI) UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/1.0 UP.Browser/5.0.1.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/1.0 UP.Browser/5.0.1.7 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/1.0 UP.Browser/5.0.1.7 (GUI) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-3XXX/1.0 UP.Browser/5.0.2.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-9XX/0.0 UP/4.1.16g';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-9XX/0.0 UP/4.1.16q';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-9XX/0.0 UP/4.1.19i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-9XX/0.0 UP/4.1.19is';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-9XX/0.0 UP/4.1.19is UP.Browser/4.1.19is-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myV-55/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.6.d.3 (GUI) MMP/1.0 UP.Lin';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myV-55/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.6.d.3.100 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myV-65/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.3.e.1 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myV-65/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.3.e.2 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myV-65/1.0 UP.Browser/6.2.2.3 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myV-65/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.3.e.2 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myV-75/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.5.d.2 (GUI) MMP/1.0 UP.Lin';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-2/1.0 UP.Browser/5.0.5.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-2/1.0 UP.Browser/5.0.5.5 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-2/1.0 UP.Browser/5.0.5.5.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-2G/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-2m/1.0 UP.Browser/6.1.0.6.1.c.4 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-3/1.0 UP.Browser/5.0.1.12.c.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-3/1.0 UP.Browser/5.0.1.12.c.1 (GUI) (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-3/1.0 UP.Browser/5.0.1.12.c.1 (GUI) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-3/2.0 UP.Browser/5.0.5.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-3/2.0 UP.Browser/5.0.5.1 (GUI) (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.1.7 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.2.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.1.c.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.1.c.1 (GUI) UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.1.c.1 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.1.c.1 (GUI)-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.100 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.100 (GUI) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.100 (GUI) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.100 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.100 (GUI) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.100 (GUI)-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5/2.0 UP.Browser/5.0.3.3.100(GUI)-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5e/1.0 UP.Browser/6.1.0.6.1.c.3 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.0 UP.Browser/6.1.0.6.1.103 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.0 UP.Browser/6.1.0.6.1.103 (GUI) MMP/1.0 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.0 UP.Browser/6.1.0.6.1.c.1 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.0 UP.Browser/6.1.0.6.1.c.1 (GUI) MMP/1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.0 UP.Browser/6.1.0.6.1.c.1 (GUI) MMP/1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.0 UP.Browser/6.1.0.6.1.c.1 (GUI) MMP/1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.0 UP.Browser/6.1.0.6.1.c.3 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.0 UP.Browser/6.1.0.6.1.c.3 (GUI) MMP/1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.0 UP.Browser/6.1/0.6.1.103 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.0 UP.Browser/6.1/0.6.1.103 (GUI) MMP/1.0-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.1 UP.Browser/6.1.0.6.1.c.3 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.1 UP.Browser/6.1.0.6.1.c.4 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-5m/1.1 UP.Browser/6.1.0.6.1.c.4 (GUI) MMP/1.0 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.1.0.6.1.c.1 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.1.0.6.1.c.3 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.1.0.6.1.c.3 (GUI) MMP/1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.1.0.6.1.c.3 (GUI) MMP/1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.1.0.6.1.c.3 (GUI) MMP/1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.1.0.6.1.c.4 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.1.0.6.1.c.4 (GUI) MMP/1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.1.0.6.1.c.4 (GUI) MMP/1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.1.0.6.1.c.4 (GUI) MMP/1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.2.2.1 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0 UP.Browser/6.2.2.3 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/1.0UP.Browser/6.1.0.6.1.c.1(GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAGEM-myX-6/2.0 UP.Browser/6.2.2.4.105 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A110/1.0 UP/4.1.19j';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A110/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A110/1.0 UP/4.1.20a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A200/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A288/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A300/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A300/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A300/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A400/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A400/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A800/1.0 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A800/1.0 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-A800/1.0 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-E330/1.0 UP.Browser/6.2.2.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-E700/BSI UP.Browser/6.1.0.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-E700/BSI UP.Browser/6.1.0.6 (GUI) MMP/1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-E700/BSI UP.Browser/6.1.0.6 (GUI) MMP/1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-E700/BSI2.0 UP.Browser/6.1.0.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-E700/BSI2.0 UP.Browser/6.1.0.6 (GUI) MMP/1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-E800/1.0 UP.Browser/6.2.2.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-E800/1.0 UP.Browser/6.2.2.6 (GUI) MMP/1.0 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-E820/1.0 UP.Browser/6.2.2.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N100/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N100/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N100/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/5.0.0.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N188/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N300 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N400 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N400 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N500/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N500/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N500/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N600/1.0 UP.Browser/4.1.26b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N600/1.0 UP.Browser/4.1.26c4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N600/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N620/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N620/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N620/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-N620/1.1 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-Q100/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R200/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R200/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R200S/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R200S/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R210S/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R210S/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R210S/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/5.1.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R210S/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R210S/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R210S/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R220/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-R220/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-S500/SHARK UP.Browser/5.0.4.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-S500/SHARK UP.Browser/5.0.5.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP.Browser/4.1.26c4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP.Browser/4.1.26c4 UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP.Browser/4.1.26c4 UP.Link/4.3.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP.Browser/4.1.26c4 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP.Browser/4.1.26c4 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP.Browser/4.1.26c4 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP.Browser/4.1.26c4 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP.Browser/5.0.3.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T100/1.0 UP/4.1.19k UP.Browser/4.1.19k-XXXX UP.Link/5.1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T200/1.0 UP.Browser/5.0.4.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T400/1.0 UP.Browser/5.0.4.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T410/1.0 UP.Browser/5.0.4 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-T500/1.0 UP.Browser/5.0.5.2.c.1.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-X600/K3 UP.Browser/6.1.0.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGH-Z100';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGHT100/1.0 UP.Browser/4.1.26b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGHT100/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SAMSUNG-SGHT108/1.0 UP/4.1.19k';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHC100/1.0 UP.Browser/5.0.5.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHC100/1.0 UP.Browser/5.0.5.1 (GUI) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHC100/1.0 UP.Browser/5.0.5.1 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHC100G/1.0 UP.Browser/5.0.5.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHC100G/1.0 UP.Browser/5.0.5.1 (GUI) (Google';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHC100G/1.0 UP.Browser/5.0.5.1 (GUI) (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHC100G/1.0 UP.Browser/5.0.5.1 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHC100G/1.0 UP.Browser/5.0.5.1 (GUI) UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHD100';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHE600';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHE600 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHE710';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHE710/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHE810';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHN350/1.0 UP.Browser/5.0.1 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHP400';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHP400 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHP400 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHP510/1.0 UP.Browser/6.2.2.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHQ200/1.0 UP.Browser/4.1.24c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHQ200/1.0 UP.Browser/4.1.24i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHQ300/1.0 UP.Browser/5.0.3.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS100';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS105 NW.Browser3.01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS208*MzUxNDEwODkwNjgzNzcw';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS300';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS300 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS300 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS300 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS300 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS300M';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS300M UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHS307 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHT208/1.0 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV200';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV200 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV200 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV200 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV200 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV200 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV200 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV200 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV200 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV200 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHV205 NW.Browser3.01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHX105 NW.Browser3.01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SGHX450';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SPHA540 UP.Browser/4.1.26l UP.Link/4.3.3.4a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-SPHN300 UP.Browser/4.1.22b1 UP.Link/5.0.2.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-scha310 UP.Browser/4.1.26c3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-scha310 UP.Browser/4.1.26c3 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-schn195 UP.Browser/4.1.26l UP.Link/4.3.4.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-schn370_WAP_DL UP.Browser/4.1.26b UP.Link/5.0.2.7a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-spha460 UP.Browser/4.1.26c4 UP.Link/5.0.2.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC-spha500 UP.Browser/4.1.26l UP.Link/5.0.2.7a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC02 UP.Browser/4.1.22b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC02 UP.Browser/4.1.22b1 UP.Link/5.0.2.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC03 UP.Browser/4.1.22c1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC07 UP.Browser/4.1.22b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC09 UP.Browser/4.1.22b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC09 UP.Browser/4.1.22b UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC09 UP.Browser/4.1.22b UP.Link/4.3.3.4a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SEC13/n150 UP.Browser/4.1.22b UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TM-100/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.6.c.2.101 (GUI) MMP/1.0 UP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX1/1.0 UP.Browser/6.1.0.5.102 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX1/1.0 UP.Browser/6.1.0.5.102 (GUI) MMP/1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.3.121c (GUI) MMP/1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.3.121c (GUI) MMP/1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.4.128 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.4.128 (GUI) MMP/1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.4.128 (GUI) MMP/1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.4.128 (GUI) MMP/1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.4.128 (GUI) MMP/1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.4.128 (GUI) MMP/1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.1 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.105 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.1 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.105 (GUI) MMP/1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.1 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.105 (GUI) MMP/1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10/1.1 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.105 (GUI) MMP/1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10i/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.d.1 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10i/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.d.1 (GUI) MMP/1.0 UP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10i/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.d.1 (GUI) MMP/1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10i/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.d.1 (GUI) MMP/1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10i/1.1 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.d.2 (GUI) MMP/1.0 UP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10m/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.d.1 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX10m/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.6.1.d.1 (GUI) MMP/1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX12/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.5.119 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX20/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.2.107 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX20/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.2.107 (GUI) MMP/1.0 UP.Li';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX20/1.0 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.2.107 (GUI) MMP/1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SHARP-TQ-GX20/1.0f Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.2.2.2.107 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-2128/17 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-3618/01 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-3618/24 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-6618/01 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-6618/24 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-6688/3.1 UP/4.1.19i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A50/00 UP.Browser/5.0.2.3.100';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A50/01 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A50/02 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A50/03 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A50/03 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A50/04 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A50/07 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A55/05 UP.Browser/5.0.3.3.1.e.4 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A55/05 UP.Browser/5.0.3.3.1.e.4 (GUI) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A55/05 UP.Browser/5.0.3.3.1.e.4 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-A55/07 UP.Browser/5.0.3.3.1.e.4 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C3I/1.0 UP/4.1.8b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C3I/1.0 UP/4.1.8c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C3I/1.0 UP/4.1.8c UP.Browser/4.1.8c-XXXX (compatible; YOSPACE SmartPhone Emulator Website Edition 1.9)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C3I/2.0 UP/4.1.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C3I/3.0 UP/4.1.16m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C3I/3.0 UP/4.1.16m UP.Browser/4.1.16m-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C3I/3.0 UP/4.1.16m UP.Browser/4.1.16m-XXXX UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C3I/3.0 UP/4.1.16m UP.Browser/4.1.16m-XXXX UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/02 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/03 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/06 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/06 UP.Browser/5.0.1.1.102 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/08 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/08 UP.Browser/5.0.1.1.102 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/13 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/14 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/14 UP.Browser/5.0.1.1.102 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/16 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/16 UP.Browser/5.0.1.1.102 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/16 UP.Browser/5.0.1.1.102 (GUI) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/17 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/18 UP.Browser/5.0.1.1.102 (GUI) UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/31 UP.Browser/5.0.2.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/31 UP.Browser/5.0.2.2 (GUI) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/33 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/35 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/35 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/36 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C45/38 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/07 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/09 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/10 UP.Browser/5.0.2.3.3 (GUI) UP.Link/5.1.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/10 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/10 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/11 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/12 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/12 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/12 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/14 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/14 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/14 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/18 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/18 UP.Browser/5.0.3.3 (GUI) UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/18 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/18 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/18 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/19 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/21 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/21 UP.Browser/5.0.3.3 (GUI) UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/21 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/21 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/21 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/21 UP.Browser/5.0.3.3 (GUI) UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C55/24 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C56/14 UP.Browser/5.0.3.3.1.e.2 (GUI) UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C56/14 UP.Browser/5.0.3.3.1.e.2 (GUI) UP.Link/5.1.2.1 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C60/23 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.7.3 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C62/83 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-C65/08 UP.Browser/7.0.0.1.181 (GUI) MMP/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-CX65/08 UP.Browser/7.0.0.1.181 (GUI) MMP/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-IC35/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M46/52 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M50/07 UP.Browser/5.0.2.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M50/09 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M50/09 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M50/14 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M50/16 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M50/17 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M50/17 UP.Browser/5.0.2.3.100 (GUI) (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M50/17 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M50I/81 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M50I/81 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M55/04 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M55/04 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M55/04 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M55/07 UP.Browser/6.1.0.5.c.5 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M55/07 UP.Browser/6.1.0.5.c.5 (GUI) MMP/1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M55/10 UP.Browser/6.1.0.5.c.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-M65/06 UP.Browser/7.0.0.1.181 (GUI) MMP/2.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Link/5.1.';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MC60/04 UP.Browser/6.1.0.5.c.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MC60/04 UP.Browser/6.1.0.5.c.6 (GUI) MMP/1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MC60/10 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Browser/6.1.0.7.3 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/04 UP.Browser/5.0.3.1.105 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/05 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/06 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/07 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/09 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/09 UP.Browser/5.0.1.1.102 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/10 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/10 UP.Browser/5.0.1.1.102 (GUI) UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/14 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/21 UP.Browser/5.0.2.1.103 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/5.0.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/5.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/23 UP.Browser/5.0.2.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/23 UP.Browser/5.0.2.2 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/23 UP.Browser/5.0.2.2 (GUI) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/24 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/24 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/24 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/26 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/28 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ME45/30 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MT50/07 UP.Browser/5.0.2.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MT50/09 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MT50/09 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MT50/09 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MT50/09 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MT50/09 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MT50/09 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MT50/14 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MT50/14 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-MT50/17 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-P35/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S35/1.0 UP/4.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S35/1.0 UP/4.1.8c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S35/1.0 UP/4.1.8c UP.Browser/4.1.8c-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S35/1.0_UP/4.1.8c_UP.Browser/4.1.8c-UP.Link/4.1.0.4_Yahoo';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S35/2.0 UP/4.1.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S35/2.0+UP/4.1.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S35/3.0 UP/4.1.16m';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S35/3.0 UP/4.1.16m UP.Browser/4.1.16m-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S35/3.0 UP/4.1.16m UP.Browser/4.1.16m-XXXX UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S35/3.0 UP/4.1.16m UP.Browser/4.1.16m-XXXX UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S40/2.3 UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S40/2.6 UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S40/2.9 UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S40/3.2 UP/4.1.16r';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S40/4.0 UP/4.1.16u';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S40/5.0 UP/4.1.16u';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S40/9.0 UP/4.1.16u';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/00 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/05 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/06 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/06 UP.Browser/5.0.1.1.102 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/06 UP.Browser/5.0.1.1.102 (GUI) UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/09 UP.Browser/5.0.1.1.102 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/09 UP.Browser/5.0.1.1.102 (GUI) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/10 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/10 UP.Browser/5.0.1.1.102 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/11 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/14 UP.Browser/5.0.1.1.102 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/14 UP.Browser/5.0.1.1.102 (GUI) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/14 UP.Browser/5.0.1.1.102 (GUI) UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/14 UP.Browser/5.0.1.1.102 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/20 UP.Browser/5.0.2.1.103 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/21 UP.Browser/5.0.2.1.103 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/5.0.1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/5.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/21 UP.Browser/5.0.2.1.103 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/23 UP.Browser/5.0.2.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/23 UP.Browser/5.0.2.2 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/23 UP.Browser/5.0.2.2 (GUI) UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/23 UP.Browser/5.0.2.2 (GUI) UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/23 UP.Browser/5.0.2.2 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/23 UP.Browser/5.0.2.2 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/24 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/24 UP.Browser/5.0.2.3.100 (GUI) UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/26 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/28 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/28 UP.Browser/5.0.2.3.100 (GUI) (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/28 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/30 UP.Browser/5.0.2.3.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/30 UP.Browser/5.0.2.3.100 (GUI) UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/4.0 UP.Browser/5.0.1.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/4.0 UP.Browser/5.0.1.2 (GUI) UP.Link/5.0.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/4.0 UP.Browser/5.0.1.2 (GUI) UP.Link/5.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45/4.0 UP/5.0.1.2 (GUI) UP.Browser/5.0.1.2 (GUI)-XXXX UP.Link/5.0.HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45i/02 UP.Browser/5.0.3.1.105 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45i/02 UP.Browser/5.0.3.1.105 (GUI) UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45i/03 UP.Browser/5.0.3.1.105 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45i/04 UP.Browser/5.0.3.1.105 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S45i/04 UP.Browser/5.0.3.1.105 (GUI) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/04 UP.Browser/6.1.0.5.119 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/04 UP.Browser/6.1.0.5.119 (GUI) MMP/1.0 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/04 UP.Browser/6.1.0.5.119 (GUI) MMP/1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/04 UP.Browser/6.1.0.5.119 (GUI) MMP/1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/04 UP.Browser/6.1.0.5.119 (GUI) MMP/1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/05 UP.Browser/6.1.0.5.121 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/05 UP.Browser/6.1.0.5.121 (GUI) MMP/1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/05 UP.Browser/6.1.0.5.121 (GUI) MMP/1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/05 UP.Browser/6.1.0.5.121 (GUI) MMP/1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/08 UP.Browser/6.1.0.5.c.1 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/09 UP.Browser/6.1.0.5.c.1 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/10 UP.Browser/6.1.0.5.c.2 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/11 UP.Browser/6.1.0.5.c.2 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/11 UP.Browser/6.1.0.5.c.2 (GUI) MMP/1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/12 UP.Browser/6.1.0.5.c.2 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/12 UP.Browser/6.1.0.5.c.2 (GUI) MMP/1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/16 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/16 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/16 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/16 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/20 UP.Browser/6.1.0.5.c.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/20 UP.Browser/6.1.0.5.c.6 (GUI) MMP/1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S55/20 UP.Browser/6.1.0.5.c.6 (GUI) MMP/1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S57/05 UP.Browser/6.1.0.5.121 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-S57/05 UP.Browser/6.1.0.5.121 (GUI) MMP/1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL45/1.0 (ccWAP-Browser)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL45/3.1 UP/4.1.19i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL45/3.1 UP/4.1.19i UP.Browser/4.1.19i-XXXX UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL45/3.1 UP/4.1.19i UP.Browser/4.1.19i-XXXX UP.Link/4.2.2.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL45/3.1 UP/4.1.19i UP.Browser/4.1.19i-XXXX UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL55/00 UP.Browser/6.1.0.5.c.1 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL55/05 UP.Browser/6.1.0.5.c.2 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL55/07 UP.Browser/6.1.0.5.c.2 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL55/09 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL55/09 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL55/09 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL55/09 UP.Browser/6.1.0.5.c.4 (GUI) MMP/1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL55/12 UP.Browser/6.1.0.5.c.5 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL55/14 UP.Browser/6.1.0.5.c.5 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SL55/14 UP.Browser/6.1.0.5.c.5 (GUI) MMP/1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SLIK/3.1 UP/4.1.19i';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SLIN/3.1 UP/4.1.19i UP.Browser/4.1.19i-XXXX UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-ST60/1.0 UP.Browser/6.1.0.7.4 (GUI) MMP/1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SIE-SX1/1.1 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Sanyo-C304SA/2.0 UP/4.1.20e';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Sanyo-SCP5000/1.1b UP.Browser/4.1.23a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Sanyo-SCP6200/1.1 UP.Browser/4.1.26c UP.Link/5.0.2.7';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SendoM550/226-E-09';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SendoM550/226-E-10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SendoS330/14A-G-02';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SendoS600/03';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SendoX/1.0 SymbianOS/6.1 Series60/1.2 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Smith WAP Emulator/1.0 (http://www.ceskywap.cz/smith)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonK700i/R2A SEMC-Browser/4.0 Profile/MIDP-1.0 MIDP-2.0 Configuration/CLDC-1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP800';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP800/P201 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP800/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP800/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP800/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP800/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP800/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP800/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP800/R102 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP800/R102 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP900/R101 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonP900/R102 Profile/MIDP-2.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT100/R101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT200/R101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT200/R101 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT200/R101 UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT200/R101 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT200/R101 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT200/R101 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT200/R101 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT230/R101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R101 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R101 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R101 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R101 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R101 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R101 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R101 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R101-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R201';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R201 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R201 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R201 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R201 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R201 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT300/R201 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT306/R101 UP.Link/5.1.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT306/R101 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT310/R201';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT310/R201 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT310/R201 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT312/R201';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT316/R101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT316/R101 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT600';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R101 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R201 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R201 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R201 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R201 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R201 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.2.10';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R301 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R301 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R401 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R401 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R601 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT610/R601 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT630/R401 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT630/R401 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT630/R601 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT630/R601 Profile/MIDP-1.0 Configuration/CLDC-1.0 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A (compatible; YOSPACE SmartPhone Emulator Website Edition 1.11)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A (compatible; YOSPACE SmartPhone Emulator Website Edition 1.14)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/4.1.0.9b';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/4.2.0.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/4.2.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/4.3.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/4.3.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/5.0.2.3d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/5.01';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/5.1.0.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/5.1.1.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R201A-WG';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R301A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R301A UP.Link/5.1.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R301A UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R401';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R401 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R401A';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R501';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R501 (Google WAP Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R501 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R501 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R501 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R501 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R501 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R501 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R502';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R502 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R502 UP.Link/5.1.1.2a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R502 UP.Link/5.1.1.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R502 UP.Link/5.1.1.5a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R502 UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R502 UP.Link/5.1.2.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68/R502 UP.Link/5.1.2.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonT68i/R101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonZ1010/R1A Profile/MIDP-1.0 MIDP2.0 Configurationn/CLDC-1.1 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonZ1010/R1E SEMC-Browser/4.0 Profile/MIDP-1.0 MIDP-2.0 Configuration/CLDC-1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonZ1010/R1G SEMC-Browser/4.0 Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonZ200/R101';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonZ600/R301 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonZ600/R301 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonZ600/R401 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonZ600/R401 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'SonyEricssonZ600/R601 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'T250 UP/4.1.20a UP.Browser/4.1.20a-XXXX UP.Link/4.1.HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'T600 1.0 WAP1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'T66 1.0 WAP1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TMT Mobile Internet Browser';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TSM-100';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TSM-100/141053B7 Browser/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TSM-100/141053B9 Browser/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TSM-100/141053BB Browser/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TSM-100/141053BB Browser/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TSM-100v/40100012 Browser/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TSM-5/2.2 UP.Browser/5.0.2.2 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TSM-5m/1.3.8.5 UP.Browser/6.2.2.4.g.1.100 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TSM-6/7.12.2 Teleca/1.1.13.4 Profile/MIDP-1.0 Configuration/CLDC-1.0 UP.Link/5.1.15';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TSM100v/40100012 Browser/1.2.1 Profile/MIDP-1.0 Configuration/CLDC-1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'TTPCom WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Telit-G80/2.01 UP.Browser/6.1.0.6 (GUI) MMP/1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Telit_Mobile_Terminals-GM882/1.02 UP.Browser/5.0.3.3 (GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser Alcatel-BF4/1.0 UP.Browser/4.1.21d';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.0.02-QC32 UP.Link/4.2.1.7';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.01-IG01 UP.Link/3.2.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1 UP.Link/3.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.02-MCC7 UP.Link/4.2.1.8';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.02-MCC8 UP.Link/5.1.2.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.02-MCCB UP.Link/4.2.1.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.03-ERK0 UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.03-ERK1 UP.Link/4.2.1.7';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.03-ERK1 UP.Link/4.3.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.03-ERK1 UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.03-ERK1 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.03-NK02 UP.Link/4.2.1.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.03-T250 UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.04-LG08 UP.Link/5.1.2.3';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.04-LG18 UP.Link/4.2.1.2';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.04-MO01 UP.Link/4.2.3.5c';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.04-SC02 UP.Link/4.3.3.4a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.04-SC03 UP.Link/4.3.4.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.04-SC04 UP.Link/4.3.4.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/3.1.04-SY02 UP.Link/4.3.3.4';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UP.Browser/6.1.0.1.140 (Google CHTML Proxy/1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UPG1 UP/4.0 (compatible; Blazer 1.0)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UPG1 UP/4.0.10 UP.Browser/4.0.10-XXXX UP.Link/4.1.HTTP-DIRECT';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UPG1 UP/4.0.7';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UPG1 UP/4.0.WPK_V01.01.49';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'UPG1 UP/4.0.WPK_V02.00.04';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Vitelcom-Feature Phone1.0 UP.Browser/5.0.2.2(GUI)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'WAP/Ericsson';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'WAPPER';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'WAPman Version 1.6';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'WML-Browser';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Wap terminal';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'WapIDE-SDK/2.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'WapOnWindows 1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'WapView 1.02';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Wapaka (Windows 2000; 5.0; x86) DAW/1.0 Orange/1.00 UP/4.1.9';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Wapalizer/1.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'Waptor 1.0';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'ccWAP-Browser';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'iCab/2.7.1 (Macintosh; I; PPC)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'iCab/2.7.1 (Macintosh; I; PPC; Mac OS X)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'iPanel/1.0 WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'innostream WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'jBrowser UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'jBrowser-J2ME';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'jBrowser-WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'jBrowser-WAP 2.0 (PPC)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'jBrowser-WAP 2.0 (PPC) UP.Link/5.1.1a';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'jBrowser/SP/1.0 MIO/8380 Profile/MIDP-1.0 MIDP-2.0 Configuration/CLDC-1.0 UP.Link/5.1.2.1';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'jBrowser2.06-WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'jBrowser2.07-WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'm-crawler/1.0 WAP';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'm-crawler/2.5 WAP (m-crawler@m-find.com; http://m-find.com)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = '1936521343 SK-04/1.0 UP/4.1.21';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'mozilla/4.0 (compatible;MSIE 4.01; Windows CE;PPC;240X320) UP.Link/5.1.1.5';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/1.0 TS21i-10(;ser123456789012345;icc1234567890123456789F)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/1.0 TS21i-10(c10)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/1.0 m21i-10(c10)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/1.0 n21i-10(;ser123456789012345;icc1234567890123456789F)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/1.0 n21i-10(c10)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/1.0 n21i-10(c10) (;; ;; ;; ;)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/1.0 n21i-10(c10) (;; ;; ;; ;; 240x320)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/1.0 n21i-20(c10)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/1.0 n22i-10(;ser123456789012345;icc1234567890123456789F)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/1.0 n22i-10(c10)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/2.0 M341i(c10;TB)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/2.0 N223i(c10;TB)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/2.0 N341i(c10;TB)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/2.0 N400i(c20;TB)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));
        $userAgent = 'portalmmm/2.0 N410i(c20;TB)';
        $this->assertTrue(Zend_Http_UserAgent_Mobile::match($userAgent, [
            'HTTP_USER_AGENT' => $userAgent
        ]));

    }

    public function testMatchBot()
    {
        $userAgent = 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';
        $this->assertTrue(Zend_Http_UserAgent_Bot::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));

        $userAgent = 'Googlebot/2.1 (+http://www.googlebot.com/bot.html)';
        $this->assertTrue(Zend_Http_UserAgent_Bot::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));

        $userAgent = 'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)';
        $this->assertTrue(Zend_Http_UserAgent_Bot::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));

        $userAgent = 'YahooSeeker/1.2 (compatible; Mozilla 4.0; MSIE 5.5; yahooseeker at yahoo-inc dot com ; http://help.yahoo.com/help/us/shop/merchant/)';
        $this->assertTrue(Zend_Http_UserAgent_Bot::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));

        $userAgent = 'Mozilla/4.0 compatible ZyBorg/1.0 (wn.zyborg@looksmart.net; http://www.WISEnutbot.com)';
        $this->assertTrue(Zend_Http_UserAgent_Bot::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));
    }

    public function testMatchChecker()
    {
        $userAgent = 'Mozilla/5.0 (compatible; AbiLogicBot/1.0; +http://www.abilogic.com/bot.html)';
        $this->assertTrue(Zend_Http_UserAgent_Checker::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));

        $userAgent = 'W3C-checklink/4.5 [4.160] libwww-perl/5.823';
        $this->assertTrue(Zend_Http_UserAgent_Checker::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));
    }

    public function testMatchConsole()
    {
        $userAgent = 'Mozilla/5.0 (PLAYSTATION 3; 1.10)';
        $this->assertTrue(Zend_Http_UserAgent_Console::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));

        $userAgent = 'Opera/9.30 (Nintendo Wii; U; ; 2071; Wii Shop Channel/1.0; en)';
        $this->assertTrue(Zend_Http_UserAgent_Console::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));
    }

    public function testMatchEmail()
    {
        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.1.9) Gecko/20100317 Lightning/1.0b1 Thunderbird/3.0.4';
        $this->assertTrue(Zend_Http_UserAgent_Email::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));
    }

    public function testMatchFeed()
    {
        $userAgent = 'Bloglines/3.0-rho (http://www.bloglines.com; 3 subscribers)';
        $this->assertTrue(Zend_Http_UserAgent_Feed::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));
    }

    public function testMatchOffline()
    {
        $userAgent = 'Offline Explorer/2.5';
        $this->assertTrue(Zend_Http_UserAgent_Offline::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));

        $userAgent = 'Wget/1.9.1';
        $this->assertTrue(Zend_Http_UserAgent_Offline::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));

        $userAgent = 'WebCopier v3.2a';
        $this->assertTrue(Zend_Http_UserAgent_Offline::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));
    }

    public function _testMatchProbe()
    {
        $this->markTestIncomplete();
    }

    public function _testMatchSpam()
    {
        $this->markTestIncomplete();
    }

    public function testMatchText()
    {
        $userAgent = 'Lynx/2.8.6rel.4 libwww-FM/2.14 SSL-MM/1.4.1 OpenSSL/0.9.8k';
        $this->assertTrue(Zend_Http_UserAgent_Text::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));

        $userAgent = 'w3m/0.5.1+cvs-1.968';
        $this->assertTrue(Zend_Http_UserAgent_Text::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));
    }

    public function testMatchValidator()
    {
        $userAgent = 'CSE HTML Validator Lite Online (http://online.htmlvalidator.com/php/onlinevallite.php)';
        $this->assertTrue(Zend_Http_UserAgent_Validator::match($userAgent,['HTTP_USER_AGENT'=>$userAgent]));
    }

    /**
     * @group ZF-11557
     */
    public function testMatchingIpadUserAgentShouldNotResultInNotices()
    {
        $userAgent = 'Mozilla/5.0 (iPad; U; CPU OS 4_3_3 like Mac OS X; de-de) AppleWebKit/533.17.9 (KHTML, like Gecko)';
        $capabilities = Zend_Http_UserAgent_AbstractDevice::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleWebKit', $capabilities['browser_name']);
    }

    /**
     * @group ZF-11557
     */
    public function testMatchingMacSafariUserAgentShouldNotResultInNotices()
    {
        $userAgent = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_5; de-de) AppleWebKit/533.18.1 (KHTML, like Gecko)';
        $capabilities = Zend_Http_UserAgent_AbstractDevice::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleWebKit', $capabilities['browser_name']);
    }
    
    /**
     * @group ZF-11815
     */
    public function testUserAgentAppleCoreMediaForIphoneShouldNotResultInNotices()
    {
        $userAgent = 'AppleCoreMedia/1.0.0.8L1 (iPhone; U; CPU OS 4_3_5 like Mac OS X; de_de)';
        $capabilities = Zend_Http_UserAgent_AbstractDevice::extractFromUserAgent($userAgent);
        $this->assertEquals('AppleCoreMedia', $capabilities['browser_name']);        
    }
    
    /**
     * @group ZF-11749
     */
    public function testUserAgentAppleWebKit53446WithoutLanguageShouldNotResultInNotices()
    {
        $userAgent = 'Mozilla/5.0 (iPhone; CPU iPhone OS 5_0 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9A5313e Safari/7534.48.3';
        $capabilities = Zend_Http_UserAgent_AbstractDevice::extractFromUserAgent($userAgent);
        $this->assertEquals('Safari Mobile', $capabilities['browser_name']);
    }
    
    /**
     * @group ZF-11693
     */
    public function testShortMozillaUserAgentShouldNotResultInNotices()
    {
        $userAgent = 'Mozilla/3.0 (compatible)';
        $capabilities = Zend_Http_UserAgent_AbstractDevice::extractFromUserAgent($userAgent);
        $this->assertEquals('Mozilla', $capabilities['browser_name']);
    }
    
    /**
     * @group ZF-11857
     */
    public function testOperaOnHtcHd2UserAgentShouldNotResultInNotices()
    {
        $userAgent = 'HTC_HD2_T8585 Opera/9.7 (Windows NT 5.1; U; de)';
        $capabilities = Zend_Http_UserAgent_AbstractDevice::extractFromUserAgent($userAgent);
        $this->assertEquals('Opera', $capabilities['browser_name']);
    }

    /**
     * @group GH-550
     */
    public function testOnlyBrowserNameShouldNotResultInNotices()
    {
        $userAgent    = 'Mozilla';
        $capabilities = Zend_Http_UserAgent_AbstractDevice::extractFromUserAgent($userAgent);
        $this->assertEquals('Mozilla', $capabilities['browser_name']);
    }
}
