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
 * @package    Zend_EventManager
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_EventManager_StaticIntegrationTest::main');
}

require_once 'Zend/EventManager/EventManager.php';
require_once 'Zend/EventManager/StaticEventManager.php';
require_once 'Zend/EventManager/TestAsset/ClassWithEvents.php';
require_once 'Zend/EventManager/TestAsset/StaticEventsMock.php';

/**
 * @category   Zend
 * @package    Zend_EventManager
 * @subpackage UnitTests
 * @group      Zend_EventManager
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_EventManager_StaticIntegrationTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        Zend_EventManager_StaticEventManager::resetInstance();
    }

    public function testCanConnectStaticallyToClassWithEvents()
    {
        $this->counter = (object) ['count' => 0];
        Zend_EventManager_StaticEventManager::getInstance()->attach(
            'Zend_EventManager_TestAsset_ClassWithEvents', 
            'foo', 
            [$this, 'advanceCounter']
        );
        $class = new Zend_EventManager_TestAsset_ClassWithEvents();
        $class->foo();
        $this->assertEquals(1, $this->counter->count);
    }

    public function testLocalHandlersAreExecutedPriorToStaticHandlersWhenSetWithSamePriority()
    {
        $this->test = (object) ['results' => []];
        Zend_EventManager_StaticEventManager::getInstance()->attach(
            'Zend_EventManager_TestAsset_ClassWithEvents', 
            'foo', 
            [$this, 'aggregateStatic']
        );
        $class = new Zend_EventManager_TestAsset_ClassWithEvents();
        $class->events()->attach('foo', [$this, 'aggregateLocal']);
        $class->foo();
        $this->assertEquals(['local', 'static'], $this->test->results);
    }

    public function testLocalHandlersAreExecutedInPriorityOrderRegardlessOfStaticOrLocalRegistration()
    {
        $this->test = (object) ['results' => []];
        Zend_EventManager_StaticEventManager::getInstance()->attach(
            'Zend_EventManager_TestAsset_ClassWithEvents', 
            'foo', 
            [$this, 'aggregateStatic'],
            10000 // high priority
        );
        $class = new Zend_EventManager_TestAsset_ClassWithEvents();
        $class->events()->attach('foo', [$this, 'aggregateLocal'], 1); // low priority
        $class->events()->attach('foo', [$this, 'aggregateLocal2'], 1000); // medium priority
        $class->events()->attach('foo', [$this, 'aggregateLocal3'], 15000); // highest priority
        $class->foo();
        $this->assertEquals(['local3', 'static', 'local2', 'local'], $this->test->results);
    }

    public function testPassingNullValueToSetSharedCollectionsDisablesSharedCollections()
    {
        $this->counter = (object) ['count' => 0];
        Zend_EventManager_StaticEventManager::getInstance()->attach(
            'Zend_EventManager_TestAsset_ClassWithEvents', 
            'foo', 
            [$this, 'advanceCounter']
        );
        $class = new Zend_EventManager_TestAsset_ClassWithEvents();
        $class->events()->unsetSharedCollections();
        $class->foo();
        $this->assertEquals(0, $this->counter->count);
    }

    public function testCanPassAlternateSharedCollectionsHolder()
    {
        $this->counter = (object) ['count' => 0];
        Zend_EventManager_StaticEventManager::getInstance()->attach(
            'Zend_EventManager_TestAsset_ClassWithEvents', 
            'foo', 
            [$this, 'advanceCounter']
        );
        $mockStaticEvents = new Zend_EventManager_TestAsset_StaticEventsMock();
        $class = new Zend_EventManager_TestAsset_ClassWithEvents();
        $class->events()->setSharedCollections($mockStaticEvents);
        $this->assertSame($mockStaticEvents, $class->events()->getSharedCollections());
        $class->foo();
        $this->assertEquals(0, $this->counter->count);
    }

    public function testTriggerMergesPrioritiesOfStaticAndInstanceListeners()
    {
        $this->test = (object) ['results' => []];
        Zend_EventManager_StaticEventManager::getInstance()->attach(
            'Zend_EventManager_TestAsset_ClassWithEvents', 
            'foo', 
            [$this, 'aggregateStatic'],
            100
        );
        $class = new Zend_EventManager_TestAsset_ClassWithEvents();
        $class->events()->attach('foo', [$this, 'aggregateLocal'], -100);
        $class->foo();
        $this->assertEquals(['static', 'local'], $this->test->results);
    }

    /*
     * Listeners used in tests
     */

    public function advanceCounter($e)
    {
        $this->counter->count++;
    }

    public function aggregateStatic($e)
    {
        $this->test->results[] = 'static';
    }

    public function aggregateLocal($e)
    {
        $this->test->results[] = 'local';
    }

    public function aggregateLocal2($e)
    {
        $this->test->results[] = 'local2';
    }

    public function aggregateLocal3($e)
    {
        $this->test->results[] = 'local3';
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_EventManager_StaticIntegrationTest::main') {
    Zend_EventManager_StaticIntegrationTest::main();
}
