<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

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
 * @package    Zend_Session
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once 'Zend/Session/SaveHandler/Interface.php';
require_once 'Zend/Session/SaveHandler/SessionHandlerInterfaceAdapter.php';

/**
 * @category   Zend
 * @package    Zend_Session
 * @subpackage UnitTests
 * @group      Zend_Session
 * @group      Zend_Session_SaveHandler
 */
class Zend_Session_SaveHandler_SessionHandlerInterfaceAdapterTest extends TestCase
{
    /**
     * @var Zend_Session_SaveHandler_Interface&\PHPUnit\Framework\MockObject\MockObject
     */
    private $mockHandler;

    /**
     * @var Zend_Session_SaveHandler_SessionHandlerInterfaceAdapter
     */
    private Zend_Session_SaveHandler_SessionHandlerInterfaceAdapter $adapter;

    protected function set_up(): void
    {
        $this->mockHandler = $this->createMock(Zend_Session_SaveHandler_Interface::class);
        $this->adapter = new Zend_Session_SaveHandler_SessionHandlerInterfaceAdapter($this->mockHandler);
    }

    /**
     * Ensure the adapter implements PHP's native SessionHandlerInterface,
     * which is required for the single-object form of session_set_save_handler().
     */
    public function testAdapterImplementsSessionHandlerInterface(): void
    {
        $this->assertInstanceOf(SessionHandlerInterface::class, $this->adapter);
    }

    /**
     * Ensure the adapter wraps a Zend_Session_SaveHandler_Interface correctly.
     */
    public function testAdapterAcceptsZendSaveHandlerInterface(): void
    {
        $this->assertInstanceOf(
            Zend_Session_SaveHandler_SessionHandlerInterfaceAdapter::class,
            $this->adapter
        );
    }

    /**
     * open() should delegate to the inner handler and return bool.
     */
    public function testOpenDelegatesToInnerHandler(): void
    {
        $this->mockHandler
            ->expects($this->once())
            ->method('open')
            ->with('/tmp', 'PHPSESSID')
            ->willReturn(true);

        $result = $this->adapter->open('/tmp', 'PHPSESSID');

        $this->assertTrue($result);
        $this->assertIsBool($result);
    }

    /**
     * open() should cast a truthy non-bool return from inner handler to true.
     */
    public function testOpenCastsReturnToBool(): void
    {
        $this->mockHandler
            ->method('open')
            ->willReturn(1); // non-bool truthy

        $result = $this->adapter->open('/tmp', 'PHPSESSID');

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    /**
     * close() should delegate to the inner handler and return bool.
     */
    public function testCloseDelegatesToInnerHandler(): void
    {
        $this->mockHandler
            ->expects($this->once())
            ->method('close')
            ->willReturn(true);

        $result = $this->adapter->close();

        $this->assertTrue($result);
        $this->assertIsBool($result);
    }

    /**
     * read() should delegate to the inner handler and return the session data string.
     */
    public function testReadDelegatesToInnerHandler(): void
    {
        $this->mockHandler
            ->expects($this->once())
            ->method('read')
            ->with('abc123')
            ->willReturn('serialized|data');

        $result = $this->adapter->read('abc123');

        $this->assertSame('serialized|data', $result);
    }

    /**
     * read() should return an empty string (not false) when the inner handler
     * returns an empty string — empty string is valid session data.
     */
    public function testReadReturnsEmptyStringWhenHandlerReturnsEmptyString(): void
    {
        $this->mockHandler
            ->method('read')
            ->willReturn('');

        $result = $this->adapter->read('abc123');

        $this->assertSame('', $result);
        $this->assertNotFalse($result);
    }

    /**
     * read() should return false when the inner handler returns null,
     * satisfying SessionHandlerInterface's string|false return type.
     */
    public function testReadReturnsFalseWhenHandlerReturnsNull(): void
    {
        $this->mockHandler
            ->method('read')
            ->willReturn(null);

        $result = $this->adapter->read('abc123');

        $this->assertFalse($result);
    }

    /**
     * write() should delegate to the inner handler and return bool.
     */
    public function testWriteDelegatesToInnerHandler(): void
    {
        $this->mockHandler
            ->expects($this->once())
            ->method('write')
            ->with('abc123', 'serialized|data')
            ->willReturn(true);

        $result = $this->adapter->write('abc123', 'serialized|data');

        $this->assertTrue($result);
        $this->assertIsBool($result);
    }

    /**
     * destroy() should delegate to the inner handler and return bool.
     */
    public function testDestroyDelegatesToInnerHandler(): void
    {
        $this->mockHandler
            ->expects($this->once())
            ->method('destroy')
            ->with('abc123')
            ->willReturn(true);

        $result = $this->adapter->destroy('abc123');

        $this->assertTrue($result);
        $this->assertIsBool($result);
    }

    /**
     * gc() should delegate to the inner handler and return int when
     * the inner handler returns a truthy value (ZF1 handlers return bool true).
     */
    public function testGcDelegatesToInnerHandlerAndReturnsInt(): void
    {
        $this->mockHandler
            ->expects($this->once())
            ->method('gc')
            ->with(1440)
            ->willReturn(true); // ZF1 handlers return bool true

        $result = $this->adapter->gc(1440);

        $this->assertIsInt($result);
        $this->assertSame(1, $result);
    }

    /**
     * gc() should return false when the inner handler returns false,
     * satisfying SessionHandlerInterface's int|false return type.
     */
    public function testGcReturnsFalseWhenHandlerReturnsFalse(): void
    {
        $this->mockHandler
            ->method('gc')
            ->willReturn(false);

        $result = $this->adapter->gc(1440);

        $this->assertFalse($result);
    }

    /**
     * gc() should cast an integer rows-deleted count correctly.
     */
    public function testGcCastsIntegerReturnFromHandler(): void
    {
        $this->mockHandler
            ->method('gc')
            ->willReturn(42); // a handler that returns actual row count

        $result = $this->adapter->gc(1440);

        $this->assertIsInt($result);
        $this->assertSame(42, $result);
    }
}