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
 * @package    Zend_Version
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_VersionTest::main');
}

/**
 * @see Zend_Version
 */
require_once 'Zend/Version.php';

/**
 * @category   Zend
 * @package    Zend_Version
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Version
 */
class Zend_VersionTest extends TestCase
{
    public static function main()
    {
        $suite = new TestSuite(__CLASS__);
        $result = (new resources_Runner())->run($suite);
    }

    /**
     * Tests that version_compare() and its "proxy"
     * Zend_Version::compareVersion() work as expected.
     */
    public function testVersionCompare()
    {
        $expect = -1;
        // unit test breaks if ZF version > 1.x
        for ($i = 0; $i <= 1; $i++) {
            for ($j = 0; $j <= 99; $j++) {
                for ($k = 0; $k <= 99; $k++) {
                    foreach (['dev', 'pr', 'PR', 'alpha', 'a1', 'a2', 'beta', 'b1', 'b2', 'RC', 'RC1', 'RC2', 'RC3', '', 'pl1', 'PL1'] as $rel) {
                        $ver = "$i.$j.$k$rel";
                        $normalizedVersion = strtolower(Zend_Version::VERSION);
                        if (strtolower($ver) === $normalizedVersion
                            || strtolower("$i.$j.$k-$rel") === $normalizedVersion
                            || strtolower("$i.$j.$k.$rel") === $normalizedVersion
                            || strtolower("$i.$j.$k $rel") === $normalizedVersion
                        ) {
                            if ($expect == -1) {
                                $expect = 1;
                            }
                        } else {
                            $this->assertSame(
                                Zend_Version::compareVersion($ver),
                                $expect,
                                "For version '$ver' and Zend_Version::VERSION = '"
                                . Zend_Version::VERSION . "': result=" . (Zend_Version::compareVersion($ver))
                                . ', but expected ' . $expect
                            );
                        }
                    }
                }
            }
        }
        if ($expect === -1) {
            $this->fail('Unable to recognize Zend_Version::VERSION (' . Zend_Version::VERSION . '); last version compared: ' . $ver);
        }
    }

    /**
     * getLatest() reads the name of the latest release from the GitHub API; a
     * stream wrapper serves the response, so the test needs no network
     *
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testFetchLatestVersion()
    {
        Zend_VersionTest_HttpsStream::register(json_encode(['name' => 'release-1.25.2']));

        $this->assertSame('1.25.2', Zend_Version::getLatest());
        $this->assertSame(
            'https://api.github.com/repos/Shardj/zf1-future/releases/latest',
            Zend_VersionTest_HttpsStream::$requested
        );
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testFetchLatestVersionWhenTheRequestFails()
    {
        Zend_VersionTest_HttpsStream::register(false);

        // file_get_contents() warns about the failed request
        error_reporting(E_ALL & ~E_WARNING);
        $this->assertSame('not available', Zend_Version::getLatest());
    }
}

/**
 * Stream wrapper for https:// that serves a fixed response or fails to open
 */
class Zend_VersionTest_HttpsStream
{
    /**
     * @var string|false
     */
    public static $response;

    /**
     * @var string|null
     */
    public static $requested;

    /**
     * @var resource
     */
    public $context;

    /**
     * @var int
     */
    protected $_position = 0;

    /**
     * @param string|false $response Response body, false to fail the request
     */
    public static function register($response)
    {
        self::$response  = $response;
        self::$requested = null;
        if (in_array('https', stream_get_wrappers())) {
            stream_wrapper_unregister('https');
        }
        stream_wrapper_register('https', __CLASS__);
    }

    public function stream_open($path, $mode, $options, &$openedPath)
    {
        self::$requested = $path;

        return self::$response !== false;
    }

    public function stream_read($count)
    {
        $chunk = substr(self::$response, $this->_position, $count);
        $this->_position += strlen($chunk);

        return $chunk;
    }

    public function stream_eof()
    {
        return $this->_position >= strlen(self::$response);
    }

    public function stream_stat()
    {
        return [];
    }
}

// A test in a separate process loads this file again in the child process;
// the tests must not start over there.
if (PHPUnit_MAIN_METHOD === "Zend_VersionTest::main" && !function_exists('__phpunit_run_isolated_test')) {
    Zend_VersionTest::main();
}
