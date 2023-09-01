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
class Zend_Gdata_Analytics_AccountFeedTest extends TestCase
{
    /** @var AccountFeed */
    public $accountFeed;

    protected function set_up()
    {
        $this->accountFeed = new Zend_Gdata_Analytics_AccountFeed(
            file_get_contents(dirname(__FILE__) . '/_files/TestAccountFeed.xml')
        );
    }

    public function testAccountFeed()
    {
        $this->assertEquals(2, count($this->accountFeed->entries));

        foreach ($this->accountFeed->entries as $entry) {
            $this->assertInstanceOf('Zend_Gdata_Analytics_AccountEntry', $entry);
        }
    }

    public function testFirstAccountProperties()
    {
        $account = $this->accountFeed->entries[0];
        $this->assertEquals(876543, "{$account->accountId}");
        $this->assertEquals('foobarbaz', "{$account->accountName}");
        $this->assertInstanceOf('Zend_GData_App_Extension_Link', $account->link[0]);
    }

    public function testSecondAccountProperties()
    {
        $account = $this->accountFeed->entries[1];
        $this->assertEquals(23456789, "{$account->accountId}");
        $this->assertEquals('brain dump', "{$account->accountName}");
        $this->assertInstanceOf('Zend_GData_App_Extension_Link', $account->link[0]);
    }
}
