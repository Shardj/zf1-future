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
 * @see Zend_Serializer_Adapter_PhpCode
 */
require_once 'Zend/Serializer/Adapter/PhpCode.php';

/**
 * @category   Zend
 * @package    Zend_Serializer
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Serializer_Adapter_PhpCodeTest extends TestCase
{
    private $_adapter;

    protected function set_up()
    {
        $this->_adapter = new Zend_Serializer_Adapter_PhpCode();
    }

    protected function tear_down()
    {
        $this->_adapter = null;
    }

    public function testSerializeString()
    {
        $value = 'test';
        $expected = "'test'";

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
        $expected = 'NULL';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testSerializeNumeric()
    {
        $value = 100.12345;
        $expected = '100.12345';

        $data = $this->_adapter->serialize($value);
        $this->assertEquals($expected, $data);
    }

    public function testSerializeObject()
    {
        $value = new stdClass();
        $data = $this->_adapter->serialize($value);
        if (version_compare(phpversion(), '7.3', '<')) {
            $expected = "stdClass::__set_state(array(\n))";
            $this->assertEquals($expected, $data);
        } else {
            $expected = "(object) array(\n)";
            $this->assertEquals($expected, $data);
        }
    }

    public function testUnserializeString()
    {
        $value = "'test'";
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
        $value = 'NULL';
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

    /* TODO: PHP Fatal error:  Call to undefined method stdClass::__set_state()
        public function testUnserializeObject()
        {
            $value    = "stdClass::__set_state(array(\n))";
            $expected = new stdClass();

            $data = $this->_adapter->unserialize($value);
            $this->assertEquals($expected, $data);
        }
    */

    public function testUnserialzeInvalid()
    {
        if (version_compare(phpversion(), '7', '>=')) {
            $this->markTestSkipped('Evaling of invalid input is PHP Parse error in PHP7+');
        }
        $value = 'not a serialized string';
        $this->expectException('Zend_Serializer_Exception');
        $this->_adapter->unserialize($value);
    }
}
