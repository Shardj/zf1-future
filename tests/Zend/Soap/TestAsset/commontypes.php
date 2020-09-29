<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Soap
 */

/* Test Functions */

/**
 * Test Function
 *
 * @param string $arg
 * @return string
 */
function Zend_Soap_TestAsset_TestFunc($who)
{
    return "Hello $who";
}

/**
 * Test Function 2
 */
function Zend_Soap_TestAsset_TestFunc2()
{
    return "Hello World";
}

/**
 * Return false
 *
 * @return bool
 */
function Zend_Soap_TestAsset_TestFunc3()
{
    return false;
}

/**
 * Return true
 *
 * @return bool
 */
function Zend_Soap_TestAsset_TestFunc4()
{
    return true;
}

/**
 * Return integer
 *
 * @return int
 */
function Zend_Soap_TestAsset_TestFunc5()
{
    return 123;
}

/**
 * Return string
 *
 * @return string
 */
function Zend_Soap_TestAsset_TestFunc6()
{
    return "string";
}

/**
 * Return array
 *
 * @return array
 */
function Zend_Soap_TestAsset_TestFunc7()
{
    return ['foo' => 'bar', 'baz' => true, 1 => false, 'bat' => 123];
}

/**
 * Return Object
 *
 * @return StdClass
 */
function Zend_Soap_TestAsset_TestFunc8()
{
    $return = (object) ['foo' => 'bar', 'baz' => true, 'bat' => 123, 'qux' => false];
    return $return;
}

/**
 * Multiple Args
 *
 * @param string $foo
 * @param string $bar
 * @return string
 */
function Zend_Soap_TestAsset_TestFunc9($foo, $bar)
{
    return "$foo $bar";
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_TestFixingMultiplePrototypes
{
    /**
     * Test function
     *
     * @param integer $a
     * @param integer $b
     * @param integer $d
     * @return integer
     */
    public function testFunc($a=100, $b=200, $d=300)
    {

    }
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_Test
{
    /**
     * Test Function 1
     *
     * @return string
     */
    public function testFunc1()
    {
        return "Hello World";
    }

    /**
     * Test Function 2
     *
     * @param string $who Some Arg
     * @return string
     */
    public function testFunc2($who)
    {
        return "Hello $who!";
    }

    /**
     * Test Function 3
     *
     * @param string $who Some Arg
     * @param int $when Some
     * @return string
     */
    public function testFunc3($who, $when)
    {
        return "Hello $who, How are you $when";
    }

    /**
     * Test Function 4
     *
     * @return string
     */
    public static function testFunc4()
    {
        return "I'm Static!";
    }
}

class Zend_Soap_TestAsset_AutoDiscoverTestClass1
{
    /**
     * @var integer $var
     */
    public $var = 1;

    /**
     * @var string $param
     */
    public $param = "hello";
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_AutoDiscoverTestClass2
{
    /**
     *
     * @param Zend_Soap_TestAsset_AutoDiscoverTestClass1 $test
     * @return boolean
     */
    public function add(AutoDiscoverTestClass1 $test)
    {
        return true;
    }

    /**
     * @return Zend_Soap_TestAsset_AutoDiscoverTestClass1[]
     */
    public function fetchAll()
    {
        return [
            new AutoDiscoverTestClass1(),
            new AutoDiscoverTestClass1(),
        ];
    }

    /**
     * @param Zend_Soap_TestAsset_AutoDiscoverTestClass1[]
     */
    public function addMultiple($test)
    {

    }
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_ComplexTypeB
{
    /**
     * @var string
     */
    public $bar;
    /**
     * @var string
     */
    public $foo;
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_ComplexTypeA
{
    /**
     * @var Zend_Soap_TestAsset_ComplexTypeB[]
     */
    public $baz = [];
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_ComplexTest
{
    /**
     * @var int
     */
    public $var = 5;
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_ComplexObjectStructure
{
    /**
     * @var boolean
     */
    public $boolean = true;

    /**
     * @var string
     */
    public $string = "Hello World";

    /**
     * @var int
     */
    public $int = 10;

    /**
     * @var array
     */
    public $array = [1, 2, 3];
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_ComplexObjectWithObjectStructure
{
    /**
     * @var Zend_Soap_TestAsset_ComplexTest
     */
    public $object;
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_MyService
{
    /**
     *    @param string $foo
     *    @return Zend_Soap_TestAsset_MyResponse[]
     */
    public function foo($foo)
    {
    }
    /**
     *    @param string $bar
     *    @return Zend_Soap_TestAsset_MyResponse[]
     */
    public function bar($bar)
    {
    }

    /**
     *    @param string $baz
     *    @return Zend_Soap_TestAsset_MyResponse[]
     */
    public function baz($baz)
    {
    }
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_MyServiceSequence
{
    /**
     *    @param string $foo
     *    @return string[]
     */
    public function foo($foo)
    {
    }
    /**
     *    @param string $bar
     *    @return string[]
     */
    public function bar($bar)
    {
    }

    /**
     *    @param string $baz
     *    @return string[]
     */
    public function baz($baz)
    {
    }

    /**
     *    @param string $baz
     *    @return string[][][]
     */
    public function bazNested($baz)
    {
    }
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_MyResponse
{
    /**
     * @var string
     */
    public $p1;
}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_Recursion
{
    /**
     * @var Zend_Soap_TestAsset_Recursion
     */
    public $recursion;

    /**
     * @return Zend_Soap_TestAsset_Recursion
     */
    public function create() {}
}

/**
 * @param string $message
 */
function Zend_Soap_TestAsset_OneWay($message)
{

}

/**
 * @category   Zend
 * @package    Zend_Soap
 * @subpackage UnitTests
 */
class Zend_Soap_TestAsset_NoReturnType
{
    /**
     *
     * @param string $message
     */
    public function pushOneWay($message)
    {

    }
}

/* Client test classes */
/** Test Class */
class Zend_Soap_TestAsset_TestClass
{
    /**
     * Test Function 1
     *
     * @return string
     */
    public function testFunc1()
    {
        return "Hello World";
    }

    /**
     * Test Function 2
     *
     * @param string $who Some Arg
     * @return string
     */
    public function testFunc2($who)
    {
        return "Hello $who!";
    }

    /**
     * Test Function 3
     *
     * @param string $who Some Arg
     * @param int $when Some
     * @return string
     */
    public function testFunc3($who, $when)
    {
        return "Hello $who, How are you $when";
    }

    /**
     * Test Function 4
     *
     * @return string
     */
    public static function testFunc4()
    {
        return "I'm Static!";
    }
}

/** Test class 2 */
class Zend_Soap_TestAsset_TestData1
{
    /**
     * Property1
     *
     * @var string
     */
     public $property1;

    /**
     * Property2
     *
     * @var float
     */
     public $property2;
}

/** Test class 2 */
class Zend_Soap_TestAsset_TestData2
{
    /**
     * Property1
     *
     * @var integer
     */
     public $property1;

    /**
     * Property1
     *
     * @var float
     */
     public $property2;
}

class Zend_Soap_TestAsset_MockSoapServer
{
    public $handle = null;
    public function handle()
    {
        $this->handle = func_get_args();
    }
    public function __call($name, $args) {}
}

class Zend_Soap_TestAsset_MockServer extends Zend_Soap_Server
{
    public $mockSoapServer = null;
    protected function _getSoap()
    {
        $this->mockSoapServer = new MockSoapServer();
        return $this->mockSoapServer;
    }
}


/** Server test classes */
class Zend_Soap_TestAsset_ServerTestClass
{
    /**
     * Test Function 1
     *
     * @return string
     */
    public function testFunc1()
    {
        return "Hello World";
    }

    /**
     * Test Function 2
     *
     * @param string $who Some Arg
     * @return string
     */
    public function testFunc2($who)
    {
        return "Hello $who!";
    }

    /**
     * Test Function 3
     *
     * @param string $who Some Arg
     * @param int $when Some
     * @return string
     */
    public function testFunc3($who, $when)
    {
        return "Hello $who, How are you $when";
    }

    /**
     * Test Function 4
     *
     * @return string
     */
    public static function testFunc4()
    {
        return "I'm Static!";
    }

    /**
     * Test Function 5 raises a user error
     *
     * @return void
     */
    public function testFunc5()
    {
        trigger_error("Test Message", E_USER_ERROR);
    }
}

if (extension_loaded('soap')) {

/** Local SOAP client */
class Zend_Soap_TestAsset_TestLocalSoapClient extends SoapClient
{
    /**
     * Server object
     *
     * @var Zend_Soap_Server
     */
    public $server;

    /**
     * Local client constructor
     *
     * @param Zend_Soap_Server $server
     * @param string $wsdl
     * @param array $options
     */
    public function __construct(Zend_Soap_Server $server, $wsdl, $options)
    {
        $this->server = $server;
        parent::__construct($wsdl, $options);
    }

    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        ob_start();
        $this->server->handle($request);
        $response = ob_get_clean();

        return $response;
    }
}

}
