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
 * @version    $Id $
 */

require_once 'Zend/Db/Statement/TestCommon.php';


/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Statement
 */
class Zend_Db_Statement_Db2Test extends Zend_Db_Statement_TestCommon
{
    public function testStatementColumnCountForSelect()
    {
        $select = $this->_db->select()
            ->from('zfproducts');

        $stmt = $this->_db->prepare($select->__toString());

        $n = $stmt->columnCount();
        // DB2 returns the column count once the query has been prepared
        // while PDO returns it only after it has been executed
        $this->assertEquals(2, $n);

        $stmt->execute();

        $n = $stmt->columnCount();
        $stmt->closeCursor();

        $this->assertTrue(is_int($n));
        $this->assertEquals(2, $n);
    }

    public function testStatementBindParamByName()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        $product_id = $this->_db->quoteIdentifier('product_id');
        $product_name = $this->_db->quoteIdentifier('product_name');

        $productIdValue = 4;
        $productNameValue = 'AmigaOS';

        try {
            $stmt = $this->_db->prepare("INSERT INTO $products ($product_id, $product_name) VALUES (:id, :name)");
            // test with colon prefix
            $this->assertTrue($stmt->bindParam(':id', $productIdValue), 'Expected bindParam(\':id\') to return true');
            // test with no colon prefix
            $this->assertTrue($stmt->bindParam('name', $productNameValue), 'Expected bindParam(\'name\') to return true');
            $this->fail('Expected to catch Zend_Db_Statement_Exception');
        } catch (Zend_Exception $e) {
            $this->assertTrue(
                $e instanceof Zend_Db_Statement_Exception,
                'Expecting object of type Zend_Db_Statement_Exception, got ' . get_class($e)
            );
            $this->assertEquals("Invalid bind-variable name ':id'", $e->getMessage());
        }
    }

    public function testStatementBindValueByName()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        $product_id = $this->_db->quoteIdentifier('product_id');
        $product_name = $this->_db->quoteIdentifier('product_name');

        $productIdValue = 4;
        $productNameValue = 'AmigaOS';

        try {
            $stmt = $this->_db->prepare("INSERT INTO $products ($product_id, $product_name) VALUES (:id, :name)");
            // test with colon prefix
            $this->assertTrue($stmt->bindParam(':id', $productIdValue), 'Expected bindParam(\':id\') to return true');
            // test with no colon prefix
            $this->assertTrue($stmt->bindParam('name', $productNameValue), 'Expected bindParam(\'name\') to return true');
            $this->fail('Expected to catch Zend_Db_Statement_Exception');
        } catch (Zend_Exception $e) {
            $this->assertTrue(
                $e instanceof Zend_Db_Statement_Exception,
                'Expecting object of type Zend_Db_Statement_Exception, got ' . get_class($e)
            );
            $this->assertEquals("Invalid bind-variable name ':id'", $e->getMessage());
        }
    }

    // ibm_db2 reports neither the table nor the flags of a column
    protected $_getColumnMetaKeys = [
        'native_type', 'name', 'len', 'precision', 'scale', 'pdo_type'
    ];

    public function testStatementGetColumnMetaDescribesTheColumns()
    {
        $bugs = $this->_db->quoteIdentifier('zfbugs');
        $bug_id = $this->_db->quoteIdentifier('bug_id');
        $bug_description = $this->_db->quoteIdentifier('bug_description');
        $stmt = $this->_db->query("SELECT $bug_id, $bug_description FROM $bugs");

        $id = $stmt->getColumnMeta(0);
        $this->assertSame('bug_id', $id['name']);
        $this->assertSame('int', $id['native_type']);
        $this->assertSame(0, $id['scale']);
        $this->assertSame(Zend_Db::PARAM_INT, $id['pdo_type']);

        $description = $stmt->getColumnMeta(1);
        $this->assertSame('bug_description', $description['name']);
        $this->assertSame('string', $description['native_type']);
        $this->assertSame(100, $description['len']);
        $this->assertSame(Zend_Db::PARAM_STR, $description['pdo_type']);

        $stmt->closeCursor();
    }

    public function testStatementGetColumnMetaWithoutSuchColumn()
    {
        $bugs = $this->_db->quoteIdentifier('zfbugs');
        $bug_id = $this->_db->quoteIdentifier('bug_id');
        $bug_status = $this->_db->quoteIdentifier('bug_status');

        $stmt = $this->_db->query("SELECT $bug_id FROM $bugs");
        $this->assertFalse($stmt->getColumnMeta(1));
        $this->assertFalse($stmt->getColumnMeta(-1));
        $stmt->closeCursor();

        $stmt = $this->_db->query("UPDATE $bugs SET $bug_status = $bug_status WHERE $bug_id = 1");
        $this->assertFalse($stmt->getColumnMeta(0));
    }

    /**
     * The name and the sizes match pdo_ibm; the native_type of ibm_db2 is not
     * the SQL type
     */
    public function testStatementGetColumnMetaMatchesPdoIbm()
    {
        if (!extension_loaded('pdo_ibm')) {
            $this->markTestSkipped('Comparing with pdo_ibm requires the pdo_ibm extension');
        }

        $sql = 'SELECT * FROM ' . $this->_db->quoteIdentifier('zfbugs');
        $pdo = Zend_Db::factory('Pdo_Ibm', $this->_util->getParams());

        $db2Stmt = $this->_db->query($sql);
        $pdoStmt = $pdo->query($sql);
        $this->assertSame($pdoStmt->columnCount(), $db2Stmt->columnCount());
        $keys = ['name' => true, 'len' => true, 'precision' => true, 'scale' => true];
        for ($i = 0; $i < $pdoStmt->columnCount(); ++$i) {
            $expected = array_intersect_key($pdoStmt->getColumnMeta($i), $keys);
            $actual = array_intersect_key($db2Stmt->getColumnMeta($i), $keys);
            $this->assertEquals($expected, $actual, "Column $i");
        }
        $db2Stmt->closeCursor();
        $pdoStmt->closeCursor();
        $pdo->closeConnection();
    }

    public function getDriver()
    {
        return 'Db2';
    }
}
