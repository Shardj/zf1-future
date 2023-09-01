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
 * @package    Zend_Service_Rackspace
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once 'Zend/Service/Rackspace/Files.php';
require_once 'Zend/Http/Client/Adapter/Test.php';


/**
 * Test helper
 */

/**
 * @category   Zend
 * @package    Zend\Service\Rackspace\Files
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend\Service
 * @group      Zend\Service\Rackspace
 * @group      Zend\Service\Rackspace\Files
 */
 class Zend_Service_Rackspace_OfflineTest extends TestCase
 {
     /**
      * Reference to RackspaceFiles
      *
      * @var Zend_Service_Rackspace_Files
      */
     protected $_files;
     /**
      * HTTP client adapter for testing
      *
      * @var Zend_Http_Client_Adapter_Test
      */
     protected $_httpClientAdapterTest;
     /**
      * Path to test data files
      *
      * @var string
      */
     protected $_filesPath;
     /**
      * Sets up this test case
      *
      * @return void
      */
     protected function set_up()
     {
         $this->_files = new Zend_Service_Rackspace_Files('foo', 'bar');
         $this->_filesPath = dirname(__FILE__) . '/_files';
         $this->_httpClientAdapterTest = new Zend_Http_Client_Adapter_Test();
     }
     /**
      * Utility method for returning a string HTTP response, which is loaded from a file
      *
      * @param  string $name
      * @return string
      */
     protected function _loadResponse($name)
     {
         return file_get_contents("$this->_filesPath/$name.response");
     }
     /**
      * Ensures that __construct() throws an exception when given an empty key attribute
      *
      * @return void
      */
     public function testConstructExceptionMissingUserAttribute()
     {
         $this->expectException(
             'Zend_Service_Rackspace_Exception'
         );
         $this->expectExceptionMessage('The user cannot be empty');
         $file = new Zend_Service_Rackspace_Files(null, 'bar');
     }
     /**
      * Ensures that __construct() throws an exception when given an empty secret attribute
      *
      * @return void
      */
     public function testConstructExceptionMissingKeyAttribute()
     {
         $this->expectException(
             'Zend_Service_Rackspace_Exception'
         );
         $this->expectExceptionMessage('The key cannot be empty');
         $file = new Zend_Service_Rackspace_Files('foo', null);
     }
     /**
      * Test the default authentication URL
      *
      * @return void
      */
     public function testDefaultAuthUrl()
     {
         $this->assertEquals($this->_files->getAuthUrl(), Zend_Service_Rackspace_Files::US_AUTH_URL, 'The default Authentication URL is changed');
     }
     /**
      * Test the set of the key
      *
      * @return void
      */
     public function testSetKey()
     {
         $key = '1234567890';
         $this->_files->setKey($key);
         $this->assertEquals($this->_files->getKey(), $key);
     }
     /**
      * Test the set of the user
      *
      * @return void
      */
     public function testSetUser()
     {
         $user = 'test';
         $this->_files->setUser($user);
         $this->assertEquals($this->_files->getUser(), $user);
     }
     /**
      * Test the set of an invalid authentication URL
      *
      * @return void
      */
     public function testSetInvalidAuthUrl()
     {
         $this->expectException(
             'Zend_Service_Rackspace_Exception'
         );
         $this->expectExceptionMessage('The authentication URL is not valid');
         $this->_files->setAuthUrl('http://test');
     }
     /**
      * Check the authentication and the results (token, storage_url, cdn_url)
      *
      * @return void
      */
     public function testAuthenticate()
     {
         $this->_files->getHttpClient()
                    ->setAdapter($this->_httpClientAdapterTest);

         $this->_httpClientAdapterTest->setResponse($this->_loadResponse(__FUNCTION__));

         $this->assertTrue($this->_files->authenticate(), 'Authentication failed');
         $this->assertTrue($this->_files->isSuccessful(), 'Authentication call failed');
         $this->assertEquals($this->_files->getToken(), '0f0223cd-f157-4d04-bb2d-ccda1a5643af', 'The token is not valid');
         $this->assertEquals($this->_files->getStorageUrl(), 'https://storage101.ord1.clouddrive.com/v1/test', 'The storage URL is not valid');
         $this->assertEquals($this->_files->getCdnUrl(), 'https://cdn2.clouddrive.com/v1/test', 'The CDN URL is not valid');
     }
     /**
      * Test the authentication error (401 Unauthorized - Bad username or password)
      *
      * @return void
      */
     public function testAuthenticateError()
     {
         $this->_files->getHttpClient()
                    ->setAdapter($this->_httpClientAdapterTest);

         $this->_httpClientAdapterTest->setResponse($this->_loadResponse(__FUNCTION__));

         $this->assertFalse($this->_files->authenticate());
         $this->assertFalse($this->_files->isSuccessful());
         $this->assertEquals($this->_files->getErrorCode(), '401');
         $this->assertEquals($this->_files->getErrorMsg(), 'Bad username or password');
     }
 }
