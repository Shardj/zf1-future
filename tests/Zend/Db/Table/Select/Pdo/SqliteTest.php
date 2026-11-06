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

require_once 'Zend/Db/Table/Select/TestCommon.php';





/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Table
 * @group      Zend_Db_Table_Select
 */
class Zend_Db_Table_Select_Pdo_SqliteTest extends Zend_Db_Table_Select_TestCommon
{




    public function testSelectJoinRight()
    {
        $version = $this->_db->getConnection()->query('SELECT sqlite_version()')->fetchColumn();
        if (version_compare($version, '3.39.0', '<')) {
            $this->markTestSkipped("SQLite $version does not support RIGHT OUTER JOIN, 3.39.0 does");
        }
        parent::testSelectJoinRight();
    }

    public function testSelectGroupBy()
    {
        //SQLite doesn't need different test from 5.3
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            return parent::testSelectGroupBy();
        }
        $select = $this->_selectGroupBy();
        $stmt = $this->_db->query($select);
        $result = $stmt->fetchAll();
        $bugs_products = $this->_db->quoteIdentifier('zfbugs_products');
        $bug_id = $this->_db->quoteIdentifier('bug_id');
        $key = "$bugs_products.$bug_id";
        $this->assertEquals(
            3,
            count($result),
            'Expected count of first result set to be 2'
        );
        $this->assertEquals(1, $result[0][$key]);
        $this->assertEquals(
            3,
            $result[0]['thecount'],
            'Expected count(*) of first result set to be 2'
        );
        $this->assertEquals(2, $result[1][$key]);
        $this->assertEquals(1, $result[1]['thecount']);
    }

    public function testSelectGroupByQualified()
    {
        //SQLite doesn't need different test from 5.3
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            return parent::testSelectGroupByQualified();
        }
        $select = $this->_selectGroupByQualified();
        $stmt = $this->_db->query($select);
        $result = $stmt->fetchAll();
        $bugs_products = $this->_db->quoteIdentifier('zfbugs_products');
        $bug_id = $this->_db->quoteIdentifier('bug_id');
        $key = "$bugs_products.$bug_id";
        $this->assertEquals(
            3,
            count($result),
            'Expected count of first result set to be 2'
        );
        $this->assertEquals(1, $result[0][$key]);
        $this->assertEquals(
            3,
            $result[0]['thecount'],
            'Expected count(*) of first result set to be 2'
        );
        $this->assertEquals(2, $result[1][$key]);
        $this->assertEquals(1, $result[1]['thecount']);
    }

    public function testSelectHaving()
    {
        //SQLite doesn't need different test from 5.3
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            return parent::testSelectHaving();
        }
        $select = $this->_selectHaving();
        $stmt = $this->_db->query($select);
        $result = $stmt->fetchAll();
        $bugs_products = $this->_db->quoteIdentifier('zfbugs_products');
        $bug_id = $this->_db->quoteIdentifier('bug_id');
        $key = "$bugs_products.$bug_id";
        $this->assertEquals(2, count($result));
        $this->assertEquals(1, $result[0][$key]);
        $this->assertEquals(3, $result[0]['thecount']);
    }

    public function testSelectHavingWithParameter()
    {
        //SQLite doesn't need different test from 5.3
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            return parent::testSelectHavingWithParameter();
        }
        $select = $this->_selectHavingWithParameter();
        $stmt = $this->_db->query($select);
        $result = $stmt->fetchAll();
        $bugs_products = $this->_db->quoteIdentifier('zfbugs_products');
        $bug_id = $this->_db->quoteIdentifier('bug_id');
        $key = "$bugs_products.$bug_id";
        $this->assertEquals(2, count($result));
        $this->assertEquals(1, $result[0][$key]);
        $this->assertEquals(3, $result[0]['thecount']);
    }

    public function testSelectHavingOr()
    {
        //SQLite doesn't need different test from 5.3
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            return parent::testSelectHavingOr();
        }
        $select = $this->_selectHavingOr();
        $stmt = $this->_db->query($select);
        $result = $stmt->fetchAll();
        $bugs_products = $this->_db->quoteIdentifier('zfbugs_products');
        $bug_id = $this->_db->quoteIdentifier('bug_id');
        $key = "$bugs_products.$bug_id";
        $this->assertEquals(3, count($result));
        $this->assertEquals(1, $result[0][$key]);
        $this->assertEquals(3, $result[0]['thecount']);
        $this->assertEquals(2, $result[1][$key]);
        $this->assertEquals(1, $result[1]['thecount']);
    }

    public function testSelectHavingOrWithParameter()
    {
        //SQLite doesn't need different test from 5.3
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            return parent::testSelectHavingOrWithParameter();
        }
        $select = $this->_selectHavingOrWithParameter();
        $stmt = $this->_db->query($select);
        $result = $stmt->fetchAll();
        $bugs_products = $this->_db->quoteIdentifier('zfbugs_products');
        $bug_id = $this->_db->quoteIdentifier('bug_id');
        $key = "$bugs_products.$bug_id";
        $this->assertEquals(3, count($result));
        $this->assertEquals(1, $result[0][$key]);
        $this->assertEquals(3, $result[0]['thecount']);
        $this->assertEquals(2, $result[1][$key]);
        $this->assertEquals(1, $result[1]['thecount']);
    }

    public function getDriver()
    {
        return 'Pdo_Sqlite';
    }

}
