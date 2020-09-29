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
 * @package    Zend_Service_Amazon
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Service/Amazon/Sqs.php';
require_once 'Zend/Service/Amazon/Sqs/Exception.php';
require_once 'Zend/Http/Client/Adapter/Test.php';

/**
 * @category   Zend
 * @package    Zend_Service_Amazon
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service
 * @group      Zend_Service_Amazon
 * @group      Zend_Service_Amazon_Sqs
 */
class Zend_Service_Amazon_Sqs_OfflineTest extends PHPUnit_Framework_TestCase
{
    /**
     * Reference to Amazon service consumer object
     *
     * @var Zend_Service_Amazon_Sqs
     */
    protected $_amazon;
    
    /**
     * Test based HTTP client adapter
     *
     * @var Zend_Http_Client_Adapter_Test
     */
    protected $_httpClientAdapterTest;
    
    public function setUp()
    {
        //$this->markTestSkipped('No offline tests for Zend_Service_Amazon_Sqs');
        
        $this->_amazon= new Zend_Service_Amazon_Sqs('test','test');
        
        $this->_httpClientAdapterTest = new Zend_Http_Client_Adapter_Test();

        $this->_amazon->getHttpClient()
                      ->setAdapter($this->_httpClientAdapterTest);
    }

    public function testSetRegion()
    {
        $this->_amazon->setEndpoint('eu-west-1');
        $endPoints= $this->_amazon->getEndpoints();
        $this->assertEquals($this->_amazon->getEndpoint(),$endPoints['eu-west-1']);
    }
    
    public function testSetNewRegion()
    {
        $this->_amazon->setEndpoint('foo');
        $this->assertEquals($this->_amazon->getEndpoint(),'sqs.foo.amazonaws.com');
    }
    
    public function testSetEmptyRegion()
    {
         $this->setExpectedException(
            'Zend_Service_Amazon_Sqs_Exception',
            'Empty region specified.'
        );
        $this->_amazon->setEndpoint('');
    }
    
    public function testGetRegions()
    {
        $endPoints= ['us-east-1' => 'sqs.us-east-1.amazonaws.com',
                                     'us-west-1' => 'sqs.us-west-1.amazonaws.com',
                                     'eu-west-1' => 'sqs.eu-west-1.amazonaws.com',
                                     'ap-southeast-1' => 'sqs.ap-southeast-1.amazonaws.com',
                                     'ap-northeast-1' => 'sqs.ap-northeast-1.amazonaws.com'];
        $this->assertEquals($this->_amazon->getEndpoints(),$endPoints);
    }
}
