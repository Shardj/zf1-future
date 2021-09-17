<?php

namespace MyApp\Controller\Plugin;
use stdClass;
use Zend_Controller_Request_Abstract;

require_once 'Zend/Controller/Action/Helper/Abstract.php';
class ThrowingPlugin extends \Zend_Controller_Plugin_Abstract {

    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
    {
        $this->produceTypeError();
        throw new \Exception('Should not ever get here');
    }

    private function produceTypeError(): self
    {
        return new stdClass();
    }
}
