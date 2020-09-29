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
 * @version    $Id: OfflineTest.php 22824 2010-08-09 18:59:54Z renanbr $
 */

/**
 * @see Zend_Service_Ebay_Finding
 */
require_once 'Zend/Service/Ebay/Finding.php';

/**
 * @see Zend_Service_Ebay_Finding_Response_Keywords
 */
require_once 'Zend/Service/Ebay/Finding/Response/Keywords.php';

/**
 * @see Zend_Service_Ebay_Finding_Response_Items
 */
require_once 'Zend/Service/Ebay/Finding/Response/Items.php';

/**
 * @category   Zend
 * @package    Zend_Service_Ebay
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Ebay_OfflineTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Zend_Service_Ebay_Finding
     */
    protected $_finding;

    protected function setUp()
    {
        $this->_finding = new Zend_Service_Ebay_Finding('foo');
    }

    public function testClient()
    {
        $this->assertTrue($this->_finding->getClient() instanceof Zend_Rest_Client);

        require_once dirname(__FILE__) . '/_files/ClientCustom.php';
        $this->assertTrue($this->_finding->setClient(new ClientCustom()) instanceof Zend_Service_Ebay_Finding);
        $this->assertTrue($this->_finding->getClient() instanceof ClientCustom);

        $this->setExpectedException('Zend_Service_Ebay_Finding_Exception');
        $this->_finding->setClient(new stdClass());
    }

    public function testConstructor()
    {
        $this->assertEquals('EBAY-US', $this->_finding->getOption(Zend_Service_Ebay_Finding::OPTION_GLOBAL_ID));
        $this->assertEquals('foo', $this->_finding->getOption(Zend_Service_Ebay_Finding::OPTION_APP_ID));

        $options = [
            Zend_Service_Ebay_Finding::OPTION_APP_ID    => 'app-id',
            Zend_Service_Ebay_Finding::OPTION_GLOBAL_ID => 'EBAY-GB',
            'foo' => 'bar'
        ];
        $finding = new Zend_Service_Ebay_Finding($options);
        $this->assertEquals('EBAY-GB', $finding->getOption(Zend_Service_Ebay_Finding::OPTION_GLOBAL_ID));
        $this->assertEquals('app-id', $finding->getOption(Zend_Service_Ebay_Finding::OPTION_APP_ID));
        $this->assertEquals('bar', $finding->getOption('foo'));

        $this->setExpectedException('Zend_Service_Ebay_Finding_Exception');
        $finding = new Zend_Service_Ebay_Finding(['foo' => 'bar']);
    }

    public function testResponseAbstract()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/get-search-keywords-recomendation.xml');

        // no error xml
        $response = $this->_createResponseKeywords($xml);
        $this->assertNotNull($response->ack);
        $this->assertNotNull($response->timestamp);
        $this->assertNotNull($response->version);
    }

    public function testErrorMessage()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/error.xml');

        // xml with error inside
        $response = $this->_createResponseKeywords($xml);
        $this->assertNotNull($response->ack);
        $this->assertNotNull($response->timestamp);
        $this->assertNotNull($response->version);
        $this->assertTrue($response->errorMessage instanceof Zend_Service_Ebay_Finding_Error_Message);

        // Zend_Service_Ebay_Finding_Error_Message
        $object = $response->errorMessage;
        $this->assertTrue($object->error instanceof Zend_Service_Ebay_Finding_Error_Data_Set);

        // Zend_Service_Ebay_Finding_Error_Data
        $object = $object->error->current();
        $this->assertNotNull($object->category);
        $this->assertNotNull($object->domain);
        $this->assertNotNull($object->errorId);
        $this->assertNotNull($object->message);
        $this->assertTrue(is_array($object->parameter));
        $this->assertTrue(is_array($object->attributes('parameter', 'name')));
        $this->assertNotNull($object->severity);
        $this->assertNotNull($object->subdomain);

        // missing attributes in XML
        //$this->assertNotNull($object->exceptionId);
    }

    public function testResponseKeywords()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/get-search-keywords-recomendation.xml');

        $response = $this->_createResponseKeywords($xml);
        $this->assertNotNull($response->keywords);
    }

    public function testResponseItems()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/find-items-advanced.xml');
        $response = $this->_createResponseItems($xml);

        $this->assertTrue($response->paginationOutput instanceof Zend_Service_Ebay_Finding_PaginationOutput);
        $this->assertTrue($response->searchResult instanceof Zend_Service_Ebay_Finding_Search_Result);
        $this->assertNotNull($response->attributes('searchResult', 'count'));
    }

    public function testPaginationOutput()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/find-items-advanced.xml');
        $response = $this->_createResponseItems($xml);

        $object = $response->paginationOutput;
        $this->assertNotNull($object->entriesPerPage);
        $this->assertNotNull($object->pageNumber);
        $this->assertNotNull($object->totalEntries);
        $this->assertNotNull($object->totalPages);
    }

    public function testSearchResult()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/find-items-advanced.xml');
        $response = $this->_createResponseItems($xml);

        $object = $response->searchResult;
        $this->assertTrue($object->item instanceof Zend_Service_Ebay_Finding_Search_Item_Set);
    }

    public function testSearchItem()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/find-items-advanced.xml');
        $response = $this->_createResponseItems($xml);

        // general attributes
        $response->searchResult->item->seek(0);
        $object = $response->searchResult->item->current();
        $this->assertTrue($object instanceof Zend_Service_Ebay_Finding_Search_Item);
        $this->assertNotNull($object->autoPay);
        $this->assertNotNull($object->country);
        $this->assertTrue(is_array($object->galleryPlusPictureURL));
        $this->assertNotNull($object->galleryPlusPictureURL[0]);
        $this->assertNotNull($object->galleryURL);
        $this->assertNotNull($object->globalId);
        $this->assertNotNull($object->itemId);
        $this->assertTrue($object->listingInfo instanceof Zend_Service_Ebay_Finding_ListingInfo);
        $this->assertNotNull($object->location);
        $this->assertTrue(is_array($object->paymentMethod));
        $this->assertNotNull($object->paymentMethod[0]);
        $this->assertNotNull($object->postalCode);
        $this->assertTrue($object->primaryCategory instanceof Zend_Service_Ebay_Finding_Category);
        $this->assertTrue($object->sellerInfo instanceof Zend_Service_Ebay_Finding_SellerInfo);
        $this->assertTrue($object->sellingStatus instanceof Zend_Service_Ebay_Finding_SellingStatus);
        $this->assertTrue($object->shippingInfo instanceof Zend_Service_Ebay_Finding_ShippingInfo);
        $this->assertTrue($object->storeInfo instanceof Zend_Service_Ebay_Finding_Storefront);
        $this->assertNotNull($object->title);
        $this->assertNotNull($object->viewItemURL);

        // product id
        $response->searchResult->item->seek(3);
        $object = $response->searchResult->item->current();
        $this->assertNotNull($object->productId);
        $this->assertNotNull($object->attributes('productId', 'type'));

        // sub category
        $response->searchResult->item->seek(2);
        $object = $response->searchResult->item->current();
        $this->assertTrue($object->secondaryCategory instanceof Zend_Service_Ebay_Finding_Category);

        // missing attributes in XML
        //$this->assertNotNull($object->charityId);
        //$this->assertNotNull($object->distance);
        //$this->assertNotNull($object->attributes('distance', 'unit'));
    }

    public function testListingInfo()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/find-items-advanced.xml');
        $response = $this->_createResponseItems($xml);

        $response->searchResult->item->seek(4);
        $object = $response->searchResult->item->current()->listingInfo;
        $this->assertNotNull($object->bestOfferEnabled);
        $this->assertNotNull($object->buyItNowAvailable);
        $this->assertNotNull($object->buyItNowPrice);
        $this->assertNotNull($object->attributes('buyItNowPrice', 'currencyId'));
        $this->assertNotNull($object->convertedBuyItNowPrice);
        $this->assertNotNull($object->attributes('convertedBuyItNowPrice', 'currencyId'));
        $this->assertNotNull($object->endTime);
        $this->assertNotNull($object->gift);
        $this->assertNotNull($object->listingType);
        $this->assertNotNull($object->startTime);
    }

    public function testCategory()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/find-items-advanced.xml');
        $response = $this->_createResponseItems($xml);

        $response->searchResult->item->seek(0);
        $object = $response->searchResult->item->current()->primaryCategory;
        $this->assertNotNull($object->categoryId);
        $this->assertNotNull($object->categoryName);
    }

    public function testSellerInfo()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/find-items-advanced.xml');
        $response = $this->_createResponseItems($xml);

        $response->searchResult->item->seek(0);
        $object = $response->searchResult->item->current()->sellerInfo;
        $this->assertNotNull($object->feedbackRatingStar);
        $this->assertNotNull($object->feedbackScore);
        $this->assertNotNull($object->positiveFeedbackPercent);
        $this->assertNotNull($object->sellerUserName);
        $this->assertNotNull($object->topRatedSeller);
    }

    public function testSellingStatus()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/find-items-advanced.xml');
        $response = $this->_createResponseItems($xml);

        $response->searchResult->item->seek(1);
        $object = $response->searchResult->item->current()->sellingStatus;
        $this->assertNotNull($object->bidCount);
        $this->assertNotNull($object->convertedCurrentPrice);
        $this->assertNotNull($object->attributes('convertedCurrentPrice', 'currencyId'));
        $this->assertNotNull($object->currentPrice);
        $this->assertNotNull($object->attributes('currentPrice', 'currencyId'));
        $this->assertNotNull($object->sellingState);
        $this->assertNotNull($object->timeLeft);
    }

    public function testShippingInfo()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/find-items-advanced.xml');
        $response = $this->_createResponseItems($xml);

        $response->searchResult->item->seek(0);
        $object = $response->searchResult->item->current()->shippingInfo;
        $this->assertNotNull($object->shippingServiceCost);
        $this->assertNotNull($object->attributes('shippingServiceCost', 'currencyId'));
        $this->assertNotNull($object->shippingType);
        $this->assertTrue(is_array($object->shipToLocations));
        $this->assertNotNull($object->shipToLocations[0]);
    }

    public function testStorefront()
    {
        $xml = file_get_contents(dirname(__FILE__) . '/_files/find-items-advanced.xml');
        $response = $this->_createResponseItems($xml);

        $response->searchResult->item->seek(0);
        $object = $response->searchResult->item->current()->storeInfo;
        $this->assertNotNull($object->storeName);
        $this->assertNotNull($object->storeURL);
    }

    public function testResponseHistogramAspect()
    {
        // test histogram aspect
        $xml = file_get_contents(dirname(__FILE__) . '/_files/histogram-aspect.xml');
        $response = $this->_createResponseHistograms($xml);

        $this->assertNotNull($response->aspectHistogramContainer);
        $this->assertTrue($response->aspectHistogramContainer instanceof Zend_Service_Ebay_Finding_Aspect_Histogram_Container);
        $this->assertNull($response->categoryHistogramContainer);

        // Zend_Service_Ebay_Finding_Aspect_Set
        $object = $response->aspectHistogramContainer;
        $this->assertTrue($object->aspect instanceof Zend_Service_Ebay_Finding_Aspect_Set);

        // Zend_Service_Ebay_Finding_Aspect
        $object = $object->aspect->current();
        $this->assertTrue($object->valueHistogram instanceof Zend_Service_Ebay_Finding_Aspect_Histogram_Value_Set);
        $this->assertTrue(is_array($object->attributes('valueHistogram', 'valueName')));

        // Zend_Service_Ebay_Finding_Aspect_Histogram_Value
        $object = $object->valueHistogram->current();
        $this->assertNotNull($object->count);
    }

    public function testResponseHistogramCategory()
    {
        // test histogram aspect
        $xml = file_get_contents(dirname(__FILE__) . '/_files/histogram-category.xml');
        $response = $this->_createResponseHistograms($xml);

        $this->assertNotNull($response->categoryHistogramContainer);
        $this->assertTrue($response->categoryHistogramContainer instanceof Zend_Service_Ebay_Finding_Category_Histogram_Container);
        $this->assertNull($response->aspectHistogramContainer);

        // Zend_Service_Ebay_Finding_Category_Histogram_Container
        $object = $response->categoryHistogramContainer;
        $this->assertTrue($object->categoryHistogram instanceof Zend_Service_Ebay_Finding_Category_Histogram_Set);

        // Zend_Service_Ebay_Finding_Category_Histogram
        $object = $object->categoryHistogram->current();
        $this->assertTrue($object instanceof Zend_Service_Ebay_Finding_Category_Histogram);
        $this->assertTrue($object->childCategoryHistogram instanceof Zend_Service_Ebay_Finding_Category_Histogram_Set);
        $this->assertNotNull($object->count);
    }

    protected function _readXML($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        return $dom;
    }

    protected function _createResponseItems($xml)
    {
        return new Zend_Service_Ebay_Finding_Response_Items($this->_readXML($xml)->firstChild);
    }

    protected function _createResponseHistograms($xml)
    {
        return new Zend_Service_Ebay_Finding_Response_Histograms($this->_readXML($xml)->firstChild);
    }

    protected function _createResponseKeywords($xml)
    {
        return new Zend_Service_Ebay_Finding_Response_Keywords($this->_readXML($xml)->firstChild);
    }
}
