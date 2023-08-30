<?php

use PHPUnit\Extensions\Database\DataSet\FlatXmlDataSet;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

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
 * @package    Zend_Test
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once "Zend/Test/DbAdapter.php";

require_once "Zend/Test/PHPUnit/Db/Operation/Insert.php";

/**
 * @category   Zend
 * @package    Zend_Test
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Test
 */
class Zend_Test_PHPUnit_Db_Operation_InsertTest extends TestCase
{
    private $operation = null;

    protected function set_up()
    {
        $this->operation = new Zend_Test_PHPUnit_Db_Operation_Insert();
    }

    public function testInsertDataSetUsingAdapterInsert()
    {
        $dataSet = new FlatXmlDataSet(dirname(__FILE__) . "/_files/insertFixture.xml");

        $testAdapter = $this->createMock('Zend_Test_DbAdapter');
        $testAdapter->expects($this->at(0))
                    ->method('insert')
                    ->with('foo', ['foo' => 'foo', 'bar' => 'bar', 'baz' => 'baz']);
        $testAdapter->expects($this->at(1))
                    ->method('insert')
                    ->with('foo', ['foo' => 'bar', 'bar' => 'bar', 'baz' => 'bar']);
        $testAdapter->expects($this->at(2))
                    ->method('insert')
                    ->with('foo', ['foo' => 'baz', 'bar' => 'baz', 'baz' => 'baz']);

        $connection = new Zend_Test_PHPUnit_Db_Connection($testAdapter, "schema");

        $this->operation->execute($connection, $dataSet);
    }

    public function testInsertExceptionIsTransformed()
    {
        $this->expectException('PHPUnit_Extensions_Database_Operation_Exception');

        $dataSet = new FlatXmlDataSet(dirname(__FILE__) . "/_files/insertFixture.xml");

        $testAdapter = $this->createMock('Zend_Test_DbAdapter');
        $testAdapter->expects($this->any())->method('insert')->will($this->throwException(new Exception()));

        $connection = new Zend_Test_PHPUnit_Db_Connection($testAdapter, "schema");
        $this->operation->execute($connection, $dataSet);
    }

    public function testInvalidConnectionGivenThrowsException()
    {
        $this->expectException("Zend_Test_PHPUnit_Db_Exception");

        $dataSet = $this->createMock('PHPUnit_Extensions_Database_DataSet_IDataSet');
        $connection = $this->createMock('PHPUnit_Extensions_Database_DB_IDatabaseConnection');

        $this->operation->execute($connection, $dataSet);
    }
}
