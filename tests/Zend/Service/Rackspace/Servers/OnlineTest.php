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
 * @package    Zend_Service_Rackspace_Servers
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once 'Zend/Service/Rackspace/Servers.php';
require_once 'Zend/Http/Client/Adapter/Socket.php';

/**
 * @category   Zend
 * @package    Zend_Service_Rackspace_Servers
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service_Rackspace_Servers
 */
class Zend_Service_Rackspace_Servers_OnlineTest extends PHPUnit_Framework_TestCase
{
    /**
     * Reference to Rackspace Servers object
     *
     * @var Zend_Service_Rackspace_Servers
     */
    protected $rackspace;
    /**
     * Check if the resize was successfully done
     * 
     * @var boolean 
     */
    protected $resize;
    /**
     * List of flavors available
     * 
     * @var array
     */
    protected static $flavors;
    /**
     * List of images available
     * 
     * @var Zend_Service_Rackspace_Servers_ImageList 
     */
    protected static $images;
    /**
     * Id of the image created
     * 
     * @var string
     */
    protected static $imageId;
    /**
     * Server id of testing
     * 
     * @var integer 
     */
    protected static $serverId;
    /**
     * Admin password of the server
     * 
     * @var string 
     */
    protected static $adminPass;
    /**
     * Shared Ip group
     * 
     * @var Zend_Service_Rackspace_Servers_SharedIpGroup
     */
    protected static $sharedIpGroup;
    /**
     * Socket based HTTP client adapter
     *
     * @var Zend_Http_Client_Adapter_Socket
     */
    protected $httpClientAdapterSocket;

    /**
     * Sets up this test case
     *
     * @return void
     */
    public function setUp()
    {
        if (!constant('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_ENABLED')) {
            $this->markTestSkipped('Zend_Service_Rackspace_Servers_OnlineTest tests are not enabled');
        }
        
        if(!defined('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_USER') || !defined('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_KEY')) {
            $this->markTestSkipped('Constants User and Key have to be set.');
        }

        $this->rackspace = new Zend_Service_Rackspace_Servers(TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_USER,
                                       TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_KEY);

        $this->httpClientAdapterSocket = new Zend_Http_Client_Adapter_Socket();

        $this->rackspace->getHttpClient()
                        ->setAdapter($this->httpClientAdapterSocket);

        // terms of use compliance: safe delay between each test
        sleep(2);
    }
    
    /**
     * Wait n seconds for status change
     * 
     * @param string  $status 
     * @param integer $timeout
     * @return boolean
     */
    protected function waitForStatus($status,$timeout=TESTS_ZEND_SERVICE_RACKSPACE_TIMEOUT)
    {
        $info['status']= null;
        $i=0;
        while ((strtoupper($info['status'])!==strtoupper($status)) && ($i<$timeout)) {
            $info= $this->rackspace->getServer(self::$serverId)->toArray();
            $i+=5;
            sleep(5);
        }
        return ($i<$timeout);
    }
    /**
     * Test constants
     */
    public function testConstants()
    {
        $this->assertEquals(10240, Zend_Service_Rackspace_Servers::LIMIT_FILE_SIZE);
        $this->assertEquals(5, Zend_Service_Rackspace_Servers::LIMIT_NUM_FILE);
        $this->assertEquals('json', Zend_Service_Rackspace_Servers::API_FORMAT);
    }
    /**
     * Test authentication
     */
    public function testAuthentication()
    {
        $this->filename= __METHOD__;
        $this->assertTrue($this->rackspace->authenticate());
    }
    /**
     * Test create server
     */
    public function testCreateServer()
    {       
        $data = [
            'name'     => TESTS_ZEND_SERVICE_RACKSPACE_SERVER_NAME,
            'imageId'  => TESTS_ZEND_SERVICE_RACKSPACE_SERVER_IMAGEID,
            'flavorId' => TESTS_ZEND_SERVICE_RACKSPACE_SERVER_FLAVORID
        ];
        $server= $this->rackspace->createServer($data);
        $this->assertTrue($server!==false);
        self::$serverId= $server->getId();
        self::$adminPass= $server->getAdminPass();
        $this->assertEquals(TESTS_ZEND_SERVICE_RACKSPACE_SERVER_NAME,$server->getName());
        $this->assertTrue($this->waitForStatus('active'));
    }
    /**
     * Test Get Server
     */
    public function testGetServer()
    {
        $server= $this->rackspace->getServer(self::$serverId);
        $this->assertTrue($server!==false);
        $this->assertEquals(TESTS_ZEND_SERVICE_RACKSPACE_SERVER_NAME,$server->getName());
    }
    /**
     * Test list servers
     */
    public function testListServers()
    {
        $servers= $this->rackspace->listServers();
        $this->assertTrue($servers!==false);
    }
    /**
     * Test change server name
     */
    public function testChangeServerName()
    {
        $this->assertTrue($this->rackspace->changeServerName(self::$serverId,TESTS_ZEND_SERVICE_RACKSPACE_SERVER_NAME.'_renamed'));
    }
    /**
     * Test rechange server name
     */
    public function testRechangeServerName()
    {
        $this->assertTrue($this->rackspace->changeServerName(self::$serverId,TESTS_ZEND_SERVICE_RACKSPACE_SERVER_NAME));
    }
    /**
     * Test change admin password
     */
    public function testChangeServerPassword()
    {
        self::$adminPass= md5(time().rand());
        $this->assertTrue($this->rackspace->changeServerPassword(self::$serverId,self::$adminPass));
    }
    /**
     * Test get server IP
     */
    public function testGetServerIp()
    {
        $addresses= $this->rackspace->getServerIp(self::$serverId);
        $this->assertTrue(!empty($addresses['public']) && is_array($addresses['public']));
        $this->assertTrue(!empty($addresses['private']) && is_array($addresses['private']));
    }
    /**
     * Test get server public IP
     */
    public function testGetServerPublicIp()
    {
        $public= $this->rackspace->getServerPublicIp(self::$serverId);
        $this->assertTrue(!empty($public) && is_array($public));
    }
    /**
     * Test get server private IP
     */
    public function testGetServerPrivateIp()
    {
        $private= $this->rackspace->getServerPrivateIp(self::$serverId);
        $this->assertTrue(!empty($private) && is_array($private));
    }
    /**
     * Test reboot the server
     */
    public function testSoftRebootServer()
    {
        $this->assertTrue($this->rackspace->rebootServer(self::$serverId));
        $this->assertTrue($this->waitForStatus('active'));
    }
    /**
     * Test hard reboot the server
     */
    public function testHardRebootServer()
    {
        $this->assertTrue($this->rackspace->rebootServer(self::$serverId,true));
        $this->assertTrue($this->waitForStatus('active'));
    }
    /**
     * Test rebuild the server image
     */
    public function testRebuildServer()
    {
        $this->assertTrue($this->rackspace->rebuildServer(self::$serverId,TESTS_ZEND_SERVICE_RACKSPACE_SERVER_NEW_IMAGEID));
    }
    /**
     * Test resize server
     */
    public function testResizeServer()
    {
         $this->markTestSkipped('Resize server skipped');
    }
    /**
     * Test confirm resize server
     */
    public function testConfirmResizeServer()
    {
        $this->markTestSkipped('Confirm resize server skipped');
    }
    /**
     * Test revert resize server
     */
    public function testRevertResizeServer()
    {
        $this->markTestSkipped('Revert resize server skipped');
    }
    /**
     * Test list flavors
     */
    public function testListFlavors()
    {
        self::$flavors= $this->rackspace->listFlavors(true);
        $this->assertTrue(is_array(self::$flavors) && !empty(self::$flavors));
        $this->assertTrue(isset(self::$flavors[0]['id']));
    }
    /**
     * Test get flavor
     */
    public function testGetFlavor()
    {
        $flavor= $this->rackspace->getFlavor(self::$flavors[0]['id']);
        $this->assertTrue(is_array($flavor) && !empty($flavor));
        $this->assertEquals($flavor['id'],self::$flavors[0]['id']);
    }
    /**
     * Test list images
     */
    public function testListImages()
    {
        self::$images= $this->rackspace->listImages(true);
        $this->assertTrue(count(self::$images)>0);
        $image= self::$images[0];
        $imageId= $image->getId();
        $this->assertTrue(!empty($imageId));
    }
    /**
     * Test get image
     */
    public function testGetImage()
    {
        $image= self::$images[0];
        $getImage= $this->rackspace->getImage($image->getId());
        $this->assertEquals($getImage->getId(),$image->getId());
    }
    /**
     * Test get image info
     */
    public function testGetImageInfo()
    {
        $image= $this->rackspace->getImage(self::$images[0]->getId())->toArray();
        $this->assertTrue(is_array($image) && !empty($image));
        $this->assertEquals($image['id'],self::$images[0]->getId());
    }
    /**
     * Test create image
     */
    public function testCreateImage()
    {
        $image= $this->rackspace->createImage(self::$serverId, TESTS_ZEND_SERVICE_RACKSPACE_SERVER_IMAGE_NAME);
        if ($image!==false) {
            self::$imageId= $image->getId();
        }
        $this->assertTrue($image!==false);
        $this->assertEquals($image->getName(),TESTS_ZEND_SERVICE_RACKSPACE_SERVER_IMAGE_NAME);
    }
    /**
     * Test delete image
     */
    public function testDeleteImage()
    {
        if (isset(self::$imageId)) {
            $this->assertTrue($this->rackspace->deleteImage(self::$imageId));
        } else {
            $this->markTestSkipped('Delete image skipped because the new image has not been created');
        }
    }
    /**
     * Test get backup schedule
     */
    public function testGetBackupSchedule()
    {
        $this->markTestSkipped('Get backup schedule skipped');
    }
    /**
     * Test change backup schedule
     */
    public function testChangeBackupSchedule()
    {
        $this->markTestSkipped('Change backup schedule skipped');
    }
    /**
     * Test disable backup schedule
     */
    public function testDisableBackupSchedule()
    {
        $this->markTestSkipped('Disable backup schedule skipped');
    }
    /**
     * Test create shared Ip group
     */
    public function testCreateSharedIpGroup()
    {
        self::$sharedIpGroup= $this->rackspace->createSharedIpGroup(TESTS_ZEND_SERVICE_RACKSPACE_SERVER_SHARED_IP_GROUP_NAME, self::$serverId);
        $this->assertTrue(self::$sharedIpGroup!==false);
        $this->assertEquals(self::$sharedIpGroup->getName(),TESTS_ZEND_SERVICE_RACKSPACE_SERVER_SHARED_IP_GROUP_NAME);
    }
    /**
     * Test list shared ip groups
     */
    public function testListSharedIpGroups()
    {
        $groups= $this->rackspace->listSharedIpGroups(true);
        $this->assertTrue($groups!==false);
    }
    /**
     * Test get shared IP group 
     */
    public function testGetSharedIpGroup()
    {
        $groupId= self::$sharedIpGroup->getId();
        $group= $this->rackspace->getSharedIpGroup($groupId);
        $this->assertTrue($group!==false);
        $this->assertEquals($group->getId(), $groupId);   
    }
    /**
     * Test delete shared ip group
     */
    public function testDeleteSharedIpGroup()
    {
        $this->assertTrue($this->rackspace->deleteSharedIpGroup(self::$sharedIpGroup->getId())); 
    }
    /**
     * Test delete server
     */
    public function testDeleteServer()
    {
        $this->assertTrue($this->rackspace->deleteServer(self::$serverId));
    }
}
