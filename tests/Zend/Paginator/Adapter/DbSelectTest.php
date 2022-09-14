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
 * @package    Zend_Paginator
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Paginator_Adapter_DbSelect
 */
require_once 'Zend/Paginator/Adapter/DbSelect.php';

/**
 * @see Zend_Db_Adapter_Pdo_Sqlite
 */
require_once 'Zend/Db/Adapter/Pdo/Sqlite.php';
require_once 'Zend/Debug.php';
require_once 'Zend/Db/Adapter/Abstract.php';

/**
 * @see PHPUnit_Framework_TestCase
 */

require_once dirname(__FILE__) . '/../_files/TestTable.php';

/**
 * @category   Zend
 * @package    Zend_Paginator
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Paginator
 */
class Zend_Paginator_Adapter_DbSelectTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Zend_Paginator_Adapter_DbSelect
     */
    protected $_adapter;

    /**
     * @var Zend_Db_Adapter_Pdo_Sqlite
     */
    protected $_db;

    /**
     * @var Zend_Db_Select
     */
    protected $_query;

    /**
     * @var Zend_Db_Table_Abstract
     */
    protected $_table;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        if (!extension_loaded('pdo_sqlite')) {
           $this->markTestSkipped('Pdo_Sqlite extension is not loaded');
        }

        parent::setUp();

        $this->_db = new Zend_Db_Adapter_Pdo_Sqlite([
            'dbname' => dirname(__FILE__) . '/../_files/test.sqlite'
        ]);

        $this->_table = new TestTable($this->_db);

        $this->_query = $this->_db->select()->from('test')
                                            ->order('number ASC'); // ZF-3740
                                            //->limit(1000, 0); // ZF-3727

        $this->_adapter = new Zend_Paginator_Adapter_DbSelect($this->_query);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_adapter = null;
        parent::tearDown();
    }

    /**
     * @group ZF-6989
     */
    public function testCacheIdentifierIsHashOfAssembledSelect()
    {
        $dbAdapter = $this->getMockForAbstractClass('Zend_Db_Adapter_Abstract', [''], '', false);
        $select    = new Zend_Db_Select($dbAdapter);
        $select->from('ZF_6989');

        $paginatorAdapter = new Zend_Paginator_Adapter_DbSelect($select);

        $this->assertSame(md5($select->assemble()), $paginatorAdapter->getCacheIdentifier(),
                          'Cache identifier incorrect!');
    }
    
    public function testGetsItemsAtOffsetZero()
    {
        $actual = $this->_adapter->getItems(0, 10);

        $i = 1;
        foreach ($actual as $item) {
            $this->assertEquals($i, $item['number']);
            $i++;
        }
    }

    public function testGetsItemsAtOffsetTen()
    {
        $actual = $this->_adapter->getItems(10, 10);

        $i = 11;
        foreach ($actual as $item) {
            $this->assertEquals($i, $item['number']);
            $i++;
        }
    }

    public function testAcceptsIntegerValueForRowCount()
    {
        $this->_adapter->setRowCount(101);
        $this->assertEquals(101, $this->_adapter->count());
    }

    public function testThrowsExceptionIfInvalidQuerySuppliedForRowCount()
    {
        try {
            $this->_adapter->setRowCount($this->_db->select()->from('test'));
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Paginator_Exception);
            $this->assertContains('Row count column not found', $e->getMessage());
        }

        try {
            $wrongcolumn = $this->_db->quoteIdentifier('wrongcolumn');
            $expr = new Zend_Db_Expr("COUNT(*) AS $wrongcolumn");
            $query = $this->_db->select($expr)->from('test');

            $this->_adapter->setRowCount($query);
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Paginator_Exception);
            $this->assertEquals('Row count column not found', $e->getMessage());
        }
    }

    public function testAcceptsQueryForRowCount()
    {
        $row_count_column = $this->_db->quoteIdentifier(Zend_Paginator_Adapter_DbSelect::ROW_COUNT_COLUMN);
        $expression = new Zend_Db_Expr("COUNT(*) AS $row_count_column");

        $rowCount = clone $this->_query;
        $rowCount->reset(Zend_Db_Select::COLUMNS)
                 ->reset(Zend_Db_Select::ORDER)        // ZF-3740
                 ->reset(Zend_Db_Select::LIMIT_OFFSET) // ZF-3727
                 ->reset(Zend_Db_Select::GROUP)        // ZF-4001
                 ->columns($expression);

        $this->_adapter->setRowCount($rowCount);

        $this->assertEquals(500, $this->_adapter->count());
    }

    public function testThrowsExceptionIfInvalidRowCountValueSupplied()
    {
        try {
            $this->_adapter->setRowCount('invalid');
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Zend_Paginator_Exception);
            $this->assertEquals('Invalid row count', $e->getMessage());
        }
    }

    public function testReturnsCorrectCountWithAutogeneratedQuery()
    {
        $expected = 500;
        $actual = $this->_adapter->count();

        $this->assertEquals($expected, $actual);
    }

    public function testDbTableSelectDoesNotThrowException()
    {
        $adapter = new Zend_Paginator_Adapter_DbSelect($this->_table->select());
        $count = $adapter->count();
        $this->assertEquals(500, $count);
    }

    /**
     * @group ZF-4001
     */
    public function testGroupByQueryReturnsOneRow()
    {
        $query = $this->_db->select()->from('test')
                           ->order('number ASC')
                           ->limit(1000, 0)
                           ->group('number');

        $adapter = new Zend_Paginator_Adapter_DbSelect($query);

        $this->assertEquals(500, $adapter->count());
    }

    /**
     * @group ZF-4001
     */
    public function testGroupByQueryOnEmptyTableReturnsRowCountZero()
    {
        $db = new Zend_Db_Adapter_Pdo_Sqlite([
            'dbname' => dirname(__FILE__) . '/../_files/testempty.sqlite'
        ]);

        $query = $db->select()->from('test')
                              ->order('number ASC')
                              ->limit(1000, 0);
        $adapter = new Zend_Paginator_Adapter_DbSelect($query);

        $this->assertEquals(0, $adapter->count());
    }

    /**
     * @group ZF-4001
     */
    public function testGroupByQueryReturnsCorrectResult()
    {
        $query = $this->_db->select()->from('test')
                                     ->order('number ASC')
                                     ->limit(1000, 0)
                                     ->group('testgroup');
        $adapter = new Zend_Paginator_Adapter_DbSelect($query);

        $this->assertEquals(2, $adapter->count());
    }

    /**
     * @group ZF-4032
     */
    public function testDistinctColumnQueryReturnsCorrectResult()
    {
        $query = $this->_db->select()->from('test', 'testgroup')
                                     ->order('number ASC')
                                     ->limit(1000, 0)
                                     ->distinct();
        $adapter = new Zend_Paginator_Adapter_DbSelect($query);

        $this->assertEquals(2, $adapter->count());
    }

    /**
     * @group ZF-4094
     */
    public function testSelectSpecificColumns()
    {
        $number = $this->_db->quoteIdentifier('number');
        $query = $this->_db->select()->from('test', ['testgroup', 'number'])
                                     ->where("$number >= ?", '1');
        $adapter = new Zend_Paginator_Adapter_DbSelect($query);

        $this->assertEquals(500, $adapter->count());
    }

    /**
     * @group ZF-4177
     */
    public function testSelectDistinctAllUsesRegularCountAll()
    {
        $query = $this->_db->select()->from('test')
                                     ->distinct();
        $adapter = new Zend_Paginator_Adapter_DbSelect($query);

        $this->assertEquals(500, $adapter->count());
    }

    /**
     * @group ZF-5233
     */
    public function testSelectHasAliasedColumns()
    {
        $db = $this->_db;

        $db->query('DROP TABLE IF EXISTS `sandboxTransaction`');
        $db->query('DROP TABLE IF EXISTS `sandboxForeign`');

        // A transaction table
        $db->query(
            'CREATE TABLE `sandboxTransaction` (
                `id` INTEGER PRIMARY KEY,
                `foreign_id` INT( 1 ) NOT NULL ,
                `name` TEXT NOT NULL
            ) '
        );

        // A foreign table
        $db->query(
            'CREATE TABLE `sandboxForeign` (
                `id` INTEGER PRIMARY KEY,
                `name` TEXT NOT NULL
            ) '
        );

        // Insert some data
        $db->insert('sandboxTransaction',
            [
                'foreign_id' => 1,
                'name' => 'transaction 1 with foreign_id 1',
            ]
        );

        $db->insert('sandboxTransaction',
            [
                'foreign_id' => 1,
                'name' => 'transaction 2 with foreign_id 1',
            ]
        );

        $db->insert('sandboxForeign',
            [
                'name' => 'John Doe',
            ]
        );

        $db->insert('sandboxForeign',
            [
                'name' => 'Jane Smith',
            ]
        );

        $query = $db->select()->from(['a'=>'sandboxTransaction'], [])
                              ->join(['b'=>'sandboxForeign'], 'a.foreign_id = b.id', ['name'])
                              ->distinct(true);

        try {
            $adapter = new Zend_Paginator_Adapter_DbSelect($query);
            $adapter->count();
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    /**
     * @group ZF-5956
     */
    public function testUnionSelect()
    {
        $union = $this->_db->select()->union([
            $this->_db->select()->from('test')->where('number <= 250'),
            $this->_db->select()->from('test')->where('number > 250')
        ]);

        $adapter = new Zend_Paginator_Adapter_DbSelect($union);
        $expected = 500;
        $actual = $adapter->count();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @group ZF-7045
     */
    public function testGetCountSelect()
    {
        $union = $this->_db->select()->union([
            $this->_db->select()->from('test')->where('number <= 250'),
            $this->_db->select()->from('test')->where('number > 250')
        ]);

        $adapter = new Zend_Paginator_Adapter_DbSelect($union);

        $expected = 'SELECT COUNT(1) AS "zend_paginator_row_count" FROM (SELECT "test".* FROM "test" WHERE (number <= 250) UNION SELECT "test".* FROM "test" WHERE (number > 250)) AS "t"';

        $this->assertEquals($expected, $adapter->getCountSelect()->__toString());
    }

    /**
     * @group ZF-5295
     */
    public function testMultipleDistinctColumns()
    {
        $select = $this->_db->select()->from('test', ['testgroup', 'number'])
                                      ->distinct(true);

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);

        $expected = 'SELECT COUNT(1) AS "zend_paginator_row_count" FROM (SELECT DISTINCT "test"."testgroup", "test"."number" FROM "test") AS "t"';

        $this->assertEquals($expected, $adapter->getCountSelect()->__toString());
        $this->assertEquals(500, $adapter->count());
    }

    /**
     * @group ZF-5295
     */
    public function testSingleDistinctColumn()
    {
        $select = $this->_db->select()->from('test', 'testgroup')
                                      ->distinct(true);

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);

        $expected = 'SELECT COUNT(DISTINCT "test"."testgroup") AS "zend_paginator_row_count" FROM "test"';

        $this->assertEquals($expected, $adapter->getCountSelect()->__toString());
        $this->assertEquals(2, $adapter->count());
    }

    /**
     * @group ZF-6330
     */
    public function testGroupByMultipleColumns()
    {
        $select = $this->_db->select()->from('test', 'testgroup')
                                      ->group(['number', 'testgroup']);

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);

        $expected = 'SELECT COUNT(1) AS "zend_paginator_row_count" FROM (SELECT "test"."testgroup" FROM "test" GROUP BY "number"' . ",\n\t" . '"testgroup") AS "t"';

        $this->assertEquals($expected, $adapter->getCountSelect()->__toString());
        $this->assertEquals(500, $adapter->count());
    }

    /**
     * @group ZF-6330
     */
    public function testGroupBySingleColumn()
    {
        $select = $this->_db->select()->from('test', 'testgroup')
                                      ->group('test.testgroup');

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);

        $expected = 'SELECT COUNT(DISTINCT "test"."testgroup") AS "zend_paginator_row_count" FROM "test"';

        $this->assertEquals($expected, $adapter->getCountSelect()->__toString());
        $this->assertEquals(2, $adapter->count());
    }

    /**
     * @group ZF-6562
     */
    public function testSelectWithHaving()
    {
        $select = $this->_db->select()->from('test')
                                      ->group('number')
                                      ->having('number > 250');

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);

        $expected = 'SELECT COUNT(1) AS "zend_paginator_row_count" FROM (SELECT "test".* FROM "test" GROUP BY "number" HAVING (number > 250)) AS "t"';

        $this->assertEquals($expected, $adapter->getCountSelect()->__toString());
        $this->assertEquals(250, $adapter->count());
    }

    /**
     * @group ZF-7127
     */
    public function testMultipleGroupSelect()
    {
        $select = $this->_db->select()->from('test')
                                      ->group('testgroup')
                                      ->group('number')
                                      ->where('number > 250');

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);

        $expected = 'SELECT COUNT(1) AS "zend_paginator_row_count" FROM (SELECT "test".* FROM "test" WHERE (number > 250) GROUP BY "testgroup"' . ",\n\t" . '"number") AS "t"';

        $this->assertEquals($expected, $adapter->getCountSelect()->__toString());
        $this->assertEquals(250, $adapter->count());
    }

    /**
     * @group ZF-10884
     */
    public function testSetRowCountWithAlias()
    {
        $select = $this->_db->select();
        $select->from('test', [
            Zend_Paginator_Adapter_DbSelect::ROW_COUNT_COLUMN => new Zend_Db_Expr('COUNT(DISTINCT number)')
        ]);

        $this->_db->setProfiler(true);
        $adapter = new Zend_Paginator_Adapter_DbSelect($this->_db->select());
        $adapter->setRowCount($select);
        $adapter->count();

        $expected = 'SELECT COUNT(DISTINCT number) AS "zend_paginator_row_count" FROM "test"';
        $lastQuery = $this->_db->getProfiler()
                         ->getLastQueryProfile()
                         ->getQuery();
        $this->assertEquals($expected, $lastQuery);
    }

    /**
     * @group ZF-7434
     */
    public function testGroupByOneColumnWithZendExpr()
    {
        $select = $this->_db->select();
        $select->from('test', 'testgroup')
               ->group(new Zend_Db_Expr('testgroup'));

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);

        $this->assertEquals(2, $adapter->count());
    }

    /**
     * @group ZF-10704
     */
    public function testObjectSelectWithBind()
    {
        $select = $this->_db->select();
        $select->from('test', ['number'])
               ->where('number = ?')
               ->distinct(true)
               ->bind([250]);

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);
        $this->assertEquals(1, $adapter->count());

        $select->reset(Zend_Db_Select::DISTINCT);
        $select2 = clone $select;
        $select2->reset(Zend_Db_Select::WHERE)
                ->where('number = 500');

        $selectUnion = $this->_db
                           ->select()
                           ->bind([250]);

        $selectUnion->union([$select, $select2]);
        $adapter = new Zend_Paginator_Adapter_DbSelect($selectUnion);
        $this->assertEquals(2, $adapter->count());
    }
}
