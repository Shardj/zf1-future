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
 * @package    Zend_Filter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: $
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Filter_DecompressTest::main');
}

/**
 * @see Zend_Filter_Decompress
 */
require_once 'Zend/Filter/Decompress.php';

/**
 * @category   Zend
 * @package    Zend_Filter
 * @subpackage UnitTests
 * @group      Zend_Filter
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Filter_DecompressTest extends TestCase
{
    /**
     * Runs this test suite
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite('Zend_Filter_DecompressTest');
        $result = (new resources_Runner())->run($suite);
    }

    protected function set_up()
    {
        if (!extension_loaded('bz2')) {
            $this->markTestSkipped('This filter is tested with the bz2 extension');
        }
    }

    protected function tear_down()
    {
        if (file_exists(dirname(__FILE__) . '/../_files/compressed.bz2')) {
            unlink(dirname(__FILE__) . '/../_files/compressed.bz2');
        }
    }

    /**
     * Basic usage
     *
     * @return void
     */
    public function testBasicUsage()
    {
        $filter = new Zend_Filter_Decompress('bz2');

        $text = 'compress me';
        $compressed = $filter->compress($text);
        $this->assertNotEquals($text, $compressed);

        $decompressed = $filter->filter($compressed);
        $this->assertEquals($text, $decompressed);
    }

    /**
     * Setting Archive
     *
     * @return void
     */
    public function testCompressToFile()
    {
        $filter = new Zend_Filter_Decompress('bz2');
        $archive = dirname(__FILE__) . '/../_files/compressed.bz2';
        $filter->setArchive($archive);

        $content = $filter->compress('compress me');
        $this->assertTrue($content);

        $filter2 = new Zend_Filter_Decompress('bz2');
        $content2 = $filter2->filter($archive);
        $this->assertEquals('compress me', $content2);

        $filter3 = new Zend_Filter_Decompress('bz2');
        $filter3->setArchive($archive);
        $content3 = $filter3->filter(null);
        $this->assertEquals('compress me', $content3);
    }

    /**
     * Basic usage
     *
     * @return void
     */
    public function testDecompressArchive()
    {
        $filter = new Zend_Filter_Decompress('bz2');
        $archive = dirname(__FILE__) . '/../_files/compressed.bz2';
        $filter->setArchive($archive);

        $content = $filter->compress('compress me');
        $this->assertTrue($content);

        $filter2 = new Zend_Filter_Decompress('bz2');
        $content2 = $filter2->filter($archive);
        $this->assertEquals('compress me', $content2);
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Filter_DecompressTest::main') {
    Zend_Filter_DecompressTest::main();
}
