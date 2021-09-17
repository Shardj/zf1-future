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
    define('PHPUnit_MAIN_METHOD', 'Zend_Service_WindowsAzure_DynamicTableEntityTest::main');
}

/**
 * Test helpers
 */
require_once dirname(__FILE__) . '/../../../TestHelper.php';
require_once dirname(__FILE__) . '/../../../TestConfiguration.dist.php';

/** Zend_Service_WindowsAzure_Storage_Table */
require_once 'Zend/Service/WindowsAzure/Storage/Table.php';

/** Zend_Service_WindowsAzure_Storage_DynamicTableEntity */
require_once 'Zend/Service/WindowsAzure/Storage/DynamicTableEntity.php';

/**
 * @category   Zend
 * @package    Zend_Service_WindowsAzure
 * @subpackage UnitTests
 * @version    $Id$
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_WindowsAzure_DynamicTableEntityTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Zend_Service_WindowsAzure_DynamicTableEntityTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }
    
    /**
     * Test teardown
     */
    protected function tearDown()
    {
        $storageClient = $this->createStorageInstance();
        for ($i = 1; $i <= self::$uniqId; $i++)
        {
            try { $storageClient->deleteTable(TESTS_ZEND_SERVICE_WINDOWSAZURE_TABLE_TABLENAME_PREFIX . $i); } catch (Exception $e) { }
        }
    }
    
    protected function createStorageInstance()
    {
        $storageClient = null;
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_TABLE_RUNONPROD) {
            $storageClient = new Zend_Service_WindowsAzure_Storage_Table(TESTS_ZEND_SERVICE_WINDOWSAZURE_TABLE_HOST_PROD, TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_ACCOUNT_PROD, TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_KEY_PROD, false, Zend_Service_WindowsAzure_RetryPolicy_RetryPolicyAbstract::retryN(10, 250));
        } else {
            $storageClient = new Zend_Service_WindowsAzure_Storage_Table(TESTS_ZEND_SERVICE_WINDOWSAZURE_TABLE_HOST_DEV, TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_ACCOUNT_DEV, TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_KEY_DEV, true, Zend_Service_WindowsAzure_RetryPolicy_RetryPolicyAbstract::retryN(10, 250));
        }
        
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_USEPROXY) {
            $storageClient->setProxy(TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_USEPROXY, TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_PROXY, TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_PROXY_PORT, TESTS_ZEND_SERVICE_WINDOWSAZURE_STORAGE_PROXY_CREDENTIALS);
        }

        return $storageClient;
    }
    
    protected static $uniqId = 0;
    
    protected function generateName()
    {
        self::$uniqId++;
        return TESTS_ZEND_SERVICE_WINDOWSAZURE_TABLE_TABLENAME_PREFIX . self::$uniqId;
    }
    
    /**
     * Test constructor
     */
    public function testConstructor()
    {
        $target = new Zend_Service_WindowsAzure_Storage_DynamicTableEntity('partition1', '000001');
        $this->assertEquals('partition1', $target->getPartitionKey());
        $this->assertEquals('000001',     $target->getRowKey());
    }
    
    /**
     * Test get Azure values
     */
    public function testGetAzureValues()
    {
    	$dateTimeValue = new DateTime();
    	
        $target = new Zend_Service_WindowsAzure_Storage_DynamicTableEntity('partition1', '000001');
        $target->Name = 'Name';
        $target->Age  = 25;
        $target->DateInService = $dateTimeValue;
        $result = $target->getAzureValues();

        $this->assertEquals('Name',       $result[0]->Name);
        $this->assertEquals('Name',       $result[0]->Value);
        $this->assertEquals('Edm.String', $result[0]->Type);
        
        $this->assertEquals('Age',        $result[1]->Name);
        $this->assertEquals(25,           $result[1]->Value);
        $this->assertEquals('Edm.Int32',  $result[1]->Type);
        
        $this->assertEquals('DateInService',	$result[2]->Name);
        $this->assertEquals($dateTimeValue,  	$result[2]->Value);
        $this->assertEquals('Edm.DateTime',  	$result[2]->Type);
        
        $this->assertEquals('partition1', $result[3]->Value);
        $this->assertEquals('000001',     $result[4]->Value);
    }
    
    /**
     * Test set Azure values
     */
    public function testSetAzureValues()
    {
    	$dateTimeValue = new DateTime();
    	
        $values = [
            'PartitionKey' => 'partition1',
            'RowKey' => '000001',
            'Name' => 'Maarten',
            'Age' => 25,
            'Visible' => true,
        	'DateInService' => $dateTimeValue
        ];
        
        $target = new Zend_Service_WindowsAzure_Storage_DynamicTableEntity();
        $target->setAzureValues($values);
        $target->setAzurePropertyType('Age', 'Edm.Int32');

        $this->assertEquals('partition1', $target->getPartitionKey());
        $this->assertEquals('000001',     $target->getRowKey());
        $this->assertEquals('Maarten',    $target->Name);
        $this->assertEquals(25,           $target->Age);
        $this->assertEquals('Edm.Int32',  $target->getAzurePropertyType('Age'));
        $this->assertEquals(true,         $target->Visible);
        $this->assertEquals($dateTimeValue,		$target->DateInService);
        $this->assertEquals('Edm.DateTime',  	$target->getAzurePropertyType('DateInService'));
    }
    
    /**
     * Test insert entity
     */
    public function testInsertEntity()
    {
        if (TESTS_ZEND_SERVICE_WINDOWSAZURE_TABLE_RUNTESTS) {
            $tableName = $this->generateName();
            $storageClient = $this->createStorageInstance();
            $storageClient->createTable($tableName);
            
            $entity = new Zend_Service_WindowsAzure_Storage_DynamicTableEntity();
            $entity->Name = 'Maarten';
            $entity->Age = 25;
            $entity->Inserted = new DateTime();
            $entity->TestValue = 200000;
            $entity->NullStringValue = null;
            
            $result = $storageClient->insertEntity($tableName, $entity);
            $this->assertNotEquals('0001-01-01T00:00:00', $result->getTimestamp());
            $this->assertNotEquals('', $result->getEtag());
            $this->assertEquals($entity->getAzureValues(), $result->getAzureValues());
        }
    }
}

// Call Zend_Service_WindowsAzure_DynamicTableEntityTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Service_WindowsAzure_DynamicTableEntityTest::main") {
    Zend_Service_WindowsAzure_DynamicTableEntityTest::main();
}
