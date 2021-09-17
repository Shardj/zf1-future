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
    define('PHPUnit_MAIN_METHOD', 'Zend_Log_Writer_DbTest::main');
}

/** Zend_Log_Writer_Db */
require_once 'Zend/Log/Writer/Db.php';

/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Log
 */
class Zend_Log_Writer_DbTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp()
    {
        $this->tableName = 'db-table-name';

        $this->db     = new Zend_Log_Writer_DbTest_MockDbAdapter();
        $this->writer = new Zend_Log_Writer_Db($this->db, $this->tableName);
    }

    public function testFormattingIsNotSupported()
    {
        try {
            require_once 'Zend/Log/Formatter/Simple.php';
            $this->writer->setFormatter(new Zend_Log_Formatter_Simple());
            $this->fail();
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Log_Exception);
            $this->assertRegExp('/does not support formatting/i', $e->getMessage());
        }
    }

    public function testWriteWithDefaults()
    {
        // log to the mock db adapter
        $fields = ['message'  => 'foo',
                        'priority' => 42];

        $this->writer->write($fields);

        // insert should be called once...
        $this->assertContains('insert', array_keys($this->db->calls));
        $this->assertEquals(1, count($this->db->calls['insert']));

        // ...with the correct table and binds for the database
        $binds = ['message'  => $fields['message'],
                       'priority' => $fields['priority']];
        $this->assertEquals([$this->tableName, $binds],
                            $this->db->calls['insert'][0]);
    }

    public function testWriteUsesOptionalCustomColumnNames()
    {
        $this->writer = new Zend_Log_Writer_Db($this->db, $this->tableName,
                                                ['new-message-field'  => 'message',
                                                      'new-message-field' => 'priority']);

        // log to the mock db adapter
        $message  = 'message-to-log';
        $priority = 2;
        $this->writer->write(['message' => $message, 'priority' => $priority]);

        // insert should be called once...
        $this->assertContains('insert', array_keys($this->db->calls));
        $this->assertEquals(1, count($this->db->calls['insert']));

        // ...with the correct table and binds for the database
        $binds = ['new-message-field' => $message,
                       'new-message-field' => $priority];
        $this->assertEquals([$this->tableName, $binds],
                            $this->db->calls['insert'][0]);
    }

    public function testShutdownRemovesReferenceToDatabaseInstance()
    {
        $this->writer->write(['message' => 'this should not fail']);
        $this->writer->shutdown();

        try {
            $this->writer->write(['message' => 'this should fail']);
            $this->fail();
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Log_Exception);
            $this->assertEquals('Database adapter is null', $e->getMessage());
        }
    }

    public function testFactory()
    {
        $cfg = ['log' => ['memory' => [
            'writerName'   => "Db",
            'writerParams' => [
                'db'    => $this->db,
                'table' => $this->tableName,
            ],
        ]]];

        require_once 'Zend/Log.php';
        $logger = Zend_Log::factory($cfg['log']);
        $this->assertTrue($logger instanceof Zend_Log);
    }

    /**
     * @group ZF-10089
     */
    public function testThrowStrictSetFormatter()
    {
        if (version_compare(phpversion(), '7', '>=')) {
            $this->markTestSkipped('Invalid typehinting is PHP Fatal error in PHP7+');
        }

        try {
            $this->writer->setFormatter(new StdClass());
        } catch (Exception $e) {
            $this->assertTrue($e instanceof PHPUnit_Framework_Error);
            $this->assertContains('must implement interface', $e->getMessage());
        }
    }

    /**
     * @group ZF-12514
     */
    public function testWriteWithExtraInfos()
    {
        // Init writer
        $this->writer = new Zend_Log_Writer_Db(
            $this->db, $this->tableName,
            [
                 'message-field'  => 'message',
                 'priority-field' => 'priority',
                 'info-field'     => 'info',
            ]
        );

        // Log
        $message  = 'message-to-log';
        $priority = 2;
        $info     = 'extra-info';
        $this->writer->write(
            [
                 'message'  => $message,
                 'priority' => $priority,
                 'info'     => $info,
            ]
        );

        // Test
        $binds = [
            'message-field'  => $message,
            'priority-field' => $priority,
            'info-field'     => $info,
        ];
        $this->assertEquals(
            [$this->tableName, $binds],
            $this->db->calls['insert'][0]
        );
    }

    /**
     * @group ZF-12514
     */
    public function testWriteWithoutExtraInfos()
    {
        // Init writer
        $this->writer = new Zend_Log_Writer_Db(
            $this->db, $this->tableName,
            [
                 'message-field'  => 'message',
                 'priority-field' => 'priority',
                 'info-field'     => 'info',
            ]
        );

        // Log
        $message  = 'message-to-log';
        $priority = 2;
        $this->writer->write(
            [
                 'message'  => $message,
                 'priority' => $priority,
            ]
        );

        // Test
        $binds = [
            'message-field'  => $message,
            'priority-field' => $priority,
        ];
        $this->assertEquals(
            [$this->tableName, $binds],
            $this->db->calls['insert'][0]
        );
    }
}


class Zend_Log_Writer_DbTest_MockDbAdapter
{
    public $calls = [];

    public function __call($method, $params)
    {
        $this->calls[$method][] = $params;
    }

}

if (PHPUnit_MAIN_METHOD == 'Zend_Log_Writer_DbTest::main') {
    Zend_Log_Writer_DbTest::main();
}
