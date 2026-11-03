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
 * @package    Zend_Gdata_Analytics
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Gdata/Analytics.php';

/**
 * @category   Zend
 * @package    Zend_Gdata_Analytics
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Gdata
 * @group      Zend_Gdata_Analytics
 */
class Zend_GData_Analytics_DataQueryTest extends TestCase
{
    /**
     * @var Zend_GData_Analytics_DataQuery
     */
    public $dataQuery;

    protected function set_up()
    {
        $this->dataQuery = new Zend_GData_Analytics_DataQuery();
    }

    public function testProfileId()
    {
        $this->assertTrue($this->dataQuery->getProfileId() == null);
        $this->dataQuery->setProfileId(123456);
        $this->assertTrue($this->dataQuery->getProfileId() == 123456);
    }

    public function testAddMetric()
    {
        $this->assertTrue(count($this->dataQuery->getMetrics()) == 0);
        $this->dataQuery->addMetric(Zend_GData_Analytics_DataQuery::METRIC_BOUNCES);
        $this->assertTrue(count($this->dataQuery->getMetrics()) == 1);
    }

    public function testAddAndRemoveMetric()
    {
        $this->dataQuery->addMetric(Zend_GData_Analytics_DataQuery::METRIC_BOUNCES);
        $this->dataQuery->removeMetric(Zend_GData_Analytics_DataQuery::METRIC_BOUNCES);
        $this->assertTrue(count($this->dataQuery->getMetrics()) == 0);
    }

    public function testAddDimension()
    {
        $this->assertTrue(count($this->dataQuery->getDimensions()) == 0);
        $this->dataQuery->addDimension(Zend_GData_Analytics_DataQuery::DIMENSION_AD_SLOT);
        $this->assertTrue(count($this->dataQuery->getDimensions()) == 1);
    }

    public function testAddAndRemoveDimension()
    {
        $this->dataQuery->addDimension(Zend_GData_Analytics_DataQuery::DIMENSION_AD_SLOT);
        $this->dataQuery->removeDimension(Zend_GData_Analytics_DataQuery::DIMENSION_AD_SLOT);
        $this->assertTrue(count($this->dataQuery->getDimensions()) == 0);
    }

    public function testQueryString()
    {
        $this->dataQuery
            ->setProfileId(123456789)
            ->addFilter('foo=bar')
            ->addFilter('bar>2')
            ->addOrFilter('baz=42')
            ->addDimension(Zend_GData_Analytics_DataQuery::DIMENSION_CITY)
            ->addMetric(Zend_GData_Analytics_DataQuery::METRIC_PAGEVIEWS)
            ->addMetric(Zend_GData_Analytics_DataQuery::METRIC_VISITS);
        $url = parse_url($this->dataQuery->getQueryUrl());
        parse_str($url['query'], $parameter);

        $this->assertEquals(count($parameter), 4);
        $this->assertEquals($parameter['ids'], "ga:123456789");
        $this->assertEquals($parameter['dimensions'], "ga:city");
        $this->assertEquals($parameter['metrics'], "ga:pageviews,ga:visits");
        $this->assertEquals($parameter['filters'], 'foo=bar;bar>2,baz=42');
    }
}
