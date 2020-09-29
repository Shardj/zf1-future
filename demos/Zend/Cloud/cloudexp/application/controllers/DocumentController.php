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
class DocumentController extends Zend_Controller_Action
{
    
    public $dependencies = ['config'];
    
    /**
     * @var Zend_Cloud_DocumentService_Adapter
     */
    protected $_doc = null;

    public function preDispatch()
    {
        $this->_doc = Zend_Cloud_DocumentService_Factory::getAdapter(
            $this->config->document
        );
    }

    public function indexAction()
    {
        $this->view->collections = $this->_doc->listCollections();
    }

    public function showAction()
    {
        $request = $this->getRequest();
        if (!$name = $this->view->collection = $this->_getParam('collection', false)) {
            return;
        }
        $q = $this->_doc->select("*");
        $this->view->data = $this->_doc->query($name, $q, [
            Zend_Cloud_DocumentService_Adapter_SimpleDB::RETURN_DOCUMENTS => true
        ]);
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
        $this->_doc->createCollection($name);
        return $this->_helper->redirector('index');
    }

    public function addDocumentAction()
    {
    	$this->view->fieldcount = 5;
    	$this->view->collections = $this->_doc->listCollections();
    	$request = $this->getRequest();
        if (!$request->isPost()) {
            return;
        }
        if (!$name = $this->view->name =  $this->_getParam('name', false)) {
            return;
        }
        if (!$id = $this->_getParam('id', false)) {
            return;
        }
        $fields = [];
        foreach ($this->_getParam('field', []) as $field) {
            if (!$field["name"]) {
                continue;
            }
        	$fields[$field["name"]] = $field["value"];
        }
        if (empty($fields)) {
        	return;
        }
        $document = new Zend_Cloud_DocumentService_Document($id, $fields);
		$this->_doc->insertDocument($name, $document);
        return $this->_helper->redirector('show', null, null, ["collection" => $name]);
    }

    public function deleteDocumentAction()
    {   
    	$request = $this->getRequest();
        if (!$request->isPost()) {
            return;
        }
        if (!$name = $this->view->name =  $this->_getParam('name', false)) {
            return;
        }
        if (!$id = $this->_getParam('id', false)) {
            return;
        }
        $this->_doc->deleteDocument($name, $id);
        return $this->_helper->redirector('show', null, null, ["collection" => $name]);
   }
}
