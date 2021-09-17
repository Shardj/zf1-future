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
 * @package    Zend_Json
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Json
 */
require_once 'Zend/Json.php';

/**
 * @see Zend_Json_Expr
 */
require_once 'Zend/Json/Expr.php';

/**
 * @see Zend_Json_Encoder
 */
require_once 'Zend/Json/Encoder.php';

/**
 * @see Zend_Json_Decoder
 */
require_once 'Zend/Json/Decoder.php';

/**
 * @category   Zend
 * @package    Zend_Json
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Json
 */
class Zend_JsonTest extends PHPUnit_Framework_TestCase
{
    private $_originalUseBuiltinEncoderDecoderValue;

    public function setUp()
    {
        $this->_originalUseBuiltinEncoderDecoderValue = Zend_Json::$useBuiltinEncoderDecoder;
    }

    public function tearDown()
    {
        Zend_Json::$useBuiltinEncoderDecoder = $this->_originalUseBuiltinEncoderDecoderValue;
    }

    public function testJsonWithPhpJsonExtension()
    {
        if (!extension_loaded('json')) {
            $this->markTestSkipped('JSON extension is not loaded');
        }
        Zend_Json::$useBuiltinEncoderDecoder = false;
        $this->_testJson(['string', 327, true, null]);
    }

    public function testJsonWithBuiltins()
    {
        Zend_Json::$useBuiltinEncoderDecoder = true;
        $this->_testJson(['string', 327, true, null]);
    }

    /**
     * Test encoding and decoding in a single step
     * @param array $values   array of values to test against encode/decode
     */
    protected function _testJson($values)
    {
        $encoded = Zend_Json::encode($values);
        $this->assertEquals($values, Zend_Json::decode($encoded));
    }

    /**
     * test null encoding/decoding
     */
    public function testNull()
    {
        $this->_testEncodeDecode([null]);
    }


    /**
     * test boolean encoding/decoding
     */
    public function testBoolean()
    {
        $this->assertTrue(Zend_Json_Decoder::decode(Zend_Json_Encoder::encode(true)));
        $this->assertFalse(Zend_Json_Decoder::decode(Zend_Json_Encoder::encode(false)));
    }


    /**
     * test integer encoding/decoding
     */
    public function testInteger()
    {
        $this->_testEncodeDecode([-2]);
        $this->_testEncodeDecode([-1]);

        $zero = Zend_Json_Decoder::decode(Zend_Json_Encoder::encode(0));
        $this->assertEquals(0, $zero, 'Failed 0 integer test. Encoded: ' . serialize(Zend_Json_Encoder::encode(0)));
    }

    /**
     * @group ZF-10185
     */
    public function testJsonPrettyPrintWorksWithArrayNotationInStringLiteral()
    {
        $o = new stdClass();
        $o->test = 1;
        $o->faz = 'fubar';
        
        // The escaped double-quote in item 'stringwithjsonchars' ensures that 
        // escaped double-quotes don't throw off prettyPrint's string literal detection
        $test = [
            'simple'=>'simple test string',
            'stringwithjsonchars'=>'\"[1,2]',
            'complex'=>[
                'foo'=>'bar',
                'far'=>'boo',
                'faz'=>[
                    'obj'=>$o
                ]
            ]
        ];
        $pretty = Zend_Json::prettyPrint(Zend_Json::encode($test), ["indent"  => " "]);
        $expected = <<<EOB
{
 "simple":"simple test string",
 "stringwithjsonchars":"\\\\\\"[1,2]",
 "complex":{
  "foo":"bar",
  "far":"boo",
  "faz":{
   "obj":{
    "test":1,
    "faz":"fubar"
   }
  }
 }
}
EOB;
        $this->assertSame($expected, $pretty);
    }

    /**
     * test float encoding/decoding
     */
    public function testFloat()
    {
        $this->_testEncodeDecode([-2.1, 1.2]);
    }

    /**
     * test string encoding/decoding
     */
    public function testString()
    {
        $this->_testEncodeDecode(['string']);
        $this->assertEquals('', Zend_Json_Decoder::decode(Zend_Json_Encoder::encode('')), 'Empty string encoded: ' . serialize(Zend_Json_Encoder::encode('')));
    }

    /**
     * Test backslash escaping of string
     */
    public function testString2()
    {
        $string   = 'INFO: Path \\\\test\\123\\abc';
        $expected = '"INFO: Path \\\\\\\\test\\\\123\\\\abc"';
        $encoded = Zend_Json_Encoder::encode($string);
        $this->assertEquals($expected, $encoded, 'Backslash encoding incorrect: expected: ' . serialize($expected) . '; received: ' . serialize($encoded) . "\n");
        $this->assertEquals($string, Zend_Json_Decoder::decode($encoded));
    }

    /**
     * Test newline escaping of string
     */
    public function testString3()
    {
        $expected = '"INFO: Path\nSome more"';
        $string   = "INFO: Path\nSome more";
        $encoded  = Zend_Json_Encoder::encode($string);
        $this->assertEquals($expected, $encoded, 'Newline encoding incorrect: expected ' . serialize($expected) . '; received: ' . serialize($encoded) . "\n");
        $this->assertEquals($string, Zend_Json_Decoder::decode($encoded));
    }

    /**
     * Test tab/non-tab escaping of string
     */
    public function testString4()
    {
        $expected = '"INFO: Path\\t\\\\tSome more"';
        $string   = "INFO: Path\t\\tSome more";
        $encoded  = Zend_Json_Encoder::encode($string);
        $this->assertEquals($expected, $encoded, 'Tab encoding incorrect: expected ' . serialize($expected) . '; received: ' . serialize($encoded) . "\n");
        $this->assertEquals($string, Zend_Json_Decoder::decode($encoded));
    }

    /**
     * Test double-quote escaping of string
     */
    public function testString5()
    {
        $expected = '"INFO: Path \"Some more\""';
        $string   = 'INFO: Path "Some more"';
        $encoded  = Zend_Json_Encoder::encode($string);
        $this->assertEquals($expected, $encoded, 'Quote encoding incorrect: expected ' . serialize($expected) . '; received: ' . serialize($encoded) . "\n");
        $this->assertEquals($string, Zend_Json_Decoder::decode($encoded));
    }

    /**
     * test indexed array encoding/decoding
     */
    public function testArray()
    {
        $array = [1, 'one', 2, 'two'];
        $encoded = Zend_Json_Encoder::encode($array);
        $this->assertSame($array, Zend_Json_Decoder::decode($encoded), 'Decoded array does not match: ' . serialize($encoded));
    }

    /**
     * test associative array encoding/decoding
     */
    public function testAssocArray()
    {
        $this->_testEncodeDecode([['one' => 1, 'two' => 2]]);
    }

    /**
     * test associative array encoding/decoding, with mixed key types
     */
    public function testAssocArray2()
    {
        $this->_testEncodeDecode([['one' => 1, 2 => 2]]);
    }

    /**
     * test associative array encoding/decoding, with integer keys not starting at 0
     */
    public function testAssocArray3()
    {
        $this->_testEncodeDecode([[1 => 'one', 2 => 'two']]);
    }

    /**
     * test object encoding/decoding (decoding to array)
     */
    public function testObject()
    {
        $value = new stdClass();
        $value->one = 1;
        $value->two = 2;

        $array = ['__className' => 'stdClass', 'one' => 1, 'two' => 2];

        $encoded = Zend_Json_Encoder::encode($value);
        $this->assertSame($array, Zend_Json_Decoder::decode($encoded));
    }

    /**
     * test object encoding/decoding (decoding to stdClass)
     */
    public function testObjectAsObject()
    {
        $value = new stdClass();
        $value->one = 1;
        $value->two = 2;

        $encoded = Zend_Json_Encoder::encode($value);
        $decoded = Zend_Json_Decoder::decode($encoded, Zend_Json::TYPE_OBJECT);
        $this->assertTrue(is_object($decoded), 'Not decoded as an object');
        $this->assertTrue($decoded instanceof StdClass, 'Not a StdClass object');
        $this->assertTrue(isset($decoded->one), 'Expected property not set');
        $this->assertEquals($value->one, $decoded->one, 'Unexpected value');
    }

    /**
     * Test that arrays of objects decode properly; see issue #144
     */
    public function testDecodeArrayOfObjects()
    {
        $value = '[{"id":1},{"foo":2}]';
        $expect = [['id' => 1], ['foo' => 2]];
        $this->assertEquals($expect, Zend_Json_Decoder::decode($value));
    }

    /**
     * Test that objects of arrays decode properly; see issue #107
     */
    public function testDecodeObjectOfArrays()
    {
        $value = '{"codeDbVar" : {"age" : ["int", 5], "prenom" : ["varchar", 50]}, "234" : [22, "jb"], "346" : [64, "francois"], "21" : [12, "paul"]}';
        $expect = [
            'codeDbVar' => [
                'age'   => ['int', 5],
                'prenom' => ['varchar', 50],
            ],
            234 => [22, 'jb'],
            346 => [64, 'francois'],
            21  => [12, 'paul']
        ];
        $this->assertEquals($expect, Zend_Json_Decoder::decode($value));
    }

    /**
     * Test encoding and decoding in a single step
     * @param array $values   array of values to test against encode/decode
     */
    protected function _testEncodeDecode($values)
    {
        foreach ($values as $value) {
            $encoded = Zend_Json_Encoder::encode($value);
            $this->assertEquals($value, Zend_Json_Decoder::decode($encoded));
        }
    }

    /**
     * Test that version numbers such as 4.10 are encoded and decoded properly;
     * See ZF-377
     */
    public function testEncodeReleaseNumber()
    {
        $value = '4.10';

        $this->_testEncodeDecode([$value]);
    }

    /**
     * Tests that spaces/linebreaks prior to a closing right bracket don't throw
     * exceptions. See ZF-283.
     */
    public function testEarlyLineBreak()
    {
        $expected = ['data' => [1, 2, 3, 4]];

        $json = '{"data":[1,2,3,4' . "\n]}";
        $this->assertEquals($expected, Zend_Json_Decoder::decode($json));

        $json = '{"data":[1,2,3,4 ]}';
        $this->assertEquals($expected, Zend_Json_Decoder::decode($json));
    }

    /**
     * Tests for ZF-504
     *
     * Three confirmed issues reported:
     * - encoder improperly encoding empty arrays as structs
     * - decoder happily decoding clearly borked JSON
     * - decoder decoding octal values improperly (shouldn't decode them at all, as JSON does not support them)
     */
    public function testZf504()
    {
        $test = [];
        $this->assertSame('[]', Zend_Json_Encoder::encode($test));

        try {
            $json = '[a"],["a],[][]';
            $test = Zend_Json_Decoder::decode($json);
            $this->fail("Should not be able to decode '$json'");

            $json = '[a"],["a]';
            $test = Zend_Json_Decoder::decode($json);
            $this->fail("Should not be able to decode '$json'");
        } catch (Exception $e) {
            // success
        }

        try {
            $expected = 010;
            $test = Zend_Json_Decoder::decode('010');
            $this->fail('Octal values are not supported in JSON notation');
        } catch (Exception $e) {
            // sucess
        }
    }

    /**
     * Tests for ZF-461
     *
     * Check to see that cycling detection works properly
     */
    public function testZf461()
    {
        $item1 = new Zend_JsonTest_Item() ;
        $item2 = new Zend_JsonTest_Item() ;
        $everything = [] ;
        $everything['allItems'] = [$item1, $item2] ;
        $everything['currentItem'] = $item1 ;

        try {
            $encoded = Zend_Json_Encoder::encode($everything);
        } catch (Exception $e) {
            $this->fail('Object cycling checks should check for recursion, not duplicate usage of an item');
        }

        try {
            $encoded = Zend_Json_Encoder::encode($everything, true);
            $this->fail('Object cycling not allowed when cycleCheck parameter is true');
        } catch (Exception $e) {
            // success
        }
    }

    /**
     * Test for ZF-4053
     *
     * Check to see that cyclical exceptions are silenced when
     * $option['silenceCyclicalExceptions'] = true is used
     */
    public function testZf4053()
    {
        $item1 = new Zend_JsonTest_Item() ;
        $item2 = new Zend_JsonTest_Item() ;
        $everything = [] ;
        $everything['allItems'] = [$item1, $item2] ;
        $everything['currentItem'] = $item1 ;

        $options = ['silenceCyclicalExceptions'=>true];

        Zend_Json::$useBuiltinEncoderDecoder = true;
        $encoded = Zend_Json::encode($everything, true, $options);
        $json = '{"allItems":[{"__className":"Zend_JsonTest_Item"},{"__className":"Zend_JsonTest_Item"}],"currentItem":"* RECURSION (Zend_JsonTest_Item) *"}';

        $this->assertEquals($encoded,$json);
    }

    public function testEncodeObject()
    {
        $actual  = new Zend_JsonTest_Object();
        $encoded = Zend_Json_Encoder::encode($actual);
        $decoded = Zend_Json_Decoder::decode($encoded, Zend_Json::TYPE_OBJECT);

        $this->assertTrue(isset($decoded->__className));
        $this->assertEquals('Zend_JsonTest_Object', $decoded->__className);
        $this->assertTrue(isset($decoded->foo));
        $this->assertEquals('bar', $decoded->foo);
        $this->assertTrue(isset($decoded->bar));
        $this->assertEquals('baz', $decoded->bar);
        $this->assertFalse(isset($decoded->_foo));
    }

    public function testEncodeClass()
    {
        $encoded = Zend_Json_Encoder::encodeClass('Zend_JsonTest_Object');

        $this->assertContains("Class.create('Zend_JsonTest_Object'", $encoded);
        $this->assertContains("ZAjaxEngine.invokeRemoteMethod(this, 'foo'", $encoded);
        $this->assertContains("ZAjaxEngine.invokeRemoteMethod(this, 'bar'", $encoded);
        $this->assertNotContains("ZAjaxEngine.invokeRemoteMethod(this, 'baz'", $encoded);

        $this->assertContains('variables:{foo:"bar",bar:"baz"}', $encoded);
        $this->assertContains('constants : {FOO: "bar"}', $encoded);
    }

    public function testEncodeClasses()
    {
        $encoded = Zend_Json_Encoder::encodeClasses(['Zend_JsonTest_Object', 'Zend_JsonTest']);

        $this->assertContains("Class.create('Zend_JsonTest_Object'", $encoded);
        $this->assertContains("Class.create('Zend_JsonTest'", $encoded);
    }

    public function testToJsonSerialization()
    {
        $toJsonObject = new ToJsonClass();

        $result = Zend_Json::encode($toJsonObject);

        $this->assertEquals('{"firstName":"John","lastName":"Doe","email":"john@doe.com"}', $result);
    }

     /**
     * test encoding array with Zend_Json_Expr
     *
     * @group ZF-4946
     */
    public function testEncodingArrayWithExpr()
    {
        $expr = new Zend_Json_Expr('window.alert("Zend Json Expr")');
        $array = ['expr'=>$expr, 'int'=>9, 'string'=>'text'];
        $result = Zend_Json::encode($array, false, ['enableJsonExprFinder' => true]);
        $expected = '{"expr":window.alert("Zend Json Expr"),"int":9,"string":"text"}';
        $this->assertEquals($expected, $result);
    }

    /**
     * test encoding object with Zend_Json_Expr
     *
     * @group ZF-4946
     */
    public function testEncodingObjectWithExprAndInternalEncoder()
    {
        Zend_Json::$useBuiltinEncoderDecoder = true;

        $expr = new Zend_Json_Expr('window.alert("Zend Json Expr")');
        $obj = new stdClass();
        $obj->expr = $expr;
        $obj->int = 9;
        $obj->string = 'text';
        $result = Zend_Json::encode($obj, false, ['enableJsonExprFinder' => true]);
        $expected = '{"__className":"stdClass","expr":window.alert("Zend Json Expr"),"int":9,"string":"text"}';
        $this->assertEquals($expected, $result);
    }

    /**
     * test encoding object with Zend_Json_Expr
     *
     * @group ZF-4946
     */
    public function testEncodingObjectWithExprAndExtJson()
    {
        if(!function_exists('json_encode')) {
            $this->markTestSkipped('Test only works with ext/json enabled!');
        }

        Zend_Json::$useBuiltinEncoderDecoder = false;

        $expr = new Zend_Json_Expr('window.alert("Zend Json Expr")');
        $obj = new stdClass();
        $obj->expr = $expr;
        $obj->int = 9;
        $obj->string = 'text';
        $result = Zend_Json::encode($obj, false, ['enableJsonExprFinder' => true]);
        $expected = '{"expr":window.alert("Zend Json Expr"),"int":9,"string":"text"}';
        $this->assertEquals($expected, $result);
    }

    /**
     * test encoding object with ToJson and Zend_Json_Expr
     *
     * @group ZF-4946
     */
    public function testToJsonWithExpr()
    {
        Zend_Json::$useBuiltinEncoderDecoder = true;

        $obj = new Zend_Json_ToJsonWithExpr();
        $result = Zend_Json::encode($obj, false, ['enableJsonExprFinder' => true]);
        $expected = '{"expr":window.alert("Zend Json Expr"),"int":9,"string":"text"}';
        $this->assertEquals($expected, $result);
    }

    /**
     * Regression tests for Zend_Json_Expr and mutliple keys with the same name.
     *
     * @group ZF-4946
     */
    public function testEncodingMultipleNestedSwitchingSameNameKeysWithDifferentJsonExprSettings()
    {
        $data = [
            0 => [
                "alpha" => new Zend_Json_Expr("function(){}"),
                "beta"  => "gamma",
            ],
            1 => [
                "alpha" => "gamma",
                "beta"  => new Zend_Json_Expr("function(){}"),
            ],
            2 => [
                "alpha" => "gamma",
                "beta" => "gamma",
            ]
        ];
        $result = Zend_Json::encode($data, false, ['enableJsonExprFinder' => true]);

        $this->assertEquals(
            '[{"alpha":function(){},"beta":"gamma"},{"alpha":"gamma","beta":function(){}},{"alpha":"gamma","beta":"gamma"}]',
            $result
        );
    }

    /**
     * Regression tests for Zend_Json_Expr and mutliple keys with the same name.
     *
     * @group ZF-4946
     */
    public function testEncodingMultipleNestedIteratedSameNameKeysWithDifferentJsonExprSettings()
    {
        $data = [
            0 => [
                "alpha" => "alpha"
            ],
            1 => [
                "alpha" => "beta",
            ],
            2 => [
                "alpha" => new Zend_Json_Expr("gamma"),
            ],
            3 => [
                "alpha" => "delta",
            ],
            4 => [
                "alpha" => new Zend_Json_Expr("epsilon"),
            ]
        ];
        $result = Zend_Json::encode($data, false, ['enableJsonExprFinder' => true]);

        $this->assertEquals('[{"alpha":"alpha"},{"alpha":"beta"},{"alpha":gamma},{"alpha":"delta"},{"alpha":epsilon}]', $result);
    }

    public function testDisabledJsonExprFinder()
    {
        Zend_Json::$useBuiltinEncoderDecoder = true;

        $data = [
            0 => [
                "alpha" => new Zend_Json_Expr("function(){}"),
                "beta"  => "gamma",
            ],
        ];
        $result = Zend_Json::encode($data);

        $this->assertEquals(
            '[{"alpha":{"__className":"Zend_Json_Expr"},"beta":"gamma"}]',
            $result
        );
    }

    /**
     * @group ZF-4054
     */
    public function testEncodeWithUtf8IsTransformedToPackedSyntax()
    {
        $data = ["Отмена"];
        $result = Zend_Json_Encoder::encode($data);

        $this->assertEquals('["\u041e\u0442\u043c\u0435\u043d\u0430"]', $result);
    }

    /**
     * @group ZF-4054
     *
     * This test contains assertions from the Solar Framework by Paul M. Jones
     * @link http://solarphp.com
     */
    public function testEncodeWithUtf8IsTransformedSolarRegression()
    {
        $expect = '"h\u00c3\u00a9ll\u00c3\u00b6 w\u00c3\u00b8r\u00c5\u201ad"';
        $this->assertEquals($expect,           Zend_Json_Encoder::encode('hÃ©llÃ¶ wÃ¸rÅ‚d'));
        $this->assertEquals('hÃ©llÃ¶ wÃ¸rÅ‚d', Zend_Json_Decoder::decode($expect));

        $expect = '"\u0440\u0443\u0441\u0441\u0438\u0448"';
        $this->assertEquals($expect,  Zend_Json_Encoder::encode("руссиш"));
        $this->assertEquals("руссиш", Zend_Json_Decoder::decode($expect));
    }

    /**
     * @group ZF-4054
     */
    public function testEncodeUnicodeStringSolarRegression()
    {
        $value    = 'hÃ©llÃ¶ wÃ¸rÅ‚d';
        $expected = 'h\u00c3\u00a9ll\u00c3\u00b6 w\u00c3\u00b8r\u00c5\u201ad';
        $this->assertEquals($expected, Zend_Json_Encoder::encodeUnicodeString($value));

        $value    = "\xC3\xA4";
        $expected = '\u00e4';
        $this->assertEquals($expected, Zend_Json_Encoder::encodeUnicodeString($value));

        $value    = "\xE1\x82\xA0\xE1\x82\xA8";
        $expected = '\u10a0\u10a8';
        $this->assertEquals($expected, Zend_Json_Encoder::encodeUnicodeString($value));
    }

    /**
     * @group ZF-4054
     */
    public function testDecodeUnicodeStringSolarRegression()
    {
        $expected = 'hÃ©llÃ¶ wÃ¸rÅ‚d';
        $value    = 'h\u00c3\u00a9ll\u00c3\u00b6 w\u00c3\u00b8r\u00c5\u201ad';
        $this->assertEquals($expected, Zend_Json_Decoder::decodeUnicodeString($value));

        $expected = "\xC3\xA4";
        $value    = '\u00e4';
        $this->assertEquals($expected, Zend_Json_Decoder::decodeUnicodeString($value));

        $value    = '\u10a0';
        $expected = "\xE1\x82\xA0";
        $this->assertEquals($expected, Zend_Json_Decoder::decodeUnicodeString($value));
    }

    /**
     * @group ZF-4054
     *
     * This test contains assertions from the Solar Framework by Paul M. Jones
     * @link http://solarphp.com
     */
    public function testEncodeWithUtf8IsTransformedSolarRegressionEqualsJsonExt()
    {
        if(function_exists('json_encode') == false) {
            $this->markTestSkipped('Test can only be run, when ext/json is installed.');
        }

        $this->assertEquals(
            json_encode('hÃ©llÃ¶ wÃ¸rÅ‚d'),
            Zend_Json_Encoder::encode('hÃ©llÃ¶ wÃ¸rÅ‚d')
        );

        $this->assertEquals(
            json_encode("руссиш"),
            Zend_Json_Encoder::encode("руссиш")
        );
    }

    /**
     * @group ZF-4946
     */
    public function testUtf8JsonExprFinder()
    {
        $data = ["Отмена" => new Zend_Json_Expr("foo")];

        Zend_Json::$useBuiltinEncoderDecoder = true;
        $result = Zend_Json::encode($data, false, ['enableJsonExprFinder' => true]);
        $this->assertEquals('{"\u041e\u0442\u043c\u0435\u043d\u0430":foo}', $result);
        Zend_Json::$useBuiltinEncoderDecoder = false;

        $result = Zend_Json::encode($data, false, ['enableJsonExprFinder' => true]);
        $this->assertEquals('{"\u041e\u0442\u043c\u0435\u043d\u0430":foo}', $result);
    }

    /**
     * @group ZF-4437
     */
    public function testKommaDecimalIsConvertedToCorrectJsonWithDot()
    {
        $localeInfo = localeconv();
        if($localeInfo['decimal_point'] != ",") {
            $this->markTestSkipped("This test only works for platforms where , is the decimal point separator.");
        }

        Zend_Json::$useBuiltinEncoderDecoder = true;
        $this->assertEquals("[1.20, 1.68]", Zend_Json_Encoder::encode([
            (float)"1,20", (float)"1,68"
        ]));
    }

    public function testEncodeObjectImplementingIterator()
    {
        $iterator = new ArrayIterator([
            'foo' => 'bar',
            'baz' => 5
        ]);
        $target = '{"__className":"ArrayIterator","foo":"bar","baz":5}';

        Zend_Json::$useBuiltinEncoderDecoder = true;
        $this->assertEquals($target, Zend_Json::encode($iterator));
    }

    /**
     * @group ZF-12347
     */
    public function testEncodeObjectImplementingIteratorAggregate()
    {
        $iterator = new ZF12347_IteratorAggregate();
        $target = '{"__className":"ZF12347_IteratorAggregate","foo":"bar","baz":5}';

        Zend_Json::$useBuiltinEncoderDecoder = true;
        $this->assertEquals($target, Zend_Json::encode($iterator));
    }


    /**
     * @group ZF-8663
     */
    public function testNativeJsonEncoderWillProperlyEncodeSolidusInStringValues()
    {
        $source = "</foo><foo>bar</foo>";
        $target = '"<\\/foo><foo>bar<\\/foo>"';

        // first test ext/json
        Zend_Json::$useBuiltinEncoderDecoder = false;
        $this->assertEquals($target, Zend_Json::encode($source));
    }

    /**
     * @group ZF-8663
     */
    public function testBuiltinJsonEncoderWillProperlyEncodeSolidusInStringValues()
    {
        $source = "</foo><foo>bar</foo>";
        $target = '"<\\/foo><foo>bar<\\/foo>"';

        // first test ext/json
        Zend_Json::$useBuiltinEncoderDecoder = true;
        $this->assertEquals($target, Zend_Json::encode($source));
    }

    /**
     * @group ZF-8918
     * @expectedException Zend_Json_Exception
     */
    public function testDecodingInvalidJsonShouldRaiseAnException()
    {
        Zend_Json::decode(' some string ');
    }

    /**
     * @group ZF-9416
     * Encoding an iterator using the internal encoder should handle undefined keys
     */
    public function testIteratorWithoutDefinedKey()
    {
        $inputValue = new ArrayIterator(['foo']);
        $encoded = Zend_Json_Encoder::encode($inputValue);
        $expectedDecoding = '{"__className":"ArrayIterator","0":"foo"}';
        $this->assertEquals($encoded, $expectedDecoding);
    }
    
    /**
     * @group ZF-11356
     */
    public function testEncoderEscapesNamespacedClassNamesProperly()
    {
        if (version_compare(PHP_VERSION, '5.3.0') === -1) {
            $this->markTestSkipped('Namespaces not available in PHP < 5.3.0');
        }
        
        require_once dirname(__FILE__ ) . "/Json/_files/ZF11356-NamespacedClass.php";        
        $className = '\Zend\JsonTest\ZF11356\NamespacedClass';
        $inputValue = new $className(['foo']);
        
        $encoded = Zend_Json_Encoder::encode($inputValue);
        $this->assertEquals(
            '{"__className":"Zend\\\\JsonTest\\\\ZF11356\\\\NamespacedClass","0":"foo"}',
            $encoded
        );
    }

    /**
     * @group ZF-9577
     */
    public function testJsonPrettyPrintWorksWithTxtOutputFormat()
    {
        $o = new stdClass;
        $o->four = 4;
        $o->foo = [1,2,3];

        $jsonstr = Zend_Json::encode($o);

        $targetTxtOutput = "{\n\t\"four\":4,\n\t\"foo\":[\n\t\t1,\n\t\t2,\n\t\t3\n\t]\n}";
        $this->assertEquals($targetTxtOutput, Zend_Json::prettyPrint($jsonstr));
    }

    /**
     * @group ZF-9577
     */
    public function testJsonPrettyPrintWorksWithHtmlOutputFormat()
    {
        $o = new stdClass;
        $o->four = 4;
        $o->foo = [1,2,3];

        $jsonstr = Zend_Json::encode($o);
        $targetHtmlOutput = '{<br />&nbsp;&nbsp;&nbsp;&nbsp;"four":4,<br />&nbsp;&nbsp;&nbsp;&nbsp;"foo":[<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1,<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2,<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3<br />&nbsp;&nbsp;&nbsp;&nbsp;]<br />}';
        $this->assertEquals($targetHtmlOutput, Zend_Json::prettyPrint($jsonstr, ['format' => 'html']));
    }

    /**
     * @group ZF-11167
     */
    public function testEncodeWillUseToArrayMethodWhenAvailable()
    {
        $o = new ZF11167_ToArrayClass();
        $objJson = Zend_Json::encode($o);
        $arrJson = Zend_Json::encode($o->toArray());
        $this->assertSame($arrJson, $objJson);
    }

    /**
     * @group ZF-11167
     */
    public function testEncodeWillUseToJsonWhenBothToJsonAndToArrayMethodsAreAvailable()
    {
        $o = new ZF11167_ToArrayToJsonClass();
        $objJson = Zend_Json::encode($o);
        $this->assertEquals('"bogus"', $objJson);
        $arrJson = Zend_Json::encode($o->toArray());
        $this->assertNotSame($objJson, $arrJson);
    }

    /**
     * @group ZF-9521
     */
    public function testWillEncodeArrayOfObjectsEachWithToJsonMethod()
    {
        $array = ['one'=>new ToJsonClass()];
        $expected = '{"one":{"__className":"ToJsonClass","firstName":"John","lastName":"Doe","email":"john@doe.com"}}';

        Zend_Json::$useBuiltinEncoderDecoder = true;
        $json = Zend_Json::encode($array);
        $this->assertEquals($expected, $json);
    }
    
    /**
     * @group ZF-7586
     */
    public function testWillDecodeStructureWithEmptyKeyToObjectProperly()
    {
        Zend_Json::$useBuiltinEncoderDecoder = true;
        
        $json = '{"":"test"}';
        $object = Zend_Json::decode($json, Zend_Json::TYPE_OBJECT);
        $this->assertTrue(isset($object->_empty_));
        $this->assertEquals('test', $object->_empty_);
    }

}

/**
 * Zend_JsonTest_Item: test item for use with testZf461()
 */
class Zend_JsonTest_Item
{
}

/**
 * Zend_JsonTest_Object: test class for encoding classes
 */
class Zend_JsonTest_Object
{
    const FOO = 'bar';

    public $foo = 'bar';
    public $bar = 'baz';

    protected $_foo = 'fooled you';

    public function foo($bar, $baz)
    {
    }

    public function bar($baz)
    {
    }

    protected function baz()
    {
    }
}

class ToJsonClass
{
    private $_firstName = 'John';

    private $_lastName = 'Doe';

    private $_email = 'john@doe.com';

    public function toJson()
    {
        $data = [
            'firstName' => $this->_firstName,
            'lastName'  => $this->_lastName,
            'email'     => $this->_email
        ];

        return Zend_Json::encode($data);
    }
}

/**
 * Serializable class exposing a toArray() method
 * @see ZF-11167
 */
class ZF11167_ToArrayClass
{
    private $_firstName = 'John';

    private $_lastName = 'Doe';

    private $_email = 'john@doe.com';

    public function toArray()
    {
        $data = [
            'firstName' => $this->_firstName,
            'lastName'  => $this->_lastName,
            'email'     => $this->_email
        ];
        return $data;
    }
}

/**
 * Serializable class exposing both toArray() and toJson() methods
 * @see ZF-11167
 */
class ZF11167_ToArrayToJsonClass extends ZF11167_ToArrayClass
{    
    public function toJson()
    {
        return Zend_Json::encode('bogus');
    }
}

/**
 * ISSUE  ZF-4946
 *
 */
class Zend_Json_ToJsonWithExpr
{
    private $_string = 'text';
    private $_int = 9;
    private $_expr = 'window.alert("Zend Json Expr")';

    public function toJson()
    {
        $data = [
            'expr'   => new Zend_Json_Expr($this->_expr),
            'int'    => $this->_int,
            'string' => $this->_string
        ];

        return Zend_Json::encode($data, false, ['enableJsonExprFinder' => true]);
    }
}

/**
 * @see ZF-12347
 */
class ZF12347_IteratorAggregate implements IteratorAggregate
{
    protected $array = [
        'foo' => 'bar',
        'baz' => 5
    ];

    public function getIterator() {
        return new ArrayIterator($this->array);
    }
}
