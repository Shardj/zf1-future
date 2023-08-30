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
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Log_Filter_ChainingTest::main');
}

/** Zend_Log */
require_once 'Zend/Log.php';

/** Zend_Log_Writer_Stream */
require_once 'Zend/Log/Writer/Stream.php';

/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Log
 */
class Zend_Log_Filter_ChainingTest extends TestCase
{
    /**
     * @var resource|bool|mixed
     */
    protected $log;

    /**
     * @var \Zend_Log|mixed
     */
    protected $logger;

    public static function main()
    {
        $suite = new TestSuite(__CLASS__);
        $result = (new resources_Runner())->run($suite);
    }

    protected function set_up()
    {
        $this->log = fopen('php://memory', 'w');
        $this->logger = new Zend_Log();
        $this->logger->addWriter(new Zend_Log_Writer_Stream($this->log));
    }

    protected function tear_down()
    {
        fclose($this->log);
    }

    public function testFilterAllWriters()
    {
        // filter out anything above a WARNing for all writers
        $this->logger->addFilter(Zend_Log::WARN);

        $this->logger->info($ignored = 'info-message-ignored');
        $this->logger->warn($logged = 'warn-message-logged');

        rewind($this->log);
        $logdata = stream_get_contents($this->log);

        $this->assertStringNotContainsString($ignored, $logdata);
        $this->assertStringContainsString($logged, $logdata);
    }

    public function testFilterOnSpecificWriter()
    {
        $log2 = fopen('php://memory', 'w');
        $writer2 = new Zend_Log_Writer_Stream($log2);
        $writer2->addFilter(Zend_Log::ERR);

        $this->logger->addWriter($writer2);

        $this->logger->warn($warn = 'warn-message');
        $this->logger->err($err = 'err-message');

        rewind($this->log);
        $logdata = stream_get_contents($this->log);
        $this->assertStringContainsString($warn, $logdata);
        $this->assertStringContainsString($err, $logdata);

        rewind($log2);
        $logdata = stream_get_contents($log2);
        $this->assertStringContainsString($err, $logdata);
        $this->assertStringNotContainsString($warn, $logdata);
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Log_Filter_ChainingTest::main') {
    Zend_Log_Filter_ChainingTest::main();
}
