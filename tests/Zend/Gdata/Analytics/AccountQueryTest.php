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
class Zend_GData_Analytics_AccountQueryTest extends TestCase
{
    /**
     * @var string|mixed
     */
    protected $queryBase;

    /**
     * @var Zend_GData_Analytics_AccountQuery
     */
    public $accountQuery;

    protected function set_up()
    {
        $this->accountQuery = new Zend_GData_Analytics_AccountQuery();
        $this->queryBase = Zend_GData_Analytics_AccountQuery::ANALYTICS_FEED_URI;
    }

    public function testWebpropertiesAll()
    {
        $this->accountQuery->webproperties();
        $allQuery = $this->accountQuery->getQueryUrl();
        
        $this->assertEquals(
            $this->queryBase . '/~all/webproperties',
            $allQuery
        );
    }
    
    public function testWebpropertiesSpecific()
    {
        $this->accountQuery->webproperties(12345678);
        $specificQuery = $this->accountQuery->getQueryUrl();
        
        $this->assertEquals(
            $this->queryBase . '/12345678/webproperties',
            $specificQuery
        );
    }
    
    public function testProfilesAll()
    {
        $this->accountQuery->profiles();
        $allQuery = $this->accountQuery->getQueryUrl();
        
        $this->assertEquals(
            $this->queryBase . '/~all/webproperties/~all/profiles',
            $allQuery
        );
    }
    
    public function testProfilesSpecific()
    {
        $this->accountQuery->profiles('U-87654321-0', 87654321);
        $specificQuery = $this->accountQuery->getQueryUrl();
        
        $this->assertEquals(
            $this->queryBase . '/87654321/webproperties/U-87654321-0/profiles',
            $specificQuery
        );
    }
    
    public function testGoalsAll()
    {
        $this->accountQuery->goals();
        $allQuery = $this->accountQuery->getQueryUrl();
        
        $this->assertEquals(
            $this->queryBase . '/~all/webproperties/~all/profiles/~all/goals',
            $allQuery
        );
    }
    
    public function testGoalsSpecific()
    {
        $this->accountQuery->goals(42, 'U-87654321-0', 87654321);
        $specificQuery = $this->accountQuery->getQueryUrl();
        
        $this->assertEquals(
            $this->queryBase . '/87654321/webproperties/U-87654321-0/profiles/42/goals',
            $specificQuery
        );
    }
    
    public function testChainedProperties()
    {
        $this->accountQuery
            ->goals(42)
            ->profiles('U-87654321-0')
            ->webproperties(87654321);
        $specificQuery = $this->accountQuery->getQueryUrl();
        
        $this->assertEquals(
            $this->queryBase . '/87654321/webproperties/U-87654321-0/profiles/42/goals',
            $specificQuery
        );
    }
}
