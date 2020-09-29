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
    define('PHPUnit_MAIN_METHOD', 'Zend_Log_Writer_MockTest::main');
}

/** Zend_Log_Writer_Mock */
require_once 'Zend/Log/Writer/Mock.php';

/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Log
 */
class Zend_Log_Writer_MockTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testWrite()
    {
        $writer = new Zend_Log_Writer_Mock();
        $this->assertSame([], $writer->events);

        $fields = ['foo' => 'bar'];
        $writer->write($fields);
        $this->assertSame([$fields], $writer->events);
    }

    public function testFactory()
    {
        $cfg = ['log' => ['memory' => [
            'writerName' => "Mock"
        ]]];

        require_once 'Zend/Log.php';
        $logger = Zend_Log::factory($cfg['log']);
        $this->assertTrue($logger instanceof Zend_Log);
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Log_Writer_MockTest::main') {
    Zend_Log_Writer_MockTest::main();
}
