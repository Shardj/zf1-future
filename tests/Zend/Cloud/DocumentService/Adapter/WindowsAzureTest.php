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
 * @package    Zend_Cloud_Document
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */


// Call Zend_Cloud_Document_Adapter_WindowsAzureTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Cloud_DocumentService_Adapter_WindowsAzureTest::main");
}

/**
 * @see Zend_Cloud_DocumentServiceTestCase
 */
require_once 'Zend/Cloud/DocumentService/TestCase.php';

/**
 * @see Zend_Cloud_DocumentService_Adapter_WindowsAzure
 */
require_once 'Zend/Cloud/DocumentService/Adapter/WindowsAzure.php';

/**
 * @see Zend_Cloud_DocumentService_Factory
 */
require_once 'Zend/Cloud/DocumentService/Factory.php';

/** @see Zend_Config */
require_once 'Zend/Config.php';

/**
 * @category   Zend
 * @package    Zend_Cloud
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Cloud_DocumentService_Adapter_WindowsAzureTest
    extends Zend_Cloud_DocumentService_TestCase
{
    /**
     * Period to wait for propagation in seconds
     * Should be set by adapter
     *
     * @var int
     */
    protected $_waitPeriod = 10;

    protected $_clientType = 'Zend_Service_WindowsAzure_Storage_Table';

	/**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testQueryStructOrder()
    {
        try {
            parent::testQueryStructOrder();
        } catch(Zend_Cloud_OperationNotAvailableException $e) {
            $this->_commonDocument->deleteCollection($this->_collectionName("testStructQuery4"));
            $this->markTestSkipped('Azure query sorting not implemented yet');
        }
    }

    static function getConfigArray()
    {
         return [
            Zend_Cloud_DocumentService_Factory::DOCUMENT_ADAPTER_KEY => 'Zend_Cloud_DocumentService_Adapter_WindowsAzure',
            Zend_Cloud_DocumentService_Adapter_WindowsAzure::ACCOUNT_NAME => constant('TESTS_ZEND_SERVICE_WINDOWSAZURE_ONLINE_ACCOUNTNAME'),
            Zend_Cloud_DocumentService_Adapter_WindowsAzure::ACCOUNT_KEY => constant('TESTS_ZEND_SERVICE_WINDOWSAZURE_ONLINE_ACCOUNTKEY'),
            Zend_Cloud_DocumentService_Adapter_WindowsAzure::HOST => constant('TESTS_ZEND_SERVICE_WINDOWSAZURE_ONLINE_TABLE_HOST'),
            Zend_Cloud_DocumentService_Adapter_WindowsAzure::PROXY_HOST => constant('TESTS_ZEND_SERVICE_WINDOWSAZURE_ONLINE_STORAGE_PROXY_HOST'),
            Zend_Cloud_DocumentService_Adapter_WindowsAzure::PROXY_PORT => constant('TESTS_ZEND_SERVICE_WINDOWSAZURE_ONLINE_STORAGE_PROXY_PORT'),
            Zend_Cloud_DocumentService_Adapter_WindowsAzure::PROXY_CREDENTIALS => constant('TESTS_ZEND_SERVICE_WINDOWSAZURE_ONLINE_STORAGE_PROXY_CREDENTIALS'),
        ];
    }

    protected function _getConfig()
    {
        if (!defined('TESTS_ZEND_SERVICE_WINDOWSAZURE_ONLINE_ENABLED') ||
            !constant('TESTS_ZEND_SERVICE_WINDOWSAZURE_ONLINE_ENABLED') ||
            !defined('TESTS_ZEND_SERVICE_WINDOWSAZURE_ONLINE_ACCOUNTNAME') ||
            !defined('TESTS_ZEND_SERVICE_WINDOWSAZURE_ONLINE_ACCOUNTKEY')) {
            $this->markTestSkipped("Windows Azure access not configured, skipping test");
        }

        $config = new Zend_Config(self::getConfigArray());

        return $config;
    }

    protected function _getDocumentData()
    {
        return [
            [
	        	parent::ID_FIELD => ["Amazon", "0385333498"],
	        	"name" =>	"The Sirens of Titan",
	        	"author" =>	"Kurt Vonnegut",
	        	"year"	=> 1959,
	        	"pages" =>	336,
	        	"keyword" => "Book"
	        	],
            [
	        	parent::ID_FIELD => ["Amazon", "0802131786"],
	        	"name" =>	"Tropic of Cancer",
	        	"author" =>	"Henry Miller",
	        	"year"	=> 1934,
	        	"pages" =>	318,
	        	"keyword" => "Book"
	        	],
            [
	        	parent::ID_FIELD => ["Amazon", "B000T9886K"],
	        	"name" =>	"In Between",
	        	"author" =>	"Paul Van Dyk",
	        	"year"	=> 2007,
	        	"keyword" => "CD"
	        	],
	       [
	        	parent::ID_FIELD => ["Amazon", "1579124585"],
	        	"name" =>	"The Right Stuff",
	        	"author" =>	"Tom Wolfe",
	        	"year"	=> 1979,
	        	"pages" =>	304,
	        	"keyword" => "Book"
	        	],
        ];
    }

    protected function _queryString($domain, $s1, $s2)
    {
        $k1 = $s1[1];
        $k2 = $s2[1];
        return "RowKey eq '$k1' or RowKey eq '$k2'";
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Cloud_DocumentService_Adapter_WindowsAzureTest::main') {
    Zend_Cloud_DocumentService_Adapter_WindowsAzureTest::main();
}
