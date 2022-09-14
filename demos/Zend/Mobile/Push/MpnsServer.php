<?php
require_once 'Zend/Mobile/Push/Mpns.php';
require_once 'Zend/Mobile/Push/Message/Mpns/Raw.php';
require_once 'Zend/Mobile/Push/Message/Mpns/Tile.php';
require_once 'Zend/Mobile/Push/Message/Mpns/Toast.php';

$mpns = new Zend_Mobile_Push_Mpns();
$messages = [];
 
// raw notification
$message = new Zend_Mobile_Push_Message_Mpns_Raw();
$message->setToken('http://sn1.notify.live.net/throttledthirdparty/01.00/THETOKEN');
$message->setMessage('<notification><foo id="bar" /></notification>');
$messages[] = $message;
 
// toast message
$message = new Zend_Mobile_Push_Message_Mpns_Toast();
$message->setToken('http://sn1.notify.live.net/throttledthirdparty/01.00/THETOKEN');
$message->setTitle('Foo');
$message->setMessage('Bar');
$messages[] = $message;
 
// tile message
$message = new Zend_Mobile_Push_Mpns_Tile();
$message->setToken('http://sn1.notify.live.net/throttledthirdparty/01.00/THETOKEN');
$message->setBackgroundImage('foo.bar');
$message->setCount(1);
$message->setTitle('Bar Foo');
$messages[] = $message;
 
foreach ($messages as $m) {
    try {
        $mpns->send($m);
    } catch (Zend_Mobile_Push_Exception_InvalidToken $e) {
        echo 'Remove token: ' . $m->getToken() . PHP_EOL;
    } catch (Zend_Mobile_Push_Exception $e) {
        echo 'Error occurred, token: ' . $m->getToken() . ' - ' . $e->getMessage() . PHP_EOL;
    }
}
