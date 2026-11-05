<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * @see Zend_Db_Table_Rowset
 */
require_once 'Zend/Db/Table/Rowset.php';

/**
 * Zend_Db_Table_Rowset built from plain data, without a table or database
 *
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Table
 * @group      Zend_Db_Table_Rowset
 */
class Zend_Db_Table_Rowset_StaticTest extends TestCase
{
    protected $_data = [
        ['bug_id' => 1, 'bug_status' => 'NEW'],
        ['bug_id' => 2, 'bug_status' => 'FIXED'],
        ['bug_id' => 3, 'bug_status' => 'CLOSED'],
    ];

    /**
     * @return Zend_Db_Table_Rowset
     */
    protected function _rowset()
    {
        return new Zend_Db_Table_Rowset(['data' => $this->_data, 'readOnly' => true]);
    }

    public function testCountAndIteration()
    {
        $rowset = $this->_rowset();
        $this->assertCount(3, $rowset);

        $ids = [];
        foreach ($rowset as $key => $row) {
            $this->assertInstanceOf('Zend_Db_Table_Row', $row);
            $this->assertTrue($row->isReadOnly());
            $ids[$key] = $row->bug_id;
        }
        $this->assertEquals([1, 2, 3], $ids);
    }

    public function testRowsAreCreatedOnceAndReused()
    {
        $rowset = $this->_rowset();
        $first  = $rowset->current();
        $rowset->next();
        $rowset->rewind();
        $this->assertSame($first, $rowset->current());
    }

    public function testSeekAndGetRow()
    {
        $rowset = $this->_rowset();
        $this->assertEquals('CLOSED', $rowset->getRow(2)->bug_status);
        $rowset->seek(1);
        $this->assertEquals('FIXED', $rowset->current()->bug_status);
        $this->assertEquals(1, $rowset->key());
        $this->assertTrue(isset($rowset[2]));
        $this->assertFalse(isset($rowset[3]));
        $this->assertEquals(2, $rowset[1]->bug_id);
    }

    public function testSeekOutOfRangeThrows()
    {
        $this->expectException('Zend_Db_Table_Rowset_Exception');
        $this->_rowset()->seek(3);
    }

    public function testToArrayReturnsTheData()
    {
        $this->assertEquals($this->_data, $this->_rowset()->toArray());
    }

    public function testEmptyRowsetHasNoCurrentRow()
    {
        $rowset = new Zend_Db_Table_Rowset(['data' => []]);
        $this->assertCount(0, $rowset);
        $this->assertFalse($rowset->valid());
        $this->assertNull($rowset->current());
    }

    public function testRowsetWithoutATable()
    {
        $rowset = $this->_rowset();
        $this->assertNull($rowset->getTable());
        $this->assertNull($rowset->current()->getTable());
        $this->assertFalse($rowset->current()->isConnected());
    }

    public function testRowClassOption()
    {
        $rowset = new Zend_Db_Table_Rowset([
            'data'     => $this->_data,
            'readOnly' => true,
            'rowClass' => 'Zend_Db_Table_Rowset_StaticTest_Row',
        ]);
        $this->assertInstanceOf('Zend_Db_Table_Rowset_StaticTest_Row', $rowset->current());
        $this->assertEquals('new', $rowset->current()->lowerStatus());
    }
}

class Zend_Db_Table_Rowset_StaticTest_Row extends Zend_Db_Table_Row_Abstract
{
    public function lowerStatus()
    {
        return strtolower($this->bug_status);
    }
}
