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
    define('PHPUnit_MAIN_METHOD', 'Zend_Log_Writer_ZendMonitorTest::main');
}

/** Zend_Log_Writer_ZendMonitor */
require_once 'Zend/Log/Writer/ZendMonitor.php';

/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Log
 */
class Zend_Log_Writer_ZendMonitorTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * @group ZF-10081
     */
    public function testWrite()
    {
        $writer = new Zend_Log_Writer_ZendMonitor();
        $writer->write(['message' => 'my mess', 'priority' => 1]);
    }

    public function testFactory()
    {
        $cfg = [];

        $writer = Zend_Log_Writer_ZendMonitor::factory($cfg);
        $this->assertTrue($writer instanceof Zend_Log_Writer_ZendMonitor);
    }

    public function testIsEnabled()
    {
        $writer = new Zend_Log_Writer_ZendMonitor();
        $this->assertTrue(is_bool($writer->isEnabled()));
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Log_Writer_ZendMonitorTest::main') {
    Zend_Log_Writer_ZendMonitorTest::main();
}
