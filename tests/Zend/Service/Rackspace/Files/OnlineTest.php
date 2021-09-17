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
 * @package    Zend_Service_Rackspace
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once 'Zend/Service/Rackspace/Files.php';
require_once 'Zend/Http/Client/Adapter/Socket.php';


/**
 * Test helper
 */

/**
 * @category   Zend
 * @package    Zend_Service_Rackspace_Files
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service_Rackspace_Files
 */
class Zend_Service_Rackspace_Files_OnlineTest extends PHPUnit_Framework_TestCase
{
    /**
     * Reference to Rackspace Files object
     *
     * @var Zend_Service_Rackspace_Files
     */
    protected $rackspace;
    /**
     * Socket based HTTP client adapter
     *
     * @var Zend_Http_Client_Adapter_Socket
     */
    protected $httpClientAdapterSocket;
    /**
     * Metadata for container/object test
     * 
     * @var array 
     */
    protected $metadata;
    /**
     * Another metadata for container/object test
     * 
     * @var array 
     */
    protected $metadata2;
    
    /**
     * Set up the test case
     *
     * @return void
     */
    public function setUp()
    {
        
        if (!constant('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_ENABLED')) {
            $this->markTestSkipped('Zend_Service_Rackspace_Files_OnlineTest tests are not enabled');
        }
        if(!defined('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_USER') || !defined('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_KEY')) {
             $this->markTestSkipped('Constants User and Key have to be set.');
        }

        $this->rackspace = new Zend_Service_Rackspace_Files(TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_USER,
                                       TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_KEY);

        $this->httpClientAdapterSocket = new Zend_Http_Client_Adapter_Socket();

        $this->rackspace->getHttpClient()
                        ->setAdapter(self::$httpClientAdapterSocket);
        
        $this->metadata =  [
            'foo'  => 'bar',
            'foo2' => 'bar2'
        ];
        
        $this->metadata2 = [
            'hello' => 'world'
        ];
        
        // terms of use compliance: safe delay between each test
        sleep(2);
    }
    
    public function testCreateContainer()
    {
        $container= $this->rackspace->createContainer(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME,$this->metadata);
        $this->assertTrue($container!==false);
        $this->assertEquals($container->getName(),TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME);
    }

    public function testGetCountContainers()
    {
        $num= $this->rackspace->getCountContainers();
        $this->assertTrue($num>0);
    }
    
    public function testGetContainer()
    {
        $container= $this->rackspace->getContainer(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME);
        $this->assertTrue($container!==false);
        $this->assertEquals($container->getName(),TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME);
    }
    
    public function testGetContainers()
    {
        $containers= $this->rackspace->getContainers();
        $this->assertTrue($containers!==false);
        $found=false;
        foreach ($containers as $container) {
            if ($container->getName()==TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME) {
                $found=true;
                break;
            }
        } 
        $this->assertTrue($found);
    }
    
    public function testGetMetadataContainer()
    {
        $data= $this->rackspace->getMetadataContainer(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME);
        $this->assertTrue($data!==false);
        $this->assertEquals($data['name'],TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME);
        $this->assertEquals($data['metadata'],$this->metadata);
        
    }
    
    public function testGetInfoAccount()
    {
        $data= $this->rackspace->getInfoAccount();
        $this->assertTrue($data!==false);
        $this->assertTrue($data['tot_containers']>0);
    }
    
    public function testStoreObject()
    {
        $content= 'This is a test!';
        $result= $this->rackspace->storeObject(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME, 
                                               TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME,
                                               $content,
                                               $this->metadata);
        $this->assertTrue($result);
    }
    
    public function testGetObject()
    {
        $object= $this->rackspace->getObject(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME, 
                                             TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME);
        $this->assertTrue($object!==false);
        $this->assertEquals($object->getName(),TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME);
    }

    public function testCopyObject()
    {
        $result= $this->rackspace->copyObject(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME,
                                              TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME,
                                              TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME,
                                              TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME.'-copy');
        $this->assertTrue($result);
    }

    public function testGetObjects()
    {
        $objects= $this->rackspace->getObjects(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME);
        $this->assertTrue($objects!==false);
        
        $this->assertEquals($objects[0]->getName(),TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME);
        $this->assertEquals($objects[1]->getName(),TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME.'-copy');
    }
    
    public function testGetSizeContainers()
    {
        $size= $this->rackspace->getSizeContainers();
        $this->assertTrue($size!==false);
        $this->assertTrue(is_numeric($size));
    }
    
    public function testGetCountObjects()
    {
        $count= $this->rackspace->getCountObjects();
        $this->assertTrue($count!==false);
        $this->assertTrue(is_numeric($count));
    }
    
    public function testSetMetadataObject()
    {
        $result= $this->rackspace->setMetadataObject(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME,
                                                     TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME,
                                                     $this->metadata2);
        $this->assertTrue($result);
    }
    
    public function testGetMetadataObject()
    {
        $data= $this->rackspace->getMetadataObject(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME,
                                                   TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME);
        $this->assertTrue($data!==false);
        $this->assertEquals($data['metadata'],$this->metadata2);
    }
    
    public function testEnableCdnContainer()
    {
        $data= $this->rackspace->enableCdnContainer(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME);
        $this->assertTrue($data!==false);
        $this->assertTrue(is_array($data));
        $this->assertTrue(!empty($data['cdn_uri']));
        $this->assertTrue(!empty($data['cdn_uri_ssl']));
    }
    
    public function testGetCdnContainers()
    {
        $containers= $this->rackspace->getCdnContainers();
        $this->assertTrue($containers!==false);
        $found= false;
        foreach ($containers as $container) {
            if ($container->getName()==TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME) {
                $found= true;
                break;
            }
        }
        $this->assertTrue($found);
    }
    
    public function testUpdateCdnContainer()
    {
        $data= $this->rackspace->updateCdnContainer(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME,null,false);
        $this->assertTrue($data!==false);
    }

    
    public function testDeleteObject()
    {
        $this->assertTrue($this->rackspace->deleteObject(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME,
                                                         TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME));
    }
    
    public function testDeleteObject2()
    {
        $this->assertTrue($this->rackspace->deleteObject(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME,
                                                         TESTS_ZEND_SERVICE_RACKSPACE_OBJECT_NAME.'-copy'));
    }
    
    public function testDeleteContainer()
    {
        $this->assertTrue($this->rackspace->deleteContainer(TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME));
    }
  
}
