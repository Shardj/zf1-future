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
    define('PHPUnit_MAIN_METHOD', 'Zend_EventManager_GlobalEventManagerTest::main');
}

require_once 'Zend/EventManager/GlobalEventManager.php';
require_once 'Zend/EventManager/EventManager.php';

/**
 * @category   Zend
 * @package    Zend_EventManager
 * @subpackage UnitTests
 * @group      Zend_EventManager
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_EventManager_GlobalEventManagerTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        Zend_EventManager_GlobalEventManager::setEventCollection(null);
    }

    public function testStoresAnEventManagerInstanceByDefault()
    {
        $events = Zend_EventManager_GlobalEventManager::getEventCollection();
        $this->assertTrue($events instanceof Zend_EventManager_EventManager);
    }

    public function testPassingNullValueForEventCollectionResetsInstance()
    {
        $events = Zend_EventManager_GlobalEventManager::getEventCollection();
        $this->assertTrue($events instanceof Zend_EventManager_EventManager);
        Zend_EventManager_GlobalEventManager::setEventCollection(null);
        $events2 = Zend_EventManager_GlobalEventManager::getEventCollection();
        $this->assertTrue($events2 instanceof Zend_EventManager_EventManager);
        $this->assertNotSame($events, $events2);
    }

    public function testProxiesAllStaticOperationsToEventCollectionInstance()
    {
        $this->test = new stdClass();
        $listener = Zend_EventManager_GlobalEventManager::attach('foo.bar', [$this, 'aggregateEventMetadata']);
        $this->assertTrue($listener instanceof Zend_Stdlib_CallbackHandler);

        Zend_EventManager_GlobalEventManager::trigger('foo.bar', $this, ['foo' => 'bar']);
        $this->assertSame($this, $this->test->target);
        $this->assertEquals('foo.bar', $this->test->event);
        $this->assertEquals(['foo' => 'bar'], $this->test->params);

        $results = Zend_EventManager_GlobalEventManager::triggerUntil('foo.bar', $this, ['baz' => 'bat'], [$this, 'returnOnArray']);
        $this->assertTrue($results->stopped());
        $this->assertEquals(['baz' => 'bat'], $this->test->params);
        $this->assertEquals(['baz' => 'bat'], $results->last());

        $events = Zend_EventManager_GlobalEventManager::getEvents();
        $this->assertEquals(['foo.bar'], $events);

        $listeners = Zend_EventManager_GlobalEventManager::getListeners('foo.bar');
        $this->assertEquals(1, count($listeners));
        $this->assertTrue($listeners->contains($listener));

        Zend_EventManager_GlobalEventManager::detach($listener);
        $events = Zend_EventManager_GlobalEventManager::getEvents();
        $this->assertEquals([], $events);

        $this->test = new stdClass;
        $listener = Zend_EventManager_GlobalEventManager::attach('foo.bar', [$this, 'aggregateEventMetadata']);
        $events = Zend_EventManager_GlobalEventManager::getEvents();
        $this->assertEquals(['foo.bar'], $events);
        Zend_EventManager_GlobalEventManager::clearListeners('foo.bar');
        $events = Zend_EventManager_GlobalEventManager::getEvents();
        $this->assertEquals([], $events);
    }

    /*
     * Listeners used in tests
     */

    public function aggregateEventMetadata($e)
    {
        $this->test->event  = $e->getName();
        $this->test->target = $e->getTarget();
        $this->test->params = $e->getParams();
        return $this->test->params;
    }

    public function returnOnArray($result)
    {
        return is_array($result);
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_EventManager_GlobalEventManagerTest::main') {
    Zend_EventManager_GlobalEventManagerTest::main();
}
