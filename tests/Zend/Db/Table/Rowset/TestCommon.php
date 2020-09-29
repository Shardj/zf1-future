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
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */


/**
 * @see Zend_Db_Table_TestSetup
 */
require_once 'Zend/Db/Table/TestSetup.php';





/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Table
 * @group      Zend_Db_Table_Rowset
 */
abstract class Zend_Db_Table_Rowset_TestCommon extends Zend_Db_Table_TestSetup
{

    public function testTableRowsetIterator()
    {
        $table = $this->_table['bugs'];

        $rows = $table->find([1, 2]);
        $this->assertTrue($rows instanceof Zend_Db_Table_Rowset_Abstract,
            'Expecting object of type Zend_Db_Table_Rowset_Abstract, got '.get_class($rows));

        // see if we're at the beginning
        $this->assertEquals(0, $rows->key());
        $this->assertTrue($rows->valid());

        // get first row and see if it's the right one
        $row1 = $rows->current();
        $this->assertTrue($row1 instanceof Zend_Db_Table_Row_Abstract,
            'Expecting object of type Zend_Db_Table_Row_Abstract, got '.get_class($row1));
        $bug_id = $this->_db->foldCase('bug_id');
        $this->assertEquals(1, $row1->$bug_id);

        // advance to next row
        $rows->next();
        $this->assertEquals(1, $rows->key());
        $this->assertTrue($rows->valid());

        // get second row and see if it's the right one
        $row2 = $rows->current();
        $this->assertTrue($row2 instanceof Zend_Db_Table_Row_Abstract,
            'Expecting object of type Zend_Db_Table_Row_Abstract, got '.get_class($row2));
        $this->assertEquals(2, $row2->$bug_id);

        // advance beyond last row
        $rows->next();
        $this->assertEquals(2, $rows->key());
        $this->assertFalse($rows->valid());

        // current() returns null if beyond last row
        $row3 = $rows->current();
        $this->assertNull($row3);

        // rewind to beginning
        $result = $rows->rewind();
        $this->assertEquals($result, $rows);
        $this->assertEquals(0, $rows->key());
        $this->assertTrue($rows->valid());

        // get row at beginning and compare it to
        // the one we got earlier
        $row1Copy = $rows->current();
        $this->assertTrue($row1 instanceof Zend_Db_Table_Row_Abstract,
            'Expecting object of type Zend_Db_Table_Row_Abstract, got '.get_class($row1));
        $this->assertEquals(1, $row1->$bug_id);
        $this->assertSame($row1, $row1Copy);

        // test seeking to infinite fails
        $rows->rewind();
        try{
            $rows->seek(99999); // this index should not exist
            $this->fail('An exception should have been thrown here');
        }catch(Zend_Db_Table_Rowset_Exception $e){ }
        try{
            $rows->seek(-20);
            $this->fail('An exception should have been thrown here');
        }catch(Zend_Db_Table_Rowset_Exception $e){ }


        $rows->seek(1);
        $row = $rows->current();
        $this->assertEquals(1, $rows->key());
        $this->assertTrue($rows->valid());
        $this->assertEquals(2, $row2->$bug_id);

        $rows->rewind();
        $row = $rows->getRow(1);
        $this->assertEquals(0, $rows->key()); // pointer should not have moved
        $this->assertEquals(1, $row1->$bug_id);

        $rows->rewind();
        $row = $rows->getRow(1, true);
        $this->assertEquals(1, $rows->key()); // pointer should have moved
        $this->assertEquals(1, $row1->$bug_id);

        $rows->rewind();
        $rowcopy = $rows->seek(1)->current();
        $rows->rewind();
        $row1 = $rows->getRow(1);
        $this->assertSame($rowcopy, $row1);

        try{
            $rows->getRow(99999); // this index should not exist
            $this->fail('An exception should have been thrown here');
        }catch(Zend_Db_Table_Rowset_Exception $e){
            // has the exception correctly been overwritten by getRow() ?
            $this->assertRegExp('#No row could be found at position \d+#',$e->getMessage());
        }
    }

    public function testTableRowSetArrayAccess()
    {
        $table = $this->_table['bugs'];
        $rowset = $table->fetchAll();

        $this->assertTrue(isset($rowset[0]));
        $this->assertTrue($rowset[0] instanceof Zend_Db_Table_Row);
    }

    public function testTableRowsetEmpty()
    {
        $bug_id = $this->_db->quoteIdentifier('bug_id', true);

        $table = $this->_table['bugs'];

        $rows = $table->fetchAll("$bug_id = -1");
        $this->assertEquals(0, count($rows));
        $this->assertNull($rows->current());
    }

    public function testTableRowsetToArray()
    {
        $table = $this->_table['bugs'];
        $bug_description = $this->_db->foldCase('bug_description');

        $rows = $table->find([1, 2]);
        $this->assertEquals(2, count($rows));

        // iterate through the rowset, because that's the only way
        // to force it to instantiate the individual Rows
        foreach ($rows as $row) {
            $row->$bug_description = 'foo';
        }

        $a = $rows->toArray();

        $this->assertTrue(is_array($a));
        $this->assertEquals(count($a), count($rows));
        $this->assertTrue(is_array($a[0]));
        $this->assertEquals(8, count($a[0]));
        $this->assertEquals('foo', $a[0][$bug_description]);
    }

    public function testTableRowsetGetConnected()
    {
        $table = $this->_table['bugs'];
        $bug_description = $this->_db->foldCase('bug_description');

        $rows = $table->find(1);

        $this->assertTrue($rows->isConnected());
    }

    public function testTableRowsetGetTable()
    {
        $table = $this->_table['bugs'];
        $bug_description = $this->_db->foldCase('bug_description');

        $rows = $table->find(1);
        $rows->setTable($table);

        $this->assertEquals($table, $rows->getTable());
    }

    public function testTableRowsetGetTableClass()
    {
        $table = $this->_table['bugs'];
        $bug_description = $this->_db->foldCase('bug_description');

        $rows = $table->find(1);
        $this->assertEquals(get_class($table), $rows->getTableClass());
    }

    public function testTableSerializeRowset()
    {
        $table = $this->_table['bugs'];

        $rows = $table->find(1);

        $serRows = serialize($rows);

        $rowsNew = unserialize($serRows);

        $this->assertFalse($rowsNew->isConnected());
        $this->assertTrue($rowsNew instanceof Zend_Db_Table_Rowset_Abstract,
            'Expecting object of type Zend_Db_Table_Rowset_Abstract, got '.get_class($rowsNew));

        $row1New = $rowsNew->current();
        $this->assertTrue($row1New instanceof Zend_Db_Table_Row_Abstract,
            'Expecting object of type Zend_Db_Table_Row_Abstract, got '.get_class($row1New));
    }

    public function testTableSerializeRowsetExceptionWrongTable()
    {
        $table = $this->_table['bugs'];
        $bug_description = $this->_db->foldCase('bug_description');

        $rows = $table->find(1);

        // iterate through the rowset, because that's the only way
        // to force it to instantiate the individual Rows
        foreach ($rows as $row)
        {
            $row->$bug_description = $row->$bug_description;
        }

        $serRows = serialize($rows);

        $rowsNew = unserialize($serRows);
        $this->assertTrue($rowsNew instanceof Zend_Db_Table_Rowset_Abstract,
            'Expecting object of type Zend_Db_Table_Rowset_Abstract, got '.get_class($rowsNew));

        $table2 = $this->_table['products'];
        $connected = false;
        try {
            $connected = $rowsNew->setTable($table2);
            $this->fail('Expected to catch Zend_Db_Table_Row_Exception');
        } catch (Zend_Exception $e) {
            $this->assertTrue($e instanceof Zend_Db_Table_Row_Exception,
                'Expecting object of type Zend_Db_Table_Row_Exception, got '.get_class($e));
            $this->assertEquals('The specified Table is of class My_ZendDbTable_TableProducts, expecting class to be instance of My_ZendDbTable_TableBugs', $e->getMessage());
        }
        $this->assertFalse($connected);
    }

    /**
     * @group ZF-9213
     * @group ZF-10173
     */
    public function testTableRowsetIndexesValid()
    {
        $rowset = $this->_table['bugs']->fetchAll();
        try {
            $rowset[-1];
            $this->fail();
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Db_Table_Rowset_Exception);
            $this->assertContains('Illegal index', $e->getMessage());
        }

        $this->assertTrue($rowset[0] instanceof Zend_Db_Table_Row);

        try {
            $row = $rowset[count($rowset) + 1];
            $this->fail();
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Db_Table_Rowset_Exception);
            $this->assertContains('Illegal index', $e->getMessage());
        }
        $this->assertEquals(0, $rowset->key());
    }



    /**
     * @group ZF-8486
     */
    public function testTableRowsetIteratesAndWillReturnLastRowAfter()
    {
        $table = $this->_table['bugs'];
        $rowset = $table->fetchAll('bug_id IN (1,2,3,4)', 'bug_id ASC');
        foreach ($rowset as $row) {
            $lastRow = $row;
        }

        $numRows = $rowset->count();
        $this->assertEquals(4, $numRows);

        $rowset->seek(3);
        $seekLastRow = $rowset->current();

        $this->assertSame($lastRow, $seekLastRow);
    }

    /**
     * @group ZF-8486
     */
    public function testTableRowsetThrowsExceptionOnInvalidSeek()
    {
        $table = $this->_table['bugs'];
        $rowset = $table->fetchAll('bug_id IN (1,2,3,4)', 'bug_id ASC');
        $rowset->seek(3);

        $this->setExpectedException('Zend_Db_Table_Rowset_Exception', 'Illegal index 4');
        $rowset->seek(4);
    }

    /**
     * @group ZF-8486
     */
    public function testTableRowsetThrowsExceptionOnInvalidGetRow()
    {
        $table = $this->_table['bugs'];
        $rowset = $table->fetchAll('bug_id IN (1,2,3,4)', 'bug_id ASC');
        $rowset->getRow(3);

        $this->setExpectedException('Zend_Db_Table_Rowset_Exception', 'No row could be found at position 4');
        $rowset->getRow(4);
    }

    /**
     * @group GH-172
     */
    public function testTableRowsetContainsDisconnectedRowObjectsWhenDeserialized()
    {
        $table = $this->_table['bugs'];
        $onlineRowset = $table->fetchAll('bug_id = 1', 'bug_id ASC');

        // Test that initial rowset and it's rows are connected
        $this->assertTrue($onlineRowset instanceof Zend_Db_Table_Rowset_Abstract);
        $this->assertTrue($onlineRowset->isConnected());
        $onlineRow = $onlineRowset->current();
        $this->assertTrue($onlineRow instanceof Zend_Db_Table_Row_Abstract);
        $this->assertTrue($onlineRow->isConnected());

        $ser = serialize($onlineRowset);
        $rowset = unserialize($ser);

        // Test that newly-unserialized rowset and it's rows are not connected
        $this->assertTrue($rowset instanceof Zend_Db_Table_Rowset_Abstract);
        $this->assertFalse($rowset->isConnected());
        $row = $rowset->current();
        $this->assertTrue($row instanceof Zend_Db_Table_Row_Abstract);
        $this->assertFalse($row->isConnected());
        $this->assertNull($row->getTable());
    }

    /**
     * @group GH-172
     */
    public function testConnectedRowObjectsAreCreatedByRowsetAfterSetTableIsCalled()
    {
        $table = $this->_table['bugs'];
        $ser = serialize($table->fetchAll('bug_id = 1', 'bug_id ASC'));
        $rowset = unserialize($ser);

        // Reconnect the rowset
        $rowset->setTable($table);

        // Test that unserialized rowset and it's rows are now connected
        $this->assertTrue($rowset instanceof Zend_Db_Table_Rowset_Abstract);
        $this->assertTrue($rowset->isConnected());
        $row = $rowset->current();
        $this->assertTrue($row instanceof Zend_Db_Table_Row_Abstract);
        $this->assertTrue($row->isConnected());
        $this->assertTrue($row->getTable() instanceof Zend_Db_Table_Abstract);
    }

    /**
      * @group GH-172
      */
    public function testFixForRowsetContainsDisconnectedRowObjectsWhenDeserializedDoesNotBreakPaginator()
    {
        $table = $this->_table['bugs'];
        $tableClass = get_class($table);

        $select = $table->select();
        $select->from('zfbugs', ['bug_id']);

        require_once 'Zend/Paginator.php';
        $paginator = Zend_Paginator::factory($select);
        foreach ($paginator as $test) {
            $this->assertTrue($test instanceof Zend_Db_Table_Row);
        }
    }

    /**
      * @group GH-172
      * @see https://github.com/zendframework/zf1/commit/d418b73b53964c3bd84a6624075008106e7d5962#commitcomment-4438005
      */
    public function testFixForRowsetContainsDisconnectedRowObjectsWhenDeserializedDoesNotBreakTableJoin()
    {
        $table = $this->_table['bugs'];
        $tableClass = get_class($table);

        $select = $table->select(Zend_Db_Table::SELECT_WITH_FROM_PART)->setIntegrityCheck(false);
        $select->join('zfaccounts', 'zfaccounts.account_name = zfbugs.reported_by', 'account_name');
        $select->where('zfaccounts.account_name = ?', 'Bob');

        $result = $table->fetchAll($select);
        $this->assertTrue($result instanceof Zend_Db_Table_Rowset);
    }

}
