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
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

require_once 'Zend/Oauth/Signature/Plaintext.php';

/**
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Oauth
 * @group      Zend_Oauth_Signature
 */
class Zend_Oauth_Signature_AbstractTest extends TestCase
{
    public function testNormaliseHttpBaseSignatureUrl()
    {
        $sign = new Zend_Oauth_Signature_Plaintext('foo');
        $url = 'HTTP://WWW.EXAMPLE.COM:80/REQUEST';
        $this->assertEquals('http://www.example.com/REQUEST', $sign->normaliseBaseSignatureUrl($url));
    }

    public function testNormaliseHttpsBaseSignatureUrl()
    {
        $sign = new Zend_Oauth_Signature_Plaintext('foo');
        $url = 'HTTPS://WWW.EXAMPLE.COM:443/REQUEST';
        $this->assertEquals('https://www.example.com/REQUEST', $sign->normaliseBaseSignatureUrl($url));
    }

    public function testNormaliseHttpPortBaseSignatureUrl()
    {
        $sign = new Zend_Oauth_Signature_Plaintext('foo');
        $url = 'HTTP://WWW.EXAMPLE.COM:443/REQUEST';
        $this->assertEquals('http://www.example.com:443/REQUEST', $sign->normaliseBaseSignatureUrl($url));
    }

    public function testNormaliseHttpsPortBaseSignatureUrl()
    {
        $sign = new Zend_Oauth_Signature_Plaintext('foo');
        $url = 'HTTPS://WWW.EXAMPLE.COM:80/REQUEST';
        $this->assertEquals('https://www.example.com:80/REQUEST', $sign->normaliseBaseSignatureUrl($url));
    }

    public function testNormaliseHttpsRemovesFragmentFromBaseSignatureUrl()
    {
        $sign = new Zend_Oauth_Signature_Plaintext('foo');
        $url = 'https://www.example.com/request#foo';
        $this->assertEquals('https://www.example.com/request', $sign->normaliseBaseSignatureUrl($url));
    }

    public function testNormaliseHttpsRemovesQueryFromBaseSignatureUrl()
    {
        $sign = new Zend_Oauth_Signature_Plaintext('foo');
        $url = 'https://www.example.com/request?foo=bar';
        $this->assertEquals('https://www.example.com/request', $sign->normaliseBaseSignatureUrl($url));
    }
}
