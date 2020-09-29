<?php
require_once 'Zend/Mobile/Push/Gcm.php';
require_once 'Zend/Mobile/Push/Message/Gcm.php';

$message = new Zend_Mobile_Push_Message_Gcm();
$message->addToken('ABCDEF0123456789');
$message->setData([
    'foo' => 'bar',
    'bar' => 'foo',
]);

$gcm = new Zend_Mobile_Push_Gcm();
$gcm->setApiKey('YOUR_API_KEY');

try {
    $response = $gcm->send($message);
} catch (Zend_Mobile_Push_Exception $e) {
    // exceptions require action or implementation of exponential backoff.
    die($e->getMessage());
}

// handle all errors and registration_id's
foreach ($response->getResults() as $k => $v) {
    if (isset($v['registration_id'])) {
        printf("%s has a new registration id of: %s\r\n", $k, $v['registration_id']);
    }
    if (isset($v['error'])) {
        printf("%s had an error of: %s\r\n", $k, $v['error']);
    }
    if (isset($v['message_id'])) {
        printf("%s was successfully sent the message, message id is: %s", $k, $v['message_id']);
    }
}
