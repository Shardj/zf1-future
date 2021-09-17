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
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_SqlAzure_Management_ManagementClientTest::main');
}

/**
 * Test helpers
 */
require_once dirname(__FILE__) . '/../../../../TestHelper.php';
require_once dirname(__FILE__) . '/../../../../TestConfiguration.dist.php';

/** Zend_Service_SqlAzure_Management_Client */
require_once 'Zend/Service/SqlAzure/Management/Client.php';

/**
 * @category   Zend
 * @package    Zend_Service_SqlAzure
 * @subpackage UnitTests
 * @version    $Id$
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_SqlAzure_Management_ManagementClientTest extends PHPUnit_Framework_TestCase
{
	static $path;
	static $debug = true;
	static $serverName = '';
	
    public function __construct()
    {
        self::$path = dirname(__FILE__).'/_files/';
    }
    
    public static function main()
    {
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_SQLMANAGEMENT_RUNTESTS) {
            $suite  = new PHPUnit_Framework_TestSuite("Zend_Service_SqlAzure_Management_ManagementClientTest");
            $result = PHPUnit_TextUI_TestRunner::run($suite);
        }
    }
    
    /**
     * Test teardown
     */
    protected function tearDown()
    {
        // Clean up server
        $managementClient = $this->createManagementClient();
        
        // Remove server
        try { $managementClient->dropServer(self::$serverName); } catch (Exception $ex) { }
    }
    
    protected function createManagementClient()
    {
    	return new Zend_Service_SqlAzure_Management_Client(
	            TESTS_ZEND_SERVICE_WINDOWSAZURE_SQLMANAGEMENT_SUBSCRIPTIONID, self::$path . '/management.pem', TESTS_ZEND_SERVICE_WINDOWSAZURE_SQLMANAGEMENT_CERTIFICATEPASSWORD);
    }
    
    protected function log($message)
    {
    	if (self::$debug) {
    		echo date('Y-m-d H:i:s') . ' - ' . $message . "\r\n";
    	}
    }
    
    /**
     * Test create and configure server
     */
    public function testCreateAndConfigureServer()
    {
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_SQLMANAGEMENT_RUNTESTS) {
            // Create a management client
            $managementClient = $this->createManagementClient();
            
             // ** Step 1: create a server
	        $this->log('Creating server...');
	        $server = $managementClient->createServer('sqladm', '@@cool1OO', 'West Europe');
	        $this->assertEquals('sqladm', $server->AdministratorLogin);
	        $this->assertEquals('West Europe', $server->Location);
	        self::$serverName = $server->Name;
            $this->log('Created server.');
            
	        // ** Step 2: change password
	        $this->log('Changing password...');
	        $managementClient->setAdministratorPassword($server->Name, '@@cool1OO11');
	        $this->log('Changed password...');
	        
	        // ** Step 3: add firewall rule
	        $this->log('Creating firewall rule...');
			$managementClient->createFirewallRuleForMicrosoftServices($server->Name, true);
			$result = $managementClient->listFirewallRules($server->Name);
	        $this->assertEquals(1, count($result));
	        $this->log('Created firewall rule.');
	        
	        // ** Step 4: remove firewall rule
	        $this->log('Removing firewall rule...');
			$managementClient->createFirewallRuleForMicrosoftServices($server->Name, false);
			$result = $managementClient->listFirewallRules($server->Name);
	        $this->assertEquals(0, count($result));
	        $this->log('Removed firewall rule.');
            
			// ** Step 5: Drop server
	        $this->log('Dropping server...');
			$managementClient->dropServer($server->Name);
	        $this->log('Dropped server.');
        }
    }
}

// Call Zend_Service_SqlAzure_Management_ManagementClientTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Service_SqlAzure_Management_ManagementClientTest::main") {
    Zend_Service_SqlAzure_Management_ManagementClientTest::main();
}
