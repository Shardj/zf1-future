<?php

return function ($class) {
    if ('AutoloaderTest_AutoloaderClosure' == $class) {
        return true;
    }
    return false;
};
