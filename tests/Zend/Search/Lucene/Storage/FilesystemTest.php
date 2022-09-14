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
 * @package    Zend_Search_Lucene
 * @subpackage UnitTests
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */


/**
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage UnitTests
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Search_Lucene
 */

class FilesystemTest extends PHPUnit_Framework_TestCase
{
    private $testFile;

    protected function tearDown()
    {
        if (is_file($this->testFile)) {
            unlink($this->testFile);
        }
    }

    public function testFileConstructorException()
    {
        try {
            new Zend_Search_Lucene_Storage_File_Filesystem('/foo');
        } catch (Exception $e) {
            self::assertInstanceOf('Zend_Search_Lucene_Exception', $e);

            return;
        }

        self::fail('This test should return early and never reach this line');
    }

    public function testDirectoryConstructorException()
    {
        try {
            $this->testFile = tempnam(sys_get_temp_dir(), 'lucene_test');
            touch($this->testFile);
            $fs = new Zend_Search_Lucene_Storage_Directory_Filesystem(sys_get_temp_dir());

            $newFilename = '/../../foo';
            if ($fs->renameFile($this->testFile, $newFilename)) {
                $this->testFile = sys_get_temp_dir() . "/$newFilename";
            }
        } catch (Exception $e) {
            self::assertInstanceOf('Zend_Search_Lucene_Exception', $e);

            return;
        }

        self::fail('This test should return early and never reach this line');
    }
}