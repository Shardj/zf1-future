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

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Http_UserAgent_Features_Adapter_Browscap::main');
}

require_once 'Zend/Http/UserAgent/Features/Adapter/Browscap.php';

/**
 * @category   Zend
 * @package    Zend_Http_UserAgent
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Http_UserAgent_Features_Adapter_BrowscapTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        $browscap = ini_get('browscap');
        if (empty($browscap) || !file_exists($browscap)) {
            $this->markTestSkipped('Requires php.ini to provide a valid "browscap" entry');
        }
    }

    public function testGetFromRequest()
    {
        $request['http_user_agent'] = 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/4A102 Safari/419.3';
        $adapter = Zend_Http_UserAgent_Features_Adapter_Browscap::getFromRequest($request, []);
        $this->assertEquals(1,                           $adapter['ismobiledevice']);
        $this->assertEquals(1,                           $adapter['javascript']);
        $this->assertEquals(3,                           $adapter['cssversion']);
        $this->assertEquals('iPhone',                    $adapter['mobile_browser']);
        $this->assertContains('^mozilla/.\\..*(iphone;.*cpu', $adapter['browser_name_regex']);

        $request['http_user_agent'] = 'SonyEricssonK700i/R2AC SEMC-Browser/4.0.2 Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $adapter = Zend_Http_UserAgent_Features_Adapter_Browscap::getFromRequest($request, []);
        $this->assertEquals(1,                           $adapter['ismobiledevice']);
        $this->assertEquals(1,                           $adapter['javascript']);
        $this->assertEquals(1,                           $adapter['cssversion']);
        $this->assertEquals('SEMC Browser',              $adapter['mobile_browser']);
        $this->assertEquals('^.*semc-browser/.*$',       $adapter['browser_name_regex']);
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Http_UserAgent_Features_Adapter_Browscap::main') {
    Zend_Http_UserAgent_Features_Adapter_Browscap::main();
}
