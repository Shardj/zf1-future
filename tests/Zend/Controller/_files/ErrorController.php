<?php

class ErrorController extends Zend_Controller_Action
{
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');

        $this->getResponse()
            ->setHttpResponseCode(500)
            ->appendBody($errors->type . PHP_EOL)
            ->appendBody($errors->exception->getMessage());
    }
}
