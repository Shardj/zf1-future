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
 * @package    Zend_Mail
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Zend_Mail
 */
require_once 'Zend/Mail.php';

/**
 * Zend_Mail_Transport_File
 */
require_once 'Zend/Mail/Transport/File.php';

/**
 * @category   Zend
 * @package    Zend_Mail
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mail
 */
class Zend_Mail_FileTransportTest extends PHPUnit_Framework_TestCase
{
    protected $_params;
    protected $_transport;
    protected $_tmpdir;

    public function setUp()
    {
        $this->createdTmpDir = false;

        $tmpDir = null;
        if (defined('TESTS_ZEND_MAIL_TEMPDIR')) {
            $tmpDir = constant('TESTS_ZEND_MAIL_TEMPDIR');
        }
        if (empty($tmpDir)) {
            $tmpDir = sys_get_temp_dir() . '/zend_test_mail.file/';
        }
        $this->_tmpdir = $tmpDir;

        if (!is_dir($this->_tmpdir)) {
            if (!mkdir($this->_tmpdir)) {
                $this->markTestSkipped('Unable to create temporary dir for testing Zend_Mail_Transport_File');
            }
            $this->createdTmpDir = true;
        }

        $this->_cleanDir($this->_tmpdir);
    }

    public function tearDown()
    {
        $this->_cleanDir($this->_tmpdir);
        if ($this->createdTmpDir) {
            rmdir($this->_tmpdir);
        }
    }

    protected function _cleanDir($dir)
    {
        $entries = scandir($dir);
        foreach ($entries as $entry) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            $fullname = $dir . DIRECTORY_SEPARATOR . $entry;

            if (is_dir($fullname)) {
                $this->_cleanDir($fullname);
                rmdir($fullname);
            } else {
                unlink($fullname);
            }
        }
    }

    public function testTransportSetup()
    {
        $transport = new Zend_Mail_Transport_File();

        $transport = new Zend_Mail_Transport_File([
            'path'     => $this->_tmpdir,
            'callback' => 'test_function'
        ]);
    }

    protected function _prepareMail()
    {
        $mail = new Zend_Mail();
        $mail->setBodyText('This is the text of the mail.');
        $mail->setFrom('alexander@example.com', 'Alexander Steshenko');
        $mail->addTo('oleg@example.com', 'Oleg Lobach');
        $mail->setSubject('TestSubject');

        return $mail;
    }

    public function testNotWritablePathFailure()
    {
        $transport = new Zend_Mail_Transport_File([
            'callback' => [$this, 'directoryNotExisting']
        ]);

        $mail = $this->_prepareMail();

        $this->setExpectedException('Zend_Mail_Transport_Exception');
        $mail->send($transport);
    }

    public function testTransportSendMail()
    {
        $transport = new Zend_Mail_Transport_File(['path' => $this->_tmpdir]);

        $mail = $this->_prepareMail();
        $mail->send($transport);

        $entries = scandir($this->_tmpdir);
        $this->assertTrue(count($entries) == 3);
        foreach ($entries as $entry) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            $filename = $this->_tmpdir . DIRECTORY_SEPARATOR . $entry;
        }

        $email = file_get_contents($filename);
        $this->assertContains('To: Oleg Lobach <oleg@example.com>', $email);
        $this->assertContains('Subject: TestSubject', $email);
        $this->assertContains('From: Alexander Steshenko <alexander@example.com>', $email);
        $this->assertContains("This is the text of the mail.", $email);
    }

    public function prependCallback($transport)
    {
        // callback utilizes default callback and prepends recipient email
        return $transport->recipients . '_' . $transport->defaultCallback($transport);
    }

    public function testPrependToCallback()
    {
        $transport = new Zend_Mail_Transport_File([
            'path' => $this->_tmpdir,
            'callback' => [$this, 'prependCallback']
        ]);

        $mail = $this->_prepareMail();
        $mail->send($transport);

        $entries = scandir($this->_tmpdir);
        $this->assertTrue(count($entries) == 3);
        foreach ($entries as $entry) {
            if ($entry == '.' || $entry == '..') {
                continue;
            } else {
                break;
            }
        }

        // file name should now contain recipient email address
        $this->assertContains('oleg@example.com', $entry);
        // and default callback part
        $this->assertContains('ZendMail', $entry);
    }

    public function directoryNotExisting($transport)
    {
        return $this->_tmpdir . '/not_existing/directory';
    }
}
