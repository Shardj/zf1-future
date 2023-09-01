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
 * @see Zend_Db_Adapter_Pdo_TestCommon
 */
require_once 'Zend/Db/Adapter/Pdo/TestCommon.php';


/**
 * @see Zend_Db_Adapter_Pdo_Mysql
 */
require_once 'Zend/Db/Adapter/Pdo/Mysql.php';


/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Adapter
 */
class Zend_Db_Adapter_Pdo_MysqlTest extends Zend_Db_Adapter_Pdo_TestCommon
{
    protected $_numericDataTypes = [
        Zend_Db::INT_TYPE => Zend_Db::INT_TYPE,
        Zend_Db::BIGINT_TYPE => Zend_Db::BIGINT_TYPE,
        Zend_Db::FLOAT_TYPE => Zend_Db::FLOAT_TYPE,
        'INT' => Zend_Db::INT_TYPE,
        'INTEGER' => Zend_Db::INT_TYPE,
        'MEDIUMINT' => Zend_Db::INT_TYPE,
        'SMALLINT' => Zend_Db::INT_TYPE,
        'TINYINT' => Zend_Db::INT_TYPE,
        'BIGINT' => Zend_Db::BIGINT_TYPE,
        'SERIAL' => Zend_Db::BIGINT_TYPE,
        'DEC' => Zend_Db::FLOAT_TYPE,
        'DECIMAL' => Zend_Db::FLOAT_TYPE,
        'DOUBLE' => Zend_Db::FLOAT_TYPE,
        'DOUBLE PRECISION' => Zend_Db::FLOAT_TYPE,
        'FIXED' => Zend_Db::FLOAT_TYPE,
        'FLOAT' => Zend_Db::FLOAT_TYPE
    ];

    protected function tear_down() 
    {
        Zend_Db_Adapter_Pdo_Abstract::$isTransactionInBackwardCompatibleMode = true;
        parent::tear_down();
    }

    /**
     * Test AUTO_QUOTE_IDENTIFIERS option
     * Case: Zend_Db::AUTO_QUOTE_IDENTIFIERS = true
     *
     * MySQL actually allows delimited identifiers to remain
     * case-insensitive, so this test overrides its parent.
     */
    public function testAdapterAutoQuoteIdentifiersTrue()
    {
        $params = $this->_util->getParams();

        $params['options'] = [
            Zend_Db::AUTO_QUOTE_IDENTIFIERS => true
        ];
        $db = Zend_Db::factory($this->getDriver(), $params);
        $db->getConnection();

        $select = $this->_db->select();
        $select->from('zfproducts');
        $stmt = $this->_db->query($select);
        $result1 = $stmt->fetchAll();

        $this->assertEquals(1, $result1[0]['product_id']);

        $select = $this->_db->select();
        $select->from('zfproducts');
        try {
            $stmt = $this->_db->query($select);
            $result2 = $stmt->fetchAll();
        } catch (Zend_Exception $e) {
            $this->assertTrue(
                $e instanceof Zend_Db_Statement_Exception,
                'Expecting object of type Zend_Db_Statement_Exception, got ' . get_class($e)
            );
            $this->fail('Unexpected exception ' . get_class($e) . ' received: ' . $e->getMessage());
        }

        $this->assertEquals($result1, $result2);
    }

    /**
     * Ensures that driver_options are properly passed along to PDO
     *
     * @group ZF-285
     * @return void
     */
    public function testAdapterDriverOptions()
    {
        $params = $this->_util->getParams();

        $params['driver_options'] = [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true];

        $db = Zend_Db::factory($this->getDriver(), $params);

        $this->assertTrue((bool) $db->getConnection()->getAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY));

        $params['driver_options'] = [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false];

        $db = Zend_Db::factory($this->getDriver(), $params);

        $this->assertFalse((bool) $db->getConnection()->getAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY));
    }

    public function testAdapterInsertSequence()
    {
        $this->markTestSkipped($this->getDriver() . ' does not support sequences');
    }

    /**
     * test that quoteColumnAs() accepts a string
     * and an alias, and returns each as delimited
     * identifiers, with 'AS' in between.
     */
    public function testAdapterQuoteColumnAs()
    {
        $string = "foo";
        $alias = "bar";
        $value = $this->_db->quoteColumnAs($string, $alias);
        $this->assertEquals('`foo` AS `bar`', $value);
    }

    /**
     * test that quoteColumnAs() accepts a string
     * and an alias, but ignores the alias if it is
     * the same as the base identifier in the string.
     */
    public function testAdapterQuoteColumnAsSameString()
    {
        $string = 'foo.bar';
        $alias = 'bar';
        $value = $this->_db->quoteColumnAs($string, $alias);
        $this->assertEquals('`foo`.`bar`', $value);
    }

    /**
     * test that quoteIdentifier() accepts a string
     * and returns a delimited identifier.
     */
    public function testAdapterQuoteIdentifier()
    {
        $value = $this->_db->quoteIdentifier('table_name');
        $this->assertEquals('`table_name`', $value);
    }

    /**
     * test that quoteIdentifier() accepts an array
     * and returns a qualified delimited identifier.
     */
    public function testAdapterQuoteIdentifierArray()
    {
        $array = ['foo', 'bar'];
        $value = $this->_db->quoteIdentifier($array);
        $this->assertEquals('`foo`.`bar`', $value);
    }

    /**
     * test that quoteIdentifier() accepts an array
     * containing a Zend_Db_Expr, and returns strings
     * as delimited identifiers, and Exprs as unquoted.
     */
    public function testAdapterQuoteIdentifierArrayDbExpr()
    {
        $expr = new Zend_Db_Expr('*');
        $array = ['foo', $expr];
        $value = $this->_db->quoteIdentifier($array);
        $this->assertEquals('`foo`.*', $value);
    }

    /**
     * test that quoteIdentifer() escapes a double-quote
     * character in a string.
     */
    public function testAdapterQuoteIdentifierDoubleQuote()
    {
        $string = 'table_"_name';
        $value = $this->_db->quoteIdentifier($string);
        $this->assertEquals('`table_"_name`', $value);
    }

    /**
     * test that quoteIdentifer() accepts an integer
     * and returns a delimited identifier as with a string.
     */
    public function testAdapterQuoteIdentifierInteger()
    {
        $int = 123;
        $value = $this->_db->quoteIdentifier($int);
        $this->assertEquals('`123`', $value);
    }

    /**
     * test that quoteIdentifier() accepts a string
     * containing a dot (".") character, splits the
     * string, quotes each segment individually as
     * delimited identifers, and returns the imploded
     * string.
     */
    public function testAdapterQuoteIdentifierQualified()
    {
        $string = 'table.column';
        $value = $this->_db->quoteIdentifier($string);
        $this->assertEquals('`table`.`column`', $value);
    }

    /**
     * test that quoteIdentifer() escapes a single-quote
     * character in a string.
     */
    public function testAdapterQuoteIdentifierSingleQuote()
    {
        $string = "table_'_name";
        $value = $this->_db->quoteIdentifier($string);
        $this->assertEquals('`table_\'_name`', $value);
    }

    /**
     * test that describeTable() returns correct types
     * @group ZF-3624
     *
     */
    public function testAdapterDescribeTableAttributeColumnFloat()
    {
        $desc = $this->_db->describeTable('zfprice');
        $this->assertEquals('zfprice', $desc['price']['TABLE_NAME']);
        $this->assertMatchesRegularExpression('/float/i', $desc['price']['DATA_TYPE']);
    }

    /**
     * test that quoteTableAs() accepts a string and an alias,
     * and returns each as delimited identifiers.
     * Most RDBMS want an 'AS' in between.
     */
    public function testAdapterQuoteTableAs()
    {
        $string = "foo";
        $alias = "bar";
        $value = $this->_db->quoteTableAs($string, $alias);
        $this->assertEquals('`foo` AS `bar`', $value);
    }

    /**
     * Ensures that the character sequence ":0'" is handled properly
     *
     * @link   http://framework.zend.com/issues/browse/ZF-2059
     * @return void
     */
    public function testZF2059()
    {
        $this->markTestIncomplete('Inconsistent test results');
    }

    /**
     * Ensures that the PDO Buffered Query does not throw the error
     * 2014 General error
     *
     * @link   http://framework.zend.com/issues/browse/ZF-2101
     * @return void
     */
    public function testZF2101()
    {
        $params = $this->_util->getParams();
        $params['driver_options'] = [PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true];
        $db = Zend_Db::factory($this->getDriver(), $params);

        // Set default bound value
        $customerId = 1;

        // Stored procedure returns a single row
        $stmt = $db->prepare('CALL zf_test_procedure(:customerId)');
        $stmt->bindParam('customerId', $customerId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->assertEquals(1, $result[0]['product_id']);

        // Reset statement
        $stmt->closeCursor();

        // Stored procedure returns a single row
        $stmt = $db->prepare('CALL zf_test_procedure(:customerId)');
        $stmt->bindParam('customerId', $customerId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->assertEquals(1, $result[0]['product_id']);
    }

    /**
     * @group ZF-11304
     */
    public function testAdapterIncludesCharsetInsideGeneratedPdoDsn()
    {
        $adapter = new ZendTest_Db_Adapter_Pdo_Mysql(['dbname' => 'foo', 'charset' => 'XYZ', 'username' => 'bar', 'password' => 'foo']);
        $this->assertEquals('mysql:dbname=foo;charset=XYZ', $adapter->_dsn());
    }

    /**
     * Test that quote() does not alter binary data
     */
    public function testBinaryQuoteWithNulls()
    {
        $binary = pack("xxx");
        $value = $this->_db->quote($binary);
        $this->assertEquals('\'\0\0\0\'', $value);
    }

    public function getDriver()
    {
        return 'Pdo_Mysql';
    }

    public function testGivenBeforePhp81WhenFetchDataOnDigitFieldThenPdoMysqlWillReturnStringDigit()
    {
        $params = $this->_util->getParams();
        $db = Zend_Db::factory($this->getDriver(), $params);
        $db->getConnection();

        $select = $this->_db->select();
        $select->from('zfproducts');
        $stmt = $this->_db->query($select);
        $products = $stmt->fetchAll();

        $productId = $products[0]['product_id'] ?? '-1';
        $this->assertSame(
            '1',
            $productId,
            "BC with php < 8.1, fetch numeric field type will return 'digit' string instead of int or float type in php >= 8.1.\nSee: https://www.php.net/manual/en/migration81.incompatible.php#migration81.incompatible.pdo.mysql"
        );
    }

    /**
     * https://www.php.net/manual/en/migration81.incompatible.php#migration81.incompatible.pdo.mysql
     * @inheritDoc
     */
    public function testAdapterZendConfigEmptyDriverOptions()
    {
        $params = $this->_util->getParams();
        $params['driver_options'] = [];
        $params = new Zend_Config($params);

        $db = Zend_Db::factory($this->getDriver(), $params);
        $db->getConnection();

        $config = $db->getConfig();

        if (PHP_VERSION_ID >= 80100) {
            $this->assertEquals([PDO::ATTR_STRINGIFY_FETCHES => true], $config['driver_options']);
        } else {
            $this->assertSame([], $config['driver_options']);
        }
    }

    /**
     * @requires PHP >= 8
     *
     * https://www.php.net/manual/en/migration80.incompatible.php#migration80.incompatible.pdo-mysql
     */
    public function testSincePhp8WhenCallCommitAfterAnImplicitCommitWillRaisePdoException()
    {
        $this->expectException(PDOException::class);
        $this->expectExceptionMessage('There is no active transaction');

        $implicitCommitStatement = 'CREATE TABLE MYTABLE( myname TEXT)'; //https://dev.mysql.com/doc/refman/8.0/en/implicit-commit.html
        $dbConnection = $this->_db;
        $dbConnection->query('DROP TABLE IF EXISTS MYTABLE');
        Zend_Db_Adapter_Pdo_Abstract::$isTransactionInBackwardCompatibleMode = false;
        $dbConnection->beginTransaction();
        $dbConnection->query($implicitCommitStatement);
        $dbConnection->query('INSERT INTO MYTABLE(myname) VALUES ("1"),("2")');
        $dbConnection->commit();
    }

    /**
     * @requires PHP >= 8
     *
     * https://www.php.net/manual/en/migration80.incompatible.php#migration80.incompatible.pdo-mysql
     */
    public function testSincePhp8WhenCallCommitAfterAnImplicitCommitInBackwardCompatibleModeWillSilentErrorSamePhp7()
    {
        $implicitCommitStatement = 'CREATE TABLE MYTABLE( myname TEXT)'; //https://dev.mysql.com/doc/refman/8.0/en/implicit-commit.html
        $dbConnection = $this->_db;
        $dbConnection->query('DROP TABLE IF EXISTS MYTABLE');

        $dbConnection->beginTransaction();
        $dbConnection->query($implicitCommitStatement);
        $dbConnection->query('INSERT INTO MYTABLE(myname) VALUES ("1"),("2")');
        $dbConnection->commit();

        $actual     = $dbConnection->fetchOne('SELECT COUNT(*) FROM MYTABLE');
        $expected   = 2;
        $this->assertEquals($expected, $actual);
    }

    /**
     * @requires PHP >= 8
     *
     * https://www.php.net/manual/en/migration80.incompatible.php#migration80.incompatible.pdo-mysql
     */
    public function testSincePhp8WhenCallRollbackAfterAnImplicitCommitWillRaisePdoException()
    {
        $this->expectException(PDOException::class);
        $this->expectExceptionMessage('There is no active transaction');

        $implicitCommitStatement = 'CREATE TABLE MYTABLE( myname TEXT)'; //https://dev.mysql.com/doc/refman/8.0/en/implicit-commit.html
        $dbConnection = $this->_db;
        $dbConnection->query('DROP TABLE IF EXISTS MYTABLE');
        Zend_Db_Adapter_Pdo_Abstract::$isTransactionInBackwardCompatibleMode = false;
        $dbConnection->beginTransaction();
        $dbConnection->query($implicitCommitStatement);
        $dbConnection->query('INSERT INTO MYTABLE(myname) VALUES ("1"),("2")');
        $dbConnection->rollBack();
    }

    /**
     * @requires PHP >= 8
     *
     * https://www.php.net/manual/en/migration80.incompatible.php#migration80.incompatible.pdo-mysql
     */
    public function testSincePhp8WhenCallRollbackAfterAnImplicitCommitInBackwardCompatibleModeWillSilentErrorSamePhp7()
    {
        $implicitCommitStatement = 'CREATE TABLE MYTABLE( myname TEXT)'; //https://dev.mysql.com/doc/refman/8.0/en/implicit-commit.html
        $dbConnection = $this->_db;
        $dbConnection->query('DROP TABLE IF EXISTS MYTABLE');

        $dbConnection->beginTransaction();
        $dbConnection->query($implicitCommitStatement);
        $dbConnection->query('INSERT INTO MYTABLE(myname) VALUES ("1"),("2")');
        $dbConnection->rollBack();

        $actual     = $dbConnection->fetchOne('SELECT COUNT(*) FROM MYTABLE');
        $expected   = 2; //rollback does not effect.
        $this->assertEquals($expected, $actual);
    }
}

class ZendTest_Db_Adapter_Pdo_Mysql extends Zend_Db_Adapter_Pdo_Mysql
{
    public function _dsn()
    {
        return parent::_dsn();
    }
}
