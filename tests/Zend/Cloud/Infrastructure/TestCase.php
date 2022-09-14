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
 * @package    Zend_Cloud
 * @subpackage Infrastructure
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @see Zend_Cloud_Infrastructure_Adapter
 */
require_once 'Zend/Cloud/Infrastructure/Adapter.php';

/**
 * @see Zend_Cloud_Infrastructure_Instance
 */
require_once 'Zend/Cloud/Infrastructure/Instance.php';


/**
 * This class forces the adapter tests to implement tests for all methods on
 * Zend_Cloud_Infrastructure.
 *
 * @category   Zend
 * @package    Zend_Cloud
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Zend_Cloud_Infrastructure_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Reference to Document adapter to test
     *
     * @var Zend_Cloud_Infrastructure
     */
    protected $_commonInfrastructure;

    protected $_dummyCollectionNamePrefix = 'TestCollection';

    protected $_dummyDataPrefix = 'TestData';

    protected $_clientType = 'stdClass';

    const ID_FIELD = "__id";

    /**
     * Config object
     *
     * @var Zend_Config
     */

    protected $_config;

    /**
     * Period to wait for propagation in seconds
     * Should be set by adapter
     *
     * @var int
     */
    protected $_waitPeriod = 1;

    public function testInfrastructure()
    {
        $this->assertTrue($this->_commonInfrastructure instanceof Zend_Cloud_Infrastructure_Adapter);
    }

    public function testGetClient()
    {
    	$this->assertTrue(is_a($this->_commonInfrastructure->getClient(), $this->_clientType));
    }

    /**
     * Test all the constants of the class
     */
    public function testConstants()
    {
        $this->assertEquals('running', Zend_Cloud_Infrastructure_Instance::STATUS_RUNNING);
        $this->assertEquals('stopped', Zend_Cloud_Infrastructure_Instance::STATUS_STOPPED);
        $this->assertEquals('shutting-down', Zend_Cloud_Infrastructure_Instance::STATUS_SHUTTING_DOWN);
        $this->assertEquals('rebooting', Zend_Cloud_Infrastructure_Instance::STATUS_REBOOTING);
        $this->assertEquals('terminated', Zend_Cloud_Infrastructure_Instance::STATUS_TERMINATED);
        $this->assertEquals('id', Zend_Cloud_Infrastructure_Instance::INSTANCE_ID);
        $this->assertEquals('imageId', Zend_Cloud_Infrastructure_Instance::INSTANCE_IMAGEID);
        $this->assertEquals('name', Zend_Cloud_Infrastructure_Instance::INSTANCE_NAME);
        $this->assertEquals('status', Zend_Cloud_Infrastructure_Instance::INSTANCE_STATUS);
        $this->assertEquals('publicDns', Zend_Cloud_Infrastructure_Instance::INSTANCE_PUBLICDNS);
        $this->assertEquals('cpu', Zend_Cloud_Infrastructure_Instance::INSTANCE_CPU);
        $this->assertEquals('ram', Zend_Cloud_Infrastructure_Instance::INSTANCE_RAM);
        $this->assertEquals('storageSize', Zend_Cloud_Infrastructure_Instance::INSTANCE_STORAGE);
        $this->assertEquals('zone', Zend_Cloud_Infrastructure_Instance::INSTANCE_ZONE);
        $this->assertEquals('launchTime', Zend_Cloud_Infrastructure_Instance::INSTANCE_LAUNCHTIME);
        $this->assertEquals('CpuUsage', Zend_Cloud_Infrastructure_Instance::MONITOR_CPU);
        $this->assertEquals('NetworkIn', Zend_Cloud_Infrastructure_Instance::MONITOR_NETWORK_IN);
        $this->assertEquals('NetworkOut', Zend_Cloud_Infrastructure_Instance::MONITOR_NETWORK_OUT);
        $this->assertEquals('DiskWrite', Zend_Cloud_Infrastructure_Instance::MONITOR_DISK_WRITE);
        $this->assertEquals('DiskRead', Zend_Cloud_Infrastructure_Instance::MONITOR_DISK_READ);
        $this->assertEquals('StartTime', Zend_Cloud_Infrastructure_Instance::MONITOR_START_TIME);
        $this->assertEquals('EndTime', Zend_Cloud_Infrastructure_Instance::MONITOR_END_TIME);
        $this->assertEquals('username', Zend_Cloud_Infrastructure_Instance::SSH_USERNAME);
        $this->assertEquals('password', Zend_Cloud_Infrastructure_Instance::SSH_PASSWORD);
        $this->assertEquals('privateKey', Zend_Cloud_Infrastructure_Instance::SSH_PRIVATE_KEY);
        $this->assertEquals('publicKey', Zend_Cloud_Infrastructure_Instance::SSH_PUBLIC_KEY);
        $this->assertEquals('passphrase', Zend_Cloud_Infrastructure_Instance::SSH_PASSPHRASE);
    }

    /**
     * Test construct with missing params
     */
    public function testConstructExceptionMissingParams() 
    {
        $this->setExpectedException(
            'Zend\Cloud\Infrastructure\Exception\InvalidArgumentException',
            'You must pass an array of params'
        );
        $instance = new Zend_Cloud_Infrastructure_Instance(self::$adapter,[]);
    }

    /**
     * Test construct with invalid keys in the params
     */
    public function testConstructExceptionInvalidKeys()
    {
        $this->setExpectedException(
            'Zend\Cloud\Infrastructure\Exception\InvalidArgumentException',
            'The param "'.Zend_Cloud_Infrastructure_Instance::INSTANCE_ID.'" is a required param for Zend\Cloud\Infrastructure\Instance'
        );
        $instance = new Zend_Cloud_Infrastructure_Instance(self::$adapter,['foo'=>'bar']);
    }

    /**
     * Test get Id
     */
    public function testGetId()
    {
        $this->assertEquals('foo',$this->_commonInfrastructure->getId());
        $this->assertEquals('foo',$this->_commonInfrastructure->getAttribute(Instance::INSTANCE_ID));
    }

    /**
     * Test get Image Id
     */
    public function testGetImageId()
    {
        $this->assertEquals('foo',$this->_commonInfrastructure->getImageId());
        $this->assertEquals('foo',$this->_commonInfrastructure->getAttribute(Instance::INSTANCE_IMAGEID));
    }

    /**
     * Test get name
     */
    public function testGetName()
    {
        $this->assertEquals('foo',$this->_commonInfrastructure->getName());
        $this->assertEquals('foo',$this->_commonInfrastructure->getAttribute(Instance::INSTANCE_NAME));
    }

    /**
     * Test get status
     */
    public function testGetStatus()
    {
        $this->assertEquals('ZendTest\Cloud\Infrastructure\TestAsset\MockAdapter::statusInstance',$this->_commonInfrastructure->getStatus());
        $this->assertEquals('foo',$this->_commonInfrastructure->getAttribute(Instance::INSTANCE_STATUS));
    }

    /**
     * Test get public DNS
     */
    public function testGetPublicDns()
    {
        $this->assertEquals('foo',$this->_commonInfrastructure->getPublicDns());
        $this->assertEquals('foo',$this->_commonInfrastructure->getAttribute(Instance::INSTANCE_PUBLICDNS));
    }

    /**
     * Test get CPU
     */
    public function testGetCpu()
    {
        $this->assertEquals('foo',$this->_commonInfrastructure->getCpu());
        $this->assertEquals('foo',$this->_commonInfrastructure->getAttribute(Instance::INSTANCE_CPU));
    }

    /**
     * Test get RAM size
     */
    public function testGetRam()
    {
        $this->assertEquals('foo',$this->_commonInfrastructure->getRamSize());
        $this->assertEquals('foo',$this->_commonInfrastructure->getAttribute(Instance::INSTANCE_RAM));
    }

    /**
     * Test get storage size (disk)
     */
    public function testGetStorageSize()
    {
        $this->assertEquals('foo',$this->_commonInfrastructure->getStorageSize());
        $this->assertEquals('foo',$this->_commonInfrastructure->getAttribute(Instance::INSTANCE_STORAGE));
    }

    /**
     * Test get zone
     */
    public function testGetZone()
    {
        $this->assertEquals('foo',$this->_commonInfrastructure->getZone());
        $this->assertEquals('foo',$this->_commonInfrastructure->getAttribute(Instance::INSTANCE_ZONE));
    }

    /**
     * Test get the launch time of the instance
     */
    public function testGetLaunchTime()
    {
        $this->assertEquals('foo',$this->_commonInfrastructure->getLaunchTime());
        $this->assertEquals('foo',$this->_commonInfrastructure->getAttribute(Instance::INSTANCE_LAUNCHTIME));
    }

    /**
     * Test reboot
     */
    public function testReboot()
    {
        $this->assertEquals('ZendTest\Cloud\Infrastructure\TestAsset\MockAdapter::rebootInstance',$this->_commonInfrastructure->reboot());
    }

    /**
     * Test stop
     */
    public function testStop()
    {
        $this->assertEquals('ZendTest\Cloud\Infrastructure\TestAsset\MockAdapter::stopInstance',$this->_commonInfrastructure->stop());
    }

    /**
     * Test start
     */
    public function testStart()
    {
        $this->assertEquals('ZendTest\Cloud\Infrastructure\TestAsset\MockAdapter::startInstance',$this->_commonInfrastructure->start());
    }

    /**
     * Test destroy
     */
    public function testDestroy()
    {
        $this->assertEquals('ZendTest\Cloud\Infrastructure\TestAsset\MockAdapter::destroyInstance',$this->_commonInfrastructure->destroy());
    }

    /**
     * Test monitor
     */
    public function testMonitor()
    {
        $this->assertEquals('ZendTest\Cloud\Infrastructure\TestAsset\MockAdapter::monitorInstance',$this->_commonInfrastructure->monitor('foo'));
    }

    /**
     * Test deploy
     */
    public function testDeploy()
    {
        $this->assertEquals('ZendTest\Cloud\Infrastructure\TestAsset\MockAdapter::deployInstance',$this->_commonInfrastructure->deploy('foo','bar'));
    }

    public function setUp()
    {
        $this->_config = $this->_getConfig();
        $this->_commonInfrastructure = Zend_Cloud_Infrastructure_Factory::getAdapter($this->_config);
        parent::setUp();
    }

    abstract protected function _getConfig();

    protected function _wait() {
        sleep($this->_waitPeriod);
    }

}
