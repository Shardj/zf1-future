<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Rest
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/** Zend_Rest_Route */
require_once 'Zend/Rest/Route.php';

/** Zend_Controller_Front */
require_once 'Zend/Controller/Front.php';

/** Zend_Controller_Request_HttpTestCase */
require_once 'Zend/Controller/Request/HttpTestCase.php';

// Call Zend_Rest_RouteTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Rest_RouteTest::main");
}

/**
 * @category   Zend
 * @package    Zend_Rest
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Rest
 */
class Zend_Rest_RouteTest extends PHPUnit_Framework_TestCase
{

    protected $_front;
    protected $_request;
    protected $_dispatcher;

    /**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main()
    {

        $suite  = new PHPUnit_Framework_TestSuite("Zend_Rest_RouteTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        $this->_front = Zend_Controller_Front::getInstance();
        $this->_front->resetInstance();
        $this->_front->setParam('noErrorHandler', true)
        ->setParam('noViewRenderer', true);

        $this->_dispatcher = $this->_front->getDispatcher();

        $this->_dispatcher->setControllerDirectory([
            'default' => dirname(__FILE__) . DIRECTORY_SEPARATOR .
                '..' . DIRECTORY_SEPARATOR .
                'Controller' . DIRECTORY_SEPARATOR .
                '_files',
            'mod'     => dirname(__FILE__) . DIRECTORY_SEPARATOR .
                '..' . DIRECTORY_SEPARATOR .
                'Controller' . DIRECTORY_SEPARATOR .
                '_files' . DIRECTORY_SEPARATOR .
                'Admin',
        ]);
    }

    public function test_getVersion()
    {
        $route = new Zend_Rest_Route($this->_front);
        $this->assertEquals(2, $route->getVersion());
    }

    public function test_getInstance_fromINIConfig()
    {
    	require_once('Zend/Config/Ini.php');
    	$config = new Zend_Config_Ini(dirname(__FILE__) . '/../Controller/_files/routes.ini', 'testing');
    	require_once('Zend/Controller/Router/Rewrite.php');
    	$router = new Zend_Controller_Router_Rewrite();
    	$router->addConfig($config, 'routes');
    	$route = $router->getRoute('rest');
    	$this->assertTrue($route instanceof Zend_Rest_Route);
    	$this->assertEquals('object', $route->getDefault('controller'));

    	$request = $this->_buildRequest('GET', '/mod/project');
    	$values = $this->_invokeRouteMatch($request, [], $route);
    	$this->assertEquals('mod', $values['module']);
    	$this->assertEquals('project', $values['controller']);
    	$this->assertEquals('index', $values['action']);

    	$request = $this->_buildRequest('POST', '/mod/user');
    	$values = $this->_invokeRouteMatch($request, [], $route);
    	$this->assertEquals('mod', $values['module']);
    	$this->assertEquals('user', $values['controller']);
    	$this->assertEquals('post', $values['action']);

    	$request = $this->_buildRequest('GET', '/other');
    	$values = $this->_invokeRouteMatch($request, [], $route);
    	$this->assertFalse($values);
    }

    public function test_RESTfulApp_defaults()
    {
        $request = $this->_buildRequest('GET', '/');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('index', $values['controller']);
        $this->assertEquals('index', $values['action']);
    }

    /*
     * @group ZF-7437
     */
    public function test_RESTfulApp_GET_user_defaults()
    {
        $request = $this->_buildRequest('GET', '/user');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('index', $values['action']);
    }

    public function test_RESTfulApp_GET_user_index()
    {
        $request = $this->_buildRequest('GET', '/user/index');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('index', $values['action']);
    }

    public function test_RESTfulApp_GET_user_index_withParams()
    {
        $request = $this->_buildRequest('GET', '/user/index/changedSince/123456789/status/active');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('index', $values['action']);
        $this->assertEquals(123456789, $values['changedSince']);
        $this->assertEquals('active', $values['status']);
    }

    public function test_RESTfulApp_GET_user_index_withQueryParams()
    {
        $request = $this->_buildRequest('GET', '/user/?changedSince=123456789&status=active');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('index', $values['action']);
        $this->assertEquals(123456789, $values['changedSince']);
        $this->assertEquals('active', $values['status']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulApp_GET_user_index_withParam_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('GET', '/user/index/the%2Bemail%40address/email%2Btest%40example.com');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('index', $values['action']);
        $this->assertEquals('email+test@example.com', $values['the+email@address']);
    }

    public function test_RESTfulApp_GET_project_byIdentifier()
    {
        $request = $this->_buildRequest('GET', '/project/zendframework');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('project', $values['controller']);
        $this->assertEquals('get', $values['action']);
        $this->assertEquals('zendframework', $values['id']);
    }

    public function test_RESTfulApp_GET_project_byIdQueryParam()
    {
        $request = $this->_buildRequest('GET', '/project/?id=zendframework');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('project', $values['controller']);
        $this->assertEquals('get', $values['action']);
        $this->assertEquals('zendframework', $values['id']);
    }

    public function test_RESTfulApp_GET_project_byIdentifier_urlencoded()
    {
        $request = $this->_buildRequest('GET', '/project/zend+framework');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('project', $values['controller']);
        $this->assertEquals('get', $values['action']);
        $this->assertEquals('zend framework', $values['id']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulApp_GET_project_byIdentifier_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('GET', '/project/email%2Btest%40example.com');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('project', $values['controller']);
        $this->assertEquals('get', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulApp_HEAD_project_byIdentifier()
    {
        $request = $this->_buildRequest('HEAD', '/project/lcrouch');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('project', $values['controller']);
        $this->assertEquals('head', $values['action']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulApp_HEAD_project_byIdentifier_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('HEAD', '/project/email%2Btest%40example.com');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('project', $values['controller']);
        $this->assertEquals('head', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulApp_GET_project_edit()
    {
        $request = $this->_buildRequest('GET', '/project/zendframework/edit');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('project', $values['controller']);
        $this->assertEquals('edit', $values['action']);
        $this->assertEquals('zendframework', $values['id']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulApp_GET_project_edit_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('GET', '/project/email%2Btest%40example.com/edit');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('default', $values['module']);
        $this->assertEquals('project', $values['controller']);
        $this->assertEquals('edit', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulApp_PUT_user_byIdentifier()
    {
        $request = $this->_buildRequest('PUT', '/mod/user/lcrouch');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('put', $values['action']);
        $this->assertEquals('lcrouch', $values['id']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulApp_PUT_user_byIdentifier_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('PUT', '/mod/user/email%2Btest%40example.com');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('put', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulApp_POST_user()
    {
        $request = $this->_buildRequest('POST', '/mod/user');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('post', $values['action']);
    }

    public function test_RESTfulApp_DELETE_user_byIdentifier()
    {
        $request = $this->_buildRequest('DELETE', '/mod/user/lcrouch');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('delete', $values['action']);
        $this->assertEquals('lcrouch', $values['id']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulApp_DELETE_user_byIdentifier_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('DELETE', '/mod/user/email%2Btest%40example.com');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('delete', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulApp_POST_user_with_identifier_doesPUT()
    {
        $request = $this->_buildRequest('POST', '/mod/user/lcrouch');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('put', $values['action']);
        $this->assertEquals('lcrouch', $values['id']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulApp_POST_user_with_identifier_urlencodedWithPlusSymbol_doesPUT()
    {
        $request = $this->_buildRequest('POST', '/mod/user/email%2Btest%40example.com');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('put', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulApp_overload_POST_with_method_param_PUT()
    {
        $request = $this->_buildRequest('POST', '/mod/user');
        $request->setParam('_method', 'PUT');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('put', $values['action']);
    }

    public function test_RESTfulApp_overload_POST_with_http_header_DELETE()
    {
        $request = $this->_buildRequest('POST', '/mod/user/lcrouch');
        $request->setHeader('X-HTTP-Method-Override', 'DELETE');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('delete', $values['action']);
        $this->assertEquals('lcrouch', $values['id']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulApp_overload_POST_with_http_header_DELETE_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('POST', '/mod/user/email%2Btest%40example.com');
        $request->setHeader('X-HTTP-Method-Override', 'DELETE');
        $values = $this->_invokeRouteMatch($request);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('delete', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulApp_route_chaining()
    {
        $request = $this->_buildRequest('GET', '/api/user/lcrouch');
        $this->_front->setRequest($request);

        $router = $this->_front->getRouter();
        $router->removeDefaultRoutes();

        $nonRESTRoute = new Zend_Controller_Router_Route('api');
        $RESTRoute = new Zend_Rest_Route($this->_front);
        $router->addRoute("api", $nonRESTRoute->chain($RESTRoute));

        $routedRequest = $router->route($request);

        $this->assertEquals("default", $routedRequest->getParam("module"));
        $this->assertEquals("user", $routedRequest->getParam("controller"));
        $this->assertEquals("get", $routedRequest->getParam("action"));
        $this->assertEquals("lcrouch", $routedRequest->getParam("id"));
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulApp_route_chaining_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('GET', '/api/user/email%2Btest%40example.com');
        $this->_front->setRequest($request);

        $router = $this->_front->getRouter();
        $router->removeDefaultRoutes();

        $nonRESTRoute = new Zend_Controller_Router_Route('api');
        $RESTRoute = new Zend_Rest_Route($this->_front);
        $router->addRoute("api", $nonRESTRoute->chain($RESTRoute));

        $routedRequest = $router->route($request);

        $this->assertEquals("default", $routedRequest->getParam("module"));
        $this->assertEquals("user", $routedRequest->getParam("controller"));
        $this->assertEquals("get", $routedRequest->getParam("action"));
        $this->assertEquals("email+test@example.com", $routedRequest->getParam("id"));
    }

    public function test_RESTfulModule_GET_user_index()
    {
        $request = $this->_buildRequest('GET', '/mod/user/index');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('index', $values['action']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulModule_GET_user_index_withParam_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('GET', '/mod/user/index/the%2Bemail%40address/email%2Btest%40example.com');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('index', $values['action']);
        $this->assertEquals('email+test@example.com', $values['the+email@address']);
    }

    public function test_RESTfulModule_GET_user()
    {
        $request = $this->_buildRequest('GET', '/mod/user/1234');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('get', $values['action']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulModule_GET_user_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('GET', '/mod/user/email%2Btest%40example.com');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('get', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulModule_POST_user()
    {
        $request = $this->_buildRequest('POST', '/mod/user');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('post', $values['action']);
    }

    public function test_RESTfulModule_POST_user_inNonRESTModule_returnsFalse()
    {
        $request = $this->_buildRequest('POST', '/default/user');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertFalse($values);
    }

    public function test_RESTfulModule_PUT_user_byIdentifier()
    {
        $request = $this->_buildRequest('PUT', '/mod/user/lcrouch');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('put', $values['action']);
        $this->assertEquals('lcrouch', $values['id']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulModule_PUT_user_byIdentifier_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('PUT', '/mod/user/email%2Btest%40example.com');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('put', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulModule_DELETE_user_byIdentifier()
    {
        $request = $this->_buildRequest('DELETE', '/mod/user/lcrouch');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('delete', $values['action']);
        $this->assertEquals('lcrouch', $values['id']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulModule_DELETE_user_byIdentifier_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('DELETE', '/mod/user/email%2Btest%40example.com');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('delete', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulController_GET_user_index()
    {
        $request = $this->_buildRequest('GET', '/mod/user/index');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('index', $values['action']);
    }

    public function test_RESTfulController_GET_default_controller_returns_false()
    {
        $request = $this->_buildRequest('GET', '/mod/index/index');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertFalse($values);
    }

    public function test_RESTfulController_GET_other_index_returns_false()
    {
        $request = $this->_buildRequest('GET', '/mod/project/index');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertFalse($values);
    }

    public function test_RESTfulController_GET_user()
    {
        $request = $this->_buildRequest('GET', '/mod/user/1234');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('get', $values['action']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulController_GET_user_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('GET', '/mod/user/email%2Btest%40example.com');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('get', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulController_POST_user()
    {
        $request = $this->_buildRequest('POST', '/mod/user');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('post', $values['action']);
    }

    public function test_RESTfulController_POST_user_inNonRESTModule_returnsFalse()
    {
        $request = $this->_buildRequest('POST', '/default/user');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertFalse($values);
    }

    public function test_postToNonRESTfulDefaultController_moduleHasAnotherRESTfulController_defaultControllerInURL_returnsFalse()
    {
        $request = $this->_buildRequest('POST', '/mod/index');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertFalse($values);
    }

    public function test_postToNonRESTfulDefaultController_moduleHasAnotherRESTfulController_noDefaultControllerInURL_returnsFalse()
    {
        $request = $this->_buildRequest('POST', '/mod');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertFalse($values);
    }

    public function test_RESTfulController_PUT_user_byIdentifier()
    {
        $request = $this->_buildRequest('PUT', '/mod/user/lcrouch');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('put', $values['action']);
        $this->assertEquals('lcrouch', $values['id']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulController_PUT_user_byIdentifier_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('PUT', '/mod/user/email%2Btest%40example.com');
        $config = ['mod'=>['user']];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('put', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_RESTfulController_DELETE_user_byIdentifier()
    {
        $request = $this->_buildRequest('DELETE', '/mod/user/lcrouch');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('delete', $values['action']);
        $this->assertEquals('lcrouch', $values['id']);
    }

    /**
     * @group ZF-10964
     */
    public function test_RESTfulController_DELETE_user_byIdentifier_urlencodedWithPlusSymbol()
    {
        $request = $this->_buildRequest('DELETE', '/mod/user/email%2Btest%40example.com');
        $config = ['mod'];
        $values = $this->_invokeRouteMatch($request, $config);

        $this->assertTrue(is_array($values));
        $this->assertTrue(isset($values['module']));
        $this->assertEquals('mod', $values['module']);
        $this->assertEquals('user', $values['controller']);
        $this->assertEquals('delete', $values['action']);
        $this->assertEquals('email+test@example.com', $values['id']);
    }

    public function test_assemble_plain_ignores_action()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['module'=>'mod', 'controller'=>'user', 'action'=>'get'];
        $url = $route->assemble($params);
        $this->assertEquals('mod/user', $url);
    }

    public function test_assemble_id_after_controller()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['module'=>'mod', 'controller'=>'user', 'id'=>'lcrouch'];
        $url = $route->assemble($params);
        $this->assertEquals('mod/user/lcrouch', $url);
    }

    public function test_assemble_index_after_controller_with_params()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['module'=>'mod', 'controller'=>'user', 'index'=>true, 'foo'=>'bar'];
        $url = $route->assemble($params);
        $this->assertEquals('mod/user/index/foo/bar', $url);
    }

    public function test_assemble_encode_param_values()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['module'=>'mod', 'controller'=>'user', 'index'=>true, 'foo'=>'bar is n!ice'];
        $url = $route->assemble($params);
        $this->assertEquals('mod/user/index/foo/bar+is+n%21ice', $url);
    }

    public function test_assemble_does_NOT_encode_param_values()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['module'=>'mod', 'controller'=>'user', 'index'=>true, 'foo'=>'bar is n!ice'];
        $url = $route->assemble($params, false, false);
        $this->assertEquals('mod/user/index/foo/bar is n!ice', $url);
    }

    /**
     * @group ZF-9823
     */
    public function test_assemble_edit_with_module_appends_action_after_id()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['module'=>'mod', 'controller'=>'users', 'action'=>'edit', 'id'=>1];
        $url = $route->assemble($params);
        $this->assertEquals('mod/users/1/edit', $url);
    }

    /**
     * @group ZF-9823
     */
    public function test_assemble_edit_without_module_appends_action_after_id()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['controller'=>'users', 'action'=>'edit', 'id'=>1];
        $url = $route->assemble($params);
        $this->assertEquals('users/1/edit', $url);
    }

    /**
     * @group ZF-9823
     */
    public function test_assemble_new_with_module_appends_action()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['module'=>'mod', 'controller'=>'users', 'action'=>'new'];
        $url = $route->assemble($params);
        $this->assertEquals('mod/users/new', $url);
    }

    /**
     * @group ZF-9823
     */
    public function test_assemble_new_without_module_appends_action()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['controller'=>'users', 'action'=>'new'];
        $url = $route->assemble($params);
        $this->assertEquals('users/new', $url);
    }

    /**
     * @group ZF-9823
     */
    public function test_assemble_random_action_with_module_removes_action()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['module'=>'mod', 'controller'=>'users', 'action'=>'newbar'];
        $url = $route->assemble($params);
        $this->assertNotEquals('mod/users/newbar', $url);
    }

    /**
     * @group ZF-9823
     */
    public function test_assemble_random_action_without_module_removes_action()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['controller'=>'users', 'action'=>'newbar'];
        $url = $route->assemble($params);
        $this->assertNotEquals('users/newbar', $url);
    }

    /**
     * @group ZF-9823
     */
    public function test_assemble_with_module_honors_index_parameter_with_resource_id_and_extra_parameters()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['module'=>'mod', 'controller'=>'users', 'id' => 1, 'extra'=>'parameter', 'another' => 'parameter', 'index' => true];
        $url = $route->assemble($params, false, false);
        $this->assertEquals('mod/users/index/1/extra/parameter/another/parameter', $url);
    }

    /**
     * @group ZF-9823
     */
    public function test_assemble_without_module_honors_index_parameter_with_resource_id_and_extra_parameters()
    {
        $route = new Zend_Rest_Route($this->_front, [], []);
        $params = ['controller'=>'users', 'id' => 1, 'extra'=>'parameter', 'another' => 'parameter', 'index' => true];
        $url = $route->assemble($params, false, false);
        $this->assertEquals('users/index/1/extra/parameter/another/parameter', $url);
    }
    /**
     * @group ZF-9115
     */
    public function test_request_get_user_params()
    {
        $uri = Zend_Uri::factory('http://localhost.com/user/index?a=1&b=2');
        $request = new Zend_Controller_Request_Http($uri);
        $request->setParam('test', 5);
        $config = ['mod'=>['user']];
        $this->_invokeRouteMatch($request, $config);
        $this->assertEquals(["test"=>5], $request->getUserParams());
        $this->assertEquals(["test"=>5,"a"=>1,"b"=>2], $request->getParams());
    }


    private function _buildRequest($method, $uri)
    {
        $request = new Zend_Controller_Request_HttpTestCase();
        $request->setMethod($method)->setRequestUri($uri);
        return $request;
    }

    private function _invokeRouteMatch($request, $config = [], $route = null)
    {
        $this->_front->setRequest($request);
        if ($route == null) {
        	$route = new Zend_Rest_Route($this->_front, [], $config);
        }
        $values = $route->match($request);
        return $values;
    }
}

// Call Zend_Rest_RouteTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Rest_RouteTest::main") {
    Zend_Rest_RouteTest::main();
}
