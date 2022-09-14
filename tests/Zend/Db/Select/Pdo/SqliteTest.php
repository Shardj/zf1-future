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

require_once 'Zend/Db/Select/TestCommon.php';


/**
 * @category   Zend
 * @package    Zend_Db
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Db
 * @group      Zend_Db_Select
 */
class Zend_Db_Select_Pdo_SqliteTest extends Zend_Db_Select_TestCommon
{

    public function testSelectFromQualified()
    {
        $this->markTestSkipped($this->getDriver() . ' does not support qualified table names');
    }

    public function testSelectJoinQualified()
    {
        $this->markTestSkipped($this->getDriver() . ' does not support qualified table names');
    }

    public function testSelectFromForUpdate()
    {
        $this->markTestSkipped($this->getDriver() . ' does not support FOR UPDATE');
    }

    public function testSelectJoinRight()
    {
        $this->markTestSkipped($this->getDriver() . ' does not support RIGHT OUTER JOIN');
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
        $this->assertEquals(3, count($result),
            'Expected count of first result set to be 2');
        $this->assertEquals(1, $result[0][$key]);
        $this->assertEquals(3, $result[0]['thecount'],
            'Expected count(*) of first result set to be 2');
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
        $this->assertEquals(3, count($result),
            'Expected count of first result set to be 2');
        $this->assertEquals(1, $result[0][$key]);
        $this->assertEquals(3, $result[0]['thecount'],
            'Expected count(*) of first result set to be 2');
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

    public function testSqlInjectionWithOrder()
    {
        $select = $this->_db->select();
        $select->from(['p' => 'products'])->order('MD5(1);select');
        $this->assertEquals('SELECT "p".* FROM "products" AS "p" ORDER BY "MD5(1);select" ASC', $select->assemble());

        $select = $this->_db->select();
        $select->from(['p' => 'products'])->order('name;select;MD5(1)');
        $this->assertEquals('SELECT "p".* FROM "products" AS "p" ORDER BY "name;select;MD5(1)" ASC', $select->assemble());
    }

    /**
     * @group ZF-378
     */
    public function testOrderOfSingleFieldWithDirection()
    {
        $select = $this->_db->select();
        $select->from(['p' => 'product'])
            ->order('productId DESC');

        $expected = 'SELECT "p".* FROM "product" AS "p" ORDER BY "productId" DESC';
        $this->assertEquals($expected, $select->assemble(),
            'Order direction of field failed');
    }

    /**
     * @group ZF-378
     */
    public function testOrderOfMultiFieldWithDirection()
    {
        $select = $this->_db->select();
        $select->from(['p' => 'product'])
            ->order(['productId DESC', 'userId ASC']);

        $expected = 'SELECT "p".* FROM "product" AS "p" ORDER BY "productId" DESC, "userId" ASC';
        $this->assertEquals($expected, $select->assemble(),
            'Order direction of field failed');
    }

    /**
     * @group ZF-378
     */
    public function testOrderOfMultiFieldButOnlyOneWithDirection()
    {
        $select = $this->_db->select();
        $select->from(['p' => 'product'])
            ->order(['productId', 'userId DESC']);

        $expected = 'SELECT "p".* FROM "product" AS "p" ORDER BY "productId" ASC, "userId" DESC';
        $this->assertEquals($expected, $select->assemble(),
            'Order direction of field failed');
    }

    /**
     * @group ZF-378
     * @group ZF-381
     */
    public function testOrderOfConditionalFieldWithDirection()
    {
        $select = $this->_db->select();
        $select->from(['p' => 'product'])
            ->order('IF("productId" > 5,1,0) ASC');

        $expected = 'SELECT "p".* FROM "product" AS "p" ORDER BY IF("productId" > 5,1,0) ASC';
        $this->assertEquals($expected, $select->assemble(),
            'Order direction of field failed');
    }

}
