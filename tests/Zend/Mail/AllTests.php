<?php

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
 * @package    Zend_Mail
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_Mail_AllTests::main');
}

require_once 'Zend/Mail/Header/AllTests.php';
require_once 'Zend/Mail/MailTest.php';
require_once 'Zend/Mail/MboxTest.php';
require_once 'Zend/Mail/MboxMessageOldTest.php';
require_once 'Zend/Mail/MboxFolderTest.php';
require_once 'Zend/Mail/MaildirTest.php';
require_once 'Zend/Mail/MaildirMessageOldTest.php';
require_once 'Zend/Mail/MaildirFolderTest.php';
require_once 'Zend/Mail/MaildirWritableTest.php';
require_once 'Zend/Mail/Pop3Test.php';
require_once 'Zend/Mail/ImapTest.php';
require_once 'Zend/Mail/InterfaceTest.php';
require_once 'Zend/Mail/MessageTest.php';
require_once 'Zend/Mail/SmtpOfflineTest.php';
require_once 'Zend/Mail/SmtpProtocolTest.php';
require_once 'Zend/Mail/SmtpTest.php';
require_once 'Zend/Mail/FileTransportTest.php';

/**
 * @category   Zend
 * @package    Zend_Mail
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mail
 */
class Zend_Mail_AllTests
{
    public static function main()
    {
        (new resources_Runner())->run(self::suite());
    }

    public static function suite()
    {
        $suite = new TestSuite('Zend Framework - Zend_Mail');

        $suite->addTest(Zend_Mail_Header_AllTests::suite());
        $suite->addTestSuite('Zend_Mail_MailTest');
        $suite->addTestSuite('Zend_Mail_MessageTest');
        $suite->addTestSuite('Zend_Mail_InterfaceTest');
        $suite->addTestSuite('Zend_Mail_MboxTest');
        $suite->addTestSuite('Zend_Mail_MboxMessageOldTest');
        $suite->addTestSuite('Zend_Mail_MboxFolderTest');
        if (defined('TESTS_ZEND_MAIL_POP3_ENABLED') && constant('TESTS_ZEND_MAIL_POP3_ENABLED') == true) {
            $suite->addTestSuite('Zend_Mail_Pop3Test');
        }
        if (defined('TESTS_ZEND_MAIL_IMAP_ENABLED') && constant('TESTS_ZEND_MAIL_IMAP_ENABLED') == true) {
            $suite->addTestSuite('Zend_Mail_ImapTest');
        }
        if (defined('TESTS_ZEND_MAIL_MAILDIR_ENABLED') && constant('TESTS_ZEND_MAIL_MAILDIR_ENABLED')) {
            $suite->addTestSuite('Zend_Mail_MaildirTest');
            $suite->addTestSuite('Zend_Mail_MaildirMessageOldTest');
            $suite->addTestSuite('Zend_Mail_MaildirFolderTest');
            $suite->addTestSuite('Zend_Mail_MaildirWritableTest');
        }
        $suite->addTestSuite('Zend_Mail_SmtpOfflineTest');
        $suite->addTestSuite('Zend_Mail_SmtpProtocolTest');
        if (defined('TESTS_ZEND_MAIL_SMTP_ENABLED') && constant('TESTS_ZEND_MAIL_SMTP_ENABLED') == true) {
            $suite->addTestSuite('Zend_Mail_SmtpTest');
        }
        $suite->addTestSuite('Zend_Mail_FileTransportTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD === 'Zend_Mail_AllTests::main') {
    Zend_Mail_AllTests::main();
}
