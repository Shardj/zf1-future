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
 * @package    Zend_Http_UserAgent
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Zend_Http_UserAgent
 */
require_once 'Zend/Http/UserAgent.php';
require_once 'Zend/Http/UserAgent/Features/Adapter/TeraWurfl.php';

/**
 * @category   Zend
 * @package    Zend_Http_UserAgent
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Http_UserAgent_Features_Adapter_TeraWurflTest extends TestCase
{
    /**
     * @var array<string, mixed>
     */
    protected $config;

    protected function set_up()
    {
        if (!constant('TESTS_ZEND_HTTP_USERAGENT_TERAWURFL_LIB_DIR')) {
            $this->markTestSkipped('Requires TERAWURFL library');
        }
        $this->config['terawurfl']['terawurfl_lib_dir'] = constant('TESTS_ZEND_HTTP_USERAGENT_TERAWURFL_LIB_DIR');
        error_reporting(E_ALL ^ E_NOTICE); // TeraWurfl.php having Notice messages
    }

    public function testGetFromRequest()
    {
        $request['http_user_agent'] = 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleW1ebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/4A102 Safari/419.3';
        $wurfl = Zend_Http_UserAgent_Features_Adapter_TeraWurfl::getFromRequest($request, $this->config);
        $this->assertEquals('Safari', $wurfl['mobile_browser']);
        $this->assertEquals('iPhone OS', $wurfl['device_os']);
        $this->assertEquals('1.0', $wurfl['device_os_version']);
        $this->assertEquals('true', $wurfl['has_qwerty_keyboard']);
        $this->assertEquals('touchscreen', $wurfl['pointing_method']);
        $this->assertEquals('false', $wurfl['is_tablet']);
        $this->assertEquals('iPhone', $wurfl['model_name']);
        $this->assertEquals('Apple', $wurfl['brand_name']);

        $request['http_user_agent'] = 'SonyEricssonK700i/R2AC SEMC-Browser/4.0.2 Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $wurfl = Zend_Http_UserAgent_Features_Adapter_TeraWurfl::getFromRequest($request, $this->config);
        $this->assertEquals('http://wap.sonyericsson.com/UAprof/K700iR101.xml', $wurfl['uaprof']);
        $this->assertEquals('SonyEricsson', $wurfl['brand_name']);
        $this->assertEquals('2002_january', $wurfl['release_date']);
        $this->assertEquals('false', $wurfl['has_qwerty_keyboard']);
        $this->assertEquals('', $wurfl['pointing_method']);
        $this->assertEquals('false', $wurfl['is_tablet']);
        $this->assertEquals('K700i', $wurfl['model_name']);
    }
}
