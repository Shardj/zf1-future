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
require_once 'Zend/Db/Statement/Mysqli.php';

/**
 * Wrapper class for test protected function _stripQuoted
 */
class Zend_Db_Statement_Mysqli_Test_Class extends Zend_Db_Statement_Mysqli
{
    public function stripQuoted($sql)
    {
        return $this->_stripQuoted($sql);
    }
}

/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Statement
 */
class Zend_Db_Statement_MysqliTest extends Zend_Db_Statement_TestCommon
{
    protected $_Zend_Db_Statement_Mysqli_Test_Class = null;
    /**
     * @group ZF-7911
     */
    public function testStripQuoted()
    {
        $this->_Zend_Db_Statement_Mysqli_Test_Class = new Zend_Db_Statement_Mysqli_Test_Class($this->_db, "SELECT 1");
        
        $input = <<<INPUT
in: [SELECT * FROM `strange`table1`]
out: [SELECT * FROM table1`]
    
in: [SELECT * FROM `strange``table2`]
out: [SELECT * FROM ]
    
in: [SELECT * FROM `strange```table3`]
out: [SELECT * FROM table3`]
    
in: [SELECT * FROM `strange\`table4`]
out: [SELECT * FROM table4`]
    
in: [SELECT * FROM `strange\``table5`]
out: [SELECT * FROM ]
    
in: [SELECT * FROM `strange\```table6`]
out: [SELECT * FROM table6`]
    
in: [SELECT 'value7' AS identifier]
out: [SELECT  AS identifier]
    
in: [SELECT 'strange:value8' AS identifier]
out: [SELECT  AS identifier]
    
in: [SELECT 'strange'value9' AS identifier]
out: [SELECT value9' AS identifier]
    
in: [SELECT 'strange''value10' AS identifier]
out: [SELECT  AS identifier]
    
in: [SELECT 'strange'''value11' AS identifier]
out: [SELECT value11' AS identifier]
    
in: [SELECT 'strange\'value12' AS identifier]
out: [SELECT  AS identifier]
    
in: [SELECT 'strange\''value13' AS identifier]
out: [SELECT value13' AS identifier]
    
in: [SELECT 'strange'''value14' AS identifier]
out: [SELECT value14' AS identifier]
    
in: [SELECT "value15" AS identifier]
out: [SELECT  AS identifier]
    
in: [SELECT "strange:value16" AS identifier]
out: [SELECT  AS identifier]
    
in: [SELECT "strange"value17" AS identifier]
out: [SELECT value17" AS identifier]
    
in: [SELECT "strange""value18" AS identifier]
out: [SELECT  AS identifier]
    
in: [SELECT "strange"""value19" AS identifier]
out: [SELECT value19" AS identifier]
    
in: [SELECT "strange\"value20" AS identifier]
out: [SELECT  AS identifier]
    
in: [SELECT "strange\""value21" AS identifier]
out: [SELECT value21" AS identifier]
    
in: [SELECT "strange"""value22" AS identifier]
out: [SELECT value22" AS identifier]
        
in: [SELECT 'strange\'''value23' AS identifier]
out: [SELECT  AS identifier]
        
in: [SELECT '?`' `x`, col `y` FROM t WHERE u = ?;]
out: [SELECT  , col  FROM t WHERE u = ?;]

in: [SELECT "?`" `x`, col `y` FROM t WHERE u = ?;]
out: [SELECT  , col  FROM t WHERE u = ?;]

in: [INSERT INTO `pcre` (`test`) VALUES ('In MySQL, the backtick (`) is used to quoted identifiers, and here is another backtick: ` ...ooops');]
out: [INSERT INTO  () VALUES ();]
INPUT;
        // parse the input
        $inputOutputLines = explode('in:', $input);
        $count = 0;
    
        foreach ($inputOutputLines as $ioLine) {
            if (!trim($ioLine)) {
                continue;
            }
    
            $count++;
            $io = explode('out:', $ioLine);
            $in = str_replace(['[', ']'],'', trim($io[0]));
            $out = str_replace(['[', ']'],'', trim($io[1]));
            $actual = $this->_Zend_Db_Statement_Mysqli_Test_Class->stripQuoted($in);
            $this->assertSame($out, $actual, $count . ' - unexpected output');
        }
    }
    
    public function testStatementRowCount()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        $product_id = $this->_db->quoteIdentifier('product_id');

        $stmt = $this->_db->prepare("DELETE FROM $products WHERE $product_id = 1");

        $n = $stmt->rowCount();
        $this->assertTrue(is_int($n));
        $this->assertEquals(-1, $n, 'Expecting row count to be -1 before executing query');

        $stmt->execute();

        $n = $stmt->rowCount();
        $stmt->closeCursor();

        $this->assertTrue(is_int($n));
        $this->assertEquals(1, $n, 'Expected row count to be one after executing query');
    }

    public function testStatementBindParamByName()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        $product_id = $this->_db->quoteIdentifier('product_id');
        $product_name = $this->_db->quoteIdentifier('product_name');

        $productIdValue   = 4;
        $productNameValue = 'AmigaOS';

        try {
            $stmt = $this->_db->prepare("INSERT INTO $products ($product_id, $product_name) VALUES (:id, :name)");
            // test with colon prefix
            $this->assertTrue($stmt->bindParam(':id', $productIdValue), 'Expected bindParam(\':id\') to return true');
            // test with no colon prefix
            $this->assertTrue($stmt->bindParam('name', $productNameValue), 'Expected bindParam(\'name\') to return true');
            $this->fail('Expected to catch Zend_Db_Statement_Exception');
        } catch (Zend_Exception $e) {
            $this->assertTrue($e instanceof Zend_Db_Statement_Exception,
                'Expecting object of type Zend_Db_Statement_Exception, got '.get_class($e));
            $this->assertEquals("Invalid bind-variable name ':id'", $e->getMessage());
        }
    }

    public function testStatementBindValueByName()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        $product_id = $this->_db->quoteIdentifier('product_id');
        $product_name = $this->_db->quoteIdentifier('product_name');

        $productIdValue   = 4;
        $productNameValue = 'AmigaOS';

        try {
            $stmt = $this->_db->prepare("INSERT INTO $products ($product_id, $product_name) VALUES (:id, :name)");
            // test with colon prefix
            $this->assertTrue($stmt->bindParam(':id', $productIdValue), 'Expected bindParam(\':id\') to return true');
            // test with no colon prefix
            $this->assertTrue($stmt->bindParam('name', $productNameValue), 'Expected bindParam(\'name\') to return true');
            $this->fail('Expected to catch Zend_Db_Statement_Exception');
        } catch (Zend_Exception $e) {
            $this->assertTrue($e instanceof Zend_Db_Statement_Exception,
                'Expecting object of type Zend_Db_Statement_Exception, got '.get_class($e));
            $this->assertEquals("Invalid bind-variable name ':id'", $e->getMessage());
        }
    }

    public function testStatementGetColumnMeta()
    {
        $this->markTestIncomplete($this->getDriver() . ' has not implemented getColumnMeta() yet [ZF-1424]');
    }

    /**
     * Tests ZF-3216, that the statement object throws exceptions that
     * contain the numerica MySQL SQLSTATE error code
     * @group ZF-3216
     */
    public function testStatementExceptionShouldContainErrorCode()
    {
        $sql = "SELECT * FROM *";
        try {
            $stmt = $this->_db->query($sql);
            $this->fail('Expected to catch Zend_Db_Statement_Exception');
        } catch (Zend_Exception $e) {
            $this->assertTrue(is_int($e->getCode()));
        }
    }

    /**
     * @group ZF-7706
     */
    public function testStatementCanReturnDriverStatement()
    {
        $statement = parent::testStatementCanReturnDriverStatement();
        $this->assertTrue($statement->getDriverStatement() instanceof mysqli_stmt);
    }

    /**
     * Tests that the statement returns FALSE when no records are found
     * @group ZF-5675
     */
    public function testStatementReturnsFalseOnEmpty()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        $sql = 'SELECT * FROM ' . $products . ' WHERE 1=2';
        $stmt = $this->_db->query($sql);
        $result = $stmt->fetch();
        $this->assertFalse($result);
    }

	/**
	 * Test to verify valid report of issue
	 *
     * @group ZF-8986
     */
    public function testNumberOfBoundParamsDoesNotMatchNumberOfTokens()
    {
    	$this->_util->createTable('zf_objects', [
            'object_id'		=> 'INTEGER NOT NULL',
    		'object_type'	=> 'INTEGER NOT NULL',
    		'object_status' => 'INTEGER NOT NULL',
    		'object_lati'   => 'REAL',
    		'object_long'   => 'REAL',
        ]);
        $tableName = $this->_util->getTableName('zf_objects');

        $numRows = $this->_db->insert($tableName, [
        	'object_id' => 1,
        	'object_type' => 1,
        	'object_status' => 1,
        	'object_lati' => 1.12345,
        	'object_long' => 1.54321,
        ]);

        $sql = 'SELECT object_id, object_type, object_status,'
             . ' object_lati, object_long FROM ' . $tableName
             . ' WHERE object_id = ?';

        try {
        	$stmt = $this->_db->query($sql, 1);
        } catch (Exception $e) {
        	$this->fail('Bounding params failed: ' . $e->getMessage());
        }
        $result = $stmt->fetch();
        $this->assertTrue(is_array($result));
        $this->assertEquals(5, count($result));
        $this->assertEquals(1, $result['object_id']);
        $this->assertEquals(1, $result['object_type']);
        $this->assertEquals(1, $result['object_status']);
        $this->assertEquals(1.12345, $result['object_lati']);
        $this->assertEquals(1.54321, $result['object_long']);
    }


    public function getDriver()
    {
        return 'Mysqli';
    }

}
