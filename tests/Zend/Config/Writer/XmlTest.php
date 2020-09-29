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
 * @package    Zend_Config
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Config
 */
require_once 'Zend/Config.php';

/**
 * Zend_Config_Xml
 */
require_once 'Zend/Config/Xml.php';

/**
 * Zend_Config_Writer_Xml
 */
require_once 'Zend/Config/Writer/Xml.php';

/**
 * @category   Zend
 * @package    Zend_Config
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Config
 */
class Zend_Config_Writer_XmlTest extends PHPUnit_Framework_TestCase
{
    protected $_tempName;

    public function setUp()
    {
        $this->_tempName = tempnam(dirname(__FILE__) . '/temp', 'tmp');
    }

    public function tearDown()
    {
        @unlink($this->_tempName);
    }

    public function testNoFilenameSet()
    {
        $writer = new Zend_Config_Writer_Xml(['config' => new Zend_Config([])]);

        try {
            $writer->write();
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('No filename was set', $expected->getMessage());
        }
    }

    public function testNoConfigSet()
    {
        $writer = new Zend_Config_Writer_Xml(['filename' => $this->_tempName]);

        try {
            $writer->write();
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('No config was set', $expected->getMessage());
        }
    }

    public function testFileNotWritable()
    {
        $writer = new Zend_Config_Writer_Xml(['config' => new Zend_Config([]), 'filename' => '/../../../']);

        try {
            $writer->write();
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('Could not write to file', $expected->getMessage());
        }
    }

    public function testWriteAndRead()
    {
        $config = new Zend_Config(['default' => ['test' => 'foo']]);

        $writer = new Zend_Config_Writer_Xml(['config' => $config, 'filename' => $this->_tempName]);
        $writer->write();

        $config = new Zend_Config_Xml($this->_tempName, null);

        $this->assertEquals('foo', $config->default->test);
    }

    public function testNoSection()
    {
        $config = new Zend_Config(['test' => 'foo', 'test2' => ['test3' => 'bar']]);

        $writer = new Zend_Config_Writer_Xml(['config' => $config, 'filename' => $this->_tempName]);
        $writer->write();

        $config = new Zend_Config_Xml($this->_tempName, null);

        $this->assertEquals('foo', $config->test);
        $this->assertEquals('bar', $config->test2->test3);
    }

    public function testWriteAndReadOriginalFile()
    {
        $config = new Zend_Config_Xml(dirname(__FILE__) . '/files/allsections.xml', null, ['skipExtends' => true]);

        $writer = new Zend_Config_Writer_Xml(['config' => $config, 'filename' => $this->_tempName]);
        $writer->write();

        $config = new Zend_Config_Xml($this->_tempName, null);
        $this->assertEquals('multi', $config->staging->one->two->three);

        $config = new Zend_Config_Xml($this->_tempName, null, ['skipExtends' => true]);
        $this->assertFalse(isset($config->staging->one));
    }

    public function testWriteAndReadSingleSection()
    {
        $config = new Zend_Config_Xml(dirname(__FILE__) . '/files/allsections.xml', 'staging', ['skipExtends' => true]);

        $writer = new Zend_Config_Writer_Xml(['config' => $config, 'filename' => $this->_tempName]);
        $writer->write();

        $config = new Zend_Config_Xml($this->_tempName, null);

        $this->assertEquals('staging', $config->staging->hostname);
        $this->assertEquals('false', $config->staging->debug);
        $this->assertEquals(null, @$config->production);
    }

    /**
     * @group ZF-6773
     */
    public function testWriteMultidimensionalArrayWithNumericKeys()
    {
        $writer = new Zend_Config_Writer_Xml;
        $writer->write($this->_tempName, new Zend_Config([
            'notification' => [
                'adress' => [
                    0 => [
                        'name' => 'Matthew',
                        'mail' => 'matthew@example.com'
                    ],
                    1 => [
                        'name' => 'Thomas',
                        'mail' => 'thomas@example.com'
                    ]
                ]
            ]
        ]));
    }

    public function testNumericArray()
    {
        $config = new Zend_Config(['foo' => ['bar' => [1 => 'a', 2 => 'b', 5 => 'c']]]);

        $writer = new Zend_Config_Writer_Xml(['config' => $config, 'filename' => $this->_tempName]);
        $writer->write();

        $config = new Zend_Config_Xml($this->_tempName, null);

        $this->assertEquals('a', $config->foo->bar->{0});
        $this->assertEquals('b', $config->foo->bar->{1});
        $this->assertEquals('c', $config->foo->bar->{2});
    }

    public function testMixedArrayFailure()
    {
        $config = new Zend_Config(['foo' => ['bar' => ['a', 'b', 'c' => 'd']]]);

        try {
            $writer = new Zend_Config_Writer_Xml(['config' => $config, 'filename' => $this->_tempName]);
            $writer->write();
            $this->fail('Expected Zend_Config_Exception not raised');
        } catch (Zend_Config_Exception $e) {
            $this->assertEquals('Mixing of string and numeric keys is not allowed', $e->getMessage());
        }
    }

    public function testArgumentOverride()
    {
        $config = new Zend_Config(['default' => ['test' => 'foo']]);

        $writer = new Zend_Config_Writer_Xml();
        $writer->write($this->_tempName, $config);

        $config = new Zend_Config_Xml($this->_tempName, null);

        $this->assertEquals('foo', $config->default->test);
    }

    /**
     * @group ZF-8234
     */
    public function testRender()
    {
        $config = new Zend_Config(['test' => 'foo', 'bar' => [0 => 'baz', 1 => 'foo']]);

        $writer = new Zend_Config_Writer_Xml();
        $configString = $writer->setConfig($config)->render();

        $expected = <<<ECS
<?xml version="1.0"?>
<zend-config xmlns:zf="http://framework.zend.com/xml/zend-config-xml/1.0/">
  <test>foo</test>
  <bar>baz</bar>
  <bar>foo</bar>
</zend-config>

ECS;

        $this->assertEquals($expected, $configString);
    }
}
