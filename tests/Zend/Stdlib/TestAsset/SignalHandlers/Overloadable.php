<?php

class Zend_Stdlib_TestAsset_SignalHandlers_Overloadable
{
    public function __call($method, $args)
    {
        return $method;
    }
}
