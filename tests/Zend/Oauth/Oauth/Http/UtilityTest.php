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

require_once 'Zend/Oauth/Http/Utility.php';

/**
 * @category   Zend
 * @package    Zend_Oauth
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Oauth
 * @group      Zend_Oauth_Http
 */
class Zend_Oauth_Http_UtilityTest extends TestCase
{
    // see: http://wiki.oauth.net/TestCases (Parameter Encoding Tests)

    public function testUrlEncodeCorrectlyEncodesAlnum()
    {
        $string = 'abcABC123';
        $this->assertEquals('abcABC123', Zend_Oauth_Http_Utility::urlEncode($string));
    }

    public function testUrlEncodeCorrectlyEncodesUnreserved()
    {
        $string = '-._~';
        $this->assertEquals('-._~', Zend_Oauth_Http_Utility::urlEncode($string));
    }

    public function testUrlEncodeCorrectlyEncodesPercentSign()
    {
        $string = '%';
        $this->assertEquals('%25', Zend_Oauth_Http_Utility::urlEncode($string));
    }

    public function testUrlEncodeCorrectlyEncodesPlusSign()
    {
        $string = '+';
        $this->assertEquals('%2B', Zend_Oauth_Http_Utility::urlEncode($string));
    }

    public function testUrlEncodeCorrectlyEncodesAmpEqualsAndAsterix()
    {
        $string = '&=*';
        $this->assertEquals('%26%3D%2A', Zend_Oauth_Http_Utility::urlEncode($string));
    }

    public function testUrlEncodeCorrectlyEncodesSpace()
    {
        $string = ' ';
        $this->assertEquals('%20', Zend_Oauth_Http_Utility::urlEncode($string));
    }

    public function testUrlEncodeCorrectlyEncodesLineFeed()
    {
        $string = "\n";
        $this->assertEquals('%0A', Zend_Oauth_Http_Utility::urlEncode($string));
    }

    public function testUrlEncodeCorrectlyEncodesU007F()
    {
        $string = chr(127);
        $this->assertEquals('%7F', Zend_Oauth_Http_Utility::urlEncode($string));
    }

    public function testUrlEncodeCorrectlyEncodesU0080()
    {
        $string = "\xC2\x80";
        $this->assertEquals('%C2%80', Zend_Oauth_Http_Utility::urlEncode($string));
    }

    public function testUrlEncodeCorrectlyEncodesU3001()
    {
        $string = '、';
        $this->assertEquals('%E3%80%81', Zend_Oauth_Http_Utility::urlEncode($string));
    }
}
