<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * @see Zend_Db_Adapter_Static
 */
require_once 'Zend/Db/Adapter/Static.php';

/**
 * @see Zend_Db_Table
 */
require_once 'Zend/Db/Table.php';

/**
 * Zend_Db_Table on the static adapter: the parts that do not need a database
 *
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Table
 */
class Zend_Db_Table_StaticTest extends TestCase
{
    /**
     * @var Zend_Db_Adapter_Static
     */
    protected $_db;

    protected function set_up()
    {
        $this->_db = new Zend_Db_Adapter_Static(['dbname' => 'dummy']);
    }

    protected function tear_down()
    {
        Zend_Db_Table::setDefaultAdapter(null);
        Zend_Db_Table::setDefaultMetadataCache(null);
    }

    public function testTableUsesTheGivenAdapter()
    {
        $table = new Zend_Db_Table_StaticTest_Bugs(['db' => $this->_db]);
        $this->assertSame($this->_db, $table->getAdapter());
    }

    public function testTableUsesTheDefaultAdapter()
    {
        Zend_Db_Table::setDefaultAdapter($this->_db);
        $table = new Zend_Db_Table_StaticTest_Bugs();
        $this->assertSame($this->_db, $table->getAdapter());
    }

    public function testTableWithoutAnAdapterThrows()
    {
        Zend_Db_Table::setDefaultAdapter(null);
        $this->expectException('Zend_Db_Table_Exception');
        $this->expectExceptionMessage('No adapter found');
        new Zend_Db_Table_StaticTest_Bugs();
    }

    public function testInfoIsBuiltFromTheMetadataOfTheClass()
    {
        $table = new Zend_Db_Table_StaticTest_Bugs(['db' => $this->_db]);
        $info  = $table->info();

        $this->assertEquals('zfbugs', $info[Zend_Db_Table::NAME]);
        $this->assertEquals(['bug_id', 'bug_description', 'bug_status'], $info[Zend_Db_Table::COLS]);
        $this->assertEquals([1 => 'bug_id'], $info[Zend_Db_Table::PRIMARY]);
        $this->assertEquals('bug_id', $table->info(Zend_Db_Table::PRIMARY)[1]);
        $this->assertEquals('Zend_Db_Table_Row', $info[Zend_Db_Table::ROW_CLASS]);
        $this->assertEquals('Zend_Db_Table_Rowset', $info[Zend_Db_Table::ROWSET_CLASS]);
    }

    public function testSelectRendersTheTableName()
    {
        $table  = new Zend_Db_Table_StaticTest_Bugs(['db' => $this->_db]);
        $select = $table->select();

        $this->assertInstanceOf('Zend_Db_Table_Select', $select);
        $this->assertSame($table, $select->getTable());
        $this->assertEquals('SELECT "zfbugs".* FROM "zfbugs"', $select->assemble());
    }

    public function testSelectWithFromPartCanBeRestrictedToColumns()
    {
        $table  = new Zend_Db_Table_StaticTest_Bugs(['db' => $this->_db]);
        $select = $table->select()->from($table, ['bug_id', 'bug_status']);

        $this->assertEquals('SELECT "zfbugs"."bug_id", "zfbugs"."bug_status" FROM "zfbugs"', $select->assemble());
    }

    public function testCreateRowReturnsARowWithTheColumnsOfTheTable()
    {
        $table = new Zend_Db_Table_StaticTest_Bugs(['db' => $this->_db]);
        $row   = $table->createRow(['bug_description' => 'Broken', 'bug_status' => 'NEW']);

        $this->assertInstanceOf('Zend_Db_Table_Row', $row);
        $this->assertEquals(
            ['bug_id' => null, 'bug_description' => 'Broken', 'bug_status' => 'NEW'],
            $row->toArray()
        );
        $this->assertSame($table, $row->getTable());
    }

    public function testCreateRowIgnoresUnknownColumns()
    {
        $table = new Zend_Db_Table_StaticTest_Bugs(['db' => $this->_db]);
        $row   = $table->createRow(['bug_status' => 'NEW', 'unknown' => 'x']);

        $this->assertEquals(['bug_id' => null, 'bug_description' => null, 'bug_status' => 'NEW'], $row->toArray());
    }
}

/**
 * Table with the metadata defined in the class, so no describeTable() is needed
 */
class Zend_Db_Table_StaticTest_Bugs extends Zend_Db_Table_Abstract
{
    protected $_name = 'zfbugs';

    protected $_primary = 'bug_id';

    protected $_metadataCacheInClass = true;

    protected $_metadata = [
        'bug_id' => [
            'SCHEMA_NAME' => null, 'TABLE_NAME' => 'zfbugs', 'COLUMN_NAME' => 'bug_id', 'COLUMN_POSITION' => 1,
            'DATA_TYPE' => 'int', 'DEFAULT' => null, 'NULLABLE' => false, 'LENGTH' => null, 'SCALE' => null,
            'PRECISION' => null, 'UNSIGNED' => null, 'PRIMARY' => true, 'PRIMARY_POSITION' => 1, 'IDENTITY' => true,
        ],
        'bug_description' => [
            'SCHEMA_NAME' => null, 'TABLE_NAME' => 'zfbugs', 'COLUMN_NAME' => 'bug_description', 'COLUMN_POSITION' => 2,
            'DATA_TYPE' => 'varchar', 'DEFAULT' => null, 'NULLABLE' => true, 'LENGTH' => 100, 'SCALE' => null,
            'PRECISION' => null, 'UNSIGNED' => null, 'PRIMARY' => false, 'PRIMARY_POSITION' => null, 'IDENTITY' => false,
        ],
        'bug_status' => [
            'SCHEMA_NAME' => null, 'TABLE_NAME' => 'zfbugs', 'COLUMN_NAME' => 'bug_status', 'COLUMN_POSITION' => 3,
            'DATA_TYPE' => 'varchar', 'DEFAULT' => null, 'NULLABLE' => true, 'LENGTH' => 20, 'SCALE' => null,
            'PRECISION' => null, 'UNSIGNED' => null, 'PRIMARY' => false, 'PRIMARY_POSITION' => null, 'IDENTITY' => false,
        ],
    ];
}
