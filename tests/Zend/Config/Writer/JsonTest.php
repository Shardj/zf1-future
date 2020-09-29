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
 * Zend_Config_Json
 */
require_once 'Zend/Config/Json.php';

/**
 * Zend_Config_Writer_Json
 */
require_once 'Zend/Config/Writer/Json.php';

/**
 * @category   Zend
 * @package    Zend_Config
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Config_Writer_JsonTest extends PHPUnit_Framework_TestCase
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
        $writer = new Zend_Config_Writer_Json(['config' => new Zend_Config([])]);

        try {
            $writer->write();
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('No filename was set', $expected->getMessage());
        }
    }

    public function testNoConfigSet()
    {
        $writer = new Zend_Config_Writer_Json(['filename' => $this->_tempName]);

        try {
            $writer->write();
            $this->fail('An expected Zend_Config_Exception has not been raised');
        } catch (Zend_Config_Exception $expected) {
            $this->assertContains('No config was set', $expected->getMessage());
        }
    }

    public function testFileNotWritable()
    {
        $writer = new Zend_Config_Writer_Json(['config' => new Zend_Config([]), 'filename' => '/../../../']);

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

        $writer = new Zend_Config_Writer_Json(['config' => $config, 'filename' => $this->_tempName]);
        $writer->write();

        $config = new Zend_Config_Json($this->_tempName, null);

        $this->assertEquals('foo', $config->default->test);
    }

    public function testNoSection()
    {
        $config = new Zend_Config(['test' => 'foo', 'test2' => ['test3' => 'bar']]);

        $writer = new Zend_Config_Writer_Json(['config' => $config, 'filename' => $this->_tempName]);
        $writer->write();

        $config = new Zend_Config_Json($this->_tempName);

        $this->assertEquals('foo', $config->test);
        $this->assertEquals('bar', $config->test2->test3);
    }

    public function testWriteAndReadOriginalFile()
    {
        $config = new Zend_Config_Json(dirname(__FILE__) . '/files/allsections.json', null, ['skip_extends' => true]);

        $writer = new Zend_Config_Writer_Json(['config' => $config, 'filename' => $this->_tempName]);
        $writer->write();

        $config = new Zend_Config_Json($this->_tempName, null);
        $this->assertEquals('multi', $config->staging->one->two->three, var_export($config->toArray(), 1));

        $config = new Zend_Config_Json($this->_tempName, null, ['skip_extends' => true]);
        $this->assertFalse(isset($config->staging->one));
    }


    public function testWriteAndReadSingleSection()
    {
        $config = new Zend_Config_Json(dirname(__FILE__) . '/files/allsections.json', 'staging', ['skip_extends' => true]);

        $writer = new Zend_Config_Writer_Json(['config' => $config, 'filename' => $this->_tempName]);
        $writer->write();

        $config = new Zend_Config_Json($this->_tempName, null);

        $this->assertEquals('staging', $config->staging->hostname);
        $this->assertEquals('', $config->staging->debug);
        $this->assertEquals(null, @$config->production);
    }

    public function testArgumentOverride()
    {
        $config = new Zend_Config(['default' => ['test' => 'foo']]);

        $writer = new Zend_Config_Writer_Json();
        $writer->write($this->_tempName, $config);

        $config = new Zend_Config_Json($this->_tempName, null);

        $this->assertEquals('foo', $config->default->test);
    }

    public function testCanWritePrettyPrintedVersion()
    {
        $config = new Zend_Config_Json(dirname(__FILE__) . '/files/allsections-pretty.json');

        $writer = new Zend_Config_Writer_Json(['config' => $config, 'filename' => $this->_tempName]);
        $writer->setPrettyPrint(true);
        $writer->write();
        $testOutput     = file_get_contents($this->_tempName);
        $this->assertRegExp('/^\s+/m', $testOutput);
    }
}
