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
 * @version    $Id: ActivemqTest.php 20096 2010-01-06 02:05:09Z bkarwin $
 */

require_once 'Zend/Queue/Adapter/Activemq.php';
require_once 'Zend/Queue/Stomp/Client.php';
require_once 'Zend/Queue/Stomp/Frame.php';

/**
 * @category   Zend
 * @package    Zend_Queue
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Queue
 */
class Zend_Queue_Adapter_ActivemqOfflineTest extends PHPUnit_Framework_TestCase
{
    /**
     * @group ZF-7948
     */
    public function testSubscribesOncePerQueue()
    {
        $stompClient = new StompClientMock;
        $options['driverOptions']['stompClient'] = $stompClient;
        $adapter = new Zend_Queue_Adapter_Activemq($options);

        $queue = new Zend_Queue('array', ['name' => 'foo']);
        $adapter->receive(null, null, $queue);
        $adapter->receive(null, null, $queue);

        // iterate through mock StompClient and ensure SUBSCRIBE is only sent once per queue
        $subscribes = 0;
        foreach ($stompClient->frameStack as $frame) {
            if ($frame->getCommand() === 'SUBSCRIBE') {
                $subscribes++;
            }
        }

        $this->assertEquals(1, $subscribes);
    }
}

class StompClientMock extends Zend_Queue_Stomp_Client
{
    public $frameStack = [];
    public $responseStack = [];

    public function __construct() {
        // spoof a successful connection in the response stack
        $frame = new Zend_Queue_Stomp_Frame;
        $frame->setCommand('CONNECTED');
        $this->responseStack[] = $frame;
    }
    public function __destruct() {}

    public function send(Zend_Queue_Stomp_FrameInterface $frame)
    {
        $this->frameStack[] = $frame;
        return $this;
    }

    public function receive()
    {
        return array_shift($this->responseStack);
    }

    public function canRead()
    {
        return count($this->responseStack) > 0;
    }

    public function createFrame()
    {
        return new Zend_Queue_Stomp_Frame;
    }
}
