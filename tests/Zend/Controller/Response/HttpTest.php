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
 * @package    Zend_Controller
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Controller/Response/Http.php';
require_once 'Zend/Controller/Response/Exception.php';

/**
 * @category   Zend
 * @package    Zend_Controller
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Controller
 * @group      Zend_Controller_Response
 */
class Zend_Controller_Response_HttpTest extends TestCase
{
    /**
     * @var Zend_Http_Response
     */
    protected $_response;

    protected function set_up()
    {
        $this->_response = new Zend_Controller_Response_Http();
        $this->_response->headersSentThrowsException = false;
    }

    protected function tear_down()
    {
        unset($this->_response);
    }

    public function testSetHeader()
    {
        $expected = [['name' => 'Content-Type', 'value' => 'text/xml', 'replace' => false]];
        $this->_response->setHeader('Content-Type', 'text/xml');
        $this->assertSame($expected, $this->_response->getHeaders());

        $expected[] = ['name' => 'Content-Type', 'value' => 'text/html', 'replace' => false];
        $this->_response->setHeader('Content-Type', 'text/html');
        $this->assertSame($expected, $this->_response->getHeaders());

        $expected = [['name' => 'Content-Type', 'value' => 'text/plain', 'replace' => true]];
        $this->_response->setHeader('Content-Type', 'text/plain', true);
        $count = 0;
        foreach ($this->_response->getHeaders() as $header) {
            if ('Content-Type' == $header['name']) {
                if ('text/plain' == $header['value']) {
                    ++$count;
                } else {
                    $this->fail('Found header, but incorrect value');
                }
            }
        }
        $this->assertEquals(1, $count);
    }

    public function testNoDuplicateLocationHeader()
    {
        $this->_response->setRedirect('http://www.example.com/foo/bar');
        $this->_response->setRedirect('http://www.example.com/bar/baz');
        $headers = $this->_response->getHeaders();
        $location = 0;
        foreach ($headers as $header) {
            if ('Location' == $header['name']) {
                ++$location;
            }
        }
        $this->assertEquals(1, $location);
    }

    public function testClearHeaders()
    {
        $this->_response->setHeader('Content-Type', 'text/xml');
        $headers = $this->_response->getHeaders();
        $this->assertEquals(1, count($headers));

        $this->_response->clearHeaders();
        $headers = $this->_response->getHeaders();
        $this->assertEquals(0, count($headers));
    }

    /**
     * @group ZF-6038
     */
    public function testClearHeader()
    {
        $this->_response->setHeader('Connection', 'keep-alive');
        $original_headers = $this->_response->getHeaders();

        $this->_response->clearHeader('Connection');
        $updated_headers = $this->_response->getHeaders();

        $this->assertFalse($original_headers == $updated_headers);
    }

    public function testSetRawHeader()
    {
        $this->_response->setRawHeader('HTTP/1.0 404 Not Found');
        $headers = $this->_response->getRawHeaders();
        $this->assertContains('HTTP/1.0 404 Not Found', $headers);
    }

    public function testClearRawHeaders()
    {
        $this->_response->setRawHeader('HTTP/1.0 404 Not Found');
        $headers = $this->_response->getRawHeaders();
        $this->assertContains('HTTP/1.0 404 Not Found', $headers);

        $this->_response->clearRawHeaders();
        $headers = $this->_response->getRawHeaders();
        $this->assertTrue(empty($headers));
    }

    /**
     * @group ZF-6038
     */
    public function testClearRawHeader()
    {
        $this->_response->setRawHeader('HTTP/1.0 404 Not Found');
        $this->_response->setRawHeader('HTTP/1.0 401 Unauthorized');
        $originalHeadersRaw = $this->_response->getRawHeaders();

        $this->_response->clearRawHeader('HTTP/1.0 404 Not Found');
        $updatedHeadersRaw = $this->_response->getRawHeaders();

        $this->assertFalse($originalHeadersRaw == $updatedHeadersRaw);
    }

    /**
     * @group ZF-6038
     */
    public function testClearRawHeaderThatDoesNotExist()
    {
        $this->_response->setRawHeader('HTTP/1.0 404 Not Found');
        $this->_response->setRawHeader('HTTP/1.0 401 Unauthorized');
        $originalHeadersRaw = $this->_response->getRawHeaders();

        $this->_response->clearRawHeader('HTTP/1.0 403 Forbidden');
        $updatedHeadersRaw = $this->_response->getRawHeaders();

        $this->assertTrue($originalHeadersRaw == $updatedHeadersRaw);
    }

    public function testClearAllHeaders()
    {
        $this->_response->setRawHeader('HTTP/1.0 404 Not Found');
        $this->_response->setHeader('Content-Type', 'text/xml');

        $headers = $this->_response->getHeaders();
        $this->assertFalse(empty($headers));

        $headers = $this->_response->getRawHeaders();
        $this->assertFalse(empty($headers));

        $this->_response->clearAllHeaders();
        $headers = $this->_response->getHeaders();
        $this->assertTrue(empty($headers));
        $headers = $this->_response->getRawHeaders();
        $this->assertTrue(empty($headers));
    }

    public function testSetHttpResponseCode()
    {
        $this->assertEquals(200, $this->_response->getHttpResponseCode());
        $this->_response->setHttpResponseCode(302);
        $this->assertEquals(302, $this->_response->getHttpResponseCode());
    }

    public function testSetBody()
    {
        $expected = 'content for the response body';
        $this->_response->setBody($expected);
        $this->assertEquals($expected, $this->_response->getBody());

        $expected = 'new content';
        $this->_response->setBody($expected);
        $this->assertEquals($expected, $this->_response->getBody());
    }

    public function testAppendBody()
    {
        $expected = 'content for the response body';
        $this->_response->setBody($expected);

        $additional = '; and then there was more';
        $this->_response->appendBody($additional);
        $this->assertEquals($expected . $additional, $this->_response->getBody());
    }

    /**
     * Sending the response sends headers, so the test needs a process without
     * output; the headers themselves are not inspected because PHP ignores
     * header() calls in the CLI.
     *
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function test__toString()
    {
        $this->_response->setHeader('Content-Type', 'text/plain');
        $this->_response->setBody('Content');
        $this->_response->appendBody('; and more content.');

        $this->assertSame('Content; and more content.', $this->_response->__toString());
    }

    public function testRenderExceptions()
    {
        $this->assertFalse($this->_response->renderExceptions());
        $this->assertTrue($this->_response->renderExceptions(true));
        $this->assertTrue($this->_response->renderExceptions());
        $this->assertFalse($this->_response->renderExceptions(false));
        $this->assertFalse($this->_response->renderExceptions());
    }

    public function testGetException()
    {
        $e = new Exception('Test');
        $this->_response->setException($e);

        $test = $this->_response->getException();
        $found = false;
        foreach ($test as $t) {
            if ($t === $e) {
                $found = true;
            }
        }
        $this->assertTrue($found);
    }

    public function testSendResponseWithExceptions()
    {
        $e = new Exception('Test exception rendering');
        $this->_response->setException($e);
        $this->_response->renderExceptions(true);

        ob_start();
        $this->_response->sendResponse();
        $string = ob_get_clean();
        $this->assertStringContainsString('Test exception rendering', $string);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSetResponseCodeThrowsExceptionWithBadCode()
    {
        try {
            $this->_response->setHttpResponseCode(99);
            $this->fail('Should not accept response codes < 100');
        } catch (Exception $e) {
        }

        try {
            $this->_response->setHttpResponseCode(600);
            $this->fail('Should not accept response codes > 599');
        } catch (Exception $e) {
        }

        try {
            $this->_response->setHttpResponseCode('bogus');
            $this->fail('Should not accept non-integer response codes');
        } catch (Exception $e) {
        }
    }

    /**
     * The headers count as sent only after real output, which a test cannot make
     * without breaking the runner, so a separate PHP process prints it
     */
    public function testCanSendHeadersIndicatesFileAndLine()
    {
        $script  = dirname(__FILE__) . '/_files/headers-sent.php';
        $command = escapeshellarg(PHP_BINARY)
                 . ' -d ' . escapeshellarg('include_path=' . get_include_path())
                 . ' ' . escapeshellarg($script);
        exec($command, $output, $status);

        $this->assertSame(0, $status);
        $this->assertSame('output', $output[0]);
        $this->assertSame(
            'Cannot send headers; headers already sent in ' . $script . ', line 6',
            $output[1]
        );
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testCanSendHeadersWithoutOutput()
    {
        $this->_response->headersSentThrowsException = true;

        $this->assertTrue($this->_response->canSendHeaders(true));
    }

    public function testAppend()
    {
        $this->_response->append('some', "some content\n");
        $this->_response->append('more', "more content\n");

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'some' => "some content\n",
            'more' => "more content\n"
        ];
        $this->assertEquals($expected, $content);
    }

    public function testAppendUsingExistingSegmentOverwrites()
    {
        $this->_response->append('some', "some content\n");
        $this->_response->append('some', "more content\n");

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'some' => "more content\n"
        ];
        $this->assertEquals($expected, $content);
    }

    public function testPrepend()
    {
        $this->_response->prepend('some', "some content\n");
        $this->_response->prepend('more', "more content\n");

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'more' => "more content\n",
            'some' => "some content\n"
        ];
        $this->assertEquals($expected, $content);
    }

    public function testPrependUsingExistingSegmentOverwrites()
    {
        $this->_response->prepend('some', "some content\n");
        $this->_response->prepend('some', "more content\n");

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'some' => "more content\n"
        ];
        $this->assertEquals($expected, $content);
    }

    public function testInsert()
    {
        $this->_response->append('some', "some content\n");
        $this->_response->append('more', "more content\n");
        $this->_response->insert('foobar', "foobar content\n", 'some');

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'some' => "some content\n",
            'foobar' => "foobar content\n",
            'more' => "more content\n"
        ];
        $this->assertSame($expected, $content);
    }

    public function testInsertBefore()
    {
        $this->_response->append('some', "some content\n");
        $this->_response->append('more', "more content\n");
        $this->_response->insert('foobar', "foobar content\n", 'some', true);

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'foobar' => "foobar content\n",
            'some' => "some content\n",
            'more' => "more content\n"
        ];
        $this->assertSame($expected, $content);
    }

    public function testInsertWithFalseParent()
    {
        $this->_response->append('some', "some content\n");
        $this->_response->append('more', "more content\n");
        $this->_response->insert('foobar', "foobar content\n", 'baz', true);

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'some' => "some content\n",
            'more' => "more content\n",
            'foobar' => "foobar content\n"
        ];
        $this->assertSame($expected, $content);
    }

    public function testSetBodyNamedSegment()
    {
        $this->_response->append('some', "some content\n");
        $this->_response->setBody("more content\n", 'some');

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'some' => "more content\n"
        ];
        $this->assertEquals($expected, $content);
    }

    public function testSetBodyOverwritesWithDefaultSegment()
    {
        $this->_response->append('some', "some content\n");
        $this->_response->setBody("more content\n");

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'default' => "more content\n"
        ];
        $this->assertEquals($expected, $content);
    }

    public function testAppendBodyAppendsDefaultSegment()
    {
        $this->_response->setBody("some content\n");
        $this->_response->appendBody("more content\n");

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'default' => "some content\nmore content\n"
        ];
        $this->assertEquals($expected, $content);
    }

    public function testAppendBodyAppendsExistingSegment()
    {
        $this->_response->setBody("some content\n", 'some');
        $this->_response->appendBody("more content\n", 'some');

        $content = $this->_response->getBody(true);
        $this->assertTrue(is_array($content));
        $expected = [
            'some' => "some content\nmore content\n"
        ];
        $this->assertEquals($expected, $content);
    }

    public function testGetBodyNamedSegment()
    {
        $this->_response->append('some', "some content\n");
        $this->_response->append('more', "more content\n");

        $this->assertEquals("more content\n", $this->_response->getBody('more'));
        $this->assertEquals("some content\n", $this->_response->getBody('some'));
    }

    public function testGetBodyAsArray()
    {
        $string1 = 'content for the response body';
        $string2 = 'more content for the response body';
        $string3 = 'even more content for the response body';
        $this->_response->appendBody($string1, 'string1');
        $this->_response->appendBody($string2, 'string2');
        $this->_response->appendBody($string3, 'string3');

        $expected = [
            'string1' => $string1,
            'string2' => $string2,
            'string3' => $string3
        ];

        $this->assertEquals($expected, $this->_response->getBody(true));
    }

    public function testClearBody()
    {
        $this->_response->append('some', "some content\n");

        $this->assertTrue($this->_response->clearBody());
        $body = $this->_response->getBody(true);
        $this->assertTrue(is_array($body));
        $this->assertEquals(0, count($body));
    }

    public function testClearBodySegment()
    {
        $this->_response->append('some', "some content\n");
        $this->_response->append('more', "more content\n");
        $this->_response->append('superfluous', "superfluous content\n");

        $this->assertFalse($this->_response->clearBody('many'));
        $this->assertTrue($this->_response->clearBody('more'));
        $body = $this->_response->getBody(true);
        $this->assertTrue(is_array($body));
        $this->assertEquals(2, count($body));
        $this->assertTrue(isset($body['some']));
        $this->assertTrue(isset($body['superfluous']));
    }

    public function testIsRedirectInitiallyFalse()
    {
        $this->assertFalse($this->_response->isRedirect());
    }

    public function testIsRedirectWhenRedirectSet()
    {
        $this->_response->setRedirect('http://framework.zend.com/');
        $this->assertTrue($this->_response->isRedirect());
    }

    public function testIsRedirectWhenRawLocationHeaderSet()
    {
        $this->_response->setRawHeader('Location: http://framework.zend.com/');
        $this->assertTrue($this->_response->isRedirect());
    }

    public function testIsRedirectWhen3xxResponseCodeSet()
    {
        $this->_response->setHttpResponseCode(301);
        $this->assertTrue($this->_response->isRedirect());
    }

    public function testIsNotRedirectWithSufficientlyLarge3xxResponseCodeSet()
    {
        $this->_response->setHttpResponseCode(309);
        $this->assertFalse($this->_response->isRedirect());
    }

    public function testHasExceptionOfType()
    {
        $this->assertFalse($this->_response->hasExceptionOfType('Zend_Controller_Response_Exception'));
        $this->_response->setException(new Zend_Controller_Response_Exception());
        $this->assertTrue($this->_response->hasExceptionOfType('Zend_Controller_Response_Exception'));
    }

    public function testHasExceptionOfMessage()
    {
        $this->assertFalse($this->_response->hasExceptionOfMessage('FooBar'));
        $this->_response->setException(new Zend_Controller_Response_Exception('FooBar'));
        $this->assertTrue($this->_response->hasExceptionOfMessage('FooBar'));
    }

    public function testHasExceptionOfCode()
    {
        $this->assertFalse($this->_response->hasExceptionOfCode(200));
        $this->_response->setException(new Zend_Controller_Response_Exception('FooBar', 200));
        $this->assertTrue($this->_response->hasExceptionOfCode(200));
    }

    public function testGetExceptionByType()
    {
        $this->assertFalse($this->_response->getExceptionByType('Zend_Controller_Response_Exception'));
        $this->_response->setException(new Zend_Controller_Response_Exception());
        $exceptions = $this->_response->getExceptionByType('Zend_Controller_Response_Exception');
        $this->assertTrue(0 < count($exceptions));
        $this->assertTrue($exceptions[0] instanceof Zend_Controller_Response_Exception);
    }

    public function testGetExceptionByMessage()
    {
        $this->assertFalse($this->_response->getExceptionByMessage('FooBar'));
        $this->_response->setException(new Zend_Controller_Response_Exception('FooBar'));
        $exceptions = $this->_response->getExceptionByMessage('FooBar');
        $this->assertTrue(0 < count($exceptions));
        $this->assertEquals('FooBar', $exceptions[0]->getMessage());
    }

    public function testGetExceptionByCode()
    {
        $this->assertFalse($this->_response->getExceptionByCode(200));
        $this->_response->setException(new Zend_Controller_Response_Exception('FooBar', 200));
        $exceptions = $this->_response->getExceptionByCode(200);
        $this->assertTrue(0 < count($exceptions));
        $this->assertEquals(200, $exceptions[0]->getCode());
    }

    public function testHeaderNamesAreCaseInsensitive()
    {
        $this->_response->setHeader('X-Foo_Bar-Baz', 'value');
        $this->_response->setHeader('X-FOO_bar-bAz', 'bat');

        $headers = $this->_response->getHeaders();
        $names = [];
        foreach ($headers as $header) {
            $names[] = $header['name'];
        }
        $this->assertTrue(in_array('X-Foo-Bar-Baz', $names), var_export($headers, 1));
        $this->assertFalse(in_array('X-Foo_Bar-Baz', $names));
        $this->assertFalse(in_array('X-FOO_bar-bAz', $names));
    }
}

require_once 'Zend/Controller/Action.php';
class Zend_Controller_Response_HttpTest_Action extends Zend_Controller_Action
{
}

