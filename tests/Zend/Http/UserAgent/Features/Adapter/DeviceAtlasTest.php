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

require_once 'Zend/Http/UserAgent/Features/Adapter/DeviceAtlas.php';

/**
 * @category   Zend
 * @package    Zend_Http_UserAgent
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Http_UserAgent_Features_Adapter_DeviceAtlasTest extends TestCase
{
    /**
     * @var array<string, mixed>
     */
    protected $config;

    protected function set_up()
    {
        if (!constant('TESTS_ZEND_HTTP_USERAGENT_DEVICEATLAS_LIB_DIR')
            || !constant('TESTS_ZEND_HTTP_USERAGENT_DEVICEATLAS_DATA_FILE')
        ) {
            $this->markTestSkipped('Requires Device Atlas library');
        }

        $this->config['deviceatlas']['deviceatlas_lib_dir'] = constant('TESTS_ZEND_HTTP_USERAGENT_DEVICEATLAS_LIB_DIR');
        $this->config['deviceatlas']['deviceatlas_data'] = constant('TESTS_ZEND_HTTP_USERAGENT_DEVICEATLAS_DATA_FILE');
        $this->config['mobile']['features']['path'] = 'Zend/Http/UserAgent/Features/Adapter/DeviceAtlas.php';
        $this->config['mobile']['features']['classname'] = 'Zend_Http_UserAgent_Features_Adapter_DeviceAtlas';
    }

    public function testGetFromRequest()
    {
        $request['http_user_agent'] = 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleW1ebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/4A102 Safari/419.3';
        $deviceAtlas = Zend_Http_UserAgent_Features_Adapter_DeviceAtlas::getFromRequest($request, $this->config);
        $this->assertEquals(1, $deviceAtlas['touchScreen']);
        $this->assertEquals(1, $deviceAtlas['markup.xhtmlBasic10']);
        $this->assertEquals('iPhone', $deviceAtlas['model']);
        $this->assertEquals('Mozilla/5.0 (iPhone; U; C', $deviceAtlas['_matched']);
        $this->assertEquals('Apple', $deviceAtlas['vendor']);

        $request['http_user_agent'] = 'SonyEricssonK700i/R2AC SEMC-Browser/4.0.2 Profile/MIDP-2.0 Configuration/CLDC-1.1';
        $deviceAtlas = Zend_Http_UserAgent_Features_Adapter_DeviceAtlas::getFromRequest($request, $this->config);
        $this->assertEquals(20000, $deviceAtlas['memoryLimitMarkup']);
        $this->assertEquals('K700i', $deviceAtlas['model']);
        $this->assertEquals('SonyEricssonK700i', $deviceAtlas['_matched']);
        $this->assertEquals('Sony Ericsson', $deviceAtlas['vendor']);
    }
}
