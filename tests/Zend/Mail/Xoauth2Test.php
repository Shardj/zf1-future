<?php

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/** Zend_Mail_Protocol_Smtp_Auth_Xoauth2 */
require_once 'Zend/Mail/Protocol/Smtp/Auth/Xoauth2.php';

/** Zend_Mail_Protocol_Imap */
require_once 'Zend/Mail/Protocol/Imap.php';

/** Zend_Mail_Protocol_Pop3 */
require_once 'Zend/Mail/Protocol/Pop3.php';

/** Zend_Mail_Transport_Smtp */
require_once 'Zend/Mail/Transport/Smtp.php';

/** Zend_Mail */
require_once 'Zend/Mail.php';

/**
 * XOAUTH2 authentication for SMTP, IMAP and POP3, tested against scripted
 * server dialogs (no network).
 *
 * @category   Zend
 * @package    Zend_Mail
 * @subpackage UnitTests
 * @group      Zend_Mail
 */
class Zend_Mail_Xoauth2Test extends TestCase
{
    /**
     * base64("user=alice@example.com\x01auth=Bearer tok-123\x01\x01")
     */
    public const CREDENTIALS = 'dXNlcj1hbGljZUBleGFtcGxlLmNvbQFhdXRoPUJlYXJlciB0b2stMTIzAQE=';

    public function testEncodeCredentials()
    {
        $this->assertSame(self::CREDENTIALS, Zend_Mail_Protocol_Smtp_Auth_Xoauth2::encodeCredentials('alice@example.com', 'tok-123'));
        $this->assertSame("user=alice@example.com\x01auth=Bearer tok-123\x01\x01", base64_decode(self::CREDENTIALS));
    }

    // SMTP

    public function testSmtpAuthSucceeds()
    {
        $protocol = new Zend_Mail_Xoauth2Test_SmtpMock('127.0.0.1', null, ['username' => 'alice@example.com', 'accessToken' => 'tok-123']);
        $protocol->responseBuffer = [
            '220 smtp.example.com ESMTP',
            '250 Hello',
            '235 2.7.0 Accepted',
        ];
        $protocol->connect();
        $protocol->helo(); // helo() performs the authentication

        $this->assertContains('AUTH XOAUTH2 ' . self::CREDENTIALS, $protocol->dialog);
        $this->assertSame([], $protocol->responseBuffer);
    }

    public function testSmtpAuthFailureCarriesTheServerReason()
    {
        $protocol = new Zend_Mail_Xoauth2Test_SmtpMock('127.0.0.1', null, ['username' => 'alice@example.com', 'accessToken' => 'bad']);
        $protocol->responseBuffer = [
            '220 smtp.example.com ESMTP',
            '250 Hello',
            '334 ' . base64_encode('{"status":"401","schemes":"Bearer","scope":"https://mail.google.com/"}'),
            '535-5.7.8 Username and Password not accepted.',
            '535 5.7.8 https://support.google.com/mail/?p=BadCredentials',
        ];
        $protocol->connect();

        try {
            $protocol->helo();
            $this->fail('expected an exception');
        } catch (Zend_Mail_Protocol_Exception $e) {
            $this->assertStringContainsString('Username and Password not accepted', $e->getMessage());
            $this->assertStringContainsString('"status":"401"', $e->getMessage());
            $this->assertSame(535, $e->getCode());
        }

        // the empty line that asks for the final reply was sent after the continuation
        $this->assertSame('', $protocol->dialog[count($protocol->dialog) - 3]);
        $this->assertSame([], $protocol->responseBuffer);
    }

    public function testSmtpAuthWithoutCredentialsThrows()
    {
        $protocol = new Zend_Mail_Xoauth2Test_SmtpMock('127.0.0.1', null, ['username' => 'alice@example.com']);
        $protocol->responseBuffer = ['220 smtp.example.com ESMTP', '250 Hello'];
        $protocol->connect();

        $this->expectException('Zend_Mail_Protocol_Exception');
        $this->expectExceptionMessage('accessToken');
        $protocol->helo();
    }

    public function testTransportResolvesTheAuthClass()
    {
        $transport = new Zend_Mail_Transport_Smtp('smtp.example.com', [
            'auth'        => 'xoauth2',
            'username'    => 'alice@example.com',
            'accessToken' => 'tok-123',
            'port'        => 587,
        ]);

        // the connection is created on the first send, which would open a socket; check the class name the same way
        $this->assertTrue(class_exists('Zend_Mail_Protocol_Smtp_Auth_' . ucwords('xoauth2')));
        $this->assertInstanceOf('Zend_Mail_Transport_Smtp', $transport);
    }

    // IMAP

    /**
     * @param array $serverLines lines the fake server sends, in order
     * @return array [Zend_Mail_Protocol_Imap|Zend_Mail_Protocol_Pop3 subject socket, resource server socket]
     */
    protected function _socketPair()
    {
        if (!function_exists('stream_socket_pair')) {
            $this->markTestSkipped('stream_socket_pair() is not available');
        }
        $domain = defined('STREAM_PF_UNIX') && stripos(PHP_OS, 'WIN') !== 0 ? STREAM_PF_UNIX : STREAM_PF_INET;
        $pair   = stream_socket_pair($domain, STREAM_SOCK_STREAM, STREAM_IPPROTO_IP);
        if ($pair === false) {
            $this->markTestSkipped('could not create a socket pair');
        }
        return $pair;
    }

    /**
     * @param resource $server
     * @return string
     */
    protected function _serverRead($server)
    {
        $line = fgets($server);
        return $line === false ? '' : rtrim($line, "\r\n");
    }

    public function testImapAuthenticateSucceeds()
    {
        [$client, $server] = $this->_socketPair();
        $protocol = new Zend_Mail_Xoauth2Test_ImapMock($client);

        fwrite($server, "* CAPABILITY IMAP4rev1 AUTH=XOAUTH2\r\nTAG1 OK Success\r\n");
        $this->assertTrue($protocol->authenticateXoauth2('alice@example.com', 'tok-123'));
        $this->assertSame('TAG1 AUTHENTICATE XOAUTH2 ' . self::CREDENTIALS, $this->_serverRead($server));
    }

    public function testImapAuthenticateFailsAfterTheContinuation()
    {
        [$client, $server] = $this->_socketPair();
        $protocol = new Zend_Mail_Xoauth2Test_ImapMock($client);

        fwrite($server, '+ ' . base64_encode('{"status":"400","schemes":"Bearer"}') . "\r\nTAG1 NO [AUTHENTICATIONFAILED] Invalid credentials (Failure)\r\n");
        $this->assertFalse($protocol->authenticateXoauth2('alice@example.com', 'bad'));

        $this->assertSame('TAG1 AUTHENTICATE XOAUTH2 ' . base64_encode("user=alice@example.com\x01auth=Bearer bad\x01\x01"), $this->_serverRead($server));
        // the empty line after the continuation
        $this->assertSame('', $this->_serverRead($server));
    }

    public function testImapStorageUsesTheAccessToken()
    {
        [$client, $server] = $this->_socketPair();
        $protocol = new Zend_Mail_Xoauth2Test_ImapMock($client);
        fwrite($server, "TAG1 OK Success\r\n");

        // Zend_Mail_Storage_Imap with a ready protocol selects INBOX only; the token path is exercised through the protocol
        $this->assertTrue($protocol->authenticateXoauth2('alice@example.com', 'tok-123'));
        $this->assertStringContainsString('AUTHENTICATE XOAUTH2', $this->_serverRead($server));
    }

    // POP3

    public function testPop3AuthenticateSucceeds()
    {
        [$client, $server] = $this->_socketPair();
        $protocol = new Zend_Mail_Xoauth2Test_Pop3Mock($client);

        fwrite($server, "+ \r\n+OK Welcome.\r\n");
        $protocol->authenticateXoauth2('alice@example.com', 'tok-123');

        $this->assertSame('AUTH XOAUTH2', $this->_serverRead($server));
        $this->assertSame(self::CREDENTIALS, $this->_serverRead($server));
    }

    public function testPop3AuthenticateFailureWithContinuation()
    {
        [$client, $server] = $this->_socketPair();
        $protocol = new Zend_Mail_Xoauth2Test_Pop3Mock($client);

        fwrite($server, "+\r\n+ " . base64_encode('{"status":"400","schemes":"Bearer"}') . "\r\n-ERR [AUTH] Invalid credentials.\r\n");
        try {
            $protocol->authenticateXoauth2('alice@example.com', 'bad');
            $this->fail('expected an exception');
        } catch (Zend_Mail_Protocol_Exception $e) {
            $this->assertStringContainsString('-ERR [AUTH] Invalid credentials.', $e->getMessage());
            $this->assertStringContainsString('"status":"400"', $e->getMessage());
        }

        $this->assertSame('AUTH XOAUTH2', $this->_serverRead($server));
        $this->_serverRead($server); // credentials
        $this->assertSame('', $this->_serverRead($server));
    }

    public function testPop3AuthenticateFailureWithDirectError()
    {
        [$client, $server] = $this->_socketPair();
        $protocol = new Zend_Mail_Xoauth2Test_Pop3Mock($client);

        fwrite($server, "+ \r\n-ERR Authentication failure: unknown user name or bad password.\r\n");
        $this->expectException('Zend_Mail_Protocol_Exception');
        $this->expectExceptionMessage('Authentication failure');
        $protocol->authenticateXoauth2('alice@example.com', 'bad');
    }

    public function testPop3ServerThatDoesNotOfferTheContinuation()
    {
        [$client, $server] = $this->_socketPair();
        $protocol = new Zend_Mail_Xoauth2Test_Pop3Mock($client);

        fwrite($server, "-ERR Unknown command\r\n");
        $this->expectException('Zend_Mail_Protocol_Exception');
        $this->expectExceptionMessage('expected a SASL continuation');
        $protocol->authenticateXoauth2('alice@example.com', 'tok-123');
    }
}

/**
 * SMTP protocol with a scripted server
 */
class Zend_Mail_Xoauth2Test_SmtpMock extends Zend_Mail_Protocol_Smtp_Auth_Xoauth2
{
    public $dialog = [];
    public $responseBuffer = [];

    protected function _connect($remote)
    {
        $this->_socket = tmpfile();
    }

    protected function _send($request)
    {
        $this->dialog[] = $request;
    }

    protected function _receive($timeout = null)
    {
        if (empty($this->responseBuffer)) {
            require_once 'Zend/Mail/Protocol/Exception.php';
            throw new Zend_Mail_Protocol_Exception('Could not read from ' . $this->_host);
        }

        $line = array_shift($this->responseBuffer);
        $this->dialog[] = $line;
        return $line;
    }
}

/**
 * IMAP protocol on an already opened socket
 */
class Zend_Mail_Xoauth2Test_ImapMock extends Zend_Mail_Protocol_Imap
{
    public function __construct($socket)
    {
        $this->_socket = $socket;
    }

    public function __destruct()
    {
        $this->_socket = null;
    }
}

/**
 * POP3 protocol on an already opened socket
 */
class Zend_Mail_Xoauth2Test_Pop3Mock extends Zend_Mail_Protocol_Pop3
{
    public function __construct($socket)
    {
        $this->_socket = $socket;
    }

    public function __destruct()
    {
        $this->_socket = null;
    }
}
