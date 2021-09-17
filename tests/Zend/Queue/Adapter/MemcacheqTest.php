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
 * @package    Zend_Queue
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/*
 * The adapter test class provides a universal test class for all of the
 * abstract methods.
 *
 * All methods marked not supported are explictly checked for for throwing
 * an exception.
 */

/** Zend_Queue */
require_once 'Zend/Queue.php';

/** Zend_Queue */
require_once 'Zend/Queue/Message.php';

/** Zend_Queue_Message_Test */
require_once 'MessageTestClass.php';

/** Base Adapter test class */
require_once dirname(__FILE__) . '/AdapterTest.php';

/**
 * @category   Zend
 * @package    Zend_Queue
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Queue
 */
class Zend_Queue_Adapter_MemcacheqTest extends Zend_Queue_Adapter_AdapterTest
{
    /**
     * Test setup
     */
    public function setUp()
    {
        if (!TESTS_ZEND_QUEUE_MEMCACHEQ_ENABLED) {
            $this->markTestSkipped('TESTS_ZEND_QUEUE_MEMCACHEQ_ENABLED is not enabled in TestConfiguration.php');
        }
        if (!extension_loaded('memcache')) {
            $this->markTestSkipped('memcache extension not loaded');
        }
        date_default_timezone_set('GMT');
        parent::setUp();
    }
    
    /**
     * getAdapterName() is an method to help make AdapterTest work with any
     * new adapters
     *
     * You must overload this method
     *
     * @return string
     */
    public function getAdapterName()
    {
        return 'Memcacheq';
    }

    /**
     * getAdapterName() is an method to help make AdapterTest work with any
     * new adapters
     *
     * You may overload this method.  The default return is
     * 'Zend_Queue_Adapter_' . $this->getAdapterName()
     *
     * @return string
     */
    public function getAdapterFullName()
    {
        return 'Zend_Queue_Adapter_' . $this->getAdapterName();
    }

    public function getTestConfig()
    {
        $driverOptions = [];
        if (defined('TESTS_ZEND_QUEUE_MEMCACHEQ_HOST')) {
            $driverOptions['host'] = TESTS_ZEND_QUEUE_MEMCACHEQ_HOST;
        }
        if (defined('TESTS_ZEND_QUEUE_MEMCACHEQ_PORT')) {
            $driverOptions['port'] = TESTS_ZEND_QUEUE_MEMCACHEQ_PORT;
        }
        return ['driverOptions' => $driverOptions];
    }

    // test the constants
    public function testConst()
    {
        /**
         * @see Zend_Queue_Adapter_Memcacheq
         */
        require_once 'Zend/Queue/Adapter/Memcacheq.php';
        $this->assertTrue(is_string(Zend_Queue_Adapter_Memcacheq::DEFAULT_HOST));
        $this->assertTrue(is_integer(Zend_Queue_Adapter_Memcacheq::DEFAULT_PORT));
        $this->assertTrue(is_string(Zend_Queue_Adapter_Memcacheq::EOL));
    }
    
    /**
     * @group ZF-7650
     */
    public function testReceiveWillRetrieveZeroItems()
    {
        $options = ['name' => 'ZF7650', 'driverOptions' => $this->getTestConfig()];

        $queue = new Zend_Queue('Memcacheq', $options);
        $queue2 = $queue->createQueue('queue');

        $queue->send('My Test Message 1');
        $queue->send('My Test Message 2');

        $messages = $queue->receive(0);
        $this->assertEquals(0, count($messages));
    }
}
