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
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Log_Formatter_XmlTest::main');
}

/** Zend_Log_Formatter_Xml */
require_once 'Zend/Log/Formatter/Xml.php';

/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Log
 */
class Zend_Log_Formatter_XmlTest extends PHPUnit_Framework_TestCase
{
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite(__CLASS__);
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function testDefaultFormat()
    {
        $f = new Zend_Log_Formatter_Xml();
        $line = $f->format(['message' => 'foo', 'priority' => 42]);

        $this->assertContains('foo', $line);
        $this->assertContains((string)42, $line);
    }

    public function testConfiguringElementMapping()
    {
        $f = new Zend_Log_Formatter_Xml('log', ['foo' => 'bar']);
        $line = $f->format(['bar' => 'baz']);
        $this->assertContains('<log><foo>baz</foo></log>', $line);
    }

    public function testXmlDeclarationIsStripped()
    {
        $f = new Zend_Log_Formatter_Xml();
        $line = $f->format(['message' => 'foo', 'priority' => 42]);

        $this->assertNotContains('<\?xml version=', $line);
    }

    public function testXmlValidates()
    {
        $f = new Zend_Log_Formatter_Xml();
        $line = $f->format(['message' => 'foo', 'priority' => 42]);

        $sxml = @simplexml_load_string($line);
        $this->assertTrue($sxml instanceof SimpleXMLElement, 'Formatted XML is invalid');
    }

    /**
     * @group ZF-2062
     * @group ZF-4190
     */
    public function testHtmlSpecialCharsInMessageGetEscapedForValidXml()
    {
        $f = new Zend_Log_Formatter_Xml();
        $line = $f->format(['message' => '&key1=value1&key2=value2', 'priority' => 42]);

        $this->assertContains("&amp;", $line);
        $this->assertTrue(substr_count($line, "&amp;") == 2);
    }

    /**
     * @group ZF-2062
     * @group ZF-4190
     */
    public function testFixingBrokenCharsSoXmlIsValid()
    {
        $f = new Zend_Log_Formatter_Xml();
        $line = $f->format(['message' => '&amp', 'priority' => 42]);

        $this->assertContains('&amp;amp', $line);
    }

    public function testConstructorWithArray()
    {
        $options = [
            'rootElement' => 'log',
            'elementMap' => [
                'word' => 'message',
                'priority' => 'priority'
            ]
        ];
        $event = [
            'message' => 'tottakai',
            'priority' => 4
        ];
        $expected = '<log><word>tottakai</word><priority>4</priority></log>';

        $formatter = new Zend_Log_Formatter_Xml($options);
        $output = $formatter->format($event);
        $this->assertContains($expected, $output);
        $this->assertEquals('UTF-8', $formatter->getEncoding());
    }

    /**
     * @group ZF-9176
     */
    public function testFactory()
    {
        $options = [
            'rootElement' => 'log',
            'elementMap' => [
                'timestamp' => 'timestamp',
                'response' => 'message'
            ]
        ];
        $formatter = Zend_Log_Formatter_Xml::factory($options);
        $this->assertTrue($formatter instanceof Zend_Log_Formatter_Xml);
    }
    
    /**
     * @group ZF-11161
     */
    public function testNonScalarValuesAreExcludedFromFormattedString()
    {
        $options = [
            'rootElement' => 'log'
        ];
        $event = [
            'message' => 'tottakai',
            'priority' => 4,
            'context' => ['test'=>'one'],
            'reference' => new Zend_Log_Formatter_Xml()
        ];
        $expected = '<log><message>tottakai</message><priority>4</priority></log>';

        $formatter = new Zend_Log_Formatter_Xml($options);
        $output = $formatter->format($event);
        $this->assertContains($expected, $output);
    }
    
    /**
     * @group ZF-11161
     */
    public function testObjectsWithStringSerializationAreIncludedInFormattedString()
    {
        $options = [
            'rootElement' => 'log'
        ];
        $event = [
            'message' => 'tottakai',
            'priority' => 4,
            'context' => ['test'=>'one'],
            'reference' => new Zend_Log_Formatter_XmlTest_SerializableObject()
        ];
        $expected = '<log><message>tottakai</message><priority>4</priority><reference>Zend_Log_Formatter_XmlTest_SerializableObject</reference></log>';

        $formatter = new Zend_Log_Formatter_Xml($options);
        $output = $formatter->format($event);
        $this->assertContains($expected, $output);
    }
}

class Zend_Log_Formatter_XmlTest_SerializableObject
{
    public function __toString()
    {
        return __CLASS__;
    }
}

if (PHPUnit_MAIN_METHOD == 'Zend_Log_Formatter_XmlTest::main') {
    Zend_Log_Formatter_XmlTest::main();
}
