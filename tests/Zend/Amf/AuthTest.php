<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;
use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\TestRunner;

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
 * @package    Zend_Amf
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Amf_AuthTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Amf_AuthTest::main");
}

require_once 'Zend/Amf/Server.php';
require_once 'Zend/Amf/Request.php';
require_once 'Zend/Amf/Parse/TypeLoader.php';
require_once 'Zend/Amf/Auth/Abstract.php';
require_once 'Zend/Amf/Value/Messaging/RemotingMessage.php';
require_once 'Zend/Session.php';
require_once 'Zend/Auth/Result.php';
require_once 'Zend/Acl.php';
require_once 'Zend/Acl/Role.php';

/**
 * @category   Zend
 * @package    Zend_Amf
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Amf
 */
class Zend_Amf_AuthTest extends TestCase
{
    /**
     * @var \Zend_Acl|mixed
     */
    protected $_acl;

    /**
     * Enter description here...
     *
     * @var Zend_Amf_Server
     */
    protected $_server;

    public static function main()
    {
        $suite = new TestSuite("Zend_Amf_AuthTest");
        (new resources_Runner())->run($suite);
    }

    protected function set_up()
    {
        $this->_server = new Zend_Amf_Server();
        $this->_server->setProduction(false);
        Zend_Amf_Parse_TypeLoader::resetMap();
        $this->_acl = new Zend_Acl();
    }

    protected function tear_down()
    {
        unset($this->_server);
    }
    protected function _addServiceCall($request, $class = 'Zend_Amf_Auth_testclass', $method = 'hello')
    {
        $data[] = "12345";
        $this->_server->setClass($class);
        $newBody = new Zend_Amf_Value_MessageBody("$class.$method", "/1", $data);
        $request->addAmfBody($newBody);
    }

    protected function _addLogin($request, $username, $password)
    {
        $cmdBody = new Zend_Amf_Value_MessageBody("", "/1", "");
        $loginCmd = new Zend_Amf_Value_Messaging_CommandMessage();
        $cmdBody->setData($loginCmd);
        $loginCmd->operation = Zend_Amf_Value_Messaging_CommandMessage::LOGIN_OPERATION;
        $loginCmd->body = "$username:$password";
        $request->addAmfBody($cmdBody);
    }

    protected function _addLogout($request)
    {
        $cmdBody = new Zend_Amf_Value_MessageBody("", "/1", "");
        $loginCmd = new Zend_Amf_Value_Messaging_CommandMessage();
        $cmdBody->setData($loginCmd);
        $loginCmd->operation = Zend_Amf_Value_Messaging_CommandMessage::LOGOUT_OPERATION;
        $request->addAmfBody($cmdBody);
    }

    protected function _callService($class = 'Zend_Amf_Auth_testclass', $method = 'hello')
    {
        $request = new Zend_Amf_Request();
        $request->setObjectEncoding(0x03);
        $this->_addServiceCall($request, $class, $method);
        $this->_server->handle($request);
        $response = $this->_server->getResponse();
        $responseBody = $response->getAmfBodies();
        return $responseBody[0]->getData();
    }

    protected function _callServiceAuth($username, $password, $class = 'Zend_Amf_Auth_testclass', $method = 'hello')
    {
        $request = new Zend_Amf_Request();
        $request->setObjectEncoding(0x03);
        $this->_addLogin($request, $username, $password);
        $this->_addServiceCall($request, $class, $method);
        $this->_server->handle($request);
        return $this->_server->getResponse()->getAmfBodies();
    }

    public function testService()
    {
        $resp = $this->_callService();
        $this->assertStringContainsString("hello", $resp);
    }


    public function testUnauthenticated()
    {
        Zend_Session::$_unitTestEnabled = true;
        $this->_server->setAuth(new WrongPassword());
        $this->_server->setAcl($this->_acl);
        $data = $this->_callService();
        $this->assertTrue($data instanceof Zend_Amf_Value_Messaging_ErrorMessage);
        $this->assertStringContainsString("not allowed", $data->faultString);
    }

    public function testAnonymousDenied()
    {
        Zend_Session::$_unitTestEnabled = true;
        $this->_server->setAuth(new WrongPassword());
        $this->_acl->addRole(new Zend_Acl_Role(Zend_Amf_Constants::GUEST_ROLE));
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callService();
        $this->assertTrue($resp instanceof Zend_Amf_Value_Messaging_ErrorMessage);
        $this->assertStringContainsString("not allowed", $resp->faultString);
    }

    public function testAnonymousOK()
    {
        Zend_Session::$_unitTestEnabled = true;
        $this->_server->setAuth(new WrongPassword());
        $this->_acl->addRole(new Zend_Acl_Role(Zend_Amf_Constants::GUEST_ROLE));
        $this->_acl->allow(Zend_Amf_Constants::GUEST_ROLE, null, null);
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callService();
        $this->assertStringContainsString("hello", $resp);
    }

    public function testNoUsername()
    {
        $this->_server->setAuth(new WrongPassword());
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callServiceAuth("", "");
        $data = $resp[0]->getData();
        $this->assertTrue($data instanceof Zend_Amf_Value_Messaging_ErrorMessage);
        $this->assertStringContainsString("username not supplied", $data->faultString);
    }

    public function testWrongPassword()
    {
        $this->_server->setAuth(new WrongPassword());
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callServiceAuth("testuser", "");
        $data = $resp[0]->getData();
        $this->assertTrue($data instanceof Zend_Amf_Value_Messaging_ErrorMessage);
        $this->assertStringContainsString("Wrong Password", $data->faultString);
    }

    public function testRightPassword()
    {
        Zend_Session::$_unitTestEnabled = true;
        $this->_server->setAuth(new RightPassword("testuser", "testrole"));
        $this->_acl->addRole(new Zend_Acl_Role("testrole"));
        $this->_acl->allow("testrole", null, null);
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callServiceAuth("testuser", "");
        $this->assertTrue($resp[0]->getData() instanceof Zend_Amf_Value_Messaging_AcknowledgeMessage);
        $this->assertStringContainsString("hello", $resp[1]->getData());
    }

    // no ACL to allow access to this method
    public function testNoAcl()
    {
        $this->_server->setAuth(new RightPassword("testuser", "testrole"));
        $this->_acl->addRole(new Zend_Acl_Role("testrole"));
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callServiceAuth("testuser", "");
        $this->assertTrue($resp[0]->getData() instanceof Zend_Amf_Value_Messaging_AcknowledgeMessage);
        $data = $resp[1]->getData();
        $this->assertTrue($data instanceof Zend_Amf_Value_Messaging_ErrorMessage);
        $this->assertStringContainsString("not allowed", $data->faultString);
    }

    // Class allows everybody to access, even though no ACL is defined
    public function testNoClassAcl()
    {
        $this->_server->setAuth(new RightPassword("testuser", "testrole"));
        $this->_acl->addRole(new Zend_Acl_Role("testrole"));
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callServiceAuth("testuser", "", 'Zend_Amf_Auth_testclass_NoAcl');
        $this->assertTrue($resp[0]->getData() instanceof Zend_Amf_Value_Messaging_AcknowledgeMessage);
        $this->assertStringContainsString("hello", $resp[1]->getData());
    }

    // Class-defined ACL
    public function testClassAclAllowed()
    {
        Zend_Session::$_unitTestEnabled = true;
        $this->_server->setAuth(new RightPassword("testuser", "testrole"));
        $this->_acl->addRole(new Zend_Acl_Role("testrole"));
        $this->_acl->addRole(new Zend_Acl_Role("testrole2"));
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callServiceAuth("testuser", "", 'Zend_Amf_Auth_testclass_Acl');
        $this->assertTrue($resp[0]->getData() instanceof Zend_Amf_Value_Messaging_AcknowledgeMessage);
        $this->assertStringContainsString("hello", $resp[1]->getData());
    }

    // Class-defined ACL
    public function testClassAclDenied()
    {
        $this->_server->setAuth(new RightPassword("testuser", "testrole2"));
        $this->_acl->addRole(new Zend_Acl_Role("testrole"));
        $this->_acl->addRole(new Zend_Acl_Role("testrole2"));
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callServiceAuth("testuser", "", 'Zend_Amf_Auth_testclass_Acl');
        $this->assertTrue($resp[0]->getData() instanceof Zend_Amf_Value_Messaging_AcknowledgeMessage);
        $data = $resp[1]->getData();
        $this->assertTrue($data instanceof Zend_Amf_Value_Messaging_ErrorMessage);
        $this->assertStringContainsString("not allowed", $data->faultString);
    }

    // Class-defined ACL
    public function testClassAclAllowed2()
    {
        Zend_Session::$_unitTestEnabled = true;
        $this->_server->setAuth(new RightPassword("testuser", "testrole2"));
        $this->_acl->addRole(new Zend_Acl_Role("testrole"));
        $this->_acl->addRole(new Zend_Acl_Role("testrole2"));
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callServiceAuth("testuser", "", 'Zend_Amf_Auth_testclass_Acl', 'hello2');
        $this->assertTrue($resp[0]->getData() instanceof Zend_Amf_Value_Messaging_AcknowledgeMessage);
        $this->assertStringContainsString("hello", $resp[1]->getData());
    }

    public function testLogout()
    {
        Zend_Session::$_unitTestEnabled = true;
        $this->_server->setAuth(new RightPassword("testuser", "testrole"));
        $this->_acl->addRole(new Zend_Acl_Role("testrole"));
        $this->_acl->allow("testrole", null, null);
        $this->_server->setAcl($this->_acl);
        $resp = $this->_callServiceAuth("testuser", "");
        $this->assertTrue($resp[0]->getData() instanceof Zend_Amf_Value_Messaging_AcknowledgeMessage);
        $this->assertStringContainsString("hello", $resp[1]->getData());

        // After logout same request should not be allowed
        $this->set_up();
        $this->_server->setAuth(new RightPassword("testuser", "testrole"));
        $this->_server->setAcl($this->_acl);
        $request = new Zend_Amf_Request();
        $request->setObjectEncoding(0x03);
        $this->_addLogout($request);
        $this->_addServiceCall($request);
        $this->_server->handle($request);
        $resp = $this->_server->getResponse()->getAmfBodies();

        $this->assertTrue($resp[0]->getData() instanceof Zend_Amf_Value_Messaging_AcknowledgeMessage);
        $data = $resp[1]->getData();
        $this->assertTrue($data instanceof Zend_Amf_Value_Messaging_ErrorMessage);
        $this->assertStringContainsString("not allowed", $data->faultString);
    }
}

class WrongPassword extends Zend_Amf_Auth_Abstract
{
    public function authenticate()
    {
        return new Zend_Auth_Result(
            Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
            null,
            ['Wrong Password']
        );
    }
}

class RightPassword extends Zend_Amf_Auth_Abstract
{
    /**
     * @var mixed
     */
    protected $_name;
    /**
     * @var mixed
     */
    protected $_role;
    public function __construct($name, $role)
    {
        $this->_name = $name;
        $this->_role = $role;
    }
    public function authenticate()
    {
        $id = new stdClass();
        $id->role = $this->_role;
        $id->name = $this->_name;
        return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $id);
    }
}

class Zend_Amf_Auth_testclass
{
    public function hello()
    {
        return "hello!";
    }
}

class Zend_Amf_Auth_testclass_Acl
{
    public function hello()
    {
        return "hello!";
    }

    public function hello2()
    {
        return "hello2!";
    }

    public function initAcl(Zend_Acl $acl)
    {
        $acl->allow("testrole", null, "hello");
        $acl->allow("testrole2", null, "hello2");
        return true;
    }
}

class Zend_Amf_Auth_testclass_NoAcl
{
    public function hello()
    {
        return "hello!";
    }

    public function initAcl()
    {
        return false;
    }
}

if (PHPUnit_MAIN_METHOD === "Zend_Amf_AuthTest::main") {
    Zend_Amf_AuthTest::main();
}
