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
 * @version    $Id: AbstractTest.php 22824 2010-08-09 18:59:54Z renanbr $
 */

/**
 * @see Zend_Service_Ebay_Abstract
 */
require_once dirname(__FILE__) . '/_files/Concrete.php';

/**
 * @see Zend_Config
 */
require_once 'Zend/Config.php';

/**
 * @category   Zend
 * @package    Zend_Service_Ebay
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Ebay_AbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Zend_Service_Ebay_AbstractConcrete
     */
    protected $_concrete;

    protected function setUp()
    {
        $this->_concrete = new Zend_Service_Ebay_AbstractConcrete([]);
    }

    public function testConstructor()
    {
        $array  = ['foo'  => 'bar',
                        'some' => 'value'];
        $config = new Zend_Config($array);

        $concreteArray  = new Zend_Service_Ebay_AbstractConcrete($array);
        $concreteConfig = new Zend_Service_Ebay_AbstractConcrete($config);

        foreach (array_keys($array) as $option) {
            $this->assertEquals($concreteArray->getOption($option), $concreteConfig->getOption($option));
        }
    }

    public function testSetOptions()
    {
        $array  = ['foo'  => 'bar',
                        'some' => 'value'];
        $config = new Zend_Config($array);
        $concreteArray  = new Zend_Service_Ebay_AbstractConcrete();
        $concreteArray->setOption($array);
        $concreteConfig = new Zend_Service_Ebay_AbstractConcrete();
        $concreteConfig->setOption($config);
        foreach (array_keys($array) as $option) {
            $this->assertEquals($concreteArray->getOption($option), $concreteConfig->getOption($option));
        }

        $this->assertNull($concreteArray->getOption('bar'));
        $this->assertNull($concreteConfig->getOption('bar'));
    }

    public function testOptionsToArrayInvalid()
    {
        $this->setExpectedException('Zend_Service_Ebay_Exception');
        Zend_Service_Ebay_Abstract::optionsToArray('invalid');
    }

    public function testGetOption()
    {
        $expected = [
            'foo' => 1,
            'bar' => 2
        ];

        $this->_concrete->setOption('foo', 1)
                        ->setOption(['bar' => 2]);

        $this->assertEquals(1, $this->_concrete->getOption('foo'));
        $this->assertEquals(2, $this->_concrete->getOption('bar'));
        $this->assertEquals($expected, $this->_concrete->getOption());

        $this->_concrete->setOption(
            ['foo' => 3,
                  'bar' => 4
            ]
        );
        $this->assertEquals(3, $this->_concrete->getOption('foo'));
        $this->assertEquals(4, $this->_concrete->getOption('bar'));
    }

    public function testHasOption()
    {
        $this->_concrete->setOption('foo', 1);
        $this->assertTrue($this->_concrete->hasOption('foo'));
        $this->assertFalse($this->_concrete->hasOption('bar'));
    }

    public function testToEbayValue()
    {
        $this->assertSame('1', Zend_Service_Ebay_AbstractConcrete::toEbayValue(true));
        $this->assertSame('0', Zend_Service_Ebay_AbstractConcrete::toEbayValue(false));

        require_once 'Zend/Date.php';
        $date = new Zend_Date();
        $this->assertSame($date->getIso(), Zend_Service_Ebay_AbstractConcrete::toEbayValue($date));

        $date = new DateTime();
        $this->assertSame($date->format(DateTime::ISO8601), Zend_Service_Ebay_AbstractConcrete::toEbayValue($date));

        $this->assertSame('10', Zend_Service_Ebay_AbstractConcrete::toEbayValue(10));
    }

    public function testToPhpValue()
    {
        $this->assertSame('10', Zend_Service_Ebay_Abstract::toPhpValue(10, 'integer'));
        $this->assertSame('foo', Zend_Service_Ebay_Abstract::toPhpValue('foo', 'string'));
        $this->assertSame(10.5, Zend_Service_Ebay_Abstract::toPhpValue(10.5, 'float'));
        $this->assertTrue(true, Zend_Service_Ebay_Abstract::toPhpValue('true', 'boolean'));
    }

    public function testToPhpValueInvalidType()
    {
        $this->setExpectedException('Zend_Service_Ebay_Exception');
        Zend_Service_Ebay_Abstract::toPhpValue('value', 'invalid-type');
    }

    public function testOptionsToNameValueSyntax()
    {
        $options = [
            'paginationInput' => [
              'entriesPerPage' => 5,
              'pageNumber'     => 2
            ],
            'itemFilter' => [
              [
                  'name'       => 'MaxPrice',
                  'value'      => 25,
                  'paramName'  => 'Currency',
                  'paramValue' => 'USD'
              ],
              [
                  'name'  => 'FreeShippingOnly',
                  'value' => true
              ],
              [
                  'name'  => 'ListingType',
                  'value' => [
                      'AuctionWithBIN',
                      'FixedPrice',
                      'StoreInventory'
                  ]
              ]
            ],
            'productId' => [
              ''     => 123,
              'type' => 'UPC'
            ]
        ];

        $expected = [
            'paginationInput.entriesPerPage' => '5',
            'paginationInput.pageNumber'     => '2',
            'itemFilter(0).name'             => 'MaxPrice',
            'itemFilter(0).value'            => '25',
            'itemFilter(0).paramName'        => 'Currency',
            'itemFilter(0).paramValue'       => 'USD',
            'itemFilter(1).name'             => 'FreeShippingOnly',
            'itemFilter(1).value'            => '1',
            'itemFilter(2).name'             => 'ListingType',
            'itemFilter(2).value(0)'         => 'AuctionWithBIN',
            'itemFilter(2).value(1)'         => 'FixedPrice',
            'itemFilter(2).value(2)'         => 'StoreInventory',
            'productId'                      => '123',
            'productId.@type'                => 'UPC'
        ];

        $this->assertEquals($expected, $this->_concrete->optionsToNameValueSyntax($options));
    }
}
