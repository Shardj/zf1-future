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
class Zend_Db_Statement_OracleTest extends Zend_Db_Statement_TestCommon
{
    public function testStatementBindParamByPosition()
    {
        $this->markTestSkipped($this->getDriver() . ' does not support bound parameters by position');
    }

    public function testStatementBindValueByPosition()
    {
        $this->markTestSkipped($this->getDriver() . ' does not support bound parameters by position');
    }

    public function testStatementExecuteWithParams()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        $product_id = $this->_db->quoteIdentifier('product_id');
        $product_name = $this->_db->quoteIdentifier('product_name');

        $stmt = $this->_db->prepare("INSERT INTO $products ($product_id, $product_name) VALUES (:product_id, :product_name)");
        $stmt->execute(['product_id' => 4, 'product_name' => 'Solaris']);

        $select = $this->_db->select()
            ->from('zfproducts')
            ->where("$product_id = 4");
        $result = $this->_db->fetchAll($select);
        $stmt->closeCursor();

        $this->assertEquals([['product_id' => 4, 'product_name' => 'Solaris']], $result);
    }

    // oci8 reports neither the table nor the flags of a column
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
        $this->assertSame('NUMBER', $id['native_type']);
        $this->assertSame(11, $id['precision']);
        $this->assertSame(0, $id['scale']);
        $this->assertSame(Zend_Db::PARAM_STR, $id['pdo_type']);

        $description = $stmt->getColumnMeta(1);
        $this->assertSame('bug_description', $description['name']);
        $this->assertSame('VARCHAR2', $description['native_type']);
        $this->assertSame(100, $description['len']);
        $this->assertSame(Zend_Db::PARAM_STR, $description['pdo_type']);

        $stmt->closeCursor();
    }

    public function testStatementGetColumnMetaOfLobs()
    {
        $documents = $this->_db->quoteIdentifier('zfdocuments');
        $doc_clob = $this->_db->quoteIdentifier('doc_clob');
        $doc_blob = $this->_db->quoteIdentifier('doc_blob');
        $stmt = $this->_db->query("SELECT $doc_clob, $doc_blob FROM $documents");

        $clob = $stmt->getColumnMeta(0);
        $this->assertSame('CLOB', $clob['native_type']);
        $this->assertSame(Zend_Db::PARAM_LOB, $clob['pdo_type']);
        $this->assertSame('BLOB', $stmt->getColumnMeta(1)['native_type']);

        // the values are fetched as strings with lob_as_string
        $stmt->setLobAsString(true);
        $this->assertSame(Zend_Db::PARAM_STR, $stmt->getColumnMeta(0)['pdo_type']);

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

    public function testStatementGetColumnMetaMatchesPdoOci()
    {
        if (!extension_loaded('pdo_oci')) {
            $this->markTestSkipped('Comparing with pdo_oci requires the pdo_oci extension');
        }

        $sql = 'SELECT * FROM ' . $this->_db->quoteIdentifier('zfbugs');
        $pdo = Zend_Db::factory('Pdo_Oci', $this->_util->getParams());

        $ociStmt = $this->_db->query($sql);
        $pdoStmt = $pdo->query($sql);
        $this->assertSame($pdoStmt->columnCount(), $ociStmt->columnCount());
        for ($i = 0; $i < $pdoStmt->columnCount(); ++$i) {
            $actual = $ociStmt->getColumnMeta($i);
            $expected = array_intersect_key($pdoStmt->getColumnMeta($i), $actual);
            $this->assertEquals($expected, $actual, "Column $i");
        }
        $ociStmt->closeCursor();
        $pdoStmt->closeCursor();
        $pdo->closeConnection();
    }

    public function testStatementNextRowset()
    {
        $select = $this->_db->select()
            ->from('zfproducts');
        $stmt = $this->_db->prepare($select->__toString());
        try {
            $stmt->nextRowset();
            $this->fail('Expected to catch Zend_Db_Statement_Oracle_Exception');
        } catch (Zend_Exception $e) {
            $this->assertTrue(
                $e instanceof Zend_Db_Statement_Oracle_Exception,
                'Expecting object of type Zend_Db_Statement_Oracle_Exception, got ' . get_class($e)
            );
            $this->assertEquals('HYC00 Optional feature not implemented', $e->getMessage());
        }
        $stmt->closeCursor();
    }

    /**
     * @group ZF-5927
     */
    public function testStatementReturnNullWithEmptyField()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        $product_id = $this->_db->quoteIdentifier('product_id');
        $product_name = $this->_db->quoteIdentifier('product_name');

        $stmt = $this->_db->prepare("INSERT INTO $products ($product_id, $product_name) VALUES (:product_id, :product_name)");
        $stmt->execute(['product_id' => 4, 'product_name' => null]);

        $select = $this->_db->select()
                       ->from('zfproducts')
                       ->where("$product_id = 4");

        $result = $this->_db->fetchAll($select);
        $this->assertTrue(array_key_exists('product_name', $result[0]), 'fetchAll must return null for empty fields with Oracle');
        $result = $this->_db->fetchRow($select);
        $this->assertTrue(array_key_exists('product_name', $result), 'fetchRow must return null for empty fields with Oracle');
    }

    public function getDriver()
    {
        return 'Oracle';
    }
}
