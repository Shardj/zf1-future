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
 * @version    $Id$
 */

/**
 * @see Zend_Session
 */
require_once 'Zend/Session.php';

/**
 * Tests for the php.ini based options accepted by Zend_Session::setOptions().
 *
 * Every test runs in its own process: Zend_Session keeps static state and
 * PHP refuses to change session ini settings once a session is active or
 * output has been sent, so these tests must not share a process with any
 * test that starts a session.
 *
 * @category   Zend
 * @package    Zend_Session
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Session
 */
class Zend_Session_OptionsTest extends TestCase
{
    /**
     * Zend_Session must not run in "unit test" mode here, otherwise
     * setOptions() skips the ini_set() calls we want to verify.
     */
    public function set_up()
    {
        Zend_Session::$_unitTestEnabled = false;
    }

    /**
     * session.use_strict_mode used to be rejected with
     * "Unknown option: use_strict_mode"; it must now be applied to the PHP ini setting.
     *
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @return void
     */
    public function testSetOptionsAcceptsUseStrictMode()
    {
        Zend_Session::setOptions(['use_strict_mode' => 1]);
        $this->assertSame('1', ini_get('session.use_strict_mode'));
        $this->assertEquals(1, Zend_Session::getOptions('use_strict_mode'));

        Zend_Session::setOptions(['use_strict_mode' => 0]);
        $this->assertSame('0', ini_get('session.use_strict_mode'));
        $this->assertEquals(0, Zend_Session::getOptions('use_strict_mode'));
    }

    /**
     * Option names are case-insensitive, like the other ini based options.
     *
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @return void
     */
    public function testUseStrictModeOptionNameIsCaseInsensitive()
    {
        Zend_Session::setOptions(['use_strict_mode' => 0]);
        Zend_Session::setOptions(['USE_STRICT_MODE' => 1]);

        $this->assertSame('1', ini_get('session.use_strict_mode'));
    }

    /**
     * Zend_Session must not override session.use_strict_mode unless asked to,
     * i.e. the php.ini value is kept by default.
     *
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @return void
     */
    public function testUseStrictModeKeepsPhpIniValueByDefault()
    {
        $before = ini_get('session.use_strict_mode');

        Zend_Session::setOptions(['gc_probability' => 0]);

        $this->assertSame($before, ini_get('session.use_strict_mode'));
    }

    /**
     * Unknown options must still be rejected.
     *
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @return void
     */
    public function testUnknownOptionIsStillRejected()
    {
        $this->expectException(Zend_Session_Exception::class);
        $this->expectExceptionMessageMatches('/unknown.option/i');

        Zend_Session::setOptions(['use_strict_modee' => 1]);
    }

    /**
     * The session must start normally with strict mode enabled, and the
     * setting must survive session start.
     *
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @return void
     */
    public function testSessionStartsWithUseStrictModeEnabled()
    {
        Zend_Session::setOptions(['use_strict_mode' => 1]);

        Zend_Session::start();

        $this->assertTrue(Zend_Session::isStarted());
        $this->assertSame('1', ini_get('session.use_strict_mode'));

        Zend_Session::writeClose();
    }
}
