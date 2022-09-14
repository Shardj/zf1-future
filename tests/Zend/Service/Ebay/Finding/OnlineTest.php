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
 * @package    Zend_Service_Ebay
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: OnlineTest.php 22824 2010-08-09 18:59:54Z renanbr $
 */

/**
 * @see Zend_Service_Ebay_Finding
 */
require_once 'Zend/Service/Ebay/Finding.php';

/**
 * @category   Zend
 * @package    Zend_Service_Ebay
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Ebay_Finding_OnlineTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Zend_Service_Ebay_Finding
     */
    protected $_finding;

    protected $_httpClientOriginal;

    protected function setUp()
    {
        $this->_finding = new Zend_Service_Ebay_Finding(constant('TESTS_ZEND_SERVICE_EBAY_ONLINE_APPID'));
        $this->_httpClientOriginal = Zend_Rest_Client::getHttpClient();
        Zend_Rest_Client::setHttpClient(new Zend_Http_Client());
    }

    public function tearDown()
    {
        Zend_Rest_Client::setHttpClient($this->_httpClientOriginal);
    }

    public function testInvalidAppId()
    {
        $this->_finding->setOption(Zend_Service_Ebay_Abstract::OPTION_APP_ID, 'foo');
        $appId = $this->_finding->getOption(Zend_Service_Ebay_Abstract::OPTION_APP_ID);
        $this->assertEquals('foo', $appId);
        try {
            $response = $this->_finding->findItemsByKeywords('harry+potter');
            $this->fail('No exception found');
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Service_Ebay_Finding_Exception);
            $this->assertContains('eBay error', $e->getMessage());
        }
    }

    public function testResponseTypeFinds()
    {
        $services =  ['findItemsAdvanced'     => ['tolkien'],
                           'findItemsByCategory'   => ['10181'],
                           'findItemsByKeywords'   => ['harry+potter'],
                           'findItemsByProduct'    => ['53039031'],
                           'findItemsInEbayStores' => ["Laura_Chen's_Small_Store"]];

        $item     = null;
        $category = null;
        $store    = null;
        foreach ($services as $service => $params) {
            $response = call_user_func_array([$this->_finding, $service], $params);
            $this->assertTrue($response instanceof Zend_Service_Ebay_Finding_Response_Items);
            if (!$item && $response->attributes('searchResult', 'count') > 0) {
                $item = $response->searchResult->item->current();
            }
            if (!$category && $response->attributes('searchResult', 'count') > 0) {
                foreach ($response->searchResult->item as $node) {
                    if ($node->primaryCategory) {
                        $category = $node->primaryCategory;
                    }
                }
            }
            if (!$store && $response->attributes('searchResult', 'count') > 0) {
                foreach ($response->searchResult->item as $node) {
                    if ($node->storeInfo) {
                        $store = $node->storeInfo;
                    }
                }
            }
        }

        $response2 = $item->findItemsByProduct($this->_finding);
        $this->assertTrue($response2 instanceof Zend_Service_Ebay_Finding_Response_Items);

        $response3 = $category->findItems($this->_finding, []);
        $this->assertTrue($response3 instanceof Zend_Service_Ebay_Finding_Response_Items);

        $response4 = $store->findItems($this->_finding, []);
        $this->assertTrue($response4 instanceof Zend_Service_Ebay_Finding_Response_Items);
    }

    public function testResponseTypeGets()
    {
        $response = $this->_finding->getSearchKeywordsRecommendation('hary');
        $this->assertTrue($response instanceof Zend_Service_Ebay_Finding_Response_Keywords);

        $response2 = $response->findItems($this->_finding, []);
        $this->assertTrue($response2 instanceof Zend_Service_Ebay_Finding_Response_Items);

        $response3 = $this->_finding->getHistograms('11233');
        $this->assertTrue($response3 instanceof Zend_Service_Ebay_Finding_Response_Histograms);
    }

    public function testItemsPagination()
    {
        // page 1
        // make sure this search will generate more than one page as result
        $page1 = $this->_finding->findItemsByKeywords('laptop');
        $this->assertEquals(1, $page1->paginationOutput->pageNumber);

        // out of range, page #0
        try {
            $page1->page($this->_finding, 0);
            $this->fail('No exception found for page #0');
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Service_Ebay_Finding_Exception);
            $this->assertContains('Page number ', $e->getMessage());
        }

        // out of range, one page after last one
        try {
            $number = $page1->paginationOutput->totalPages + 1;
            $page1->page($this->_finding, $number);
            $this->fail("No exception found for page out of range #$number");
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Service_Ebay_Finding_Exception);
            $this->assertContains('Page number ', $e->getMessage());
        }

        // page next
        $page2 = $page1->pageNext($this->_finding);
        $this->assertEquals(2, $page2->paginationOutput->pageNumber);

        // previous
        $previous = $page2->pagePrevious($this->_finding);
        $this->assertEquals(1, $previous->paginationOutput->pageNumber);
        $this->assertNull($page1->pagePrevious($this->_finding));

        // first
        $first = $page2->pageFirst($this->_finding);
        $this->assertEquals(1, $first->paginationOutput->pageNumber);

        // last
        $last = $page2->pageLast($this->_finding);
        $this->assertNotEquals(1, $last->paginationOutput->pageNumber);

        // page #2
        $some = $page1->page($this->_finding, 2);
        $this->assertEquals(2, $some->paginationOutput->pageNumber);
    }
}

/**
 * @category   Zend
 * @package    Zend_Service_Ebay
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Service
 * @group      Zend_Service_Ebay
 */
class Zend_Service_Ebay_Finding_OnlineSkipTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->markTestSkipped('Zend_Service_Ebay online tests not enabled with an APPID in TestConfiguration.php');
    }

    public function testNothing()
    {
    }
}
