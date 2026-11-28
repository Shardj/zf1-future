<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

require_once 'Zend/Filter/Compress/Rar.php';

/**
 * @category   Zend
 * @package    Zend_Filter
 * @subpackage UnitTests
 * @group      Zend_Filter
 */
class Zend_Filter_Compress_RarTest extends TestCase
{
    protected function set_up()
    {
        if (!extension_loaded('rar')) {
            $this->markTestSkipped('This adapter needs the rar extension');
        }

        $files = [
            dirname(__FILE__) . '/../_files/zipextracted.txt',
            dirname(__FILE__) . '/../_files/_compress/Compress/First/Second/zipextracted.txt',
            dirname(__FILE__) . '/../_files/_compress/Compress/First/Second',
            dirname(__FILE__) . '/../_files/_compress/Compress/First/zipextracted.txt',
            dirname(__FILE__) . '/../_files/_compress/Compress/First',
            dirname(__FILE__) . '/../_files/_compress/Compress/zipextracted.txt',
            dirname(__FILE__) . '/../_files/_compress/Compress',
            dirname(__FILE__) . '/../_files/_compress/zipextracted.txt',
            dirname(__FILE__) . '/../_files/_compress'
        ];

        foreach ($files as $file) {
            if (file_exists($file)) {
                if (is_dir($file)) {
                    rmdir($file);
                } else {
                    unlink($file);
                }
            }
        }

        if (!file_exists(dirname(__FILE__) . '/../_files/Compress/First/Second')) {
            mkdir(dirname(__FILE__) . '/../_files/Compress/First/Second', 0777, true);
            file_put_contents(dirname(__FILE__) . '/../_files/Compress/First/Second/zipextracted.txt', 'compress me');
            file_put_contents(dirname(__FILE__) . '/../_files/Compress/First/zipextracted.txt', 'compress me');
            file_put_contents(dirname(__FILE__) . '/../_files/Compress/zipextracted.txt', 'compress me');
        }
    }

    protected function tear_down()
    {
        $files = [
            dirname(__FILE__) . '/../_files/zipextracted.txt',
            dirname(__FILE__) . '/../_files/_compress/Compress/First/Second/zipextracted.txt',
            dirname(__FILE__) . '/../_files/_compress/Compress/First/Second',
            dirname(__FILE__) . '/../_files/_compress/Compress/First/zipextracted.txt',
            dirname(__FILE__) . '/../_files/_compress/Compress/First',
            dirname(__FILE__) . '/../_files/_compress/Compress/zipextracted.txt',
            dirname(__FILE__) . '/../_files/_compress/Compress',
            dirname(__FILE__) . '/../_files/_compress/zipextracted.txt',
            dirname(__FILE__) . '/../_files/_compress'
        ];

        foreach ($files as $file) {
            if (file_exists($file)) {
                if (is_dir($file)) {
                    rmdir($file);
                } else {
                    unlink($file);
                }
            }
        }

        if (!file_exists(dirname(__FILE__) . '/../_files/Compress/First/Second')) {
            mkdir(dirname(__FILE__) . '/../_files/Compress/First/Second', 0777, true);
            file_put_contents(dirname(__FILE__) . '/../_files/Compress/First/Second/zipextracted.txt', 'compress me');
            file_put_contents(dirname(__FILE__) . '/../_files/Compress/First/zipextracted.txt', 'compress me');
            file_put_contents(dirname(__FILE__) . '/../_files/Compress/zipextracted.txt', 'compress me');
        }
    }

    /**
     * Basic usage
     *
     * @return void
     */
    public function testBasicUsage()
    {
        $filter = new Zend_Filter_Compress_Rar(
            [
                'archive' => dirname(__FILE__) . '/../_files/compressed.rar',
                'target' => dirname(__FILE__) . '/../_files/zipextracted.txt',
                'callback' => ['Zend_Filter_Compress_RarTest', 'rarCompress']
            ]
        );

        $content = $filter->compress('compress me');
        $this->assertEquals(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_files'
                            . DIRECTORY_SEPARATOR . 'compressed.rar', $content);

        $content = $filter->decompress($content);
        $this->assertEquals(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR, $content);
        $content = file_get_contents(dirname(__FILE__) . '/../_files/zipextracted.txt');
        $this->assertEquals('compress me', $content);
    }

    /**
     * Setting Options
     *
     * @return void
     */
    public function testRarGetSetOptions()
    {
        $filter = new Zend_Filter_Compress_Rar();
        $this->assertEquals(
            [
                'archive' => null,
                'callback' => null,
                'password' => null,
                'target' => '.',
            ],
            $filter->getOptions()
        );

        $this->assertEquals(null, $filter->getOptions('archive'));

        $this->assertNull($filter->getOptions('nooption'));
        $filter->setOptions(['nooption' => 'foo']);
        $this->assertNull($filter->getOptions('nooption'));

        $filter->setOptions(['archive' => 'temp.txt']);
        $this->assertEquals('temp.txt', $filter->getOptions('archive'));
    }

    /**
     * Setting Archive
     *
     * @return void
     */
    public function testRarGetSetArchive()
    {
        $filter = new Zend_Filter_Compress_Rar();
        $this->assertEquals(null, $filter->getArchive());
        $filter->setArchive('Testfile.txt');
        $this->assertEquals('Testfile.txt', $filter->getArchive());
        $this->assertEquals('Testfile.txt', $filter->getOptions('archive'));
    }

    /**
     * Setting Password
     *
     * @return void
     */
    public function testRarGetSetPassword()
    {
        $filter = new Zend_Filter_Compress_Rar();
        $this->assertEquals(null, $filter->getPassword());
        $filter->setPassword('test');
        $this->assertEquals('test', $filter->getPassword());
        $this->assertEquals('test', $filter->getOptions('password'));
        $filter->setOptions(['password' => 'test2']);
        $this->assertEquals('test2', $filter->getPassword());
        $this->assertEquals('test2', $filter->getOptions('password'));
    }

    /**
     * Setting Target
     *
     * @return void
     */
    public function testRarGetSetTarget()
    {
        $filter = new Zend_Filter_Compress_Rar();
        $this->assertEquals('.', $filter->getTarget());
        $filter->setTarget('Testfile.txt');
        $this->assertEquals('Testfile.txt', $filter->getTarget());
        $this->assertEquals('Testfile.txt', $filter->getOptions('target'));

        try {
            $filter->setTarget('/unknown/path/to/file.txt');
            $this->fails('Exception expected');
        } catch (Zend_Filter_Exception $e) {
            $this->assertStringContainsString('does not exist', $e->getMessage());
        }
    }

    /**
     * Setting Callback
     *
     * @return void
     */
    public function testSettingCallback()
    {
        $filter = new Zend_Filter_Compress_Rar();

        try {
            $filter->compress('test.txt');
            $this->fails('Exception expected');
        } catch (Exception $e) {
            $this->assertStringContainsString('No compression callback', $e->getMessage());
        }

        try {
            $filter->setCallback('invalidCallback');
            $this->fails('Exception expected');
        } catch (Exception $e) {
            $this->assertStringContainsString('Callback can not be accessed', $e->getMessage());
        }

        $callback = ['Zend_Filter_Compress_RarTest', 'rarCompress'];
        $filter->setCallback($callback);
        $this->assertEquals($callback, $filter->getCallback());
    }

    /**
     * Compress to Archive
     *
     * @return void
     */
    public function testRarCompressFile()
    {
        $filter = new Zend_Filter_Compress_Rar(
            [
                'archive' => dirname(__FILE__) . '/../_files/compressed.rar',
                'target' => dirname(__FILE__) . '/../_files/zipextracted.txt',
                'callback' => ['Zend_Filter_Compress_RarTest', 'rarCompress']
            ]
        );
        file_put_contents(dirname(__FILE__) . '/../_files/zipextracted.txt', 'compress me');

        $content = $filter->compress(dirname(__FILE__) . '/../_files/zipextracted.txt');
        $this->assertEquals(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_files'
                            . DIRECTORY_SEPARATOR . 'compressed.rar', $content);

        $content = $filter->decompress($content);
        $this->assertEquals(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'
                            . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR, $content);
        $content = file_get_contents(dirname(__FILE__) . '/../_files/zipextracted.txt');
        $this->assertEquals('compress me', $content);
    }

    /**
     * Compress directory to Filename
     *
     * @return void
     */
    public function testRarCompressDirectory()
    {
        $filter = new Zend_Filter_Compress_Rar(
            [
                'archive' => dirname(__FILE__) . '/../_files/compressed.rar',
                'target' => dirname(__FILE__) . '/../_files/_compress',
                'callback' => ['Zend_Filter_Compress_RarTest', 'rarCompress']
            ]
        );
        $content = $filter->compress(dirname(__FILE__) . '/../_files/Compress');
        $this->assertEquals(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_files'
                            . DIRECTORY_SEPARATOR . 'compressed.rar', $content);

        mkdir(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . '_compress');
        $content = $filter->decompress($content);
        $this->assertEquals(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'
                            . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . '_compress'
                            . DIRECTORY_SEPARATOR, $content);

        $base = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '_files'
              . DIRECTORY_SEPARATOR . '_compress' . DIRECTORY_SEPARATOR . 'Compress' . DIRECTORY_SEPARATOR;
        $this->assertTrue(file_exists($base));
        $this->assertTrue(file_exists($base . 'zipextracted.txt'));
        $this->assertTrue(file_exists($base . 'First' . DIRECTORY_SEPARATOR . 'zipextracted.txt'));
        $this->assertTrue(file_exists($base . 'First' . DIRECTORY_SEPARATOR .
                          'Second' . DIRECTORY_SEPARATOR . 'zipextracted.txt'));
        $content = file_get_contents(dirname(__FILE__) . '/../_files/Compress/zipextracted.txt');
        $this->assertEquals('compress me', $content);
    }

    /**
     * testing toString
     *
     * @return void
     */
    public function testRarToString()
    {
        $filter = new Zend_Filter_Compress_Rar();
        $this->assertEquals('Rar', $filter->toString());
    }

    /**
     * Test callback for compression
     *
     * @return bool
     */
    public static function rarCompress()
    {
        return true;
    }
}
