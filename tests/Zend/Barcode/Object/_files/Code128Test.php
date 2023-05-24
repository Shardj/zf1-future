<?php

require_once 'Zend/Barcode/Object/Code128.php';

class Code128Test extends Zend_Barcode_Object_Code128
{
    public function _convertToBarcodeChars($string)
    {
        return parent::_convertToBarcodeChars($string);
    }
}
