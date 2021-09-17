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
 * @package    Zend_Http_Response
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

use Zend\Http\StreamObject;

/**
 * Zend_Http_Response
 */
require_once 'Zend/Http/Response.php';

require_once __DIR__ . '/StreamObject.php';

/**
 * Zend_Http_Response unit tests
 *
 * @category   Zend
 * @package    Zend_Http_Response
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Http
 * @group      Zend_Http_Response
 */
class Zend_Http_ResponseTest extends PHPUnit_Framework_TestCase
{
    /** @var null|string */
    private $tempFile;

    public function setUp()
    { }

    public function tearDown()
    {
        if ($this->tempFile !== null && file_exists($this->tempFile)) {
            unlink($this->tempFile);
        }
    }

    public function testGzipResponse ()
    {
        $response_text = file_get_contents(dirname(__FILE__) . '/_files/response_gzip');

        $res = Zend_Http_Response::fromString($response_text);

        $this->assertEquals('gzip', $res->getHeader('Content-encoding'));
        $this->assertEquals('0b13cb193de9450aa70a6403e2c9902f', md5($res->getBody()));
        $this->assertEquals('f24dd075ba2ebfb3bf21270e3fdc5303', md5($res->getRawBody()));
    }

    public function testDeflateResponse ()
    {
        $response_text = file_get_contents(dirname(__FILE__) . '/_files/response_deflate');

        $res = Zend_Http_Response::fromString($response_text);

        $this->assertEquals('deflate', $res->getHeader('Content-encoding'));
        $this->assertEquals('0b13cb193de9450aa70a6403e2c9902f', md5($res->getBody()));
        $this->assertEquals('ad62c21c3aa77b6a6f39600f6dd553b8', md5($res->getRawBody()));
    }

    /**
     * Make sure we can handle non-RFC complient "deflate" responses.
     *
     * Unlike stanrdard 'deflate' response, those do not contain the zlib header
     * and trailer. Unfortunately some buggy servers (read: IIS) send those and
     * we need to support them.
     *
     * @link http://framework.zend.com/issues/browse/ZF-6040
     */
    public function testNonStandardDeflateResponseZF6040()
    {
        $response_text = file_get_contents(dirname(__FILE__) . '/_files/response_deflate_iis');

        // Ensure headers are correctly formatted (i.e., separated with "\r\n" sequence)
        //
        // Line endings are an issue inside the canned response; the
        // following uses a negative lookbehind assertion, and replaces any \n
        // not preceded by \r with the sequence \r\n within the headers,
        // ensuring that the message is well-formed.
        list($headers, $message) = explode("\n\n", $response_text, 2);
        $headers = preg_replace("#(?<!\r)\n#", "\r\n", $headers);
        $response_text = $headers . "\r\n\r\n" . $message;

        $res = Zend_Http_Response::fromString($response_text);

        $this->assertEquals('deflate', $res->getHeader('Content-encoding'));
        $this->assertEquals('d82c87e3d5888db0193a3fb12396e616', md5($res->getBody()));
        $this->assertEquals('c830dd74bb502443cf12514c185ff174', md5($res->getRawBody()));
    }

    public function testChunkedResponse ()
    {
        $response_text = file_get_contents(dirname(__FILE__) . '/_files/response_chunked');

        $res = Zend_Http_Response::fromString($response_text);

        $this->assertEquals('chunked', $res->getHeader('Transfer-encoding'));
        $this->assertEquals('0b13cb193de9450aa70a6403e2c9902f', md5($res->getBody()));
        $this->assertEquals('c0cc9d44790fa2a58078059bab1902a9', md5($res->getRawBody()));
    }

    public function testChunkedResponseCaseInsensitiveZF5438()
    {
        $response_text = file_get_contents(dirname(__FILE__) . '/_files/response_chunked_case');

        $res = Zend_Http_Response::fromString($response_text);

        $this->assertEquals('chunked', strtolower($res->getHeader('Transfer-encoding')));
        $this->assertEquals('0b13cb193de9450aa70a6403e2c9902f', md5($res->getBody()));
        $this->assertEquals('c0cc9d44790fa2a58078059bab1902a9', md5($res->getRawBody()));
    }

    public function testExtractMessageCrlf()
    {
        $response_text = file_get_contents(dirname(__FILE__) . '/_files/response_crlf');
        $this->assertEquals("OK", Zend_Http_Response::extractMessage($response_text), "Response message is not 'OK' as expected");
    }

    public function testExtractMessageLfonly()
    {
        $response_text = file_get_contents(dirname(__FILE__) . '/_files/response_lfonly');
        $this->assertEquals("OK", Zend_Http_Response::extractMessage($response_text), "Response message is not 'OK' as expected");
    }

    public function test404IsError()
    {
        $response_text = $this->readResponse('response_404');
        $response = Zend_Http_Response::fromString($response_text);

        $this->assertEquals(404, $response->getStatus(), 'Response code is expected to be 404, but it\'s not.');
        $this->assertTrue($response->isError(), 'Response is an error, but isError() returned false');
        $this->assertFalse($response->isSuccessful(), 'Response is an error, but isSuccessful() returned true');
        $this->assertFalse($response->isRedirect(), 'Response is an error, but isRedirect() returned true');
    }

    public function test500isError()
    {
        $response_text = $this->readResponse('response_500');
        $response = Zend_Http_Response::fromString($response_text);

        $this->assertEquals(500, $response->getStatus(), 'Response code is expected to be 500, but it\'s not.');
        $this->assertTrue($response->isError(), 'Response is an error, but isError() returned false');
        $this->assertFalse($response->isSuccessful(), 'Response is an error, but isSuccessful() returned true');
        $this->assertFalse($response->isRedirect(), 'Response is an error, but isRedirect() returned true');
    }

    /**
     * @group ZF-5520
     */
    public function test302LocationHeaderMatches()
    {
        $headerName  = 'Location';
        $headerValue = 'http://www.google.com/ig?hl=en';
        $response    = Zend_Http_Response::fromString($this->readResponse('response_302'));
        $responseIis = Zend_Http_Response::fromString($this->readResponse('response_302_iis'));

        $this->assertEquals($headerValue, $response->getHeader($headerName));
        $this->assertEquals($headerValue, $responseIis->getHeader($headerName));
    }

    public function test300isRedirect()
    {
        $response = Zend_Http_Response::fromString($this->readResponse('response_302'));

        $this->assertEquals(302, $response->getStatus(), 'Response code is expected to be 302, but it\'s not.');
        $this->assertTrue($response->isRedirect(), 'Response is a redirection, but isRedirect() returned false');
        $this->assertFalse($response->isError(), 'Response is a redirection, but isError() returned true');
        $this->assertFalse($response->isSuccessful(), 'Response is a redirection, but isSuccessful() returned true');
    }

    /**
     * @see https://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2021-3007
     */
    public function testDestructionDoesNothingIfStreamIsNotAResourceAndStreamNameIsNotAString()
    {
        $this->tempFile = tempnam(sys_get_temp_dir(), 'lhrs');
        $streamObject = new StreamObject($this->tempFile);

        $response = new Zend_Http_Response_Stream(200, array());
        $response->setCleanup(true);
        $response->setStreamName($streamObject);

        unset($response);

        $this->assertFileExists($this->tempFile);
    }

    public function test200Ok()
    {
        $response = Zend_Http_Response::fromString($this->readResponse('response_deflate'));

        $this->assertEquals(200, $response->getStatus(), 'Response code is expected to be 200, but it\'s not.');
        $this->assertFalse($response->isError(), 'Response is OK, but isError() returned true');
        $this->assertTrue($response->isSuccessful(), 'Response is OK, but isSuccessful() returned false');
        $this->assertFalse($response->isRedirect(), 'Response is OK, but isRedirect() returned true');
    }

    public function test100Continue()
    {
        $this->markTestIncomplete();
    }

    public function testAutoMessageSet()
    {
        $response = Zend_Http_Response::fromString($this->readResponse('response_403_nomessage'));

        $this->assertEquals(403, $response->getStatus(), 'Response status is expected to be 403, but it isn\'t');
        $this->assertEquals('Forbidden', $response->getMessage(), 'Response is 403, but message is not "Forbidden" as expected');

        // While we're here, make sure it's classified as error...
        $this->assertTrue($response->isError(), 'Response is an error, but isError() returned false');
        $this->assertFalse($response->isSuccessful(), 'Response is an error, but isSuccessful() returned true');
        $this->assertFalse($response->isRedirect(), 'Response is an error, but isRedirect() returned true');
    }

    public function testAsString()
    {
        $response_str = $this->readResponse('response_404');
        $response = Zend_Http_Response::fromString($response_str);

        $this->assertEquals(strtolower($response_str), strtolower($response->asString()), 'Response conversion to string does not match original string');
        $this->assertEquals(strtolower($response_str), strtolower((string) $response), 'Response conversion to string does not match original string');
    }

    public function testGetHeaders()
    {
        $response = Zend_Http_Response::fromString($this->readResponse('response_deflate'));
        $headers = $response->getHeaders();

        $this->assertEquals(8, count($headers), 'Header count is not as expected');
        $this->assertEquals('Apache', $headers['Server'], 'Server header is not as expected');
        $this->assertEquals('deflate', $headers['Content-encoding'], 'Content-type header is not as expected');
    }

    public function testGetVersion()
    {
        $response = Zend_Http_Response::fromString($this->readResponse('response_chunked'));
        $this->assertEquals(1.1, $response->getVersion(), 'Version is expected to be 1.1');
    }

    public function testResponseCodeAsText()
    {
        // This is an entirely static test

        // Test some response codes
        $this->assertEquals('Continue', Zend_Http_Response::responseCodeAsText(100));
        $this->assertEquals('OK', Zend_Http_Response::responseCodeAsText(200));
        $this->assertEquals('Multiple Choices', Zend_Http_Response::responseCodeAsText(300));
        $this->assertEquals('Bad Request', Zend_Http_Response::responseCodeAsText(400));
        $this->assertEquals('Internal Server Error', Zend_Http_Response::responseCodeAsText(500));

        // Make sure that invalid codes return 'Unknown'
        $this->assertEquals('Unknown', Zend_Http_Response::responseCodeAsText(600));

        // Check HTTP/1.0 value for 302
        $this->assertEquals('Found', Zend_Http_Response::responseCodeAsText(302));
        $this->assertEquals('Moved Temporarily', Zend_Http_Response::responseCodeAsText(302, false));

        // Check we get an array if no code is passed
        $codes = Zend_Http_Response::responseCodeAsText();
        $this->assertTrue(is_array($codes));
        $this->assertEquals('OK', $codes[200]);
    }

    public function testUnknownCode()
    {
        $response_str = $this->readResponse('response_unknown');
        $response = Zend_Http_Response::fromString($response_str);

        // Check that dynamically the message is parsed
        $this->assertEquals(550, $response->getStatus(), 'Status is expected to be a non-standard 550');
        $this->assertEquals('Printer On Fire', $response->getMessage(), 'Message is expected to be extracted');

        // Check that statically, an Unknown string is returned for the 550 code
        $this->assertEquals('Unknown', Zend_Http_Response::responseCodeAsText($response_str));
    }

    public function testMultilineHeader()
    {
        $response = Zend_Http_Response::fromString($this->readResponse('response_multiline_header'));

        // Make sure we got the corrent no. of headers
        $this->assertEquals(6, count($response->getHeaders()), 'Header count is expected to be 6');

        // Check header integrity
        $this->assertEquals('timeout=15, max=100', $response->getHeader('keep-alive'));
        $this->assertEquals('text/html; charset=iso-8859-1', $response->getHeader('content-type'));
    }

    public function testExceptInvalidChunkedBody()
    {
        try {
            Zend_Http_Response::decodeChunkedBody($this->readResponse('response_deflate'));
            $this->fail('An expected exception was not thrown');
        } catch (Zend_Http_Exception $e) {
            // We are ok!
        }
    }

    public function testExtractorsOnInvalidString()
    {
        // Try with an empty string
        $response_str = '';

        $this->assertTrue(Zend_Http_Response::extractCode($response_str) === false);
        $this->assertTrue(Zend_Http_Response::extractMessage($response_str) === false);
        $this->assertTrue(Zend_Http_Response::extractVersion($response_str) === false);
        $this->assertTrue(Zend_Http_Response::extractBody($response_str) === '');
        $this->assertTrue(Zend_Http_Response::extractHeaders($response_str) === []);
    }

    /**
     * Make sure a response with some leading whitespace in the response body
     * does not get modified (see ZF-1924)
     *
     */
    public function testLeadingWhitespaceBody()
    {
        $message = file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'response_leadingws');
        $body    = Zend_Http_Response::extractBody($message);
        $this->assertEquals($body, "\r\n\t  \n\r\tx", 'Extracted body is not identical to expected body');
    }

    /**
     * Test that parsing a multibyte-encoded chunked response works.
     *
     * This can potentially fail on different PHP environments - for example
     * when mbstring.func_overload is set to overload strlen().
     *
     */
    public function testMultibyteChunkedResponse()
    {
        $md5 = 'f734924685f92b243c8580848cadc560';

        $response = Zend_Http_Response::fromString($this->readResponse('response_multibyte_body'));
        $this->assertEquals($md5, md5($response->getBody()));
    }

    /**
     * Test that headers are properly set when passed to the constructor as an associative array
     *
     * @group ZF-10277
     */
    public function testConstructorWithHeadersAssocArray()
    {
        $response = new Zend_Http_Response(200, [
            'content-type' => 'text/plain',
            'x-foo'        => 'bar:baz'
        ]);

        $this->assertEquals('text/plain', $response->getHeader('content-type'));
        $this->assertEquals('bar:baz', $response->getHeader('x-foo'));
    }

    /**
     * Test that headers are properly parsed when passed to the constructor as an indexed array
     *
     * @link  http://framework.zend.com/issues/browse/ZF-10277
     * @group ZF-10277
     */
    public function testConstructorWithHeadersIndexedArrayZF10277()
    {
        $response = new Zend_Http_Response(200, [
            'content-type: text/plain',
            'x-foo: bar:baz'
        ]);

        $this->assertEquals('text/plain', $response->getHeader('content-type'));
        $this->assertEquals('bar:baz', $response->getHeader('x-foo'));
    }

    /**
     * Test that headers are properly parsed when passed to the constructor as
     * an indexed array with no whitespace after the ':' sign
     *
     * @link  http://framework.zend.com/issues/browse/ZF-10277
     * @group ZF-10277
     */
    public function testConstructorWithHeadersIndexedArrayNoWhitespace()
    {
        $response = new Zend_Http_Response(200, [
            'content-type:text/plain',
            'x-foo:bar:baz'
        ]);

        $this->assertEquals('text/plain', $response->getHeader('content-type'));
        $this->assertEquals('bar:baz', $response->getHeader('x-foo'));
    }

    /**
     * Helper function: read test response from file
     *
     * @param string $response
     * @return string
     */
    protected function readResponse($response)
    {
        $message = file_get_contents(
            dirname(__FILE__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . $response
        );
        // Line endings are sometimes an issue inside the canned responses; the
        // following is a negative lookbehind assertion, and replaces any \n
        // not preceded by \r with the sequence \r\n, ensuring that the message
        // is well-formed.
        return preg_replace("#(?<!\r)\n#", "\r\n", $message);
    }

    public function invalidResponseHeaders()
    {
        return [
            'bad-status-line'            => ["HTTP/1.0a 200 OK\r\nHost: example.com\r\n\r\nMessage Body"],
            'nl-in-header'               => ["HTTP/1.1 200 OK\r\nHost: example.\ncom\r\n\r\nMessage Body"],
            'cr-in-header'               => ["HTTP/1.1 200 OK\r\nHost: example.\rcom\r\n\r\nMessage Body"],
            'bad-continuation'           => ["HTTP/1.1 200 OK\r\nHost: example.\r\ncom\r\n\r\nMessage Body"],
            'no-status-nl-in-header'     => ["Host: example.\ncom\r\n\r\nMessage Body"],
            'no-status-cr-in-header'     => ["Host: example.\rcom\r\n\r\nMessage Body"],
            'no-status-bad-continuation' => ["Host: example.\r\ncom\r\n\r\nMessage Body"],
        ];
    }

    /**
     * @group ZF2015-04
     * @dataProvider invalidResponseHeaders
     */
    public function testExtractHeadersRaisesExceptionWhenDetectingCRLFInjection($message)
    {
        $this->setExpectedException('Zend_Http_Exception', 'Invalid');
        Zend_Http_Response::extractHeaders($message);
    }

    /**
     * @group 587
     */
    public function testExtractHeadersShouldAllowAnyValidHttpHeaderToken()
    {
        $response = $this->readResponse('response_587');
        $headers  = Zend_Http_Response::extractHeaders($response);

        $this->assertArrayHasKey('zipi.step', $headers);
        $this->assertEquals(0, $headers['zipi.step']);
    }

    /**
     * @group 587
     */
    public function testExtractHeadersShouldAllowHeadersWithEmptyValues()
    {
        $response = $this->readResponse('response_587_empty');
        $headers  = Zend_Http_Response::extractHeaders($response);

        $this->assertArrayHasKey('imagetoolbar', $headers);
        $this->assertEmpty($headers['imagetoolbar']);
    }

    /**
     * @group 587
     */
    public function testExtractHeadersShouldAllowHeadersWithMissingValues()
    {
        $response = $this->readResponse('response_587_null');
        $headers  = Zend_Http_Response::extractHeaders($response);

        $this->assertArrayHasKey('imagetoolbar', $headers);
        $this->assertEmpty($headers['imagetoolbar']);
    }
}
