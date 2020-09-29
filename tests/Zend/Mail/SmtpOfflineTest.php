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
 * Zend_Mail_Protocol_Smtp
 */
require_once 'Zend/Mail/Protocol/Smtp.php';


/**
 * Zend_Mail_Transport_Smtp
 */
require_once 'Zend/Mail/Transport/Smtp.php';

/**
 * @category   Zend
 * @package    Zend_Mail
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Mail
 */
class Zend_Mail_SmtpOfflineTest extends PHPUnit_Framework_TestCase
{
    protected $_params;

    public function setUp()
    {
        $this->_params = ['host'     => TESTS_ZEND_MAIL_SMTP_HOST,
                               'port'     => TESTS_ZEND_MAIL_SMTP_PORT,
                               'username' => TESTS_ZEND_MAIL_SMTP_USER,
                               'password' => TESTS_ZEND_MAIL_SMTP_PASSWORD,
                               'auth'     => TESTS_ZEND_MAIL_SMTP_AUTH];
    }

    /**
     * @group ZF-8988
     */
    public function testReturnPathIsUsedAsMailFrom()
    {
        $connectionMock = $this->getMock('Zend_Mail_Protocol_Smtp');
        $connectionMock->expects($this->once())
                       ->method('mail')
                       ->with('return@example.com');

        $transport = new Zend_Mail_Transport_Smtp($this->_params['host'], $this->_params);
        $transport->setConnection($connectionMock);

        $mail = new Zend_Mail();
        $mail->setBodyText('This is a test.')
             ->setFrom('from@example.com', 'from user')
             ->setReturnPath('return@example.com');

        $mail->send($transport);
    }
}
