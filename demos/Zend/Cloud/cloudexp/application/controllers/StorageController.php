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
class StorageController extends Zend_Controller_Action
{
    
    public $dependencies = ['config'];
    
    /**
     * @var Zend_Cloud_StorageService_Adapter
     */
    protected $_storage = null;

    public function preDispatch()
    {
        $this->_storage = Zend_Cloud_StorageService_Factory::getAdapter($this->config->storage);
    }

    public function indexAction()
    {
        $this->view->items = $this->_storage->listItems("/");
    }

    public function getAction()
    {
        if (!$name = $this->_getParam('item', false)) {
            return $this->_helper->redirector('index');
        }

        $item = $this->_storage->fetchItem($name, [
        	Zend_Cloud_StorageService_Adapter_S3::FETCH_STREAM => true,
        	Zend_Cloud_StorageService_Adapter_WindowsAzure::RETURN_TYPE => Zend_Cloud_StorageService_Adapter_WindowsAzure::RETURN_STREAM
        ]);

        if (!$item) {
            $this->getResponse()->setHttpResponseCode(404);
            return;
        }

        $meta = $this->_storage->fetchMetadata($name);
        if (isset($meta["type"])) {
            $this->getResponse()->setHeader('Content-Type', $meta["type"]);
        }

        // don't render the view, send the item instead
        $this->_helper->viewRenderer->setNoRender(true);
        if ($item instanceof Zend_Http_Response_Stream) {
            fpassthru($item->getStream());
        } elseif (is_resource($item)) {
            fpassthru($item);
        } else {
            $this->getResponse()->setBody($item);
        }
    }

    public function uploadAction()
    {
    	$request = $this->getRequest();
    	if (!$request->isPost()) {
    		return;
    	}
    	$name = $this->_getParam('name', false);
    	
    	$upload = new Zend_File_Transfer();
    	$upload->addValidator('Count', false, 1);
	    if (!$upload->isValid()) {
	    	return;
		}
		$upload->receive();
    	$file = $upload->getFileName();
		$fp   = fopen($file, "r");
		if (!$fp) {
			return;
		}
		$mime = $upload->getMimeType();
		if (!$name) {
			// get short name
			$name = $upload->getFileName(null, false);
		}

        $this->_storage->storeItem($name, $fp, [
            Zend_Cloud_StorageService_Adapter_S3::METADATA => ["type" => $mime]
        ]);
		try {
			$this->_storage->storeMetadata($name, ["type" => $mime]);
		} catch(Zend_Cloud_OperationNotAvailableException $e) {
			// ignore it
		}

		return $this->_helper->redirector('index');
	}
}
