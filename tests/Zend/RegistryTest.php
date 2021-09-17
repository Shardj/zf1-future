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
 * @package    Zend_Registry
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Registry
 */
require_once 'Zend/Registry.php';

/**
 * @category   Zend
 * @package    Zend_Registry
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Registry
 */
class Zend_RegistryTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        Zend_Registry::_unsetInstance();
    }

    public function tearDown()
    {
        Zend_Registry::_unsetInstance();
    }

    public function testRegistryUninitIsRegistered()
    {
        // checking entry is set returns false,
        // but does not initialize instance
        $this->assertFalse(Zend_Registry::isRegistered('objectname'));
    }

    public function testRegistryUninitGetInstance()
    {
        // getting instance initializes instance
        $registry = Zend_Registry::getInstance();
        $this->assertTrue($registry instanceof Zend_Registry);
    }

    public function testRegistryUninitSet()
    {
        // setting value initializes instance
        Zend_Registry::set('foo', 'bar');
        $registry = Zend_Registry::getInstance();
        $this->assertTrue($registry instanceof Zend_Registry);
    }

    public function testRegistryUninitGet()
    {
        // getting value initializes instance
        // but throws different exception because
        // entry is not registered
        try {
            Zend_Registry::get('foo');
            $this->fail('Expected exception when trying to fetch a non-existent key.');
        } catch (Zend_Exception $e) {
            $this->assertContains('No entry is registered for key', $e->getMessage());
        }
        $registry = Zend_Registry::getInstance();
        $this->assertTrue($registry instanceof Zend_Registry);
    }

    public function testRegistrySingletonSameness()
    {
        $registry1 = Zend_Registry::getInstance();
        $registry2 = Zend_Registry::getInstance();
        $this->assertTrue($registry1 instanceof Zend_Registry);
        $this->assertTrue($registry2 instanceof Zend_Registry);
        $this->assertEquals($registry1, $registry2);
        $this->assertSame($registry1, $registry2);
    }

    public function testRegistryEqualContents()
    {
        Zend_Registry::set('foo', 'bar');
        $registry1 = Zend_Registry::getInstance();
        $registry2 = new Zend_Registry(['foo' => 'bar']);
        $this->assertEquals($registry1, $registry2);
        $this->assertNotSame($registry1, $registry2);
    }

    public function testRegistryUnequalContents()
    {
        $registry1 = Zend_Registry::getInstance();
        $registry2 = new Zend_Registry(['foo' => 'bar']);
        $this->assertNotEquals($registry1, $registry2);
        $this->assertNotSame($registry1, $registry2);
    }

    public function testRegistrySetAndIsRegistered()
    {
        $this->assertFalse(Zend_Registry::isRegistered('foo'));
        Zend_Registry::set('foo', 'bar');
        $this->assertTrue(Zend_Registry::isRegistered('foo'));
    }

    public function testRegistryGet()
    {
        Zend_Registry::set('foo', 'bar');
        $bar = Zend_Registry::get('foo');
        $this->assertEquals('bar', $bar);
    }

    public function testRegistryArrayObject()
    {
        $this->assertTrue(Zend_Registry::getInstance() instanceof ArrayObject);
    }

    public function testRegistryArrayAsProps()
    {
        $registry = new Zend_Registry([], ArrayObject::ARRAY_AS_PROPS);
        $registry->foo = 'bar';
        $this->assertTrue(isset($registry->foo));
        $this->assertEquals('bar', $registry->foo);
    }

    public function testRegistryExceptionInvalidClassname()
    {
        try {
            $registry = Zend_Registry::setClassName(new StdClass());
            $this->fail('Expected exception, because setClassName() wants a string');
        } catch (Zend_Exception $e) {
            $this->assertContains('Argument is not a class name', $e->getMessage());
        }
    }

    /**
     * NB: We cannot make a unit test for the class not Zend_Registry or
     * a subclass, because that is enforced by type-hinting in the
     * Zend_Registry::setInstance() method. Type-hinting violations throw
     * an error, not an exception, so it cannot be caught in a unit test.
     */

    public function testRegistryExceptionNoEntry()
    {
        try {
            $foo = Zend_Registry::get('foo');
            $this->fail('Expected exception when trying to fetch a non-existent key.');
        } catch (Zend_Exception $e) {
            $this->assertContains('No entry is registered for key', $e->getMessage());
        }
    }

    public function testRegistryExceptionAlreadyInitialized()
    {
        $registry = Zend_Registry::getInstance();

        try {
            Zend_Registry::setClassName('anyclass');
            $this->fail('Expected exception, because we cannot initialize the registry if it is already initialized.');
        } catch (Zend_Exception $e) {
            $this->assertContains('Registry is already initialized', $e->getMessage());
        }
        try {
            Zend_Registry::setInstance(new Zend_Registry());
            $this->fail('Expected exception, because we cannot initialize the registry if it is already initialized.');
        } catch (Zend_Exception $e) {
            $this->assertContains('Registry is already initialized', $e->getMessage());
        }
    }

    public function testRegistryExceptionClassNotFound()
    {
        try {
            $registry = @Zend_Registry::setClassName('classdoesnotexist');
            $this->fail('Expected exception, because we cannot initialize the registry using a non-existent class.');
        } catch (Zend_Exception $e) {
            $this->assertRegExp('/file .* does not exist or .*/i', $e->getMessage());
        }
    }

    public function testDefaultRegistryArrayAsPropsZF4654()
    {
        $registry = Zend_Registry::getInstance();
        $registry->bar = "baz";
        $this->assertEquals('baz', Zend_Registry::get('bar'));
    }
}
