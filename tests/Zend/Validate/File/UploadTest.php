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
 * @package    Zend_Validate_File
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Validate_File_UploadTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Validate_File_UploadTest::main");
}

/**
 * @see Zend_Validate_File_Upload
 */
require_once 'Zend/Validate/File/Upload.php';

/**
 * @category   Zend
 * @package    Zend_Validate_File
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Validate
 */
class Zend_Validate_File_UploadTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new PHPUnit_Framework_TestSuite("Zend_Validate_File_UploadTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Ensures that the validator follows expected behavior
     *
     * @return void
     */
    public function testBasic()
    {
        $_FILES = [
            'test'  => [
                'name'     => 'test1',
                'type'     => 'text',
                'size'     => 200,
                'tmp_name' => 'tmp_test1',
                'error'    => 0],
            'test2' => [
                'name'     => 'test2',
                'type'     => 'text2',
                'size'     => 202,
                'tmp_name' => 'tmp_test2',
                'error'    => 1],
            'test3' => [
                'name'     => 'test3',
                'type'     => 'text3',
                'size'     => 203,
                'tmp_name' => 'tmp_test3',
                'error'    => 2],
            'test4' => [
                'name'     => 'test4',
                'type'     => 'text4',
                'size'     => 204,
                'tmp_name' => 'tmp_test4',
                'error'    => 3],
            'test5' => [
                'name'     => 'test5',
                'type'     => 'text5',
                'size'     => 205,
                'tmp_name' => 'tmp_test5',
                'error'    => 4],
            'test6' => [
                'name'     => 'test6',
                'type'     => 'text6',
                'size'     => 206,
                'tmp_name' => 'tmp_test6',
                'error'    => 5],
            'test7' => [
                'name'     => 'test7',
                'type'     => 'text7',
                'size'     => 207,
                'tmp_name' => 'tmp_test7',
                'error'    => 6],
            'test8' => [
                'name'     => 'test8',
                'type'     => 'text8',
                'size'     => 208,
                'tmp_name' => 'tmp_test8',
                'error'    => 7],
            'test9' => [
                'name'     => 'test9',
                'type'     => 'text9',
                'size'     => 209,
                'tmp_name' => 'tmp_test9',
                'error'    => 8]
        ];

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test'));
        $this->assertTrue(array_key_exists('fileUploadErrorAttack', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test2'));
        $this->assertTrue(array_key_exists('fileUploadErrorIniSize', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test3'));
        $this->assertTrue(array_key_exists('fileUploadErrorFormSize', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test4'));
        $this->assertTrue(array_key_exists('fileUploadErrorPartial', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test5'));
        $this->assertTrue(array_key_exists('fileUploadErrorNoFile', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test6'));
        $this->assertTrue(array_key_exists('fileUploadErrorUnknown', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test7'));
        $this->assertTrue(array_key_exists('fileUploadErrorNoTmpDir', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test8'));
        $this->assertTrue(array_key_exists('fileUploadErrorCantWrite', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test9'));
        $this->assertTrue(array_key_exists('fileUploadErrorExtension', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test1'));
        $this->assertTrue(array_key_exists('fileUploadErrorAttack', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('tmp_test1'));
        $this->assertTrue(array_key_exists('fileUploadErrorAttack', $validator->getMessages()));

        $validator = new Zend_Validate_File_Upload();
        $this->assertFalse($validator->isValid('test000'));
        $this->assertTrue(array_key_exists('fileUploadErrorFileNotFound', $validator->getMessages()));
    }

    /**
     * Ensures that getFiles() returns expected value
     *
     * @return void
     */
    public function testGetFiles()
    {
        $_FILES = [
            'test'  => [
                'name'     => 'test1',
                'type'     => 'text',
                'size'     => 200,
                'tmp_name' => 'tmp_test1',
                'error'    => 0],
            'test2' => [
                'name'     => 'test3',
                'type'     => 'text2',
                'size'     => 202,
                'tmp_name' => 'tmp_test2',
                'error'    => 1]];

        $files = [
            'test'  => [
                'name'     => 'test1',
                'type'     => 'text',
                'size'     => 200,
                'tmp_name' => 'tmp_test1',
                'error'    => 0]];

        $files1 = [
            'test2' => [
                'name'     => 'test3',
                'type'     => 'text2',
                'size'     => 202,
                'tmp_name' => 'tmp_test2',
                'error'    => 1]];

        $validator = new Zend_Validate_File_Upload();
        $this->assertEquals($files, $validator->getFiles('test'));
        $this->assertEquals($files, $validator->getFiles('test1'));
        $this->assertEquals($files1, $validator->getFiles('test3'));

        try {
            $this->assertEquals([], $validator->getFiles('test5'));
            $this->fail("Missing exception");
        } catch (Zend_Validate_Exception $e) {
            $this->assertContains("was not found", $e->getMessage());
        }
    }

    /**
     * Ensures that setFiles() returns expected value
     *
     * @return void
     */
    public function testSetFiles()
    {
        $files = [
            'test'  => [
                'name'     => 'test1',
                'type'     => 'text',
                'size'     => 200,
                'tmp_name' => 'tmp_test1',
                'error'    => 0],
            'test2' => [
                'name'     => 'test2',
                'type'     => 'text2',
                'size'     => 202,
                'tmp_name' => 'tmp_test2',
                'error'    => 1]];

        $_FILES = [
            'test'  => [
                'name'     => 'test3',
                'type'     => 'text3',
                'size'     => 203,
                'tmp_name' => 'tmp_test3',
                'error'    => 2]];


        $validator = new Zend_Validate_File_Upload();
        $validator->setFiles([]);
        $this->assertEquals($_FILES, $validator->getFiles());
        $validator->setFiles();
        $this->assertEquals($_FILES, $validator->getFiles());
        $validator->setFiles($files);
        $this->assertEquals($files, $validator->getFiles());
    }

    /**
     * @group ZF-10738
     */
    public function testGetFilesReturnsEmptyArrayWhenFilesSuperglobalIsNull()
    {
        $_FILES = NULL;
        $validator = new Zend_Validate_File_Upload();
        $validator->setFiles();
        $this->assertEquals([], $validator->getFiles());
    }

    /**
     * @group ZF-10738
     */
    public function testGetFilesReturnsEmptyArrayAfterSetFilesIsCalledWithNull()
    {
        $validator = new Zend_Validate_File_Upload();
        $validator->setFiles(NULL);
        $this->assertEquals([], $validator->getFiles());
    }

    /**
     * @group ZF-12128
     */
    public function testErrorMessage()
    {
        $_FILES = [
            'foo' => [
                'name'     => 'bar',
                'type'     => 'text',
                'size'     => 100,
                'tmp_name' => 'tmp_bar',
                'error'    => 7,
            ]
        ];

        $validator = new Zend_Validate_File_Upload();
        $validator->isValid('foo');

        $this->assertEquals(
            [
                 'fileUploadErrorCantWrite' => "File 'bar' can't be written",
            ],
            $validator->getMessages()
        );
    }

}

// Call Zend_Validate_File_UploadTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "Zend_Validate_File_UploadTest::main") {
    Zend_Validate_File_UploadTest::main();
}
