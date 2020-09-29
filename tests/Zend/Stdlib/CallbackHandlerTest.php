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
 * @package    Zend_Stdlib
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id:$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Stdlib_CallbackHandlerTest::main');
}

require_once 'Zend/Stdlib/CallbackHandler.php';
require_once 'Zend/Stdlib/TestAsset/SignalHandlers/InstanceMethod.php';
require_once 'Zend/Stdlib/TestAsset/SignalHandlers/ObjectCallback.php';

/**
 * @todo       Remove all closures from tests and refactor as methods or functions
 * @category   Zend
 * @package    Zend_Stdlib
 * @subpackage UnitTests
 * @group      Zend_Stdlib
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Stdlib_CallbackHandlerTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        if (isset($this->args)) {
            unset($this->args);
        }
        $this->error = false;
    }

    public function testCallbackShouldStoreMetadata()
    {
        $handler = new Zend_Stdlib_CallbackHandler('rand', ['event' => 'foo']);
        $this->assertEquals('foo', $handler->getMetadatum('event'));
        $this->assertEquals(['event' => 'foo'], $handler->getMetadata());
    }

    public function testCallbackShouldBeStringIfNoHandlerPassedToConstructor()
    {
        $handler = new Zend_Stdlib_CallbackHandler('rand');
        $this->assertSame('rand', $handler->getCallback());
    }

    public function testCallbackShouldBeArrayIfHandlerPassedToConstructor()
    {
        $handler = new Zend_Stdlib_CallbackHandler(['Zend_Stdlib_TestAsset_SignalHandlers_ObjectCallback', 'test']);
        $this->assertSame(['Zend_Stdlib_TestAsset_SignalHandlers_ObjectCallback', 'test'], $handler->getCallback());
    }

    public function testCallShouldInvokeCallbackWithSuppliedArguments()
    {
        $handler = new Zend_Stdlib_CallbackHandler([ $this, 'handleCall' ]);
        $args   = ['foo', 'bar', 'baz'];
        $handler->call($args);
        $this->assertSame($args, $this->args);
    }

    public function testPassingInvalidCallbackShouldRaiseInvalidCallbackExceptionDuringInstantiation()
    {
        $this->setExpectedException('Zend_Stdlib_Exception_InvalidCallbackException');
        $handler = new Zend_Stdlib_CallbackHandler('boguscallback');
    }

    public function testCallShouldReturnTheReturnValueOfTheCallback()
    {
        $handler = new Zend_Stdlib_CallbackHandler(['Zend_Stdlib_TestAsset_SignalHandlers_ObjectCallback', 'test']);
        if (!is_callable(['Zend_Stdlib_TestAsset_SignalHandlers_ObjectCallback', 'test'])) {
            echo "\nClass exists? " . var_export(class_exists('Zend_Stdlib_TestAsset_SignalHandlers_ObjectCallback'), 1) . "\n";
            echo "Include path: " . get_include_path() . "\n";
        }
        $this->assertEquals('bar', $handler->call([]));
    }

    public function testStringCallbackResolvingToClassDefiningInvokeNameShouldRaiseException()
    {
        $this->setExpectedException('Zend_Stdlib_Exception_InvalidCallbackException');
        $handler = new Zend_Stdlib_CallbackHandler('Zend_Stdlib_TestAsset_SignalHandlers_Invokable');
    }

    public function testStringCallbackReferringToClassWithoutDefinedInvokeShouldRaiseException()
    {
        $this->setExpectedException('Zend_Stdlib_Exception_InvalidCallbackException');
        $class   = new Zend_Stdlib_TestAsset_SignalHandlers_InstanceMethod();
        $handler = new Zend_Stdlib_CallbackHandler($class);
    }

    public function errorHandler($errno, $errstr)
    {
        $this->error = true;
    }

    public function testCallbackConsistingOfStringContextWithNonStaticMethodShouldRaiseException()
    {
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            $this->markTestSkipped('Behavior of is_callable changes between 5.2 and 5.3');
        }
        $this->setExpectedException('Zend_Stdlib_Exception_InvalidCallbackException');
        $handler     = new Zend_Stdlib_CallbackHandler(['Zend_Stdlib_TestAsset_SignalHandlers_InstanceMethod', 'handler']);
    }

    public function testStringCallbackConsistingOfNonStaticMethodShouldRaiseException()
    {
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            $this->markTestSkipped('Behavior of is_callable changes between 5.2 and 5.3');
        }
        $this->setExpectedException('Zend_Stdlib_Exception_InvalidCallbackException');
        $handler = new Zend_Stdlib_CallbackHandler('Zend_Stdlib_TestAsset_SignalHandlers_InstanceMethod::handler');
    }

    public function testCallbackToClassImplementingOverloadingButNotInvocableShouldRaiseException()
    {
        $this->setExpectedException('Zend_Stdlib_Exception_InvalidCallbackException');
        $handler = new Zend_Stdlib_CallbackHandler('foo', [ 'Zend_Stdlib_TestAsset_SignalHandlers_Overloadable', 'foo' ]);
    }

    public function handleCall()
    {
        $this->args = func_get_args();
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Stdlib_CallbackHandlerTest::main') {
    Zend_Stdlib_CallbackHandlerTest::main();
}
