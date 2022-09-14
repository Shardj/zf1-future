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

/**
 * @see Zend_Queue_Adapter_Db
 */
require_once 'Zend/Queue/Adapter/Db.php';

/**
 * Class for using connecting to a Zend_Db-based queuing system
 *
 * $config['options'][Zend_Db_Select::FOR_UPDATE] is a new feature that was
 * written after this code was written.  However, this will still serve as a
 * good example adapter
 *
 * @category   Zend
 * @package    Zend_Queue
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Custom_DbForUpdate extends Zend_Queue_Adapter_Db
{
    /**
     * Return the first element in the queue
     *
     * @param  integer    $maxMessages
     * @param  integer    $timeout
     * @param  Zend_Queue $queue
     * @return Zend_Queue_Message_Iterator
     */
    public function receive($maxMessages=null, $timeout=null, Zend_Queue $queue=null)
    {
        if ($maxMessages === null) {
            $maxMessages = 1;
        }
        if ($timeout === null) {
            $timeout = self::RECEIVE_TIMEOUT_DEFAULT;
        }
        if ($queue === null) {
            $queue = $this->_queue;
        }

        $msgs = [];

        $info = $this->_msg_table->info();

        $microtime = microtime(true); // cache microtime

        $db = $this->_msg_table->getAdapter();

        try {
            // transaction must start before the select query.
            $db->beginTransaction();

            // changes: added forUpdate
            $query = $db->select()->forUpdate();
            $query->from($info['name'], ['*']);
            $query->where('queue_id=?', $this->getQueueId($queue->getName()));
            $query->where('handle IS NULL OR timeout+' . (int)$timeout . ' < ' . (int)$microtime);
            $query->limit($maxMessages);

            foreach ($db->fetchAll($query) as $data) {
                // setup our changes to the message
                $data['handle'] = md5(uniqid(rand(), true));

                $update = [
                    'handle'  => $data['handle'],
                    'timeout' => $microtime
                ];

                // update the database
                $where = [];
                $where[] = $db->quoteInto('message_id=?', $data['message_id']);

                $count = $db->update($info['name'], $update, $where);

                // we check count to make sure no other thread has gotten
                // the rows after our select, but before our update.
                if ($count > 0) {
                    $msgs[] = $data;
                }
            }
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            /**
             * @see Zend_Queue_Exception
             */
            require_once 'Zend/Queue/Exception.php';
            throw new Zend_Queue_Exception($e->getMessage(), $e->getCode());
        }

        $config = [
            'queue'    => $queue,
            'data'     => $msgs,
            'messageClass' => $queue->getMessageClass()
        ];

        $classname = $queue->getMessageSetClass();
        Zend_Loader::loadClass($classname);
        return new $classname($config);
    }
}
