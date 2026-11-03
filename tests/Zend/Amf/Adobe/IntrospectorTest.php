<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;
use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\TestRunner;

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
 * @package    Zend_Amf
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Controller_Action_Helper_MultiPageFormTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Amf_Adobe_IntrospectorTest::main");
}

/**
 * @see Zend_Amf_Adobe_Introspector
 */
require_once 'Zend/Amf/Adobe/Introspector.php';

/**
 * @category   Zend
 * @package    Zend_Amf
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Amf
 */
class Zend_Amf_Adobe_IntrospectorTest extends TestCase
{
    /**
     * @var \Zend_Amf_Adobe_Introspector|mixed
     */
    protected $introspector;

    public static function main()
    {
        $suite = new TestSuite(__CLASS__);
        (new resources_Runner())->run($suite);
    }

    protected function set_up()
    {
        $this->introspector = new Zend_Amf_Adobe_Introspector();
    }

    public function testIntrospectionDoesNotIncludeConstructor()
    {
        $xml = $this->introspector->introspect('com.zend.framework.IntrospectorTest');
        $this->assertStringNotContainsString('__construct', $xml);
    }

    public function testIntrospectionDoesNotIncludeMagicMethods()
    {
        $xml = $this->introspector->introspect('com.zend.framework.IntrospectorTest');
        $this->assertStringNotContainsString('__get', $xml);
    }

    public function testIntrospectionContainsPublicPropertiesOfReturnClassTypes()
    {
        $xml = $this->introspector->introspect('com.zend.framework.IntrospectorTest');
        $this->assertMatchesRegularExpression('/<type[^>]*(name="com_zend_framework_IntrospectorTestCustomType")/', $xml, $xml);
        $this->assertMatchesRegularExpression('/<property[^>]*(name="foo")/', $xml, $xml);
        $this->assertMatchesRegularExpression('/<property[^>]*(type="string")/', $xml, $xml);
    }

    public function testIntrospectionDoesNotContainNonPublicPropertiesOfReturnClassTypes()
    {
        $xml = $this->introspector->introspect('com.zend.framework.IntrospectorTest');
        $this->assertDoesNotMatchRegularExpression('/<property[^>]*(name="_bar")/', $xml, $xml);
    }

    public function testIntrospectionContainsPublicMethods()
    {
        $xml = $this->introspector->introspect('com.zend.framework.IntrospectorTest');
        $this->assertMatchesRegularExpression('/<operation[^>]*(name="foobar")/', $xml, $xml);
        $this->assertMatchesRegularExpression('/<operation[^>]*(name="barbaz")/', $xml, $xml);
        $this->assertMatchesRegularExpression('/<operation[^>]*(name="bazbat")/', $xml, $xml);
    }

    public function testIntrospectionContainsOperationForEachPrototypeOfAPublicMethod()
    {
        $xml = $this->introspector->introspect('com.zend.framework.IntrospectorTest');
        $this->assertEquals(4, substr_count($xml, 'name="foobar"'));
        $this->assertEquals(1, substr_count($xml, 'name="barbaz"'));
        $this->assertEquals(1, substr_count($xml, 'name="bazbat"'));
    }

    public function testPassingDirectoriesOptionShouldResolveServiceClassAndType()
    {
        require_once dirname(__FILE__) . '/_files/ZendAmfAdobeIntrospectorTestType.php';
        $xml = $this->introspector->introspect('ZendAmfAdobeIntrospectorTest', [
            'directories' => [dirname(__FILE__) . '/_files'],
        ]);
        $this->assertMatchesRegularExpression('/<operation[^>]*(name="foo")/', $xml, $xml);
        $this->assertMatchesRegularExpression('/<type[^>]*(name="ZendAmfAdobeIntrospectorTestType")/', $xml, $xml);
        $this->assertMatchesRegularExpression('/<property[^>]*(name="bar")/', $xml, $xml);
    }

    public function testMissingPropertyDocblockInTypedClassShouldReportTypeAsUnknown()
    {
        $xml = $this->introspector->introspect('com.zend.framework.IntrospectorTest');
        if (!preg_match('/(<property[^>]*(name="baz")[^>]*>)/', $xml, $matches)) {
            $this->fail('Baz property of com.zend.framework.IntrospectorTestCustomType not found');
        }
        $node = $matches[1];
        $this->assertStringContainsString('type="Unknown"', $node, $node);
    }

    public function testPropertyDocblockWithoutAnnotationInTypedClassShouldReportTypeAsUnknown()
    {
        $xml = $this->introspector->introspect('com.zend.framework.IntrospectorTest');
        if (!preg_match('/(<property[^>]*(name="bat")[^>]*>)/', $xml, $matches)) {
            $this->fail('Bat property of com.zend.framework.IntrospectorTestCustomType not found');
        }
        $node = $matches[1];
        $this->assertStringContainsString('type="Unknown"', $node, $node);
    }

    public function testTypedClassWithExplicitTypeShouldReportAsThatType()
    {
        $xml = $this->introspector->introspect('com.zend.framework.IntrospectorTest');
        $this->assertMatchesRegularExpression('/<type[^>]*(name="explicit")/', $xml, $xml);
    }

    /**
     * @group ZF-10365
     */
    public function testArgumentsWithArrayTypeHintsReflectedInReturnedXml()
    {
        require_once dirname(__FILE__) . '/TestAsset/ParameterHints.php';
        $xml = $this->introspector->introspect('Zend.Amf.Adobe.TestAsset.ParameterHints');
        $this->assertMatchesRegularExpression('/<argument[^>]*(name="arg1")[^>]*(type="Unknown\[\]")/', $xml, $xml);
        $this->assertMatchesRegularExpression('/<argument[^>]*(name="arg2")[^>]*(type="Unknown\[\]")/', $xml, $xml);
    }
}

class com_zend_framework_IntrospectorTest
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Overloading: get properties
     *
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        $prop = '_' . $name;
        if (!isset($this->$prop)) {
            return null;
        }
        return $this->$prop;
    }

    /**
     * Foobar
     *
     * @param  string|int $arg
     * @return void
     */
    public function foobar($arg)
    {
    }

    /**
     * Barbaz
     *
     * @param  com_zend_framework_IntrospectorTestCustomType $arg
     * @return void
     */
    public function barbaz($arg)
    {
    }

    /**
     * Bazbat
     *
     * @return void
     */
    public function bazbat()
    {
    }
}

class com_zend_framework_IntrospectorTestCustomType
{
    /**
     * @var string
     */
    public $foo;

    public $baz;

    /**
     * Docblock without an annotation
     */
    public $bat;

    /**
     * @var bool
     */
    protected $_bar;
}

class com_zend_framework_IntrospectorTestExplicitType
{
    public $_explicitType = 'explicit';
}


// Call Zend_Amf_Adobe_IntrospectorTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_Amf_Adobe_IntrospectorTest::main") {
    Zend_Amf_Adobe_IntrospectorTest::main();
}
