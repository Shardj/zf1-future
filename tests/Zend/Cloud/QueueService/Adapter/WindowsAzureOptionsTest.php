<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

require_once 'Zend/Cloud/QueueService/Adapter/WindowsAzure.php';
require_once 'Zend/Http/Client/Adapter/Test.php';

/**
 * @group Zend_Cloud
 */
class Zend_Cloud_QueueService_Adapter_WindowsAzureOptionsTest extends TestCase
{
    public function testHttpAdapterOptionIsPassedToStorageClient()
    {
        $httpAdapter = new Zend_Http_Client_Adapter_Test();

        $adapter = new Zend_Cloud_QueueService_Adapter_WindowsAzure([
            Zend_Cloud_QueueService_Adapter_WindowsAzure::ACCOUNT_NAME => 'account',
            Zend_Cloud_QueueService_Adapter_WindowsAzure::ACCOUNT_KEY  => base64_encode('key'),
            Zend_Cloud_QueueService_Adapter_WindowsAzure::HTTP_ADAPTER => $httpAdapter,
        ]);

        $this->assertSame($httpAdapter, $adapter->getClient()->getHttpClientChannel()->getAdapter());
    }
}
