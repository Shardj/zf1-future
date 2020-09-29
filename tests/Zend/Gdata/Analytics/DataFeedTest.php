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
 * @package    Zend_Gdata_Analytics
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Gdata/Analytics.php';
require_once 'Zend/Http/Client.php';

/**
 * @category   Zend
 * @package    Zend_Gdata_Analytics
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Gdata
 * @group      Zend_Gdata_Analytics
 */
class Zend_Gdata_Analytics_DataFeedTest extends PHPUnit_Framework_TestCase
{
    public $testData = [
        'foobarbaz.de' => 12,
        'foobar.de' => 3,
        'foobarbaz.ch' => 1,
        'baz.ch' => 1,
    ];
    /** @var DataFeed */
    public $dataFeed;

    public function setUp()
    {
        $this->dataFeed = new Zend_Gdata_Analytics_DataFeed(
            file_get_contents(dirname(__FILE__) . '/_files/TestDataFeed.xml')
        );
    }

    public function testDataFeed()
    {
        $count = count($this->testData);
        $this->assertEquals(count($this->dataFeed->entries), $count);
        $this->assertEquals($this->dataFeed->entries->count(), $count);
        foreach ($this->dataFeed->entries as $entry) {
            $this->assertTrue($entry instanceof Zend_Gdata_Analytics_DataEntry);
        }
    }

    public function testGetters()
    {
        $sources = array_keys($this->testData);
        $values = array_values($this->testData);

        foreach ($this->dataFeed as $index => $row) {
            $source = $row->getDimension(Zend_Gdata_Analytics_DataQuery::DIMENSION_SOURCE);
            $medium = $row->getDimension('ga:medium');
            $visits = $row->getMetric('ga:visits');
            $visitsValue = $row->getValue('ga:visits');

            $this->assertEquals("$medium", 'referral');
            $this->assertEquals("$source", $sources[$index]);
            $this->assertEquals("$visits", $values[$index]);
            $this->assertEquals("$visitsValue", $values[$index]);
        }
    }
}
