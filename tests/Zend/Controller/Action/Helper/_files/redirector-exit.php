<?php

// Calls the *AndExit() method of the redirector named by the first argument
// and prints the redirect the response holds when the script exits
require_once 'Zend/Controller/Front.php';
require_once 'Zend/Controller/Action.php';
require_once 'Zend/Controller/Action/Helper/Redirector.php';
require_once 'Zend/Controller/Request/Http.php';
require_once 'Zend/Controller/Response/Http.php';
require_once 'Zend/Controller/Router/Route.php';

class RedirectorExitController extends Zend_Controller_Action
{
}

$router = Zend_Controller_Front::getInstance()->getRouter();
$router->addDefaultRoutes();
$router->addRoute('blog', new Zend_Controller_Router_Route(
    'blog/archive/:id',
    ['controller' => 'blog', 'action' => 'view', 'id' => false]
));

$request    = new Zend_Controller_Request_Http();
$response   = new Zend_Controller_Response_Http();
$redirector = new Zend_Controller_Action_Helper_Redirector();
$redirector->setActionController(new RedirectorExitController($request, $response, []));

register_shutdown_function(function () use ($response) {
    $location = null;
    foreach ($response->getHeaders() as $header) {
        if ($header['name'] === 'Location') {
            $location = $header['value'];
        }
    }
    echo json_encode(['code' => $response->getHttpResponseCode(), 'location' => $location]), "\n";
});

switch ($argv[1]) {
    case 'gotoAndExit':
        $redirector->gotoAndExit('bar', 'foo');
        break;
    case 'gotoRouteAndExit':
        $redirector->gotoRouteAndExit(['id' => 1], 'blog');
        break;
    case 'gotoUrlAndExit':
        $redirector->gotoUrlAndExit('/foo/bar');
        break;
    case 'redirectAndExit':
        $redirector->setGotoUrl('/baz');
        $redirector->redirectAndExit();
        break;
}

echo "not exited\n";
