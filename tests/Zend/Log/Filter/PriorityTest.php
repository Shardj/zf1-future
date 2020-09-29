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
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Log_Filter_PriorityTest::main');
}

/** Zend_Log */
require_once 'Zend/Log.php';

/** Zend_Log_Filter_Priority */
require_once 'Zend/Log/Filter/Priority.php';

/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Log
 */
class Zend_Log_Filter_PriorityTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testComparisonDefaultsToLessThanOrEqual()
    {
        // accept at or below priority 2
        $filter = new Zend_Log_Filter_Priority(2);

        $this->assertTrue($filter->accept(['priority' => 2]));
        $this->assertTrue($filter->accept(['priority' => 1]));
        $this->assertFalse($filter->accept(['priority' => 3]));
    }

    public function testComparisonOperatorCanBeChanged()
    {
        // accept above priority 2
        $filter = new Zend_Log_Filter_Priority(2, '>');

        $this->assertTrue($filter->accept(['priority' => 3]));
        $this->assertFalse($filter->accept(['priority' => 2]));
        $this->assertFalse($filter->accept(['priority' => 1]));
    }

    public function testConstructorThrowsOnInvalidPriority()
    {
        try {
            new Zend_Log_Filter_Priority('foo');
            $this->fail();
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Log_Exception);
            $this->assertRegExp('/must be an integer/i', $e->getMessage());
        }
    }

    public function testFactory()
    {
        $cfg = ['log' => ['memory' => [
            'writerName' => "Mock",
            'filterName' => "Priority",
            'filterParams' => [
                'priority' => "Zend_Log::CRIT",
                'operator' => "<="
             ],
        ]]];

        $logger = Zend_Log::factory($cfg['log']);
        $this->assertTrue($logger instanceof Zend_Log);

        try {
            $logger = Zend_Log::factory(['Null' => [
                'writerName'   => 'Mock',
                'filterName'   => 'Priority',
                'filterParams' => [],
            ]]);
        } catch(Exception $e) {
            $this->assertTrue($e instanceof Zend_Log_Exception);
            $this->assertRegExp('/must be an integer/', $e->getMessage());
        }
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Log_Filter_PriorityTest::main') {
    Zend_Log_Filter_PriorityTest::main();
}
