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
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Log_Writer_SyslogTest::main');
}

/** Zend_Log_Writer_Syslog */
require_once 'Zend/Log/Writer/Syslog.php';

/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Log
 */
class Zend_Log_Writer_SyslogTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testWrite()
    {
        $fields = ['message' => 'foo', 'priority' => LOG_NOTICE];
        $writer = new Zend_Log_Writer_Syslog();
        $writer->write($fields);
    }

    public function testFactory()
    {
        $cfg = [
            'application' => 'my app',
            'facility'    => LOG_USER
        ];

        $writer = Zend_Log_Writer_Syslog::factory($cfg);
        $this->assertTrue($writer instanceof Zend_Log_Writer_Syslog);
    }

    /**
     * @group ZF-7603
     */
    public function testThrowExceptionValueNotPresentInFacilities()
    {
        try {
            $writer = new Zend_Log_Writer_Syslog();
            $writer->setFacility(LOG_USER * 1000);
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Log_Exception);
            $this->assertContains('Invalid log facility provided', $e->getMessage());
        }
    }

    /**
     * @group ZF-7603
     */
    public function testThrowExceptionIfFacilityInvalidInWindows()
    {
        if ('WIN' != strtoupper(substr(PHP_OS, 0, 3))) {
            $this->markTestSkipped('Run only in windows');
        }
        try {
            $writer = new Zend_Log_Writer_Syslog();
            $writer->setFacility(LOG_AUTH);
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Log_Exception);
            $this->assertContains('Only LOG_USER is a valid', $e->getMessage());
        }
    }

    /**
     * @group ZF-8953
     */
    public function testFluentInterface()
    {
        $writer   = new Zend_Log_Writer_Syslog();
        $instance = $writer->setFacility(LOG_USER)
                           ->setApplicationName('my_app');

        $this->assertTrue($instance instanceof Zend_Log_Writer_Syslog);
    }

    /**
     * @group ZF-10769
     */
    public function testPastFacilityViaConstructor()
    {
        $writer = new WriterSyslogCustom(['facility' => LOG_USER]);
        $this->assertEquals(LOG_USER, $writer->getFacility());
    }

    /**
     * @group ZF-8382
     */
    public function testWriteWithFormatter()
    {
        $event = [
        	'message' => 'tottakai',
            'priority' => Zend_Log::ERR
        ];

        $writer = Zend_Log_Writer_Syslog::factory([]);
        require_once 'Zend/Log/Formatter/Simple.php';
        $formatter = new Zend_Log_Formatter_Simple('%message% (this is a test)');
        $writer->setFormatter($formatter);

        $writer->write($event);
    }
}

class WriterSyslogCustom extends Zend_Log_Writer_Syslog
{
    public function getFacility()
    {
        return $this->_facility;
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Log_Writer_SyslogTest::main') {
    Zend_Log_Writer_SyslogTest::main();
}
