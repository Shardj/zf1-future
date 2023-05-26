<?php

class Zend_LocaleTestHelper extends Zend_Locale
{
    public static function resetObject()
    {
        self::$_auto = null;
        self::$_environment = null;
        self::$_browser = null;
    }
}
