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
    define('PHPUnit_MAIN_METHOD', 'Zend_Log_Formatter_FirebugTest::main');
}

/** Zend_Log_Formatter_Firebug */
require_once 'Zend/Log/Formatter/Firebug.php';

/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Log
 */
class Zend_Log_Formatter_FirebugTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testFormat()
    {
        $event = [
            'timestamp' => date('c'),
        	'message' => 'tottakai',
            'priority' => 2,
        	'priorityName' => 'CRIT'
        ];
        $formatter = new Zend_Log_Formatter_Firebug();
        $output = $formatter->format($event);

        $this->assertEquals('tottakai', $output);
    }

    /**
     * @group ZF-9176
     */
    public function testFactory()
    {
        $options = [];
        $formatter = Zend_Log_Formatter_Firebug::factory($options);
        $this->assertTrue($formatter instanceof Zend_Log_Formatter_Firebug);
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Log_Formatter_FirebugTest::main') {
    Zend_Log_Formatter_FirebugTest::main();
}
