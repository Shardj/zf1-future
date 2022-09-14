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

date_default_timezone_set('UTC');

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_WindowsAzure_Management_ManagementClientTest::main');
}

/**
 * Test helpers
 */
require_once dirname(__FILE__) . '/../../../../TestHelper.php';
require_once dirname(__FILE__) . '/../../../../TestConfiguration.dist.php';

/** Zend_Service_WindowsAzure_Management_Client */
require_once 'Zend/Service/WindowsAzure/Management/Client.php';

/**
 * @category   Zend
 * @package    Zend_Service_WindowsAzure
 * @subpackage UnitTests
 * @version    $Id$
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_WindowsAzure_Management_ManagementClientTest extends PHPUnit_Framework_TestCase
{
	static $path;
	static $debug = true;
	protected $packageUrl;
	
    public function __construct()
    {
        self::$path = dirname(__FILE__).'/_files/';
    }
    
    public static function main()
    {
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_RUNTESTS) {
            $suite  = new PHPUnit_Framework_TestSuite("Zend_Service_WindowsAzure_Management_ManagementClientTest");
            $result = PHPUnit_TextUI_TestRunner::run($suite);
        }
    }
    
    /**
     * Test setup
     */
    protected function setUp()
    {
    	// Upload sample package to Windows Azure
    	$storageClient = $this->createStorageInstance();
    	$storageClient->createContainerIfNotExists(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_CONTAINER);
    	$storageClient->putBlob(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_CONTAINER, 'PhpOnAzure.cspkg', self::$path . 'PhpOnAzure.cspkg');

    	$this->packageUrl = $storageClient->listBlobs(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_CONTAINER);
        $this->packageUrl = $this->packageUrl[0]->Url;
    }
    
    /**
     * Test teardown
     */
    protected function tearDown()
    {
    	// Clean up storage
        $storageClient = $this->createStorageInstance();
        $storageClient->deleteContainer(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_CONTAINER);
        
        // Clean up subscription
        $managementClient = $this->createManagementClient();
        
        // Remove deployment
        try { $managementClient->updateDeploymentStatusBySlot(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, 'production', 'suspended'); $managementClient->waitForOperation(); } catch (Exception $ex) { }
		try { $managementClient->deleteDeploymentBySlot(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, 'production'); $managementClient->waitForOperation(); } catch (Exception $ex) { }

		// Remove hosted service
        try { $managementClient->deleteHostedService(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME); $managementClient->waitForOperation(); } catch (Exception $ex) { }
        
        // Remove affinity group
        try { $managementClient->deleteAffinityGroup('test'); } catch (Exception $ex) { }
    }
    
    protected function createStorageInstance()
    {
        return new Zend_Service_WindowsAzure_Storage_Blob(TESTS_ZEND_SERVICE_WINDOWSAZURE_BLOB_HOST_PROD, TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_ACCOUNT_PROD, TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_KEY_PROD, false, Zend_Service_WindowsAzure_RetryPolicy_RetryPolicyAbstract::retryN(10, 250));
    }
    
    protected function createManagementClient()
    {
    	return new Zend_Service_WindowsAzure_Management_Client(
	            TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SUBSCRIPTIONID, self::$path . '/management.pem', TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_CERTIFICATEPASSWORD);
    }
    
    protected function log($message)
    {
    	if (self::$debug) {
    		echo date('Y-m-d H:i:s') . ' - ' . $message . "\r\n";
    	}
    }
    
    /**
     * Test hosted service
     */
    public function testHostedService()
    {
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_RUNTESTS) {
        	// Create a deployment name
        	$deploymentName = 'deployment' . time();
        	
            // Create a management client
            $managementClient = $this->createManagementClient();
            
             // ** Step 1: create an affinity group
	        $this->log('Creating affinity group...');
            $managementClient->createAffinityGroup('test', 'test', 'A test affinity group.', 'North Central US');
            $this->log('Created affinity group.');
            
	        // ** Step 2: create a hosted service
	        $this->log('Creating hosted service...');
	        $managementClient->createHostedService(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, null, 'test');
	        $managementClient->waitForOperation();
	        $this->log('Created hosted service.');
	        
	        // ** Step 3: create a new deployment
	        $this->log('Creating staging deployment...');
	        $managementClient->createDeployment(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, 'staging', $deploymentName, $deploymentName, $this->packageUrl, self::$path . 'ServiceConfiguration.cscfg', false, false);
	        $managementClient->waitForOperation();
	        $this->log('Created staging deployment.');
	            
	        // ** Step 4: Run the deployment
	        $this->log('Changing status of staging deployment to running...');
	        $managementClient->updateDeploymentStatusBySlot(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, 'staging', 'running');
	        $managementClient->waitForOperation();
	        $this->log('Changed status of staging deployment to running.');
            
			// ** Step 5: Swap production <-> staging
	        $this->log('Performing VIP swap...');
			$result = $managementClient->getHostedServiceProperties(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME);
			$managementClient->swapDeployment(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, $deploymentName, $result->Deployments[0]->Name);
	        $managementClient->waitForOperation();
	        $this->log('Performed VIP swap.');
	        
	        // ** Step 6: Scale to two instances
	        $this->log('Scaling out...');
			$managementClient->setInstanceCountBySlot(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, 'production', 'PhpOnAzure.Web', 2);
	        $managementClient->waitForOperation();
	        $this->log('Scaled out.');
	        
	        // ** Step 7: Scale back
	        $this->log('Scaling in...');
			$managementClient->setInstanceCountBySlot(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, 'production', 'PhpOnAzure.Web', 1);
	        $managementClient->waitForOperation();
	        $this->log('Scaled in.');
	        
			// ** Step 8: Reboot
	        $this->log('Rebooting...');
			$managementClient->rebootRoleInstanceBySlot(TESTS_ZEND_SERVICE_WINDOWSAZURE_MANAGEMENT_SERVICENAME, 'production', 'PhpOnAzure.Web_IN_0');
	        $managementClient->waitForOperation();
	        $this->log('Rebooted.');
            
            // Dumb assertion...
            $this->assertTrue(true);
        }
    }
}

// Call Zend_Service_WindowsAzure_Management_ManagementClientTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Service_WindowsAzure_Management_ManagementClientTest::main") {
    Zend_Service_WindowsAzure_Management_ManagementClientTest::main();
}
