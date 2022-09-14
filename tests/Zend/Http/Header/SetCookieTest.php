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
 * @package    Zend_Http_Header
 * @subpackage UnitTests

 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Http_Header_SetCookie
 */
require_once 'Zend/Http/Header/SetCookie.php';

/**
 * @see Zend_Controller_Response_HttpTestCase
 */
require_once 'Zend/Controller/Response/HttpTestCase.php';

/**
 * Zend_Http_Cookie unit tests
 *
 * @category   Zend
 * @package    Zend_Http_Cookie
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Http
 * @group      Zend_Http_Header
 * @group      ZF-4520
 */
class Zend_Http_Header_SetCookieTest extends PHPUnit_Framework_TestCase
{

    /**
     * @group ZF2-254
     */
    public function testSetCookieConstructor()
    {
        $setCookieHeader = new Zend_Http_Header_SetCookie(
            'myname', 'myvalue', 'Wed, 13-Jan-2021 22:23:01 GMT', 
            '/accounts', 'docs.foo.com', true, true, 99, 9
        );
        $this->assertEquals('myname', $setCookieHeader->getName());
        $this->assertEquals('myvalue', $setCookieHeader->getValue());
        $this->assertEquals('Wed, 13-Jan-2021 22:23:01 GMT', $setCookieHeader->getExpires());
        $this->assertEquals('/accounts', $setCookieHeader->getPath());
        $this->assertEquals('docs.foo.com', $setCookieHeader->getDomain());
        $this->assertTrue($setCookieHeader->isSecure());
        $this->assertTrue($setCookieHeader->isHttpOnly());
        $this->assertEquals(99, $setCookieHeader->getMaxAge());
        $this->assertEquals(9, $setCookieHeader->getVersion());
    }

    public function testSetCookieFromStringCreatesValidSetCookieHeader()
    {
        $setCookieHeader = Zend_Http_Header_SetCookie::fromString('Set-Cookie: xxx');
        $this->assertTrue($setCookieHeader instanceof Zend_Http_Header_SetCookie);
    }

    public function testSetCookieFromStringCanCreateSingleHeader()
    {
        $setCookieHeader = Zend_Http_Header_SetCookie::fromString('Set-Cookie: myname=myvalue');
        $this->assertTrue($setCookieHeader instanceof Zend_Http_Header_SetCookie);
        $this->assertEquals('myname', $setCookieHeader->getName());
        $this->assertEquals('myvalue', $setCookieHeader->getValue());

        $setCookieHeader = Zend_Http_Header_SetCookie::fromString(
            'set-cookie: myname=myvalue; Domain=docs.foo.com; Path=/accounts;'
            . 'Expires=Wed, 13-Jan-2021 22:23:01 GMT; Secure; HttpOnly'
        );
        $this->assertTrue($setCookieHeader instanceof Zend_Http_Header_SetCookie);
        $this->assertEquals('myname', $setCookieHeader->getName());
        $this->assertEquals('myvalue', $setCookieHeader->getValue());
        $this->assertEquals('docs.foo.com', $setCookieHeader->getDomain());
        $this->assertEquals('/accounts', $setCookieHeader->getPath());
        $this->assertEquals('Wed, 13-Jan-2021 22:23:01 GMT', $setCookieHeader->getExpires());
        $this->assertTrue($setCookieHeader->isSecure());
        $this->assertTrue($setCookieHeader->isHttponly());
    }

    public function testSetCookieFromStringCanCreateMultipleHeaders()
    {
        $setCookieHeaders = Zend_Http_Header_SetCookie::fromString(
            'Set-Cookie: myname=myvalue, '
            . 'someothername=someothervalue; Domain=docs.foo.com; Path=/accounts;'
            . 'Expires=Wed, 13-Jan-2021 22:23:01 GMT; Secure; HttpOnly'
        );
        $this->assertTrue(is_array($setCookieHeaders));

        $setCookieHeader = $setCookieHeaders[0];
        $this->assertTrue($setCookieHeader instanceof Zend_Http_Header_SetCookie);
        $this->assertEquals('myname', $setCookieHeader->getName());
        $this->assertEquals('myvalue', $setCookieHeader->getValue());

        $setCookieHeader = $setCookieHeaders[1];
        $this->assertTrue($setCookieHeader instanceof Zend_Http_Header_SetCookie);
        $this->assertEquals('someothername', $setCookieHeader->getName());
        $this->assertEquals('someothervalue', $setCookieHeader->getValue());
        $this->assertEquals('Wed, 13-Jan-2021 22:23:01 GMT', $setCookieHeader->getExpires());
        $this->assertEquals('docs.foo.com', $setCookieHeader->getDomain());
        $this->assertEquals('/accounts', $setCookieHeader->getPath());
        $this->assertTrue($setCookieHeader->isSecure());
        $this->assertTrue($setCookieHeader->isHttponly());

    }

    public function testSetCookieGetFieldNameReturnsHeaderName()
    {
        $setCookieHeader = new Zend_Http_Header_SetCookie();
        $this->assertEquals('Set-Cookie', $setCookieHeader->getFieldName());

    }

    public function testSetCookieGetFieldValueReturnsProperValue()
    {
        $setCookieHeader = new Zend_Http_Header_SetCookie();
        $setCookieHeader->setName('myname');
        $setCookieHeader->setValue('myvalue');
        $setCookieHeader->setExpires('Wed, 13-Jan-2021 22:23:01 GMT');
        $setCookieHeader->setDomain('docs.foo.com');
        $setCookieHeader->setPath('/accounts');
        $setCookieHeader->setSecure(true);
        $setCookieHeader->setHttponly(true);

        $target = 'myname=myvalue; Expires=Wed, 13-Jan-2021 22:23:01 GMT;'
            . ' Domain=docs.foo.com; Path=/accounts;'
            . ' Secure; HttpOnly';

        $this->assertEquals($target, $setCookieHeader->getFieldValue());
    }

    public function testSetCookieToStringReturnsHeaderFormattedString()
    {
        $setCookieHeader = new Zend_Http_Header_SetCookie();
        $setCookieHeader->setName('myname');
        $setCookieHeader->setValue('myvalue');
        $setCookieHeader->setExpires('Wed, 13-Jan-2021 22:23:01 GMT');
        $setCookieHeader->setDomain('docs.foo.com');
        $setCookieHeader->setPath('/accounts');
        $setCookieHeader->setSecure(true);
        $setCookieHeader->setHttponly(true);

        $target = 'Set-Cookie: myname=myvalue; Expires=Wed, 13-Jan-2021 22:23:01 GMT;'
            . ' Domain=docs.foo.com; Path=/accounts;'
            . ' Secure; HttpOnly';

        $this->assertEquals($target, $setCookieHeader->toString());
    }

    public function testSetCookieCanAppendOtherHeadersInWhenCreatingString()
    {
        $setCookieHeader = new Zend_Http_Header_SetCookie();
        $setCookieHeader->setName('myname');
        $setCookieHeader->setValue('myvalue');
        $setCookieHeader->setExpires('Wed, 13-Jan-2021 22:23:01 GMT');
        $setCookieHeader->setDomain('docs.foo.com');
        $setCookieHeader->setPath('/accounts');
        $setCookieHeader->setSecure(true);
        $setCookieHeader->setHttponly(true);

        $appendCookie = new Zend_Http_Header_SetCookie('othername', 'othervalue');
        $headerLine = $setCookieHeader->toStringMultipleHeaders([$appendCookie]);

        $target = 'Set-Cookie: myname=myvalue; Expires=Wed, 13-Jan-2021 22:23:01 GMT;'
            . ' Domain=docs.foo.com; Path=/accounts;'
            . ' Secure; HttpOnly, othername=othervalue';
        $this->assertEquals($target, $headerLine);
    }

    /** Implmentation specific tests here */
    
    /**
     * ZF2-169
     * 
     * @see http://framework.zend.com/issues/browse/ZF2-169
     */
    public function testZF2_169()
    {
        $cookie = 'Set-Cookie: leo_auth_token="example"; Version=1; Max-Age=1799; Expires=Mon, 20-Feb-2012 02:49:57 GMT; Path=/';
        $setCookieHeader = Zend_Http_Header_SetCookie::fromString($cookie);
        $this->assertEquals($cookie, $setCookieHeader->toString());
    }

    public function testGetFieldName()
    {
        $c = new Zend_Http_Header_SetCookie();
        $this->assertEquals('Set-Cookie', $c->getFieldName());
    }
    
    /**
     * @dataProvider validCookieWithInfoProvider
     */
    public function testGetFieldValue($cStr, $info, $expected)
    {
        $cookie = Zend_Http_Header_SetCookie::fromString($cStr);
        if (! $cookie instanceof Zend_Http_Header_SetCookie) {
            $this->fail("Failed creating a cookie object from '$cStr'");
        }        
        $this->assertEquals($expected, $cookie->getFieldValue());
        $this->assertEquals($cookie->getFieldName() . ': ' . $expected, (string)$cookie);
    }
    
    /**
     * @dataProvider validCookieWithInfoProvider
     */
    public function testToString($cStr, $info, $expected)
    {
        $cookie = Zend_Http_Header_SetCookie::fromString($cStr);
        if (! $cookie instanceof Zend_Http_Header_SetCookie) {
            $this->fail("Failed creating a cookie object from '$cStr'");
        }        
        $this->assertEquals($cookie->getFieldName() . ': ' . $expected, $cookie->toString());
    }

    /**
     * @dataProvider validCookieWithInfoProvider
     */
    public function testAddingAsRawHeaderToResponseObject($cStr, $info, $expected)
    {
        $response = new Zend_Controller_Response_HttpTestCase();
        $cookie = Zend_Http_Header_SetCookie::fromString($cStr);
        $response->setRawHeader($cookie);
        $this->assertContains((string)$cookie, $response->sendHeaders());
    }

    /**
     * @group GH-295
     */
    public function testMultipleCookies()
    {
        $setCookieHeader = new Zend_Http_Header_SetCookie('othername1', 'othervalue1');
        $appendCookie    = new Zend_Http_Header_SetCookie('othername2', 'othervalue2');
        $headerLine      = $setCookieHeader->toStringMultipleHeaders([$appendCookie]);

        $response = new Zend_Controller_Response_HttpTestCase();
        $response->setRawHeader($headerLine);

        $this->assertEquals((array)$headerLine, $response->sendHeaders());
    }
    
    /**
     * Provide valid cookie strings with information about them
     *
     * @return array
     */
    public static function validCookieWithInfoProvider()
    {
        $now = time();
        $yesterday = $now - (3600 * 24);

        return [
            [
                'Set-Cookie: justacookie=foo; domain=example.com',
                [
                    'name'    => 'justacookie',
                    'value'   => 'foo',
                    'domain'  => 'example.com',
                    'path'    => '/',
                    'expires' => null,
                    'secure'  => false,
                    'httponly'=> false
                ],
                'justacookie=foo; Domain=example.com'
            ],
            [
                'Set-Cookie: expires=tomorrow; secure; path=/Space Out/; expires=Tue, 21-Nov-2006 08:33:44 GMT; domain=.example.com',
                [
                    'name'    => 'expires',
                    'value'   => 'tomorrow',
                    'domain'  => '.example.com',
                    'path'    => '/Space Out/',
                    'expires' => strtotime('Tue, 21-Nov-2006 08:33:44 GMT'),
                    'secure'  => true,
                    'httponly'=> false
                ],
                'expires=tomorrow; Expires=Tue, 21-Nov-2006 08:33:44 GMT; Domain=.example.com; Path=/Space Out/; Secure'
            ],
            [
                'Set-Cookie: domain=unittests; expires=' . gmdate('D, d-M-Y H:i:s', $now) . ' GMT; domain=example.com; path=/some%20value/',
                [
                    'name'    => 'domain',
                    'value'   => 'unittests',
                    'domain'  => 'example.com',
                    'path'    => '/some%20value/',
                    'expires' => $now,
                    'secure'  => false,
                    'httponly'=> false
                ],
                'domain=unittests; Expires=' . gmdate('D, d-M-Y H:i:s', $now) . ' GMT; Domain=example.com; Path=/some%20value/'
            ],
            [
                'Set-Cookie: path=indexAction; path=/; domain=.foo.com; expires=' . gmdate('D, d-M-Y H:i:s', $yesterday) . ' GMT',
                [
                    'name'    => 'path',
                    'value'   => 'indexAction',
                    'domain'  => '.foo.com',
                    'path'    => '/',
                    'expires' => $yesterday,
                    'secure'  => false,
                    'httponly'=> false
                ],
                'path=indexAction; Expires=' . gmdate('D, d-M-Y H:i:s', $yesterday) . ' GMT; Domain=.foo.com; Path=/'
            ],

            [
                'Set-Cookie: secure=sha1; secure; SECURE; domain=some.really.deep.domain.com',
                [
                    'name'    => 'secure',
                    'value'   => 'sha1',
                    'domain'  => 'some.really.deep.domain.com',
                    'path'    => '/',
                    'expires' => null,
                    'secure'  => true,
                    'httponly'=> false
                ],
                'secure=sha1; Domain=some.really.deep.domain.com; Secure'
            ],
            [
                'Set-Cookie: justacookie=foo; domain=example.com; httpOnly',
                [
                    'name'    => 'justacookie',
                    'value'   => 'foo',
                    'domain'  => 'example.com',
                    'path'    => '/',
                    'expires' => null,
                    'secure'  => false,
                    'httponly'=> true
                ],
                'justacookie=foo; Domain=example.com; HttpOnly'
            ],
            [
                'Set-Cookie: PHPSESSID=123456789+abcd%2Cef; secure; domain=.localdomain; path=/foo/baz; expires=Tue, 21-Nov-2006 08:33:44 GMT;',
                [
                    'name'    => 'PHPSESSID',
                    'value'   => '123456789+abcd%2Cef',
                    'domain'  => '.localdomain',
                    'path'    => '/foo/baz',
                    'expires' => 'Tue, 21-Nov-2006 08:33:44 GMT',
                    'secure'  => true,
                    'httponly'=> false
                ],
                'PHPSESSID=123456789%2Babcd%252Cef; Expires=Tue, 21-Nov-2006 08:33:44 GMT; Domain=.localdomain; Path=/foo/baz; Secure'
            ],
            [
                'Set-Cookie: myname=myvalue; Domain=docs.foo.com; Path=/accounts; Expires=Wed, 13-Jan-2021 22:23:01 GMT; Secure; HttpOnly',
                [
                    'name'    => 'myname',
                    'value'   => 'myvalue',
                    'domain'  => 'docs.foo.com',
                    'path'    => '/accounts',
                    'expires' => 'Wed, 13-Jan-2021 22:23:01 GMT',
                    'secure'  => true,
                    'httponly'=> true
                ],
                'myname=myvalue; Expires=Wed, 13-Jan-2021 22:23:01 GMT; Domain=docs.foo.com; Path=/accounts; Secure; HttpOnly'
            ],
        ];
    }

    public function invalidCookieComponentValues()
    {
        return [
            'setName'   => ['setName', "This\r\nis\nan\revil\r\n\r\nvalue"],
            'setValue'  => ['setValue', "This\r\nis\nan\revil\r\n\r\nvalue"],
            'setDomain' => ['setDomain', "This\r\nis\nan\revil\r\n\r\nvalue"],
            'setPath'   => ['setPath', "This\r\nis\nan\revil\r\n\r\nvalue"],
        ];
    }

    /**
     * @group ZF2015-04
     * @dataProvider invalidCookieComponentValues
     */
    public function testDoesNotAllowCRLFAttackVectorsViaSetters($setter, $value)
    {
        $cookie = new Zend_Http_Header_SetCookie();
        $this->setExpectedException('Zend_Http_Header_Exception_InvalidArgumentException');
        $cookie->{$setter}($value);
    }
}
