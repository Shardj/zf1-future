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

require_once 'Zend/Session.php';
require_once 'Zend/Session/SaveHandler/Interface.php';
require_once 'Zend/Session/SaveHandler/SessionHandlerInterfaceAdapter.php';

/**
 * @category   Zend
 * @package    Zend_Session
 * @subpackage UnitTests
 * @group      Zend_Session
 */
class Zend_SessionTest extends TestCase
{
    protected function set_up(): void
    {
        Zend_Session::$_unitTestEnabled = true;
    }

    protected function tear_down(): void
    {
        Zend_Session::$_unitTestEnabled = false;
    }

    /**
     * setSaveHandler() should accept a Zend_Session_SaveHandler_Interface
     * and store it without throwing an exception.
     */
    public function testSetSaveHandlerStoresHandler(): void
    {
        $handler = $this->createMock(Zend_Session_SaveHandler_Interface::class);

        Zend_Session::setSaveHandler($handler);

        $this->assertSame($handler, Zend_Session::getSaveHandler());
    }

    /**
     * setSaveHandler() should not trigger an E_DEPRECATED notice from
     * session_set_save_handler() on PHP 8.4+. The adapter must pass a
     * SessionHandlerInterface object instead of individual callbacks.
     *
     * @runInSeparateProcess
     */
    public function testSetSaveHandlerDoesNotTriggerDeprecationNotice(): void
    {
        Zend_Session::$_unitTestEnabled = false;

        $deprecationTriggered = false;

        set_error_handler(
            function (int $errno, string $errstr) use (&$deprecationTriggered): bool {
                if ($errno === E_DEPRECATED && strpos($errstr, 'session_set_save_handler') !== false) {
                    $deprecationTriggered = true;
                }
                return true;
            },
            E_DEPRECATED
        );

        $handler = $this->createMock(Zend_Session_SaveHandler_Interface::class);
        $handler->method('open')->willReturn(true);
        $handler->method('close')->willReturn(true);
        $handler->method('read')->willReturn('');
        $handler->method('write')->willReturn(true);
        $handler->method('destroy')->willReturn(true);
        $handler->method('gc')->willReturn(true);

        Zend_Session::setSaveHandler($handler);

        restore_error_handler();

        $this->assertFalse(
            $deprecationTriggered,
            'session_set_save_handler() triggered an E_DEPRECATED notice. '
            . 'The SessionHandlerInterfaceAdapter should prevent this by passing '
            . 'a SessionHandlerInterface object instead of individual callbacks.'
        );
    }
}