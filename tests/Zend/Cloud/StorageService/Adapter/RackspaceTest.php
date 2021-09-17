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
 * @package    Zend\Cloud\StorageService\Adapter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

// Call Zend_Cloud_StorageService_Adapter_RackspaceTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Cloud_StorageService_Adapter_RackspaceTest::main");
}

require_once 'Zend/Service/Rackspace/Files.php';
require_once 'Zend/Config.php';
require_once 'Zend/Cloud/StorageService/TestCase.php';

/**
 * @category   Zend
 * @package    Zend\Cloud\StorageService\Adapter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Cloud_StorageService_Adapter_RackspaceTest extends Zend_Cloud_StorageService_TestCase
{
    protected $_clientType = 'Zend_Service_Rackspace_Files';

    public function testFetchItemStream()
    {
        // The Rackspace client library doesn't support streams
        $this->markTestSkipped('The Rackspace client library doesn\'t support streams.');
    }

    public function testStoreItemStream()
    {
        // The Rackspace client library doesn't support streams
        $this->markTestSkipped('The Rackspace client library doesn\'t support streams.');
    }

    /**
     * Sets up this test case
     *
     * @return void
     */
    public function setUp()
    {
        if (!constant('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_ENABLED')) {
            $this->markTestSkipped('Rackspace online tests are not enabled');
        }

        parent::setUp();
        $this->_waitPeriod = 5;
        
        // Create the container here
        $rackspace= new Zend_Service_Rackspace_Files(
            $this->_config->get(Zend_Cloud_StorageService_Adapter_Rackspace::USER),
            $this->_config->get(Zend_Cloud_StorageService_Adapter_Rackspace::API_KEY)
        );
        $rackspace->createContainer( 
            $this->_config->get(Zend_Cloud_StorageService_Adapter_Rackspace::REMOTE_CONTAINER)
        );
        
    }

    /**
     * Tears down this test case
     *
     * @return void
     */
    public function tearDown()
    {
        if (!$this->_config) {
            return;
        }

        // Delete the container here
        $rackspace = new Zend_Service_Rackspace_Files(
            $this->_config->get(Zend_Cloud_StorageService_Adapter_Rackspace::USER),
            $this->_config->get(Zend_Cloud_StorageService_Adapter_Rackspace::API_KEY)
        );
        $files = $rackspace->getObjects(
            $this->_config->get(Zend_Cloud_StorageService_Adapter_Rackspace::REMOTE_CONTAINER)
        );             
        if ($files==!false) {
            foreach ($files as $file) {
                $rackspace->deleteObject(
                    $this->_config->get(Zend_Cloud_StorageService_Adapter_Rackspace::REMOTE_CONTAINER),
                    $file->getName()    
                );
            }
        }    
        $rackspace->deleteContainer(
            $this->_config->get(Zend_Cloud_StorageService_Adapter_Rackspace::REMOTE_CONTAINER)   
        );
        
        parent::tearDown();
    }

    protected function _getConfig()
    {
        if (!defined('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_ENABLED')
            || !constant('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_USER')
            || !defined('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_KEY')
            || !defined('TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME')
        ) {
            $this->markTestSkipped("Rackspace access not configured, skipping test");
        }

        $config = new Zend_Config([
            Zend_Cloud_StorageService_Factory::STORAGE_ADAPTER_KEY        => 'Zend_Cloud_StorageService_Adapter_Rackspace',
            Zend_Cloud_StorageService_Adapter_Rackspace::USER             => constant('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_USER'),
            Zend_Cloud_StorageService_Adapter_Rackspace::API_KEY          => constant('TESTS_ZEND_SERVICE_RACKSPACE_ONLINE_KEY'),
            Zend_Cloud_StorageService_Adapter_Rackspace::REMOTE_CONTAINER => constant('TESTS_ZEND_SERVICE_RACKSPACE_CONTAINER_NAME')
        ]);

        return $config;
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Cloud_StorageService_Adapter_RackspaceTest::main') {
    Zend_Cloud_StorageService_Adapter_RackspaceTest::main();
}
