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
 * @package    Zend_Stdlib
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Stdlib_PriorityQueueTest::main');
}

require_once 'Zend/Stdlib/PriorityQueue.php';

/**
 * @category   Zend
 * @package    Zend_Stdlib
 * @subpackage UnitTests
 * @group      Zend_Stdlib
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Stdlib_PriorityQueueTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        $this->queue = new Zend_Stdlib_PriorityQueue();
        $this->queue->insert('foo', 3);
        $this->queue->insert('bar', 4);
        $this->queue->insert('baz', 2);
        $this->queue->insert('bat', 1);
    }

    public function testSerializationAndDeserializationShouldMaintainState()
    {
        $s = serialize($this->queue);
        $unserialized = unserialize($s);
        $count = count($this->queue);
        $this->assertSame($count, count($unserialized), 'Expected count ' . $count . '; received ' . count($unserialized));

        $expected = [];
        foreach ($this->queue as $item) {
            $expected[] = $item;
        }
        $test = [];
        foreach ($unserialized as $item) {
            $test[] = $item;
        }
        $this->assertSame($expected, $test, 'Expected: ' . var_export($expected, 1) . "\nReceived:" . var_export($test, 1));
    }

    public function testRetrievingQueueAsArrayReturnsDataOnlyByDefault()
    {
        $expected = [
            'foo',
            'bar',
            'baz',
            'bat',
        ];
        $test     = $this->queue->toArray();
        $this->assertSame($expected, $test, var_export($test, 1));
    }

    public function testCanCastToArrayOfPrioritiesOnly()
    {
        $expected = [
            3,
            4,
            2,
            1,
        ];
        $test     = $this->queue->toArray(Zend_Stdlib_PriorityQueue::EXTR_PRIORITY);
        $this->assertSame($expected, $test, var_export($test, 1));
    }

    public function testCanCastToArrayOfDataPriorityPairs()
    {
        $expected = [
            ['data' => 'foo', 'priority' => 3],
            ['data' => 'bar', 'priority' => 4],
            ['data' => 'baz', 'priority' => 2],
            ['data' => 'bat', 'priority' => 1],
        ];
        $test     = $this->queue->toArray(Zend_Stdlib_PriorityQueue::EXTR_BOTH);
        $this->assertSame($expected, $test, var_export($test, 1));
    }

    public function testCanIterateMultipleTimesAndReceiveSameResults()
    {
        $expected = ['bar', 'foo', 'baz', 'bat'];

        for ($i = 1; $i < 3; $i++) {
            $test = [];
            foreach ($this->queue as $item) {
                $test[] = $item;
            }
            $this->assertEquals($expected, $test, 'Failed at iteration ' . $i);
        }
    }

    public function testCanRemoveItemFromQueue()
    {
        $this->queue->remove('baz');
        $expected = ['bar', 'foo', 'bat'];
        $test = [];
        foreach ($this->queue as $item) {
            $test[] = $item;
        }
        $this->assertEquals($expected, $test);
    }

    public function testCanTestForExistenceOfItemInQueue()
    {
        $this->assertTrue($this->queue->contains('foo'));
        $this->assertFalse($this->queue->contains('foobar'));
    }

    public function testCanTestForExistenceOfPriorityInQueue()
    {
        $this->assertTrue($this->queue->hasPriority(3));
        $this->assertFalse($this->queue->hasPriority(1000));
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Stdlib_PriorityQueueTest::main') {
    Zend_Stdlib_PriorityQueueTest::main();
}
