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
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

// Call Zend_Cloud_StorageService_FactoryTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Cloud_StorageService_FactoryTest::main");
}

/**
 * @see Zend_Config_Ini
 */
require_once 'Zend/Config/Ini.php';

/**
 * @see Zend_Cloud_StorageService_Factory
 */
require_once 'Zend/Cloud/StorageService/Factory.php';

require_once 'Zend/Cloud/StorageService/Adapter/FileSystem.php';

require_once 'Zend/Cloud/StorageService/Adapter/S3.php';

require_once 'Zend/Cloud/StorageService/Adapter/WindowsAzure.php';

require_once 'Zend/Http/Client/Adapter/Test.php';

/**
 * Test class for Zend_Cloud_StorageService_Factory
 *
 * @category   Zend
 * @package    Zend_Cloud
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Cloud
 */
class Zend_Cloud_StorageService_FactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testGetStorageAdapterKey()
    {
        $this->assertTrue(is_string(Zend_Cloud_StorageService_Factory::STORAGE_ADAPTER_KEY));
    }

    public function testGetAdapterWithConfig()
    {
        $httptest = new Zend_Http_Client_Adapter_Test();

        // S3 adapter
        $s3Config = new Zend_Config_Ini(realpath(dirname(__FILE__) . '/_files/config/s3.ini'));
        $s3Adapter = Zend_Cloud_StorageService_Factory::getAdapter($s3Config);
        $this->assertEquals('Zend_Cloud_StorageService_Adapter_S3', get_class($s3Adapter));

        // file system adapter
        $fileSystemConfig = new Zend_Config_Ini(realpath(dirname(__FILE__) . '/_files/config/filesystem.ini'));
        $fileSystemAdapter = Zend_Cloud_StorageService_Factory::getAdapter($fileSystemConfig);
        $this->assertEquals('Zend_Cloud_StorageService_Adapter_FileSystem', get_class($fileSystemAdapter));

        // Azure adapter
        $azureConfig    = new Zend_Config_Ini(realpath(dirname(__FILE__) . '/_files/config/windowsazure.ini'));
        $azureConfig    = $azureConfig->toArray();
        $azureContainer = $azureConfig[Zend_Cloud_StorageService_Adapter_WindowsAzure::CONTAINER];
        $azureConfig[Zend_Cloud_StorageService_Adapter_WindowsAzure::HTTP_ADAPTER] = $httptest;
        $q = "?";

        $doc = new DOMDocument('1.0', 'utf-8');
        $root = $doc->createElement('EnumerationResults');
        $acctName = $doc->createAttribute('AccountName');
        $acctName->value = 'http://myaccount.blob.core.windows.net';
        $root->appendChild($acctName);
        $maxResults     = $doc->createElement('MaxResults', 1);
        $containers     = $doc->createElement('Containers');
        $container      = $doc->createElement('Container');
        $containerName  = $doc->createElement('Name', $azureContainer);
        $container->appendChild($containerName);
        $containers->appendChild($container);
        $root->appendChild($maxResults);
        $root->appendChild($containers);
        $doc->appendChild($root);
        $body = $doc->saveXML();

        $resp = new Zend_Http_Response(200, ['x-ms-request-id' => 0], $body);
        $httptest->setResponse($resp);
        $azureAdapter = Zend_Cloud_StorageService_Factory::getAdapter($azureConfig);
        $this->assertEquals('Zend_Cloud_StorageService_Adapter_WindowsAzure', get_class($azureAdapter));
    }

    public function testGetAdapterWithArray()
    {
        // No need to overdo it; we'll test the array config with just one adapter.
        $fileSystemConfig = [
            Zend_Cloud_StorageService_Factory::STORAGE_ADAPTER_KEY        => 'Zend_Cloud_StorageService_Adapter_FileSystem',
            Zend_Cloud_StorageService_Adapter_FileSystem::LOCAL_DIRECTORY => dirname(__FILE__) ."/_files/data",
        ];
        $fileSystemAdapter = Zend_Cloud_StorageService_Factory::getAdapter($fileSystemConfig);
        $this->assertEquals('Zend_Cloud_StorageService_Adapter_FileSystem', get_class($fileSystemAdapter));
    }
}

// Call Zend_Cloud_StorageService_FactoryTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Cloud_StorageService_FactoryTest::main") {
    Zend_Cloud_StorageService_FactoryTest::main();
}
