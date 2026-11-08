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
 * @package    Zend_TimeSync
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_timeSync
 */
require_once 'Zend/TimeSync.php';
require_once 'Zend/TimeSync/Ntp.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_TranslateTest::main');
}

/**
 * @category   Zend
 * @package    Zend_TimeSync
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_TimeSync
 */
class Zend_TimeSyncTest extends TestCase
{
    public $timeservers = [
        // invalid servers
        'server_a' => 'ntp://be.foo.bar.org',
        'server_b' => 'sntp://be.foo.bar.org',
        'server_c' => 'sntp://foo:bar@be.foo.bar.org:123',

        // valid servers
        'server_d' => 'ntp://be.pool.ntp.org',
        'server_e' => 'ntp://time.windows.com',
        'server_f' => 'sntp://time-C.timefreq.bldrdoc.gov'
    ];

    /**
     * Test for object initialisation
     *
     * @return void
     */
    public function testInitTimeserver()
    {
        $server = new Zend_TimeSync();

        $this->assertTrue($server instanceof Zend_TimeSync);
    }

    /**
     * Test for object initialisation with multiple timeservers
     *
     * @return void
     */
    public function testInitTimeservers()
    {
        $server = new Zend_TimeSync($this->timeservers);
        $result = $server->getServer('server_f');

        $this->assertTrue($result instanceof Zend_TimeSync_Protocol);
    }

    /**
     * Test for object initialisation with a single timeserver that will
     * default to the default scheme (ntp), because no scheme is supplied
     *
     * @return void
     */
    public function testInitDefaultScheme()
    {
        $server = new Zend_TimeSync('time.windows.com', 'windows_time');
        $server->setServer('windows_time');
        $result = $server->getServer();

        $this->assertTrue($result instanceof Zend_TimeSync_Ntp);
    }

    /**
     * Test for object initialisation with a single NTP timeserver
     *
     * @return void
     */
    public function testInitNtpScheme()
    {
        $server = new Zend_TimeSync('ntp://time.windows.com', 'windows_time');
        $server->setServer('windows_time');
        $result = $server->getServer();

        $this->assertTrue($result instanceof Zend_TimeSync_Ntp);
    }

    /**
     * Test for object initialisation with a single SNTP timeserver
     *
     * @return void
     */
    public function testInitSntpScheme()
    {
        $server = new Zend_TimeSync('sntp://time.zend.com', 'windows_time');
        $server->setServer('windows_time');
        $result = $server->getServer();

        $this->assertTrue($result instanceof Zend_TimeSync_Sntp);
    }

    /**
     * Test for object initialisation with an unsupported scheme. This will
     * cause the default scheme to be used (ntp)
     *
     * @return void
     * @doesNotPerformAssertions
     */
    public function testInitUnknownScheme()
    {
        try {
            $server = new Zend_TimeSync('http://time.windows.com', 'windows_time');
            $this->fail('Exception expected because we supplied an invalid protocol');
        } catch (Zend_TimeSync_Exception $e) {
            // success
        }
    }

    /**
     * Test setting a single option
     *
     * @return void
     */
    public function testSetOption()
    {
        $timeout = 5;

        $server = new Zend_TimeSync();
        $server->setOptions(['timeout' => $timeout]);

        $this->assertEquals($timeout, $server->getOptions('timeout'));
    }

    /**
     * Test setting an array of options
     *
     * @return void
     */
    public function testSetOptions()
    {
        $options = [
            'timeout' => 5,
            'foo' => 'bar'
        ];

        $server = new Zend_TimeSync();
        $server->setOptions($options);

        $this->assertEquals($options['timeout'], $server->getOptions('timeout'));
        $this->assertEquals($options['foo'], $server->getOptions('foo'));
    }

    /**
     * Test getting an option that is not set
     *
     * @return void
     * @doesNotPerformAssertions
     */
    public function testGetInvalidOptionKey()
    {
        $server = new Zend_TimeSync();

        try {
            $result = $server->getOptions('foobar');
            $this->fail('Exception expected because we supplied an invalid option key');
        } catch (Zend_TimeSync_Exception $e) {
            // success
        }
    }

    /**
     * Test marking a none existing timeserver as current
     *
     * @return void
     * @doesNotPerformAssertions
     */
    public function testSetUnknownCurrent()
    {
        $server = new Zend_TimeSync();

        try {
            $server->setServer('unknown_alias');
            $this->fail('Exception expected because there is no timeserver which we can mark as current');
        } catch (Zend_TimeSync_Exception $e) {
            // success
        }
    }

    /**
     * Test getting the current timeserver when none is set
     *
     * @return void
     * @doesNotPerformAssertions
     */
    public function testGetUnknownCurrent()
    {
        $server = new Zend_TimeSync();

        try {
            $result = $server->getServer();
            $this->fail('Exception expected because there is no current timeserver set');
        } catch (Zend_TimeSync_Exception $e) {
            // success
        }
    }

    /**
     * Test getting a none existing timeserver
     *
     * @return void
     * @doesNotPerformAssertions
     */
    public function testGetUnknownServer()
    {
        $server = new Zend_TimeSync();

        try {
            $result = $server->getServer('none_existing_server_alias');
            $this->fail('Exception expected, because the requested timeserver does not exist');
        } catch (Zend_TimeSync_Exception $e) {
            // success
        }
    }

    /**
     * Test getting a date using the fallback mechanism, will try to
     * return the date from the first server that returns a valid result
     *
     * @return void
     */
    public function testGetDate()
    {
        $server = new Zend_TimeSync($this->timeservers);

        try {
            $result = $server->getDate();
            $this->assertTrue($result instanceof Zend_Date);
        } catch (Zend_TimeSync_Exception $e) {
            $this->assertStringContainsString('all timeservers are bogus', $e->getMessage());
        }
    }

    /**
     * Test getting a date from an ntp timeserver
     *
     * @return void
     */
    public function testGetNtpDate()
    {
        $server = new Zend_TimeSync('ntp://time.windows.com', 'time_windows');

        try {
            $result = $server->getDate();
            $this->assertTrue($result instanceof Zend_Date);
        } catch (Zend_TimeSync_Exception $e) {
            $this->assertStringContainsString('all timeservers are bogus', $e->getMessage());
        }
    }

    /**
     * Test getting a date from an sntp timeserver
     *
     * @return void
     */
    public function testGetSntpDate()
    {
        $server = new Zend_TimeSync('sntp://time-C.timefreq.bldrdoc.gov');

        try {
            $result = $server->getDate();
            $this->assertTrue($result instanceof Zend_Date);
        } catch (Zend_TimeSync_Exception $e) {
            $this->assertStringContainsString('all timeservers are bogus', $e->getMessage());
        }
    }

    /**
     * Test getting a date from an invalid timeserver
     *
     * @return void
     */
    public function testGetInvalidDate()
    {
        $servers = [
            'server_a' => 'dummy-ntp-timeserver.com',
            'server_b' => 'another-dummy-ntp-timeserver.com'
        ];

        $server = new Zend_TimeSync($servers);

        try {
            $result = $server->getDate();
        } catch (Zend_TimeSync_Exception $e) {
            $exceptions = $e->get();

            foreach ($exceptions as $key => $exception) {
                $this->assertTrue($exception instanceof Zend_TimeSync_Exception);
            }
        }
    }

    /**
     * Test walking through the server list
     *
     * @return void
     */
    public function testWalkServers()
    {
        $servers = new Zend_TimeSync($this->timeservers);

        foreach ($servers as $key => $server) {
            $this->assertTrue($server instanceof Zend_TimeSync_Protocol);
        }
    }

    /**
     * Test getting info returned from the server
     *
     * @return void
     */
    /**
     * The NTP client against a canned answer of a server: no network, no PHP errors
     */
    public function testGetDateFromAnNtpAnswer()
    {
        if (!function_exists('stream_socket_pair')) {
            $this->markTestSkipped('stream_socket_pair() is not available');
        }
        $now = microtime(true);
        Zend_TimeSyncTest_FakeNtp::$packet =
            chr(0x24) . chr(1) . chr(6) . chr(0xEC)          // no leap warning, NTP v4, server; stratum 1; poll; precision
            . pack('N', 0x00000100) . pack('N', 0x00000200)  // root delay, root dispersion
            . 'GPS '                                         // reference id
            . $this->_ntpTimestamp($now - 10)                // reference
            . $this->_ntpTimestamp($now)                     // originate
            . $this->_ntpTimestamp($now)                     // receive
            . $this->_ntpTimestamp($now);                    // transmit

        $sync = new Zend_TimeSync();
        $sync->addServer('ntp://fake');
        $servers = new ReflectionProperty($sync, '_timeservers');
        if (PHP_VERSION_ID < 80100) {
            $servers->setAccessible(true);
        }
        $servers->setValue($sync, ['fake' => new Zend_TimeSyncTest_FakeNtp('fake', 123)]);

        $errors = [];
        set_error_handler(function ($level, $message) use (&$errors) {
            $errors[] = $message;
            return true;
        });
        try {
            $date = $sync->getDate();
            $info = $sync->getInfo();
        } finally {
            restore_error_handler();
        }

        $this->assertSame([], $errors);
        $this->assertInstanceOf('Zend_Date', $date);
        $this->assertEqualsWithDelta($now, $date->getTimestamp(), 2);
        $this->assertEqualsWithDelta(0, $info['offset'], 1);
        $this->assertEquals('primary reference', $info['stratum']);
        $this->assertEquals('GPS UHF satellite positioning', $info['ntpid']);
    }

    /**
     * @param  float $time Unix timestamp
     * @return string 64 bit NTP timestamp
     */
    protected function _ntpTimestamp($time)
    {
        $seconds  = (int) floor($time) + 2208988800;
        $fraction = (int) (($time - floor($time)) * 4294967296);
        return pack('NN', $seconds, $fraction);
    }

    public function testGetInfo()
    {
        $server = new Zend_TimeSync('time.windows.com');
        try {
            $date = $server->getDate();
            $result = $server->getInfo();

            $this->assertTrue(count($result) > 0);
        } catch (Zend_TimeSync_Exception $e) {
            $this->assertStringContainsString('all timeservers are bogus', $e->getMessage());
        }
    }
}

/**
 * NTP client that reads the canned answer from a socket pair instead of a server
 */
class Zend_TimeSyncTest_FakeNtp extends Zend_TimeSync_Ntp
{
    public static $packet = '';

    /**
     * The server end of the pair, kept open while the client writes its request
     *
     * @var resource
     */
    protected $_server;

    protected function _connect()
    {
        [$client, $this->_server] = stream_socket_pair(STREAM_PF_UNIX, STREAM_SOCK_STREAM, STREAM_IPPROTO_IP);
        fwrite($this->_server, self::$packet);
        $this->_socket = $client;
    }
}
