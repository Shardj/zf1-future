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
 * @package    Zend\Cloud\Infrastructure\Adapter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once 'Zend/Http/Client/Adapter/Test.php';
require_once 'Zend/Cloud/Infrastructure/Adapter/Rackspace.php';
require_once 'Zend/Cloud/Infrastructure/Factory.php';

class Zend_Cloud_Infrastructure_Adapter_RackspaceTest extends PHPUnit_Framework_TestCase
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
            Zend_Cloud_Infrastructure_Factory::INFRASTRUCTURE_ADAPTER_KEY => 'Zend_Cloud_Infrastructure_Adapter_Rackspace', 
            Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_USER   => 'foo', 
            Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_KEY    => 'bar', 
            Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_REGION => 'USA'   
        ]); 

        $this->httpClientAdapterTest = new Zend_Http_Client_Adapter_Test();

        $this->infrastructure->getAdapter()
                             ->getHttpClient()
                             ->setAdapter($this->httpClientAdapterTest);
        
        // load the HTTP response (from a file)
        $shortClassName = 'RackspaceTest';
        $filename= dirname(__FILE__) . '/_files/' . $shortClassName . '_'. $this->getName().'.response';
        
        if (file_exists($filename)) {
            // authentication (from file)
            $content = dirname(__FILE__) . '/_files/'.$shortClassName . '_testAuthenticate.response';
            $this->httpClientAdapterTest->setResponse($this->loadResponse($content));
            $this->assertTrue($this->infrastructure->getAdapter()->authenticate(),'Authentication failed');
            
            $this->httpClientAdapterTest->setResponse($this->loadResponse($filename)); 
        }
        
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
            Zend_Cloud_Infrastructure_Factory::INFRASTRUCTURE_ADAPTER_KEY => 'Zend_Cloud_Infrastructure_Adapter_Rackspace',
            Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_USER   => constant('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_USER'),
            Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_KEY    => constant('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_KEY'),
            Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_REGION => constant('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_REGION')
        ];
    }
    
    /**
     * Test all the constants of the class
     */
    public function testConstants()
    {
        $this->assertEquals('rackspace_user', Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_USER);
        $this->assertEquals('rackspace_key', Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_KEY);
        $this->assertEquals('rackspace_region', Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_REGION);
        $this->assertEquals('USA', Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_ZONE_USA);
        $this->assertEquals('UK', Zend_Cloud_Infrastructure_Adapter_Rackspace::RACKSPACE_ZONE_UK);
        $this->assertTrue(Zend_Cloud_Infrastructure_Adapter_Rackspace::MONITOR_CPU_SAMPLES>0);
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
        $instance = new Zend_Cloud_Infrastructure_Adapter_Rackspace('foo');
    }
    /**
     * Test getAdapter
     */
    public function testGetAdapter()
    {
        $this->assertTrue(
            $this->infrastructure->getAdapter() instanceof Zend_Service_Rackspace_Servers
        );
    }
    /**
     * Test create an instance
     */
    public function testCreateInstance()
    {
        $options = [
            'imageId'  => constant('TESTS_ZEND_SERVICE_RACKSPACE_SERVER_IMAGEID'),
            'flavorId' => constant('TESTS_ZEND_SERVICE_RACKSPACE_SERVER_FLAVORID'),
            'metadata' => [
                'foo' => 'bar'
            ]
        ];
        $instance = $this->infrastructure->createInstance(constant('TESTS_ZEND_SERVICE_RACKSPACE_SERVER_IMAGE_NAME'), $options);
        self::$instanceId= $instance->getId();
        $this->assertEquals(constant('TESTS_ZEND_SERVICE_RACKSPACE_SERVER_IMAGEID'), $instance->getImageId());
    }
    /**
     * Test list of an instance
     */
    public function testListInstance()
    {
        $instances = $this->infrastructure->listInstances(self::$instanceId);
        $this->assertTrue(!empty($instances));
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
        $this->markTestSkipped('Test monitor instance skipped');
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

if (PHPUnit_MAIN_METHOD == 'Zend_Cloud_Infrastructure_Adapter_RackspaceTest::main') {
    Zend_Cloud_Infrastructure_Adapter_RackspaceTest::main();
}
