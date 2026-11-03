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
 * @package    Zend_Filter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Filter_Encrypt
 */
require_once 'Zend/Filter/File/Encrypt.php';
require_once 'Zend/Filter/File/Decrypt.php';

/**
 * @category   Zend
 * @package    Zend_Filter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Filter
 */
class Zend_Filter_File_EncryptTest extends TestCase
{
    protected function set_up()
    {
        if (!extension_loaded('mcrypt')) {
            $this->markTestSkipped('This filter needs the mcrypt extension');
        }

        if (extension_loaded('mcrypt') && version_compare(PHP_VERSION, '7.1.0', '>=')) {
            $this->markTestSkipped('mcrypt_* function has been DEPRECATED as of PHP 7.1.0 and REMOVED as of PHP 7.2.0. Relying on this function is highly discouraged.');
        }

        if (file_exists(dirname(__FILE__) . '/../_files/newencryption.txt')) {
            unlink(dirname(__FILE__) . '/../_files/newencryption.txt');
        }
    }

    protected function tear_down()
    {
        if (file_exists(dirname(__FILE__) . '/../_files/newencryption.txt')) {
            unlink(dirname(__FILE__) . '/../_files/newencryption.txt');
        }
    }

    /**
     * Ensures that the filter follows expected behavior
     *
     * @return void
     */
    public function testBasic()
    {
        $filter = new Zend_Filter_File_Encrypt();
        $filter->setFilename(dirname(__FILE__) . '/../_files/newencryption.txt');

        $this->assertEquals(
            dirname(__FILE__) . '/../_files/newencryption.txt',
            $filter->getFilename()
        );

        $filter->setVector('testvect');
        $this->assertEquals(
            dirname(__FILE__) . '/../_files/newencryption.txt',
            $filter->filter(dirname(__FILE__) . '/../_files/encryption.txt')
        );

        $this->assertEquals(
            'Encryption',
            file_get_contents(dirname(__FILE__) . '/../_files/encryption.txt')
        );

        $this->assertNotEquals(
            'Encryption',
            file_get_contents(dirname(__FILE__) . '/../_files/newencryption.txt')
        );
    }

    public function testEncryptionWithDecryption()
    {
        $filter = new Zend_Filter_File_Encrypt();
        $filter->setFilename(dirname(__FILE__) . '/../_files/newencryption.txt');
        $filter->setVector('testvect');
        $this->assertEquals(
            dirname(__FILE__) . '/../_files/newencryption.txt',
            $filter->filter(dirname(__FILE__) . '/../_files/encryption.txt')
        );

        $this->assertNotEquals(
            'Encryption',
            file_get_contents(dirname(__FILE__) . '/../_files/newencryption.txt')
        );

        $filter = new Zend_Filter_File_Decrypt();
        $filter->setVector('testvect');
        $input = $filter->filter(dirname(__FILE__) . '/../_files/newencryption.txt');
        $this->assertEquals(dirname(__FILE__) . '/../_files/newencryption.txt', $input);

        $this->assertEquals(
            'Encryption',
            trim(file_get_contents(dirname(__FILE__) . '/../_files/newencryption.txt'))
        );
    }

    /**
     * @return void
     */
    public function testNonExistingFile()
    {
        $filter = new Zend_Filter_File_Encrypt();
        $filter->setVector('testvect');

        try {
            $filter->filter(dirname(__FILE__) . '/../_files/nofile.txt');
            $this->fail();
        } catch (Zend_Filter_Exception $e) {
            $this->assertStringContainsString('not found', $e->getMessage());
        }
    }

    /**
     * @return void
     */
    public function testEncryptionInSameFile()
    {
        $filter = new Zend_Filter_File_Encrypt();
        $filter->setVector('testvect');

        copy(dirname(__FILE__) . '/../_files/encryption.txt', dirname(__FILE__) . '/../_files/newencryption.txt');
        $filter->filter(dirname(__FILE__) . '/../_files/newencryption.txt');

        $this->assertNotEquals(
            'Encryption',
            trim(file_get_contents(dirname(__FILE__) . '/../_files/newencryption.txt'))
        );
    }
}
