<?php

// Prints output first, so the headers are sent when canSendHeaders() runs
require_once 'Zend/Controller/Response/Http.php';

echo "output\n";

$response = new Zend_Controller_Response_Http();
try {
    $response->canSendHeaders(true);
    echo "no exception\n";
} catch (Zend_Controller_Response_Exception $e) {
    echo $e->getMessage() . "\n";
}
