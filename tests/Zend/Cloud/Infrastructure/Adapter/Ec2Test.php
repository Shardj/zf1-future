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
 * @package    Zend_Cloud_Infrastructure_Adapter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once 'Zend/Http/Client.php';
require_once 'Zend/Http/Client/Adapter/Test.php';
require_once 'Zend/Cloud/Infrastructure/Adapter/Ec2.php';
require_once 'Zend/Cloud/Infrastructure/Factory.php';

class Zend_Cloud_Infrastructure_Adapter_Ec2Test extends PHPUnit_Framework_TestCase
{
    /**
     * Timeout in seconds for status change
     */
    const STATUS_TIMEOUT= 120;

    /**
     * Reference to Infrastructure object
     *
     * @var Zend_Cloud_Infrastructure_Adapter
     */
    protected $infrastructure;

    /**
     * Socket based HTTP client adapter
     *
     * @var Zend_Http_Client_Adapter_Test
     */
    protected $httpClientAdapterTest;
    
    /**
     * Image ID of the instance
     * 
     * @var string
     */
    protected static $instanceId;

    /**
     * Setup for each test
     */
    public function setUp()
    {
        $this->infrastructure = Zend_Cloud_Infrastructure_Factory::getAdapter([ 
            Zend_Cloud_Infrastructure_Factory::INFRASTRUCTURE_ADAPTER_KEY => 'Zend_Cloud_Infrastructure_Adapter_Ec2', 
            Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_ACCESS_KEY         => 'foo', 
            Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_SECRET_KEY         => 'bar', 
            Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_REGION             => 'us-east-1'     
        ]); 

        $this->httpClientAdapterTest = new Zend_Http_Client_Adapter_Test();     

        // load the HTTP response (from a file)
        $shortClassName = substr(__CLASS__,strlen('Zend_Cloud_Infrastructure_Adapter_'));
        $filename= dirname(__FILE__) . '/_files/' . $shortClassName . '_'. $this->getName().'.response';

        if (file_exists($filename)) {
            $this->httpClientAdapterTest->setResponse($this->loadResponse($filename)); 
        }
        
        $adapter= $this->infrastructure->getAdapter();
        
        $client = new Zend_Http_Client(null, [
            'adapter' => $this->httpClientAdapterTest
        ]);
        
        call_user_func([$adapter,'setHttpClient'],$client);
    
    }
    /**
     * Utility method for returning a string HTTP response, which is loaded from a file
     *
     * @param  string $name
     * @return string
     */
    protected function loadResponse($name)
    {
        $response = file_get_contents($name);

        // Line endings are sometimes an issue inside the canned responses; the
        // following is a negative lookbehind assertion, and replaces any \n
        // not preceded by \r with the sequence \r\n, ensuring that the message
        // is well-formed.
        return preg_replace("#(?<!\r)\n#", "\r\n", $response);
    }
    /**
     * Get Config Array
     * 
     * @return array
     */ 
    static function getConfigArray()
    {
         return [
            Zend_Cloud_Infrastructure_Factory::INFRASTRUCTURE_ADAPTER_KEY => 'Zend_Cloud_Infrastructure_Adapter_Ec2',
            Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_ACCESS_KEY         => 'foo',
            Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_SECRET_KEY         => 'bar',
            Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_REGION             => 'us-east-1',
            Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_SECURITY_GROUP     => 'default'
        ];
    }
    
    /**
     * Test all the constants of the class
     */
    public function testConstants()
    {
        $this->assertEquals('aws_accesskey', Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_ACCESS_KEY);
        $this->assertEquals('aws_secretkey', Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_SECRET_KEY);
        $this->assertEquals('aws_region', Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_REGION);
    }

    /**
     * Test construct with missing params
     */
    public function testConstructExceptionMissingParams() 
    {
        $this->setExpectedException(
            'Zend_Cloud_Infrastructure_Exception',
            'Invalid options provided'
        );
        $image = new Zend_Cloud_Infrastructure_Adapter_Ec2('foo');
    }

    /**
     * Test getAdapter
     */
    public function testGetAdapter()
    {
        $this->assertTrue(
            $this->infrastructure->getAdapter() instanceof Zend_Service_Amazon_Ec2_Instance
        );
    }

    /**
     * Test create an instance
     */
    public function testCreateInstance()
    {
        $options = [
            Zend_Cloud_Infrastructure_Instance::INSTANCE_IMAGEID      => 'ami-7f418316',
            Zend_Cloud_Infrastructure_Adapter_Ec2::AWS_SECURITY_GROUP => ['default']
        ];       
        $instance = $this->infrastructure->createInstance('test', $options);
        self::$instanceId= $instance->getId();
        $this->assertEquals('ami-7f418316', $instance->getImageId());
    }

    /**
     * Test list of an instance
     */
    public function testListInstance()
    {
        $instances = $this->infrastructure->listInstances(self::$instanceId);
        $found = false;
        foreach ($instances as $instance) {
            if ($instance->getId()==self::$instanceId) {
                $found = true;
                break;
            }
        }
        $this->assertTrue($found);
    }

    /**
     * Test images instance
     */
    public function testImagesInstance()
    {
        $images = $this->infrastructure->imagesInstance();
        $this->assertTrue(!empty($images));
    }

    /**
     * Test zones instance
     */
    public function testZonesInstance()
    {
        $zones = $this->infrastructure->zonesInstance();
        $this->assertTrue(!empty($zones));
    }

    /**
     * Test monitor instance
     */
    public function testMonitorInstance()
    {
        $monitor       = $this->infrastructure->monitorInstance(self::$instanceId,Zend_Cloud_Infrastructure_Instance::MONITOR_CPU);
        $adapterResult = $this->infrastructure->getAdapterResult();
        $this->assertTrue(!empty($adapterResult['label']));
    }

    /**
     * Test deploy instance
     */
    public function testDeployInstance()
    {
        $this->markTestSkipped('Test deploy instance skipped');
    }

    /**
     * Test stop an instance
     */
    public function testStopInstance()
    {
        $this->markTestSkipped('Test stop instance skipped');
    }

    /**
     * Test start an instance
     */
    public function testStartInstance()
    {
        $this->markTestSkipped('Test start instance skipped');   
    }

    /**
     * Test reboot and instance
     */
    public function testRebootInstance()
    {
        $this->assertTrue($this->infrastructure->rebootInstance(self::$instanceId));    
    }

    /**
     * Test destroy instance
     */
    public function testDestroyInstance()
    {
        $this->assertTrue($this->infrastructure->destroyInstance(self::$instanceId));
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Cloud_Infrastructure_Adapter_Ec2Test::main') {
    Zend_Cloud_Infrastructure_Adapter_Ec2Test::main();
}
