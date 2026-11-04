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
 * @see Zend_Serializer_Adapter_PhpSerialize
 */
require_once 'Zend/Serializer.php';
require_once 'Zend/Serializer/Adapter/PhpSerialize.php';

/**
 * @category   Zend
 * @package    Zend_Serializer
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Serializer_Adapter_PhpSerializeTest extends TestCase
{
    private $_adapter;

    protected function set_up()
    {
        $this->_adapter = new Zend_Serializer_Adapter_PhpSerialize();
    }

    protected function tear_down()
    {
        $this->_adapter = null;
    }

    public function testSerializeString()
    {
        $value = 'test';
        $expected = 's:4:"test";';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testSerializeFalse()
    {
        $value = false;
        $expected = 'b:0;';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testSerializeNull()
    {
        $value = null;
        $expected = 'N;';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testSerializeNumeric()
    {
        $value = 100;
        $expected = 'i:100;';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testSerializeObject()
    {
        $value = new stdClass();
        $expected = 'O:8:"stdClass":0:{}';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeString()
    {
        $value = 's:4:"test";';
        $expected = 'test';

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeFalse()
    {
        $value = 'b:0;';
        $expected = false;

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeNull()
    {
        $value = 'N;';
        $expected = null;

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeNumeric()
    {
        $value = 'i:100;';
        $expected = 100;

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserializeObject()
    {
        $value = 'O:8:"stdClass":0:{}';
        $expected = new stdClass();

        $data = $this->_adapter->unserialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testUnserialzeInvalid()
    {
        $value = 'not a serialized string';
        $this->expectException('Zend_Serializer_Exception');
        $this->_adapter->unserialize($value);
    }

    /**
     * Without the unserialize_class_whitelist option every class is unserialized, as before.
     *
     * @group GH-341
     */
    public function testUnserializeClassWhitelistIsOffByDefault()
    {
        $this->assertFalse($this->_adapter->getOption('unserialize_class_whitelist'));

        $data = $this->_adapter->unserialize('O:8:"stdClass":1:{s:1:"a";i:1;}');
        $this->assertInstanceOf('stdClass', $data);
        $this->assertSame(1, $data->a);
    }

    /**
     * @group GH-341
     */
    public function testUnserializeClassWhitelistAsArray()
    {
        $adapter = new Zend_Serializer_Adapter_PhpSerialize(['unserialize_class_whitelist' => ['stdClass']]);

        $data = $adapter->unserialize('O:8:"stdClass":1:{s:1:"a";i:1;}');
        $this->assertInstanceOf('stdClass', $data);

        $data = $adapter->unserialize('O:11:"ArrayObject":4:{i:0;i:0;i:1;a:0:{}i:2;a:0:{}i:3;N;}');
        $this->assertInstanceOf('__PHP_Incomplete_Class', $data);

        // scalars and arrays are not affected
        $this->assertSame(['a' => 1, 'b' => 'x'], $adapter->unserialize('a:2:{s:1:"a";i:1;s:1:"b";s:1:"x";}'));
        $this->assertSame(42, $adapter->unserialize('i:42;'));
    }

    /**
     * An empty array or true allows no class at all; the option can also be given per call.
     *
     * @group GH-341
     */
    public function testUnserializeClassWhitelistNoClasses()
    {
        $adapter = new Zend_Serializer_Adapter_PhpSerialize(['unserialize_class_whitelist' => []]);
        $this->assertInstanceOf('__PHP_Incomplete_Class', $adapter->unserialize('O:8:"stdClass":0:{}'));

        $adapter = new Zend_Serializer_Adapter_PhpSerialize(['unserialize_class_whitelist' => true]);
        $this->assertInstanceOf('__PHP_Incomplete_Class', $adapter->unserialize('O:8:"stdClass":0:{}'));

        $this->assertInstanceOf('__PHP_Incomplete_Class',
            $this->_adapter->unserialize('O:8:"stdClass":0:{}', ['unserialize_class_whitelist' => []]));
        $this->assertInstanceOf('stdClass', $this->_adapter->unserialize('O:8:"stdClass":0:{}'));
    }

    /**
     * @group GH-341
     */
    public function testUnserializeClassWhitelistThroughZendSerializer()
    {
        $data = Zend_Serializer::unserialize('O:8:"stdClass":0:{}', ['adapter' => 'PhpSerialize', 'unserialize_class_whitelist' => []]);
        $this->assertInstanceOf('__PHP_Incomplete_Class', $data);
    }
}
