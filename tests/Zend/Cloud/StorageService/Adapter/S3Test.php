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
 * @package    Zend_Cloud_StorageService
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

// Call Zend_Cloud_StorageService_Adapter_S3Test::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Cloud_StorageService_Adapter_S3Test::main");
}

/**
 * @see Zend_Cloud_StorageService_TestCase
 */
require_once 'Zend/Cloud/StorageService/TestCase.php';
/**
 * @see Zend_Cloud_StorageService_Adapter_S3
 */
require_once 'Zend/Cloud/StorageService/Adapter/S3.php';

/**
 * @category   Zend
 * @package    Zend_Cloud
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Cloud_StorageService_Adapter_S3Test
    extends Zend_Cloud_StorageService_TestCase
{
	protected $_clientType = 'Zend_Service_Amazon_S3';

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

    /**
     * Sets up this test case
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        // Create the bucket here
        $s3 = new Zend_Service_Amazon_S3(
            $this->_config->get(Zend_Cloud_StorageService_Adapter_S3::AWS_ACCESS_KEY),
            $this->_config->get(Zend_Cloud_StorageService_Adapter_S3::AWS_SECRET_KEY)
        );

        $s3->createBucket(
            $this->_config->get(Zend_Cloud_StorageService_Adapter_S3::BUCKET_NAME)
        );
    }

    // TODO: Create a custom test for S3 that checks fetchMetadata() with an object that has custom metadata.
    public function testFetchMetadata()
    {
        $this->markTestIncomplete('S3 doesn\'t support storing metadata after an item is created.');
    }

    public function testStoreMetadata()
    {
        $this->markTestSkipped('S3 doesn\'t support storing metadata after an item is created.');
    }

    public function testDeleteMetadata()
    {
        $this->markTestSkipped('S3 doesn\'t support storing metadata after an item is created.');
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

        // Delete the bucket here
        $s3 = new Zend_Service_Amazon_S3(
            $this->_config->get(Zend_Cloud_StorageService_Adapter_S3::AWS_ACCESS_KEY),
            $this->_config->get(Zend_Cloud_StorageService_Adapter_S3::AWS_SECRET_KEY)
        );
        $s3->removeBucket(
            $this->_config->get(Zend_Cloud_StorageService_Adapter_S3::BUCKET_NAME)
        );
        parent::tearDown();
    }

    protected function _getConfig()
    {
        if (!defined('TESTS_ZEND_SERVICE_AMAZON_ONLINE_ENABLED')
            || !constant('TESTS_ZEND_SERVICE_AMAZON_ONLINE_ENABLED')
            || !defined('TESTS_ZEND_SERVICE_AMAZON_ONLINE_ACCESSKEYID')
            || !defined('TESTS_ZEND_SERVICE_AMAZON_ONLINE_SECRETKEY')
            || !defined('TESTS_ZEND_SERVICE_AMAZON_S3_BUCKET')
        ) {
            $this->markTestSkipped("Amazon S3 access not configured, skipping test");
        }

        $config = new Zend_Config([
            Zend_Cloud_StorageService_Factory::STORAGE_ADAPTER_KEY => 'Zend_Cloud_StorageService_Adapter_S3',
            Zend_Cloud_StorageService_Adapter_S3::AWS_ACCESS_KEY   => constant('TESTS_ZEND_SERVICE_AMAZON_ONLINE_ACCESSKEYID'),
            Zend_Cloud_StorageService_Adapter_S3::AWS_SECRET_KEY   => constant('TESTS_ZEND_SERVICE_AMAZON_ONLINE_SECRETKEY'),
            Zend_Cloud_StorageService_Adapter_S3::BUCKET_NAME      => constant('TESTS_ZEND_SERVICE_AMAZON_S3_BUCKET'),
        ]);

        return $config;
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Cloud_StorageService_Adapter_S3Test::main') {
    Zend_Cloud_StorageService_Adapter_S3Test::main();
}
