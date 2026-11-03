<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

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
 * @package    Zend_Service_Amazon_S3
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Service/Amazon/S3.php';
require_once 'Zend/Http/Client/Adapter/Test.php';

/**
 * @category   Zend
 * @package    Zend_Service_Amazon_S3
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service
 * @group      Zend_Service_Amazon
 * @group      Zend_Service_Amazon_S3
 */
class Zend_Service_Amazon_S3_OfflineTest extends TestCase
{
    /**
     * Reference to Amazon service consumer object
     *
     * @var Zend_Service_Amazon_S3
     */
    protected $_amazon;

    /**
     * Test based HTTP client adapter
     *
     * @var Zend_Http_Client_Adapter_Test
     */
    protected $_httpClientAdapterTest;

    protected function set_up()
    {
        $this->_amazon = new Zend_Service_Amazon_S3('test', 'test');

        $this->_httpClientAdapterTest = new Zend_Http_Client_Adapter_Test();

        $this->_amazon->getHttpClient()
                      ->setAdapter($this->_httpClientAdapterTest);
    }

    public function testRetryAfter5xxResponseDoesNotTriggerImplicitFloatToIntDeprecation()
    {
        $this->_httpClientAdapterTest->setResponse("HTTP/1.1 500 Internal Server Error\r\n\r\n");
        $this->_httpClientAdapterTest->addResponse("HTTP/1.1 200 OK\r\n\r\n");

        $deprecations = [];
        set_error_handler(
            static function ($errno, $errstr) use (&$deprecations) {
                $deprecations[] = $errstr;
                return true;
            },
            E_DEPRECATED
        );

        try {
            // First response is 500 (triggers one retry -> sleep(1/4*1)), second is 200.
            $this->_amazon->isBucketAvailable('test-bucket');
        } finally {
            restore_error_handler();
        }

        $this->assertSame(
            [],
            $deprecations,
            'Retrying an S3 request after a 5xx response must not trigger an E_DEPRECATED notice'
        );
    }
}
