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
    define('PHPUnit_MAIN_METHOD', 'Zend_EventManager_EventManagerTest::main');
}

require_once 'Zend/EventManager/Event.php';
require_once 'Zend/EventManager/EventDescription.php';
require_once 'Zend/EventManager/EventManager.php';
require_once 'Zend/EventManager/ResponseCollection.php';
require_once 'Zend/EventManager/TestAsset/Functor.php';
require_once 'Zend/EventManager/TestAsset/MockAggregate.php';
require_once 'Zend/Stdlib/CallbackHandler.php';

/**
 * @category   Zend
 * @package    Zend_EventManager
 * @subpackage UnitTests
 * @group      Zend_EventManager
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_EventManager_EventManagerTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        if (isset($this->message)) {
            unset($this->message);
        }
        $this->default = '';
        $this->events  = new Zend_EventManager_EventManager;
    }

    public function testAttachShouldReturnCallbackHandler()
    {
        $listener = $this->events->attach('test', [$this, __METHOD__]);
        $this->assertTrue($listener instanceof Zend_Stdlib_CallbackHandler);
    }

    public function testAttachShouldAddListenerToEvent()
    {
        $listener  = $this->events->attach('test', [$this, __METHOD__]);
        $listeners = $this->events->getListeners('test');
        $this->assertEquals(1, count($listeners));
        $this->assertContains($listener, $listeners);
    }

    public function testAttachShouldAddEventIfItDoesNotExist()
    {
        $events = $this->events->getEvents();
        $this->assertTrue(empty($events), var_export($events, 1));
        $listener = $this->events->attach('test', [$this, __METHOD__]);
        $events = $this->events->getEvents();
        $this->assertFalse(empty($events));
        $this->assertContains('test', $events);
    }

    public function testAllowsPassingArrayOfEventNamesWhenAttaching()
    {
        $callback = [$this, 'returnName'];
        $this->events->attach(['foo', 'bar'], $callback);

        foreach (['foo', 'bar'] as $event) {
            $listeners = $this->events->getListeners($event);
            $this->assertTrue(count($listeners) > 0);
            foreach ($listeners as $listener) {
                $this->assertSame($callback, $listener->getCallback());
            }
        }
    }

    public function testPassingArrayOfEventNamesWhenAttachingReturnsArrayOfCallbackHandlers()
    {
        $callback = [$this, 'returnName'];
        $listeners = $this->events->attach(['foo', 'bar'], $callback);

        $this->assertTrue(is_array($listeners));

        foreach ($listeners as $listener) {
            $this->assertTrue($listener instanceof Zend_Stdlib_CallbackHandler);
            $this->assertSame($callback, $listener->getCallback());
        }
    }

    public function testDetachShouldRemoveListenerFromEvent()
    {
        $listener  = $this->events->attach('test', [$this, __METHOD__]);
        $listeners = $this->events->getListeners('test');
        $this->assertContains($listener, $listeners);
        $this->events->detach($listener);
        $listeners = $this->events->getListeners('test');
        $this->assertNotContains($listener, $listeners);
    }

    public function testDetachShouldReturnFalseIfEventDoesNotExist()
    {
        $listener = $this->events->attach('test', [$this, __METHOD__]);
        $this->events->clearListeners('test');
        $this->assertFalse($this->events->detach($listener));
    }

    public function testDetachShouldReturnFalseIfListenerDoesNotExist()
    {
        $listener1 = $this->events->attach('test', [$this, __METHOD__]);
        $this->events->clearListeners('test');
        $listener2 = $this->events->attach('test', [$this, 'handleTestEvent']);
        $this->assertFalse($this->events->detach($listener1));
    }

    public function testRetrievingAttachedListenersShouldReturnEmptyArrayWhenEventDoesNotExist()
    {
        $listeners = $this->events->getListeners('test');
        $this->assertEquals(0, count($listeners));
    }

    public function testTriggerShouldTriggerAttachedListeners()
    {
        $listener = $this->events->attach('test', [$this, 'handleTestEvent']);
        $this->events->trigger('test', $this, ['message' => 'test message']);
        $this->assertEquals('test message', $this->message);
    }

    public function testTriggerShouldReturnAllListenerReturnValues()
    {
        $this->default = '__NOT_FOUND__';
        $this->events->attach('string.transform', [$this, 'trimString']);
        $this->events->attach('string.transform', [$this, 'stringRot13']);
        $responses = $this->events->trigger('string.transform', $this, ['string' => ' foo ']);
        $this->assertTrue($responses instanceof Zend_EventManager_ResponseCollection);
        $this->assertEquals(2, $responses->count());
        $this->assertEquals('foo', $responses->first());
        $this->assertEquals(str_rot13(' foo '), $responses->last());
    }

    public function testTriggerUntilShouldReturnAsSoonAsCallbackReturnsTrue()
    {
        $this->events->attach('foo.bar', [$this, 'stringPosition']);
        $this->events->attach('foo.bar', [$this, 'stringInString']);
        $responses = $this->events->triggerUntil(
            'foo.bar',
            $this,
            ['string' => 'foo', 'search' => 'f'],
            [$this, 'evaluateStringCallback']
        );
        $this->assertTrue($responses instanceof Zend_EventManager_ResponseCollection);
        $this->assertSame(0, $responses->last());
    }

    public function testTriggerResponseCollectionContains()
    {
        $this->events->attach('string.transform', [$this, 'trimString']);
        $this->events->attach('string.transform', [$this, 'stringRot13']);
        $responses = $this->events->trigger('string.transform', $this, ['string' => ' foo ']);
        $this->assertEquals(2, count($responses));
        $this->assertTrue($responses->contains('foo'));
        $this->assertTrue($responses->contains(str_rot13(' foo ')));
        $this->assertFalse($responses->contains(' foo '));
    }

    public function handleTestEvent($e)
    {
        $message = $e->getParam('message', '__NOT_FOUND__');
        $this->message = $message;
    }

    public function evaluateStringCallback($value)
    {
        return (!$value);
    }

    public function testTriggerUntilShouldMarkResponseCollectionStoppedWhenConditionMet()
    {
        $this->events->attach('foo.bar', [$this, 'returnBogus'], 4);
        $this->events->attach('foo.bar', [$this, 'returnNada'], 3);
        $this->events->attach('foo.bar', [$this, 'returnFound'], 2);
        $this->events->attach('foo.bar', [$this, 'returnZero'], 1);
        $responses = $this->events->triggerUntil('foo.bar', $this, [], [$this, 'returnOnFound']);
        $this->assertTrue($responses instanceof Zend_EventManager_ResponseCollection);
        $this->assertTrue($responses->stopped());
        $result = $responses->last();
        $this->assertEquals('found', $result);
        $this->assertFalse($responses->contains('zero'));
    }

    public function testTriggerUntilShouldMarkResponseCollectionStoppedWhenConditionMetByLastListener()
    {
        $this->events->attach('foo.bar', [$this, 'returnBogus']);
        $this->events->attach('foo.bar', [$this, 'returnNada']);
        $this->events->attach('foo.bar', [$this, 'returnZero']);
        $this->events->attach('foo.bar', [$this, 'returnFound']);
        $responses = $this->events->triggerUntil('foo.bar', $this, [], [$this, 'returnOnFound']);
        $this->assertTrue($responses instanceof Zend_EventManager_ResponseCollection);
        $this->assertTrue($responses->stopped());
        $this->assertEquals('found', $responses->last());
    }

    public function testResponseCollectionIsNotStoppedWhenNoCallbackMatchedByTriggerUntil()
    {
        $this->events->attach('foo.bar', [$this, 'returnBogus'], 4);
        $this->events->attach('foo.bar', [$this, 'returnNada'], 3);
        $this->events->attach('foo.bar', [$this, 'returnZero'], 1);
        $this->events->attach('foo.bar', [$this, 'returnFound'], 2);
        $responses = $this->events->triggerUntil('foo.bar', $this, [], [$this, 'returnOnNeverFound']);
        $this->assertTrue($responses instanceof Zend_EventManager_ResponseCollection);
        $this->assertFalse($responses->stopped());
        $this->assertEquals('zero', $responses->last());
    }

    public function testCanAttachListenerAggregate()
    {
        $aggregate = new Zend_EventManager_TestAsset_MockAggregate();
        $this->events->attachAggregate($aggregate);
        $events = $this->events->getEvents();
        foreach (['foo.bar', 'foo.baz'] as $event) {
            $this->assertContains($event, $events);
        }
    }

    public function testCanAttachListenerAggregateViaAttach()
    {
        $aggregate = new Zend_EventManager_TestAsset_MockAggregate();
        $this->events->attach($aggregate);
        $events = $this->events->getEvents();
        foreach (['foo.bar', 'foo.baz'] as $event) {
            $this->assertContains($event, $events);
        }
    }

    public function testAttachAggregateReturnsAttachOfListenerAggregate()
    {
        $aggregate = new Zend_EventManager_TestAsset_MockAggregate();
        $method    = $this->events->attachAggregate($aggregate);
        $this->assertSame('Zend_EventManager_TestAsset_MockAggregate::attach', $method);
    }

    public function testCanDetachListenerAggregates()
    {
        // setup some other event listeners, to ensure appropriate items are detached
        $listenerFooBar1 = $this->events->attach('foo.bar', [$this, 'returnTrue']);
        $listenerFooBar2 = $this->events->attach('foo.bar', [$this, 'returnTrue']);
        $listenerFooBaz1 = $this->events->attach('foo.baz', [$this, 'returnTrue']);
        $listenerOther   = $this->events->attach('other', [$this, 'returnTrue']);

        $aggregate = new Zend_EventManager_TestAsset_MockAggregate();
        $this->events->attachAggregate($aggregate);
        $this->events->detachAggregate($aggregate);
        $events = $this->events->getEvents();
        foreach (['foo.bar', 'foo.baz', 'other'] as $event) {
            $this->assertContains($event, $events);
        }

        $listeners = $this->events->getListeners('foo.bar');
        $this->assertEquals(2, count($listeners));
        $this->assertContains($listenerFooBar1, $listeners);
        $this->assertContains($listenerFooBar2, $listeners);

        $listeners = $this->events->getListeners('foo.baz');
        $this->assertEquals(1, count($listeners));
        $this->assertContains($listenerFooBaz1, $listeners);

        $listeners = $this->events->getListeners('other');
        $this->assertEquals(1, count($listeners));
        $this->assertContains($listenerOther, $listeners);
    }

    public function testCanDetachListenerAggregatesViaDetach()
    {
        // setup some other event listeners, to ensure appropriate items are detached
        $listenerFooBar1 = $this->events->attach('foo.bar', [$this, 'returnTrue']);
        $listenerFooBar2 = $this->events->attach('foo.bar', [$this, 'returnTrue']);
        $listenerFooBaz1 = $this->events->attach('foo.baz', [$this, 'returnTrue']);
        $listenerOther   = $this->events->attach('other',   [$this, 'returnTrue']);

        $aggregate = new Zend_EventManager_TestAsset_MockAggregate();
        $this->events->attach($aggregate);
        $this->events->detach($aggregate);
        $events = $this->events->getEvents();
        foreach (['foo.bar', 'foo.baz', 'other'] as $event) {
            $this->assertContains($event, $events);
        }

        $listeners = $this->events->getListeners('foo.bar');
        $this->assertEquals(2, count($listeners));
        $this->assertContains($listenerFooBar1, $listeners);
        $this->assertContains($listenerFooBar2, $listeners);

        $listeners = $this->events->getListeners('foo.baz');
        $this->assertEquals(1, count($listeners));
        $this->assertContains($listenerFooBaz1, $listeners);

        $listeners = $this->events->getListeners('other');
        $this->assertEquals(1, count($listeners));
        $this->assertContains($listenerOther, $listeners);
    }

    public function testDetachAggregateReturnsDetachOfListenerAggregate()
    {
        $aggregate = new Zend_EventManager_TestAsset_MockAggregate();
        $this->events->attachAggregate($aggregate);
        $method = $this->events->detachAggregate($aggregate);
        $this->assertSame('Zend_EventManager_TestAsset_MockAggregate::detach', $method);
    }

    public function testAttachAggregateAcceptsOptionalPriorityValue()
    {
        $aggregate = new Zend_EventManager_TestAsset_MockAggregate();
        $this->events->attachAggregate($aggregate, 1);
        $this->assertEquals(1, $aggregate->priority);
    }

    public function testAttachAggregateAcceptsOptionalPriorityValueViaAttachCallbackArgument()
    {
        $aggregate = new Zend_EventManager_TestAsset_MockAggregate();
        $this->events->attach($aggregate, 1);
        $this->assertEquals(1, $aggregate->priority);
    }

    public function testCallingEventsStopPropagationMethodHaltsEventEmission()
    {
        $this->events->attach('foo.bar', [$this, 'returnBogus'], 4);
        $this->events->attach('foo.bar', [$this, 'returnNadaAndStopPropagation'], 3);
        $this->events->attach('foo.bar', [$this, 'returnFound'], 2);
        $this->events->attach('foo.bar', [$this, 'returnZero'], 1);
        $responses = $this->events->trigger('foo.bar', $this, []);
        $this->assertTrue($responses instanceof Zend_EventManager_ResponseCollection);
        $this->assertTrue($responses->stopped());
        $this->assertEquals('nada', $responses->last());
        $this->assertTrue($responses->contains('bogus'));
        $this->assertFalse($responses->contains('found'));
        $this->assertFalse($responses->contains('zero'));
    }

    public function testCanAlterParametersWithinAEvent()
    {
        $this->foo = 'bar';
        $this->bar = 'baz';
        $this->events->attach('foo.bar', [$this, 'setParamFoo']);
        $this->events->attach('foo.bar', [$this, 'setParamBar']);
        $this->events->attach('foo.bar', [$this, 'returnParamsFooAndBar']);
        $responses = $this->events->trigger('foo.bar', $this, []);
        $this->assertEquals('bar:baz', $responses->last());
    }

    public function testParametersArePassedToEventByReference()
    {
        $this->foo = 'FOO';
        $this->bar = 'BAR';
        $params = [ 'foo' => 'bar', 'bar' => 'baz'];
        $args   = $this->events->prepareArgs($params);
        $this->events->attach('foo.bar', [$this, 'setParamFoo']);
        $this->events->attach('foo.bar', [$this, 'setParamBar']);
        $responses = $this->events->trigger('foo.bar', $this, $args);
        $this->assertEquals('FOO', $args['foo']);
        $this->assertEquals('BAR', $args['bar']);
    }

    public function testCanPassObjectForEventParameters()
    {
        $this->foo = 'FOO';
        $this->bar = 'BAR';
        $params = (object) [ 'foo' => 'bar', 'bar' => 'baz'];
        $this->events->attach('foo.bar', [$this, 'setParamFoo']);
        $this->events->attach('foo.bar', [$this, 'setParamBar']);
        $responses = $this->events->trigger('foo.bar', $this, $params);
        $this->assertEquals('FOO', $params->foo);
        $this->assertEquals('BAR', $params->bar);
    }

    public function testCanPassEventObjectAsSoleArgumentToTrigger()
    {
        $event = new Zend_EventManager_Event();
        $event->setName(__FUNCTION__);
        $event->setTarget($this);
        $event->setParams(['foo' => 'bar']);
        $this->events->attach(__FUNCTION__, [$this, 'returnEvent']);
        $responses = $this->events->trigger($event);
        $this->assertSame($event, $responses->last());
    }

    public function testCanPassEventNameAndEventObjectAsSoleArgumentsToTrigger()
    {
        $event = new Zend_EventManager_Event();
        $event->setTarget($this);
        $event->setParams(['foo' => 'bar']);
        $this->events->attach(__FUNCTION__, [$this, 'returnEvent']);
        $responses = $this->events->trigger(__FUNCTION__, $event);
        $this->assertSame($event, $responses->last());
        $this->assertEquals(__FUNCTION__, $event->getName());
    }

    public function testCanPassEventObjectAsArgvToTrigger()
    {
        $event = new Zend_EventManager_Event();
        $event->setParams(['foo' => 'bar']);
        $this->events->attach(__FUNCTION__, [$this, 'returnEvent']);
        $responses = $this->events->trigger(__FUNCTION__, $this, $event);
        $this->assertSame($event, $responses->last());
        $this->assertEquals(__FUNCTION__, $event->getName());
        $this->assertSame($this, $event->getTarget());
    }

    public function testCanPassEventObjectAndCallbackAsSoleArgumentsToTriggerUntil()
    {
        $event = new Zend_EventManager_Event();
        $event->setName(__FUNCTION__);
        $event->setTarget($this);
        $event->setParams(['foo' => 'bar']);
        $this->events->attach(__FUNCTION__, [$this, 'returnEvent']);
        $responses = $this->events->triggerUntil($event, [$this, 'returnOnEvent']);
        $this->assertTrue($responses->stopped());
        $this->assertSame($event, $responses->last());
    }

    public function testCanPassEventNameAndEventObjectAndCallbackAsSoleArgumentsToTriggerUntil()
    {
        $event = new Zend_EventManager_Event();
        $event->setTarget($this);
        $event->setParams(['foo' => 'bar']);
        $this->events->attach(__FUNCTION__, [$this, 'returnEvent']);
        $responses = $this->events->triggerUntil(__FUNCTION__, $event, [$this, 'returnOnEvent']);
        $this->assertTrue($responses->stopped());
        $this->assertSame($event, $responses->last());
        $this->assertEquals(__FUNCTION__, $event->getName());
    }

    public function testCanPassEventObjectAsArgvToTriggerUntil()
    {
        $event = new Zend_EventManager_Event();
        $event->setParams(['foo' => 'bar']);
        $this->events->attach(__FUNCTION__, [$this, 'returnEvent']);
        $responses = $this->events->triggerUntil(__FUNCTION__, $this, $event, [$this, 'returnOnEvent']);
        $this->assertTrue($responses->stopped());
        $this->assertSame($event, $responses->last());
        $this->assertEquals(__FUNCTION__, $event->getName());
        $this->assertSame($this, $event->getTarget());
    }

    public function testTriggerCanTakeAnOptionalCallbackArgumentToEmulateTriggerUntil()
    {
        $this->events->attach(__FUNCTION__, [$this, 'returnEvent']);

        // Four scenarios:
        // First: normal signature:
        $responses = $this->events->trigger(__FUNCTION__, $this, [], [$this, 'returnOnEvent']);
        $this->assertTrue($responses->stopped());

        // Second: Event as $argv parameter:
        $event = new Zend_EventManager_Event();
        $responses = $this->events->trigger(__FUNCTION__, $this, $event, [$this, 'returnOnEvent']);
        $this->assertTrue($responses->stopped());

        // Third: Event as $target parameter:
        $event = new Zend_EventManager_Event();
        $event->setTarget($this);
        $responses = $this->events->trigger(__FUNCTION__, $event, [$this, 'returnOnEvent']);
        $this->assertTrue($responses->stopped());

        // Fourth: Event as $event parameter:
        $event = new Zend_EventManager_Event();
        $event->setTarget($this);
        $event->setName(__FUNCTION__);
        $responses = $this->events->trigger($event, [$this, 'returnOnEvent']);
        $this->assertTrue($responses->stopped());
    }

    public function testWeakRefsAreHonoredWhenTriggering()
    {
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            $this->markTestSkipped('Requires PHP >= 5.3.0 as it tests functors');
        }
        if (!class_exists('WeakRef', false)) {
            $this->markTestSkipped('Requires pecl/weakref');
        }

        $functor = new Zend_EventManager_TestAsset_Functor;
        $this->events->attach('test', $functor);

        unset($functor);

        $result = $this->events->trigger('test', $this, []);
        $message = $result->last();
        $this->assertNull($message);
    }

    public function testDuplicateIdentifiersAreNotRegistered()
    {
        $events = new Zend_EventManager_EventManager([__CLASS__, get_class($this)]);
        $identifiers = $events->getIdentifiers();
        $this->assertSame(count($identifiers), 1);
        $this->assertSame($identifiers[0], __CLASS__);
        $events->addIdentifiers(__CLASS__);
        $this->assertSame(count($identifiers), 1);
        $this->assertSame($identifiers[0], __CLASS__);
    }

    public function testIdentifierGetterSettersWorkWithStrings()
    {
        $identifier1 = 'foo';
        $identifiers = [$identifier1];
        $this->assertTrue($this->events->setIdentifiers($identifier1) instanceof Zend_EventManager_EventManager);
        $this->assertSame($this->events->getIdentifiers(), $identifiers);
        $identifier2 = 'baz';
        $identifiers = [$identifier1, $identifier2];
        $this->assertTrue($this->events->addIdentifiers($identifier2) instanceof Zend_EventManager_EventManager);
        $this->assertSame($this->events->getIdentifiers(), $identifiers);
    }

    public function testIdentifierGetterSettersWorkWithArrays()
    {
        $identifiers = ['foo', 'bar'];
        $this->assertTrue($this->events->setIdentifiers($identifiers) instanceof Zend_EventManager_EventManager);
        $this->assertSame($this->events->getIdentifiers(), $identifiers);
        $identifiers[] = 'baz';
        $this->assertTrue($this->events->addIdentifiers($identifiers) instanceof Zend_EventManager_EventManager);
        $this->assertSame($this->events->getIdentifiers(), $identifiers);
    }

    public function testIdentifierGetterSettersWorkWithTraversables()
    {
        $identifiers = new ArrayIterator(['foo', 'bar']);
        $this->assertTrue($this->events->setIdentifiers($identifiers) instanceof Zend_EventManager_EventManager);
        $this->assertSame($this->events->getIdentifiers(), (array) $identifiers);
        $identifiers = new ArrayIterator(['foo', 'bar', 'baz']);
        $this->assertTrue($this->events->addIdentifiers($identifiers) instanceof Zend_EventManager_EventManager);
        $this->assertSame($this->events->getIdentifiers(), (array) $identifiers);
    }

    public function testListenersAttachedWithWildcardAreTriggeredForAllEvents()
    {
        $this->test         = new stdClass;
        $this->test->events = [];
        $callback           = [$this, 'setEventName'];

        $this->events->attach('*', $callback);
        foreach (['foo', 'bar', 'baz'] as $event) {
            $this->events->trigger($event);
            $this->assertContains($event, $this->test->events);
        }
    }

    /**
     * @group ZF-12185
     * @expectedException Zend_EventManager_Exception_InvalidArgumentException
     */
    public function testInvalidArgumentExceptionCanBeThrown()
    {
        require_once "Zend/EventManager/Exception/InvalidArgumentException.php";
        throw new Zend_EventManager_Exception_InvalidArgumentException();
    }

    /*
     * Listeners used in tests
     */

    public function returnName($e)
    {
        return $e->getName();
    }

    public function trimString($e)
    {
        $string = $e->getParam('string', $this->default);
        return trim($string);
    }

    public function stringRot13($e)
    {
        $string = $e->getParam('string', $this->default);
        return str_rot13($string);
    }

    public function stringPosition($e)
    {
        $string = $e->getParam('string', '');
        $search = $e->getParam('search', '?');
        return strpos($string, $search);
    }

    public function stringInString($e)
    {
        $string = $e->getParam('string', '');
        $search = $e->getParam('search', '?');
        return strstr($string, $search);
    }

    public function returnBogus()
    {
        return 'bogus';
    }

    public function returnNada()
    {
        return 'nada';
    }

    public function returnFound()
    {
        return 'found';
    }

    public function returnZero()
    {
        return 'zero';
    }

    public function returnTrue()
    {
        return true;
    }

    public function returnNadaAndStopPropagation($e)
    {
        $e->stopPropagation(true);
        return 'nada';
    }

    public function setParamFoo($e)
    {
        $e->setParam('foo', $this->foo);
    }

    public function setParamBar($e)
    {
        $e->setParam('bar', $this->bar);
    }

    public function returnParamsFooAndBar($e)
    {
        $foo = $e->getParam('foo', '__NO_FOO__');
        $bar = $e->getParam('bar', '__NO_BAR__');
        return $foo . ":" . $bar;
    }

    public function returnEvent($e)
    {
        return $e;
    }

    public function setEventName($e)
    {
        $this->test->events[] = $e->getName();
    }

    public function returnOnFound($result)
    {
        return ($result === 'found');
    }

    public function returnOnNeverFound($result)
    {
        return ($result === 'never found');
    }

    public function returnOnEvent($result)
    {
        return ($result instanceof Zend_EventManager_EventDescription);
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_EventManager_EventManagerTest::main') {
    Zend_EventManager_EventManagerTest::main();
}
