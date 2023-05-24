<?php

class Zend_Stdlib_TestAsset_SignalHandlers_Invokable
{
    public function __invoke()
    {
        return __FUNCTION__;
    }
}
