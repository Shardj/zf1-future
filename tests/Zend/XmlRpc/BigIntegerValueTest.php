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
 * @package    Zend_XmlRpc
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version $Id: ValueTest.php 23550 2010-12-18 13:18:38Z ramon $
 */

require_once 'Zend/XmlRpc/Value.php';
require_once 'Zend/XmlRpc/Value/Scalar.php';
require_once 'Zend/XmlRpc/Value/BigInteger.php';
require_once 'Zend/XmlRpc/Value/Collection.php';
require_once 'Zend/XmlRpc/Value/Array.php';
require_once 'Zend/XmlRpc/Value/Base64.php';
require_once 'Zend/XmlRpc/Value/Boolean.php';
require_once 'Zend/XmlRpc/Value/DateTime.php';
require_once 'Zend/XmlRpc/Value/Double.php';
require_once 'Zend/XmlRpc/Value/Integer.php';
require_once 'Zend/XmlRpc/Value/String.php';
require_once 'Zend/XmlRpc/Value/Nil.php';
require_once 'Zend/XmlRpc/Value/Struct.php';
require_once 'Zend/Crypt/Math/BigInteger.php';
require_once 'Zend/XmlRpc/TestProvider.php';
require_once 'Zend/Date.php';

/**
 * Test case for Zend_XmlRpc_Value
 *
 * @category   Zend
 * @package    Zend_XmlRpc
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_XmlRpc
 */
class Zend_XmlRpc_BigIntegerValueTest extends TestCase
{
    protected function set_up()
    {
        try {
            $XmlRpcBigInteger = new Zend_XmlRpc_Value_BigInteger(0);
        } catch (Zend_Crypt_Math_BigInteger_Exception $e) {
            $this->markTestSkipped($e->getMessage());
        }
    }

    // BigInteger

    /**
     * @group ZF-6445
     * @group ZF-8623
     */
    public function testBigIntegerGetValue()
    {
        $bigIntegerValue = (string)(PHP_INT_MAX + 42);
        $bigInteger = new Zend_XmlRpc_Value_BigInteger($bigIntegerValue);
        $this->assertSame($bigIntegerValue, $bigInteger->getValue());
    }

    /**
     * @group ZF-6445
     */
    public function testBigIntegerGetType()
    {
        $bigIntegerValue = (string)(PHP_INT_MAX + 42);
        $bigInteger = new Zend_XmlRpc_Value_BigInteger($bigIntegerValue);
        $this->assertSame(Zend_XmlRpc_Value::XMLRPC_TYPE_I8, $bigInteger->getType());
    }

    /**
     * @group ZF-6445
     */
    public function testBigIntegerGeneratedXml()
    {
        $bigIntegerValue = (string)(PHP_INT_MAX + 42);
        $bigInteger = new Zend_XmlRpc_Value_BigInteger($bigIntegerValue);

        $this->assertEquals(
            '<value><i8>' . $bigIntegerValue . '</i8></value>',
            $bigInteger->saveXml()
        );
    }

    /**
     * @group ZF-6445
     * @dataProvider Zend_XmlRpc_TestProvider::provideGenerators
     */
    public function testMarschalBigIntegerFromXmlRpc(Zend_XmlRpc_Generator_GeneratorAbstract $generator)
    {
        Zend_XmlRpc_Value::setGenerator($generator);

        $bigIntegerValue = (string)(PHP_INT_MAX + 42);
        $bigInteger = new Zend_XmlRpc_Value_BigInteger($bigIntegerValue);
        $bigIntegerXml = '<value><i8>' . $bigIntegerValue . '</i8></value>';

        $value = Zend_XmlRpc_Value::getXmlRpcValue(
            $bigIntegerXml,
            Zend_XmlRpc_Value::XML_STRING
        );

        $this->assertSame($bigIntegerValue, $value->getValue());
        $this->assertEquals(Zend_XmlRpc_Value::XMLRPC_TYPE_I8, $value->getType());
        $this->assertEquals($this->wrapXml($bigIntegerXml), $value->saveXml());
    }

    /**
     * @group ZF-6445
     * @dataProvider Zend_XmlRpc_TestProvider::provideGenerators
     */
    public function testMarschalBigIntegerFromApacheXmlRpc(Zend_XmlRpc_Generator_GeneratorAbstract $generator)
    {
        Zend_XmlRpc_Value::setGenerator($generator);

        $bigIntegerValue = (string)(PHP_INT_MAX + 42);
        $bigInteger = new Zend_XmlRpc_Value_BigInteger($bigIntegerValue);
        $bigIntegerXml = '<value><ex:i8 xmlns:ex="http://ws.apache.org/xmlrpc/namespaces/extensions">' . $bigIntegerValue . '</ex:i8></value>';

        $value = Zend_XmlRpc_Value::getXmlRpcValue(
            $bigIntegerXml,
            Zend_XmlRpc_Value::XML_STRING
        );

        $this->assertSame($bigIntegerValue, $value->getValue());
        $this->assertEquals(Zend_XmlRpc_Value::XMLRPC_TYPE_I8, $value->getType());
        $this->assertEquals($this->wrapXml($bigIntegerXml), $value->saveXml());
    }

    /**
     * @group ZF-6445
     */
    public function testMarshalBigIntegerFromNative()
    {
        $bigIntegerValue = (string)(PHP_INT_MAX + 42);

        $value = Zend_XmlRpc_Value::getXmlRpcValue(
            $bigIntegerValue,
            Zend_XmlRpc_Value::XMLRPC_TYPE_I8
        );

        $this->assertEquals(Zend_XmlRpc_Value::XMLRPC_TYPE_I8, $value->getType());
        $this->assertSame($bigIntegerValue, $value->getValue());
    }

    /**
     * @group ZF-6445
     */
    public function testMarschalBigIntegerFromCryptObjectThrowsException()
    {
        try {
            Zend_XmlRpc_Value::getXmlRpcValue(new Zend_Crypt_Math_BigInteger());
            $this->fail('expected Zend_XmlRpc_Value_Exception has not been thrown');
        } catch (Zend_XmlRpc_Value_Exception $exception) {
            if (strpos($exception->getMessage(), 'Zend_Crypt_Math_BigInteger') === false) {
                $this->fail('caught Zend_XmlRpc_Value_Exception does not contain expected text');
            }
        }
    }

    // Custom Assertions and Helper Methods

    public function wrapXml($xml)
    {
        return $xml . "\n";
    }
}

// Call Zend_XmlRpc_ValueTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_XmlRpc_BigIntegerValueTest::main") {
    Zend_XmlRpc_ValueTest::main();
}
