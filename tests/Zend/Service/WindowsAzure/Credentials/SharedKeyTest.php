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
 * @package    Zend_Service_WindowsAzure
 * @subpackage UnitTests
 * @version    $Id$
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_WindowsAzure_Credentials_SharedKeyTest::main');
}

/**
 * Test helpers
 */
require_once dirname(__FILE__) . '/../../../../TestHelper.php';
require_once dirname(__FILE__) . '/../../../../TestConfiguration.dist.php';

/** Zend_Service_WindowsAzure_Credentials_SharedKey */
require_once 'Zend/Service/WindowsAzure/Credentials/SharedKey.php';

/**
 * @category   Zend
 * @package    Zend_Service_WindowsAzure
 * @subpackage UnitTests
 * @version    $Id$
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_WindowsAzure_Credentials_SharedKeyTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Zend_Service_WindowsAzure_Credentials_SharedKeyTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Test signing for devstore with root path
     */
    public function testSignForDevstoreWithRootPath()
    {
        $credentials = new Zend_Service_WindowsAzure_Credentials_SharedKey(Zend_Service_WindowsAzure_Credentials_SharedKey::DEVSTORE_ACCOUNT, Zend_Service_WindowsAzure_Credentials_SharedKey::DEVSTORE_KEY, true);
        $signedHeaders = $credentials->signRequestHeaders(
                              'GET',
                              '/',
                              '',
                              ["x-ms-date" => "Wed, 29 Apr 2009 13:12:47 GMT"],
                              false
                          );
                          
        $this->assertTrue(is_array($signedHeaders));
        $this->assertEquals(2, count($signedHeaders));
        $this->assertEquals("SharedKey devstoreaccount1:9tokqwSDIqvRioVZ1k0mv5m/iseHsGRYmAMGJVu6NcU=", $signedHeaders["Authorization"]);
    }
    
    /**
     * Test signing for devstore with other path
     */
    public function testSignForDevstoreWithOtherPath()
    {
        $credentials = new Zend_Service_WindowsAzure_Credentials_SharedKey(Zend_Service_WindowsAzure_Credentials_SharedKey::DEVSTORE_ACCOUNT, Zend_Service_WindowsAzure_Credentials_SharedKey::DEVSTORE_KEY, true);
        $signedHeaders = $credentials->signRequestHeaders(
                              'GET',
                              '/test',
                              '',
                              ["x-ms-date" => "Wed, 29 Apr 2009 13:12:47 GMT"],
                              false
                          );
  
        $this->assertTrue(is_array($signedHeaders));
        $this->assertEquals(2, count($signedHeaders));
        $this->assertEquals("SharedKey devstoreaccount1:YHPfUXoeL/XZjEYii2pfSZi3CsOB++5sA4QT7CAvPig=", $signedHeaders["Authorization"]);
    }
    
    /**
     * Test signing for devstore with query string
     */
    public function testSignForDevstoreWithQueryString()
    {
        $credentials = new Zend_Service_WindowsAzure_Credentials_SharedKey(Zend_Service_WindowsAzure_Credentials_SharedKey::DEVSTORE_ACCOUNT, Zend_Service_WindowsAzure_Credentials_SharedKey::DEVSTORE_KEY, true);
        $signedHeaders = $credentials->signRequestHeaders(
                              'GET',
                              '/',
                              '?test=true',
                              ["x-ms-date" => "Wed, 29 Apr 2009 13:12:47 GMT"],
                              false
                          );
  
        $this->assertTrue(is_array($signedHeaders));
        $this->assertEquals(2, count($signedHeaders));
        $this->assertEquals("SharedKey devstoreaccount1:S1+AcI8z19N0EP0eRTEj4UUCtPbKyUcZDAt299AWudw=", $signedHeaders["Authorization"]);
    }
    
    /**
     * Test signing for production with root path
     */
    public function testSignForProductionWithRootPath()
    {
        $credentials = new Zend_Service_WindowsAzure_Credentials_SharedKey('testing', 'abcdefg');
        $signedHeaders = $credentials->signRequestHeaders(
                              'GET',
                              '/',
                              '',
                              ["x-ms-date" => "Wed, 29 Apr 2009 13:12:47 GMT"],
                              false
                          );
                          
        $this->assertTrue(is_array($signedHeaders));
        $this->assertEquals(2, count($signedHeaders));
        $this->assertEquals("SharedKey testing:amg3/Z6Yx0KxwhRz9yn1ZCPZXYWIp5aEDCeZ1H5UIwo=", $signedHeaders["Authorization"]);
    }
    
    /**
     * Test signing for production with other path
     */
    public function testSignForProductionWithOtherPath()
    {
        $credentials = new Zend_Service_WindowsAzure_Credentials_SharedKey('testing', 'abcdefg');
        $signedHeaders = $credentials->signRequestHeaders(
                              'GET',
                              '/test',
                              '',
                              ["x-ms-date" => "Wed, 29 Apr 2009 13:12:47 GMT"],
                              false
                          );
  
        $this->assertTrue(is_array($signedHeaders));
        $this->assertEquals(2, count($signedHeaders));
        $this->assertEquals("SharedKey testing:ISA0m0Gy2SrxxjBO9ogtIbz0xNNyJ/GujUv5s1ibQrY=", $signedHeaders["Authorization"]);
    }
    
    /**
     * Test signing for production with query string
     */
    public function testSignForProductionWithQueryString()
    {
        $credentials = new Zend_Service_WindowsAzure_Credentials_SharedKey('testing', 'abcdefg');
        $signedHeaders = $credentials->signRequestHeaders(
                              'GET',
                              '/',
                              '?test=true',
                              ["x-ms-date" => "Wed, 29 Apr 2009 13:12:47 GMT"],
                              false
                          );
  
        $this->assertTrue(is_array($signedHeaders));
        $this->assertEquals(2, count($signedHeaders));
        $this->assertEquals("SharedKey testing:vlfVjEbBaRVTv35e924cR4B/Z5zCaSYjbtMz9/k3UCY=", $signedHeaders["Authorization"]);
    }
}

// Call Zend_Service_WindowsAzure_Credentials_SharedKeyTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Service_WindowsAzure_Credentials_SharedKeyTest::main") {
    Zend_Service_WindowsAzure_Credentials_SharedKeyTest::main();
}
