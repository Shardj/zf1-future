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

require_once 'Zend/Db/Statement/Pdo/TestCommon.php';





/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Statement
 */
class Zend_Db_Statement_Pdo_MssqlTest extends Zend_Db_Statement_Pdo_TestCommon
{
    // pdo_dblib reports neither the flags nor the table of a column
    protected $_getColumnMetaKeys = [
        'native_type', 'name', 'len', 'precision', 'pdo_type'
    ];

    public function testStatementExecuteWithParams()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        // Make IDENTITY column accept explicit value.
        // This can be done in only one table in a given session.
        $this->_db->getConnection()->exec("SET IDENTITY_INSERT $products ON");
        parent::testStatementExecuteWithParams();
        $this->_db->getConnection()->exec("SET IDENTITY_INSERT $products OFF");
    }

    public function testStatementBindParamByPosition()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        // Make IDENTITY column accept explicit value.
        // This can be done in only one table in a given session.
        $this->_db->getConnection()->exec("SET IDENTITY_INSERT $products ON");
        parent::testStatementBindParamByPosition();
        $this->_db->getConnection()->exec("SET IDENTITY_INSERT $products OFF");
    }

    public function testStatementBindParamByName()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        // Make IDENTITY column accept explicit value.
        // This can be done in only one table in a given session.
        $this->_db->getConnection()->exec("SET IDENTITY_INSERT $products ON");
        parent::testStatementBindParamByName();
        $this->_db->getConnection()->exec("SET IDENTITY_INSERT $products OFF");
    }

    public function testStatementBindValueByPosition()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        // Make IDENTITY column accept explicit value.
        // This can be done in only one table in a given session.
        $this->_db->getConnection()->exec("SET IDENTITY_INSERT $products ON");
        parent::testStatementBindValueByPosition();
        $this->_db->getConnection()->exec("SET IDENTITY_INSERT $products OFF");
    }

    public function testStatementBindValueByName()
    {
        $products = $this->_db->quoteIdentifier('zfproducts');
        // Make IDENTITY column accept explicit value.
        // This can be done in only one table in a given session.
        $this->_db->getConnection()->exec("SET IDENTITY_INSERT $products ON");
        parent::testStatementBindValueByName();
        $this->_db->getConnection()->exec("SET IDENTITY_INSERT $products OFF");
    }

    public function getDriver()
    {
        return 'Pdo_Mssql';
    }

    /**
     * The dblib driver supports more than one rowset; a SELECT has only one
     */
    public function testStatementNextRowset()
    {
        $select = $this->_db->select()
            ->from('zfproducts');
        $stmt = $this->_db->prepare($select->__toString());
        $stmt->execute();
        $this->assertFalse($stmt->nextRowset());
        $stmt->closeCursor();
    }
}
