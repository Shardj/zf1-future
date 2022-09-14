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
 * @package    Zend_Cloud
 * @subpackage examples
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @category   Zend
 * @package    Zend_Cloud
 * @subpackage examples
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class QueueController extends Zend_Controller_Action
{
    
    public $dependencies = ['config'];
    
    /**
     * @var Zend_Cloud_QueueService_Adapter
     */
    protected $_queue = null;

    public function preDispatch()
    {
        $this->_queue = Zend_Cloud_QueueService_Factory::getAdapter($this->config->queue);
    }

    public function indexAction()
    {
        $this->view->qs = $this->_queue->listQueues();
    }

    public function createAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return;
        }
        if (!$name = $this->_getParam('name', false)) {
            return;
        }
        $this->_queue->createQueue($name);
        return $this->_helper->redirector('index');
    }

    public function sendAction()
    {
        $this->view->qs = $this->_queue->listQueues();
    	$request        = $this->getRequest();
        $name           = $this->view->name = $this->_getParam('name', false);
     	if (!$name) {
            return;
        }
        if (!$request->isPost()) {
            return;
        }
        if (!$message = $this->_getParam('message', false)) {
            return;
        }
        $ret = $this->_queue->sendMessage($name, $message);
        return $this->_helper->redirector('index');
    }

    public function receiveAction()
    {    
        $this->view->qs = $this->_queue->listQueues();
    	$request        = $this->getRequest();
        $name           = $this->view->name = $this->_getParam('name', false);
     	if (!$name) {
            return;
        }
        $messages = $this->_queue->receiveMessages($name);
        foreach ($messages as $msg) {
        	$texts[] = $msg->getBody();
        	// remove messages from the queue
        	$this->_queue->deleteMessage($name, $msg);
        }
        $this->view->messages = $texts;
    }
}
