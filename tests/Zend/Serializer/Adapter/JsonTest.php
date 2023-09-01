<?php

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
 * @package    Zend_Serializer
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Serializer_Adapter_Json
 */
require_once 'Zend/Serializer/Adapter/Json.php';

/**
 * @category   Zend
 * @package    Zend_Serializer
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Serializer_Adapter_JsonTest extends TestCase
{
    private $_adapter;

    protected function set_up()
    {
        $this->_adapter = new Zend_Serializer_Adapter_Json();
    }

    protected function tear_down()
    {
        $this->_adapter = null;
    }

    public function testSerializeString()
    {
        $value = 'test';
        $expected = '"test"';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testSerializeFalse()
    {
        $value = false;
        $expected = 'false';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testSerializeNull()
    {
        $value = null;
        $expected = 'null';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testSerializeNumeric()
    {
        $value = 100;
        $expected = '100';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testSerializeObject()
    {
        $value = new stdClass();
        $value->test = "test";
        $expected = '{"test":"test"}';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeString()
    {
        $value = '"test"';
        $expected = 'test';

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeFalse()
    {
        $value = 'false';
        $expected = false;

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeNull()
    {
        $value = 'null';
        $expected = null;

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeNumeric()
    {
        $value = '100';
        $expected = 100;

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeAsArray()
    {
        $value = '{"test":"test"}';
        $expected = ['test' => 'test'];

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeAsObject()
    {
        $value = '{"test":"test"}';
        $expected = new stdClass();
        $expected->test = 'test';

        $data = $this->_adapter->unserialize($value, ['objectDecodeType' => Zend_Json::TYPE_OBJECT]);
        $this->assertEquals($expected, $data);
    }

    public function testUnserialzeInvalid()
    {
        $value = 'not a serialized string';
        $this->expectException('Zend_Serializer_Exception');
        $this->_adapter->unserialize($value);
    }
}
