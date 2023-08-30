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
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

// Call Zend_Log_Writer_MailTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "Zend_Log_Writer_MailTest::main");
}

/** Zend_Layout */
require_once 'Zend/Layout.php';

/** Zend_Log */
require_once 'Zend/Log.php';

/** Zend_Log_Writer_Mail */
require_once 'Zend/Log/Writer/Mail.php';

/** Zend_Mail */
require_once 'Zend/Mail.php';

/** Zend_Mail_Transport_Exception */
require_once 'Zend/Mail/Transport/Exception.php';

/** Zend_View_Exception */
require_once 'Zend/View/Exception.php';

/** Zend_Mail_Transport_Abstract */
require_once 'Zend/Mail/Transport/Abstract.php';


/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Log
 */
class Zend_Log_Writer_MailTest extends TestCase
{
    /**
     * Mock Transport for Zend_Mail
     *
     * @var Zend_Mail_Transport_Abstract
     */
    protected $_transport;

    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite = new TestSuite(__CLASS__);
        $result = (new resources_Runner())->run($suite);
    }

    protected function set_up()
    {
        $this->_transport = $this->getMockForAbstractClass(
            Zend_Mail_Transport_Abstract::class,
            []
        );
        Zend_Mail::setDefaultTransport($this->_transport);
    }

    protected function tear_down()
    {
        Zend_Mail::clearDefaultTransport();
    }

    /**
     * Tests normal logging, but with multiple messages for a level.
     * @doesNotPerformAssertions
     * @return void
     */
    public function testNormalLoggingMultiplePerLevel()
    {
        list(, , $log) = $this->_getSimpleLogger();
        $log->info('an info message');
        $log->info('a second info message');
    }

    /**
     * Tests normal logging without use of Zend_Layout.
     * @doesNotPerformAssertions
     * @return void
     */
    public function testNormalLoggingNoLayout()
    {
        list(, , $log) = $this->_getSimpleLogger();
        $log->info('an info message');
        $log->warn('a warning message');
    }

    /**
     * Tests normal logging with Zend_Layout usage.
     * @doesNotPerformAssertions
     * @return void
     */
    public function testNormalLoggingWithLayout()
    {
        list(, , $log) = $this->_getSimpleLogger(true);
        $log->info('an info message');
        $log->warn('a warning message');
    }

    /**
     * Tests normal logging with Zend_Layout and a custom formatter for it.
     * @doesNotPerformAssertions
     */
    public function testNormalLoggingWithLayoutAndItsFormatter()
    {
        list(, $writer, $log) = $this->_getSimpleLogger(true);

        // Since I'm using Zend_Layout, I should be able to set a formatter
        // for it.
        $writer->setLayoutFormatter(new Zend_Log_Formatter_Simple());

        // Log some messages to cover those cases.
        $log->info('an info message');
        $log->warn('a warning message');
    }

    /**
     * Tests normal logging with use of Zend_Layout, a custom formatter, and
     * subject prepend text.
     *
     * @return void
     */
    public function testNormalLoggingWithLayoutFormatterAndSubjectPrependText()
    {
        list(, $writer, $log) = $this->_getSimpleLogger(true);
        $writer->setLayoutFormatter(new Zend_Log_Formatter_Simple());
        $return = $writer->setSubjectPrependText('foo');

        $this->assertSame($writer, $return);

        // Log some messages to cover those cases.
        $log->info('an info message');
        $log->warn('a warning message');
    }

    /**
     * Tests setting of subject prepend text.
     *
     * @return void
     */
    public function testSetSubjectPrependTextNormal()
    {
        list($mail, $writer, $log) = $this->_getSimpleLogger();

        $return = $writer->setSubjectPrependText('foo');

        // Ensure that fluent interface is present.
        $this->assertSame($writer, $return);
    }

    /**
     * Tests that the subject prepend text can't be set if the Zend_Mail
     * object already has a subject line set.
     *
     * @return void
     */
    public function testSetSubjectPrependTextPreExisting()
    {
        $this->expectException(Zend_Log_Exception::class);
        $this->expectExceptionMessage('subject already set on mail; cannot set subject prepend text');

        list($mail, $writer, $log) = $this->_getSimpleLogger();
        $mail->method('getSubject')->willReturn('a pre-existing subject line');
        $writer->setSubjectPrependText('foo');
    }

    /**
     * Tests basic fluent interface for setting layout formatter.
     *
     * @return void
     */
    public function testSetLayoutFormatter()
    {
        list(, $writer) = $this->_getSimpleLogger(true);
        $return = $writer->setLayoutFormatter(new Zend_Log_Formatter_Simple());
        $this->assertSame($writer, $return);
    }

    /**
     * Tests that the layout formatter can be set and retrieved.
     *
     * @return void
     */
    public function testGetLayoutFormatter()
    {
        list(, $writer) = $this->_getSimpleLogger(true);
        $formatter = new Zend_Log_Formatter_Simple();

        // Ensure that fluent interface is present.
        $returnedWriter = $writer->setLayoutFormatter($formatter);
        $this->assertSame($writer, $returnedWriter);

        // Ensure that the getter returns the same formatter.
        $returnedFormatter = $writer->getLayoutFormatter();
        $this->assertSame($formatter, $returnedFormatter);
    }

    /**
     * Tests setting of the layout formatter when Zend_Layout is not being
     * used.
     *
     * @return void
     */
    public function testSetLayoutFormatterWithoutLayout()
    {
        list(, $writer) = $this->_getSimpleLogger();

        // If Zend_Layout is not being used, a formatter cannot be set for it.
        $this->expectException(Zend_Log_Exception::class);
        $writer->setLayoutFormatter(new Zend_Log_Formatter_Simple());
    }

    /**
     * Tests destruction of the Zend_Log instance when an error message entry
     * is in place, but the mail can't be sent.  Should result in a warning,
     * which we test for here.
     *
     * @return void
     */
    public function testDestructorMailError()
    {
        $this->expectException(version_compare(phpversion(), '7.1', '>') ? \PHPUnit\Framework\Error\Error::class : \Error::class);
        $this->expectExceptionMessage('unable to send log entries via email;');
        list($mail, $writer, $log) = $this->_getSimpleLogger(false);

        // Force the send() method to throw the same exception that would be
        // thrown if, say, the SMTP server couldn't be contacted.
        $mail->expects($this->any())
             ->method('send')
             ->will($this->throwException(new Zend_Mail_Transport_Exception()));

        // Log an error message so that there's something to send via email.
        $log->err('a bogus error message to force mail sending');

        unset($log);
    }

    /**
     * Tests destruction of the Zend_Log instance when an error message entry
     * is in place, but the layout can't be rendered.  Should result in a
     * notice, which we test for here.
     *
     * @return void
     */
    public function testDestructorLayoutError()
    {
        $this->expectException(version_compare(phpversion(), '7.1', '>') ? \PHPUnit\Framework\Error\Error::class : \Error::class);
        $this->expectExceptionMessage('exception occurred when rendering layout; unable to set html body for message; message = bogus message');

        list($mail, $writer, $log, $layout) = $this->_getSimpleLogger(true);

        // Force the render() method to throw the same exception that would
        // be thrown if, say, the layout template file couldn't be found.
        $layout->expects($this->any())
               ->method('render')
               ->will($this->throwException(new Zend_View_Exception('bogus message')));

        // Log an error message so that there's something to send via email.
        $log->err('a bogus error message to force mail sending');

        unset($log);
    }

    /**
     * @group ZF-8953
     */
    public function testFluentInterface()
    {
        require_once 'Zend/Log/Formatter/Simple.php';
        list(, $writer) = $this->_getSimpleLogger(true);
        $instance = $writer->setLayoutFormatter(new Zend_Log_Formatter_Simple())
                           ->setSubjectPrependText('subject');

        $this->assertTrue($instance instanceof Zend_Log_Writer_Mail);
    }

    /**
     * @group ZF-9990
     */
    public function testFactory()
    {
        $config = [
            'from' => [
                'email' => 'log@test.framework.zend.com'
            ],
            'to' => 'admin@domain.com',
            'subject' => '[error] exceptions on my application'
        ];

        $writer = Zend_Log_Writer_Mail::factory($config);
        $this->assertTrue($writer instanceof Zend_Log_Writer_Mail);

        $writer->write($this->_getEvent());
        $writer->shutdown();

        $this->assertEquals('admin@domain.com', $this->_transport->recipients);
        $this->assertStringContainsString('an info message', $this->_transport->body);
        $this->assertStringContainsString('From: log@test.framework.zend.com', $this->_transport->header);
        $this->assertStringContainsString('To: admin@domain.com', $this->_transport->header);
        $this->assertStringContainsString('Subject: [error] exceptions on my application', $this->_transport->header);
    }

    /**
     * @group ZF-9990
     */
    public function testFactoryShouldSetSubjectPrependText()
    {
        $config = [
            'subjectPrependText' => '[error] exceptions on my application'
        ];

        $writer = Zend_Log_Writer_Mail::factory($config);
        $writer->write($this->_getEvent());
        $writer->shutdown();

        $this->assertStringContainsString('Subject: [error] exceptions on my application (INFO=1)', $this->_transport->header);
    }

    /**
     * @group ZF-9990
     */
    public function testFactoryShouldAcceptCustomMailClass()
    {
        $config = [
            'class' => get_class($this->createMock('Zend_Mail'))
        ];

        $writer = Zend_Log_Writer_Mail::factory($config);
        $this->assertTrue($writer instanceof Zend_Log_Writer_Mail);
    }

    /**
     * @group ZF-9990
     */
    public function testFactoryShouldSetCharsetForMail()
    {
        $config = [
            'charset' => 'UTF-8'
        ];

        $writer = Zend_Log_Writer_Mail::factory($config);
        $writer->write($this->_getEvent());
        $writer->shutdown();

        $this->assertStringContainsString('Content-Type: text/plain; charset=UTF-8', $this->_transport->header);
    }

    /**
     * @group ZF-9990
     */
    public function testFactoryShouldAllowToSetMultipleRecipientsInArray()
    {
        $config = [
            'to' => [
                'John Doe' => 'admin1@domain.com',
                'admin2@domain.com'
            ],
            'cc' => [
                'bug@domain.com',
                'project' => 'projectname@domain.com'
            ]
        ];

        $writer = Zend_Log_Writer_Mail::factory($config);
        $writer->write($this->_getEvent());
        $writer->shutdown();

        $this->assertStringContainsString('admin1@domain.com', $this->_transport->recipients);
        $this->assertStringContainsString('admin2@domain.com', $this->_transport->recipients);
        $this->assertStringContainsString('bug@domain.com', $this->_transport->recipients);
        $this->assertStringContainsString('projectname@domain.com', $this->_transport->recipients);
        $this->assertStringContainsString('To: John Doe <admin1@domain.com>', $this->_transport->header);
        $this->assertStringContainsString('admin2@domain.com', $this->_transport->header);
        $this->assertStringContainsString('Cc: bug@domain.com', $this->_transport->header);
        $this->assertStringContainsString('project <projectname@domain.com>', $this->_transport->header);
    }

    /**
     * @group ZF-9990
     */
    public function testFactoryWithLayout()
    {
        $config = [
            'layoutOptions' => [
                'layoutPath' => dirname(__FILE__) . '/_files'
            ]
        ];

        $writer = Zend_Log_Writer_Mail::factory($config);
        $writer->write($this->_getEvent());
        $writer->shutdown();

        $this->assertFalse(empty($this->_transport->boundary));
        $this->assertStringContainsString('Content-Type: multipart/', $this->_transport->header);
        $this->assertStringContainsString('boundary=', $this->_transport->header);
        $this->assertStringContainsString('Content-Type: text/plain', $this->_transport->body);
        $this->assertStringContainsString('Content-Type: text/html', $this->_transport->body);
        $this->assertStringContainsString($this->_transport->boundary, $this->_transport->body);
        $this->assertEquals(2, substr_count($this->_transport->body, 'an info message'));
    }

    /**
     * @group ZF-9990
     */
    public function testFactoryShouldSetLayoutFormatter()
    {
        $config = [
            'layoutOptions' => [
                'layoutPath' => '/path/to/layout/scripts'
            ],
            'layoutFormatter' => 'Zend_Log_Formatter_Simple'
        ];

        $writer = Zend_Log_Writer_Mail::factory($config);
        $this->assertTrue($writer->getLayoutFormatter() instanceof Zend_Log_Formatter_Simple);
    }

    /**
     * @group ZF-9990
     */
    public function testFactoryWithCustomLayoutClass()
    {
        $layout = $this->createMock(Zend_Layout::class);
        $config = [
            'layout' => get_class($layout)
        ];

        $writer = Zend_Log_Writer_Mail::factory($config);
        $this->assertTrue($writer instanceof Zend_Log_Writer_Mail);
    }

    /**
     * Returns an array of the Zend_Mail mock object, Zend_Log_Writer_Mail
     * object, and Zend_Log objects.
     *
     * This is just a helper function for the various test methods above.
     *
     * @return array Numerically indexed array of Zend_Mail,
     *               Zend_Log_Writer_Mail, Zend_Log, and Zend_Layout objects,
     *               in that order.
     */
    protected function _getSimpleLogger($useLayout = false)
    {
        // Get a mock object for Zend_Mail so that no emails are actually
        // sent.
        $mail = $this->createMock(Zend_Mail::class);

        // The send() method can be called any number of times.
        $mail->expects($this->any())
             ->method('send');

        $mail->addTo('zend_log_writer_mail_test@example.org');
        $mail->setFrom('zend_log_writer_mail_test@example.org');

        // Setup a mock object for Zend_Layout because we can't rely on any
        // layout files being in place.
        if ($useLayout) {
            $layout = $this->createMock('Zend_Layout');
            $writer = new Zend_Log_Writer_Mail($mail, $layout);
        } else {
            $writer = new Zend_Log_Writer_Mail($mail);
            $layout = null;
        }

        $log = new Zend_Log();
        $log->addWriter($writer);

        return [$mail, $writer, $log, $layout];
    }

    /**
     * Returns a sample of an event
     *
     * @return array
     */
    protected function _getEvent()
    {
        return [
            'timestamp' => date('c'),
            'message' => 'an info message',
            'priority' => 6,
            'priorityName' => 'INFO'
        ];
    }
}

// Call Zend_Log_Writer_MailTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD === "Zend_Log_Writer_MailTest::main") {
    Zend_Log_Writer_MailTest::main();
}
